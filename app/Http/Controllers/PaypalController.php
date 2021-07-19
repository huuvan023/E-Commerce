<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use App\Shipping;
use App\Coupon;
use Carbon\Carbon;
use Session;
use App\Order;
use App\OrderDetails;
use Illuminate\Support\Facades\Redirect;

use function Matrix\trace;

class PaypalController extends Controller
{

    public function create(Request $request)
    {
        if(Session::get('cart') == true) {
        $apiContext = new \PayPal\Rest\ApiContext(
            new \PayPal\Auth\OAuthTokenCredential(
                'ARMH8dssshct74JjNFckb3frVtX9n2PuHd3nEWf8BDwoR_lrtNBw4Zu9h9-NSumW37TRLZ2KG6PJjFMQ',     // ClientID
                'EEEpvRNCJyf-IfZDqb_JTVo6QPx4UwaUFGK64DfkprWDshlvsxRrmVzYuxMDKNiT6l_2DvDEkQ993HhD'      // ClientSecret
            )
        );

        $payer = new Payer();
        $payer->setPaymentMethod("paypal");



        $Items = Session::get('cart');
        $subtotal = 0;
        foreach ($Items as $element) {
            $item = new Item();
            $name = $element['product_name'];
            $quantity = (int)$element['product_qty'];
            $sku = $element['product_id'];
            $price = $element['product_price'];
            $total = $element['product_qty'] * round($element['product_price'] / 23000, 2);

            $subtotal += $total;
            $item->setName($name)
                ->setCurrency('USD')
                ->setQuantity($quantity)
                ->setSku($sku)
                ->setPrice($price /  23000);
            $result[] = $item;
        }

        $itemList = new ItemList();
        $itemList->setItems($result);


        $details = new Details();
        $details->setShipping(0)
            ->setTax(0)
            ->setSubtotal($subtotal);

        $amount = new Amount();
        $amount->setCurrency("USD")
            ->setTotal($subtotal);
        // dd($amount);
        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($itemList)
            ->setDescription("Payment description")
            ->setInvoiceNumber(uniqid());
        //dd($transaction);
        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl("http://heravn.herokuapp.com/execute-payment")
            ->setCancelUrl("http://heravn.herokuapp.com/cancel");

        $payment = new Payment();
        $payment->setIntent("sale")
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrls)
            ->setTransactions(array($transaction));


        $payment->create($apiContext);

        Session::put('payment_id', $payment->id);
        return redirect($payment->getApprovalLink());
    }
    else echo "Vui lòng thêm sản phẩm vào giỏ hàng";
    }
    public function execute(Request $request)
    {

        $apiContext = new \PayPal\Rest\ApiContext(
            new \PayPal\Auth\OAuthTokenCredential(
                'ARMH8dssshct74JjNFckb3frVtX9n2PuHd3nEWf8BDwoR_lrtNBw4Zu9h9-NSumW37TRLZ2KG6PJjFMQ',     // ClientID
                'EEEpvRNCJyf-IfZDqb_JTVo6QPx4UwaUFGK64DfkprWDshlvsxRrmVzYuxMDKNiT6l_2DvDEkQ993HhD'      // ClientSecret
            )
        );
        $Items = Session::get('cart');
        $subtotal = 0;
        foreach ($Items as $element) {

            $name = $element['product_name'];
            $quantity = (int)$element['product_qty'];
            $sku = $element['product_id'];
            $price = $element['product_price'];
            $total = $element['product_qty'] * round($element['product_price'] / 23000, 2);
            $subtotal += $total;
            $item = new Item();
            $item->setName($name)
                ->setCurrency('USD')
                ->setQuantity($quantity)
                ->setSku($sku) // Similar to `item_number` in Classic API
                ->setPrice($price /  23000);
            $results[] = $item;
        }

        $paymentId = request('paymentId');
        $payment = Payment::get($paymentId, $apiContext);

        $execution = new PaymentExecution();
        $execution->setPayerId(request('PayerID'));

        $transaction = new  Transaction();
        $amount = new Amount();
        $details = new Details();
        $details->setShipping(0)
            ->setTax(0)
            ->setSubtotal($subtotal);



        $amount->setCurrency('USD');
        $amount->setTotal($subtotal);
        $amount->setDetails($details);
        $transaction->setAmount($amount);

        $execution->addTransaction($transaction);
        $result = $payment->execute($execution, $apiContext);
        // dd($result);
        if ($result->state == 'approved') {
            $shipping = new Shipping();
            $shipping->shipping_name = $result->payer->payer_info->shipping_address->recipient_name;
            $shipping->shipping_email = $result->payer->payer_info->email;
            $shipping->shipping_phone = $result->payer->payer_info->email;
            $line1 = $result->payer->payer_info->shipping_address->line1;
            $line2 = $result->payer->payer_info->shipping_address->line2;
            $city = $result->payer->payer_info->shipping_address->city;
            $shipping->shipping_address = $line1 . ' ' . $line2 . ' ' . $city;
            $shipping->shipping_notes = 'Không';
            $shipping->shipping_method = 2;
            $shipping->save();
            $shipping_id = $shipping->shipping_id;

            $checkout_code = substr(md5(microtime()), rand(0, 26), 5);


            $order = new Order;
            $order->customer_id = Session::get('customer_id');
            $order->shipping_id = $shipping_id;
            $order->order_status = 3;
            $order->order_code = $checkout_code;
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $today = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s');
            $order_date = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
            $order->created_at = $today;
            $order->order_date = $order_date;

            $order->save();


            if (Session::get('cart') == true) {
                foreach (Session::get('cart') as $key => $cart) {
                    $order_details = new OrderDetails;
                    $order_details->order_code = $checkout_code;
                    $order_details->product_id = $cart['product_id'];
                    $order_details->product_name = $cart['product_name'];
                    $order_details->product_price = $cart['product_price'];
                    $order_details->product_sales_quantity = $cart['product_qty'];
                    $order_details->product_coupon =  'no';
                    $order_details->save();
                }
            }

            Session::forget('coupon');
            Session::forget('cart');
            return Redirect::to('success');
        } else return Redirect::to('cancel');
    }
    public function success(Request $request)
    {

        return view('pages.paypal.success');
    }
    public function cancel()
    {
        return view('pages.paypal.cancel');
    }
}

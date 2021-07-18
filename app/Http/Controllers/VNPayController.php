<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Cart;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;

session_start();

use App\Slider;
use App\Shipping;
use App\Order;
use Carbon\Carbon;
use App\OrderDetails;
use App\Brand;
use App\Customer;
use App\CategoryProductModel;
use App\Product;
use App\Coupon;

class VNPayController extends Controller
{

    public function vnpay(Request $request)
    {
        //slide
        if(Session::get('cart') == true) {
        $slider = Slider::orderBy('slider_id', 'DESC')->where('slider_status', '1')->take(4)->get();
        $cate_product = CategoryProductModel::where('category_status', '0')->orderby('category_id', 'desc')->get();
        $brand_product = Brand::where('brand_status', '0')->orderby('brand_id', 'desc')->get();
        $slider = Slider::orderBy('slider_id', 'DESC')->where('slider_status', '1')->take(4)->get();
        $cate_product = CategoryProductModel::where('category_status', '0')->orderby('category_id', 'desc')->get();
        $brand_product = Brand::where('brand_status', '0')->orderby('brand_id', 'desc')->get();

        $Items = Session::get('cart');
        $subtotal = 0;
        foreach ($Items as $element) {
            $total = $element['product_qty'] * $element['product_price'];
            $subtotal += $total;
        }

        return view('pages.vnpay.index')->with('category', $cate_product)->with('brand', $brand_product)->with('slider', $slider)->with('subtotal', $subtotal);
    }
    else  echo "Vui lòng thêm sản phẩm vào giỏ hàng";


        // return view('pages.home')->with(compact('cate_product','brand_product','all_product')); //2
    }
    public function create_payment_online(Request $request)
    {
        $checkout_code = substr(md5(microtime()),rand(0,26),5); 
       $vnp_TxnRef = $checkout_code; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = $request->order_desc;
        $vnp_OrderType = $request->order_type;
        $vnp_Amount = $request->amount * 100;
        $vnp_Locale = $request->language;
        $vnp_BankCode = $request->bank_code;
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

        $inputData = array(
            "vnp_Version" => "2.0.0",
            "vnp_TmnCode" => 'THVG4MD0',
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => 'http://heravn.herokuapp.com/vnpay-return',
            "vnp_TxnRef" => $vnp_TxnRef,
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . $key . "=" . $value;
            } else {
                $hashdata .= $key . "=" . $value;
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = 'http://sandbox.vnpayment.vn/paymentv2/vpcpay.html' . "?" . $query;
        if ('VCOKDAMNZBARVGEARVLSRBQLCAMLNLMI') {
            // $vnpSecureHash = md5($vnp_HashSecret . $hashdata);
            $vnpSecureHash = hash('sha256', 'VCOKDAMNZBARVGEARVLSRBQLCAMLNLMI' . $hashdata);
            $vnp_Url .= 'vnp_SecureHashType=SHA256&vnp_SecureHash=' . $vnpSecureHash;
        }

        return Redirect::to($vnp_Url);
    }  
    


    public function vnpay_return(Request $request)
    {
        if( $request -> vnp_ResponseCode == '00'){
        $vnpayData = $request->all();
      
      
        if(Session::get('payment') == true) {
            foreach (Session::get('payment') as $key => $payment) {
                $shipping = new Shipping();
                $shipping->shipping_name = $payment['shipping_name'];
                $shipping->shipping_email = $payment['shipping_email'];
                $shipping->shipping_phone = $payment['shipping_phone'];
                $shipping->shipping_address = $payment['shipping_address'];
                $shipping->shipping_notes = $payment['shipping_notes'];
                $shipping->shipping_method = $payment['shipping_method'];
                $shipping->save();
            }
        }
        $shipping_id = $shipping->shipping_id;
          
        $order = new Order;
        $order->customer_id = Session::get('customer_id');
        $order->shipping_id = $shipping_id;
        $order->order_status = 4;
        $order->order_code = $request->vnp_TxnRef;
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $today=Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s');
        $order_date=Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
        $order->created_at = $today;
        $order->order_date= $order_date;
        $order_code= $order-> order_code;
        $order->save();
        
        if (Session::get('cart') == true) {
            foreach (Session::get('cart') as $key => $cart) {
                $order_details = new OrderDetails;
                $order_details->order_code = $request->vnp_TxnRef;
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
        Session::forget('payment');

    return view('pages.vnpay.vnpay_return', compact('vnpayData'));

    }
}

    public function vnpay_payment(Request $request)
    {
      $data= $request->all();
        $session_id = substr(md5(microtime()), rand(0, 26), 5);
       // $payment = Session::get('payment');
        $payment[] = array(
            'session_id' => $session_id,
            'shipping_email' => $data['shipping_email'],
            'shipping_name' => $data['shipping_name'],
            'shipping_address' => $data['shipping_address'],
            'shipping_phone' => $data['shipping_phone'],
            'shipping_notes' => $data['shipping_notes'],
            'shipping_method' => 1

        );
        Session::put('payment', $payment);

        Session::save();
      
    }
}

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
class CheckoutController extends Controller
{
    
    public function confirm_order(Request $request){
         $data = $request->all();
         $coupon= Coupon::where('coupon_code',$data['order_coupon'])->first();
         if($coupon){
         $coupon->coupon_time=$coupon-> coupon_time - 1;
         $coupon->save();
         }
    
         $shipping = new Shipping();
         $shipping->shipping_name = $data['shipping_name'];
         $shipping->shipping_email = $data['shipping_email'];
         $shipping->shipping_phone = $data['shipping_phone'];
         $shipping->shipping_address = $data['shipping_address'];
         $shipping->shipping_notes = $data['shipping_notes'];
         $shipping->shipping_method = $data['shipping_method'];
         $shipping->save();
         $shipping_id = $shipping->shipping_id;

         $checkout_code = substr(md5(microtime()),rand(0,26),5);

  
         $order = new Order;
         $order->customer_id = Session::get('customer_id');
         $order->shipping_id = $shipping_id;
         $order->order_status = 1;
         $order->order_code = $checkout_code;
         date_default_timezone_set('Asia/Ho_Chi_Minh');
         $today=Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s');
         $order_date=Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
         $order->created_at = $today;
         $order->order_date= $order_date;
         
         $order->save();

         if(Session::get('cart')==true){
            foreach(Session::get('cart') as $key => $cart){
                $order_details = new OrderDetails;
                $order_details->order_code = $checkout_code;
                $order_details->product_id = $cart['product_id'];
                $order_details->product_name = $cart['product_name'];
                $order_details->product_price = $cart['product_price'];
                $order_details->product_sales_quantity = $cart['product_qty'];
                $order_details->product_coupon =  $data['order_coupon'];
                $order_details->save();
            }
         }
        
         Session::forget('coupon');
         Session::forget('cart');
    }


     public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    public function view_order($orderId){
        $this->AuthLogin();
        $order_by_id = Order::join('tbl_customers','tbl_order.customer_id','=','tbl_customers.customer_id')
        ->join('tbl_shipping','tbl_order.shipping_id','=','tbl_shipping.shipping_id')
        ->join('tbl_order_details','tbl_order.order_id','=','tbl_order_details.order_id')
        ->select('tbl_order.*','tbl_customers.*','tbl_shipping.*','tbl_order_details.*')->first();

        $manager_order_by_id  = view('admin.view_order')->with('order_by_id',$order_by_id);
        return view('admin_layout')->with('admin.view_order', $manager_order_by_id);
        
    }
    public function login_checkout(Request $request){
         //slide
        $slider = Slider::orderBy('slider_id','DESC')->where('slider_status','1')->take(4)->get();
    	$cate_product = CategoryProductModel::where('category_status','0')->orderby('category_id','desc')->get();
        $brand_product = Brand::where('brand_status','0')->orderby('brand_id','desc')->get(); 

    	return view('pages.checkout.login_checkout')->with('category',$cate_product)->with('brand',$brand_product)->with('slider',$slider);
    }
    public function add_customer(Request $request){
        $data = $request->validate(
    		[
				'customer_name' => 'required|min:3',
                'customer_email' => 'required|email|unique:tbl_customers',
                'customer_password' => 'required|min:6',
                'customer_phone' => 'required|min:10',
			],
			[
				'customer_name.required' => 'Họ tên không được để trống',
				'customer_name.min' => 'Vui lòng điền lớn hơn 3 kí tự',
				'customer_email.required' => 'Email không được để trống',
                'customer_email.email' => 'Sai định dạng email',
                'customer_email.unique' => 'Email đã được dùng để đăng kí',
                'customer_password.required' => 'Password không được để trống',
				'customer_password.min' => 'Vui lòng điền lớn hơn 6 kí tự',
                'customer_phone.required' => 'Số điện thoại không được để trống',
                'customer_phone.min' => 'Sai định dạng'
			]
            );
    	$data['customer_name'] = $request->customer_name;
    	$data['customer_phone'] = $request->customer_phone;
    	$data['customer_email'] = $request->customer_email;

    	$data['customer_password'] = md5($request->customer_password);

    	$customer_id = Customer::insertGetId($data);

    	Session::put('customer_id',$customer_id);
    	Session::put('customer_name',$request->customer_name);
    	return Redirect::to('/checkout');


    }
    public function checkout(Request $request){
         //slide
        $slider = Slider::orderBy('slider_id','DESC')->where('slider_status','1')->take(4)->get();
    	$cate_product = CategoryProductModel::where('category_status','0')->orderby('category_id','desc')->get();
        $brand_product = Brand::where('brand_status','0')->orderby('brand_id','desc')->get(); 
       

    	return view('pages.checkout.show_checkout')->with('category',$cate_product)->with('brand',$brand_product)->with('slider',$slider);
    }
    public function order_place(Request $request){
        //insert order
        $order_data = array();
        $order_data['customer_id'] = Session::get('customer_id');
        $order_data['shipping_id'] = Session::get('shipping_id');
        $order_data['order_total'] = Cart::total();
        $order_data['order_status'] = 'Đang chờ xử lý';
        $order_id = Order::insertGetId($order_data);

        //insert order_details
        $content = Cart::content();
        foreach($content as $v_content){
            $order_d_data['order_id'] = $order_id;
            $order_d_data['product_id'] = $v_content->id;
            $order_d_data['product_name'] = $v_content->name;
            $order_d_data['product_price'] = $v_content->price;
            $order_d_data['product_sales_quantity'] = $v_content->qty;
            OrderDetails::insert($order_d_data);
        }
        if($data['payment_method']==1){

            echo 'Thanh toán thẻ ATM';

        }elseif($data['payment_method']==2){
            Cart::destroy();

            $cate_product = CategoryProductModel::where('category_status','0')->orderby('category_id','desc')->get();
            $brand_product = Brand::where('brand_status','0')->orderby('brand_id','desc')->get(); 
            return view('pages.checkout.handcash')->with('category',$cate_product)->with('brand',$brand_product);

        }else{
            echo 'Thẻ ghi nợ';

        }
        
        //return Redirect::to('/payment');
    }
    public function logout_checkout(){
    	Session::forget('customer_id');
    	return Redirect::to('/dang-nhap');
    }
    public function login_customer(Request $request){
    	$email = $request->email_account;
    	$password = md5($request->password_account);
    	$result = Customer::where('customer_email',$email)->where('customer_password',$password)->first();
    	
    	
    	if($result){
           
    		Session::put('customer_id',$result->customer_id);
    		return Redirect::to('/checkout');
    	}
        else{
            Session::put('message','Tài khoản hoặc mật khẩu không đúng');
    		return Redirect::to('/dang-nhap');

    	}

        Session::save();

    }
    public function info_customer($customer_id){
        //slide
        $cus = Customer::find($customer_id);
        $slider = Slider::orderBy('slider_id','DESC')->where('slider_status','1')->take(4)->get();
    	$cate_product = CategoryProductModel::where('category_status','0')->orderby('category_id','desc')->get();
        $brand_product = Brand::where('brand_status','0')->orderby('brand_id','desc')->get(); 
       

    	return view('pages.checkout.customer_info')->with('category',$cate_product)->with('brand',$brand_product)->with('slider',$slider)->with('customer',$cus);
       //   $manager_cus  = view('pages.checkout.customer_info');
  
        //  return view('layout')->with('pages.checkout.customer_info');
        
    }
    public function update_customer(Request $request,$customer_id){
        
    	$this->AuthLogin();
        $data = $request->all();
        $customer = Customer::find($customer_id);
        // $brand = new Brand();
        $customer->customer_name = $data['customer_name'];
        $customer->customer_email = $data['customer_email'];
        $customer->customer_phone = $data['customer_phone'];
        $customer->save();
    
    
        return Redirect::to('thong-tin/'.$customer_id);
     
    }
    
    public function manage_order(){
        
        $this->AuthLogin();
        $all_order = Order::join('tbl_customers','tbl_order.customer_id','=','tbl_customers.customer_id')
        ->select('tbl_order.*','tbl_customers.customer_name')
        ->orderby('tbl_order.order_id','desc')->get();
        $manager_order  = view('admin.manage_order')->with('all_order',$all_order);
        return view('admin_layout')->with('admin.manage_order', $manager_order);
    }
}

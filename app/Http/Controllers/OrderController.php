<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Shipping;
use App\Order;
use App\OrderDetails;
use App\Customer;
use App\Coupon;
use App\Product;
use App\statistic;
use Carbon\Carbon;
use PDF;
use App\Brand;
use App\Slider;
use App\CategoryProductModel;

class OrderController extends Controller
{

	public function update_order_qty(Request $request){
		//update order
		$data = $request->all();
		$order = Order::find($data['order_id']);
		$order->order_status = $data['order_status'];
		$order->save();

		//order_date--them
		$order_date=$order->order_date;
		$statistic=statistic::where('order_date',$order_date)->get();
		
		
		if($statistic){
			$statistic_count= $statistic->count();
		}else{
			$statistic_count=0;
		}


		if($order->order_status==2){
//Them
			$total_order=0;
			$sales=0;
			$quantity=0;
			foreach($data['order_product_id'] as $key => $product_id){
				
				$product = Product::find($product_id);
				$product_quantity = $product->product_quantity;
				$product_sold = $product->product_sold;
				//Them
				$product_price=$product->product_price;
			//	$now = Carbon::now('Asia/Ho_Chi_Minh')->toDayeString();
				foreach($data['quantity'] as $key2 => $qty){
						if($key==$key2){
							//sp con lai
								$pro_remain = $product_quantity - $qty;
							//update lại soluong
								$product->product_quantity = $pro_remain;
							//sp đa ban
								$product->product_sold = $product_sold + $qty;
								$product->save();
								//Update doanh thu
								$quantity+=$qty;
								$total_order+=1;
								$sales+=$product_price*$qty;

						}
				}
			}
			//update doanh so db
			if($statistic_count>0){
				$statistic_update=statistic::where('order_date',$order_date)->first();
				$statistic_update->sales=$statistic_update->sales+$sales;
				$statistic_update->quantity=$statistic_update->quantity+$quantity;
				$statistic_update->total_order=$statistic_update->total_order+$total_order;
				$statistic_update->save();
			}
			else{
			
				$statistic_new= new statistic();
				$statistic_new->order_date=$order_date;
				$statistic_new->sales=$sales;
				$statistic_new->quantity=$quantity;
				$statistic_new->total_order=$total_order;
				$statistic_new->save();

			}
		}
	}
	public function print_order($checkout_code){
		$pdf = \App::make('dompdf.wrapper');
		$pdf->loadHTML($this->print_order_convert($checkout_code));
		
		return $pdf->stream();
	}
	public function print_order_convert($checkout_code){
		$order_details = OrderDetails::where('order_code',$checkout_code)->get();
		$order = Order::where('order_code',$checkout_code)->get();
		foreach($order as $key => $ord){
			$customer_id = $ord->customer_id;
			$shipping_id = $ord->shipping_id;
		}
		$customer = Customer::where('customer_id',$customer_id)->first();
		$shipping = Shipping::where('shipping_id',$shipping_id)->first();

		$order_details_product = OrderDetails::with('product')->where('order_code', $checkout_code)->get();

		foreach($order_details_product as $key => $order_d){

			$product_coupon = $order_d->product_coupon;
		}
		if($product_coupon != 'no'){
			$coupon = Coupon::where('coupon_code',$product_coupon)->first();

			$coupon_condition = $coupon->coupon_condition;
			$coupon_number = $coupon->coupon_number;

			if($coupon_condition==1){
				$coupon_echo = $coupon_number.'%';
			}elseif($coupon_condition==2){
				$coupon_echo = number_format($coupon_number,0,',','.').'đ';
			}
		}else{
			$coupon_condition = 2;
			$coupon_number = 0;

			$coupon_echo = '0';
		
		}

		$output = '';

		$output.='<style>body{
			font-family: DejaVu Sans;
		}
		.table-styling{
			border:1px solid #000;
		}
		.table-styling tbody tr td{
			border:1px solid #000;
		}
		</style>
		<h1><centerCông ty TNHH một thành viên ABCD</center></h1>
		<h4><center>Độc lập - Tự do - Hạnh phúc</center></h4>
		<p>Người đặt hàng</p>
		<table class="table-styling">
				<thead>
					<tr>
						<th>Tên khách đặt</th>
						<th>Số điện thoại</th>
						<th>Email</th>
					</tr>
				</thead>
				<tbody>';
				
		$output.='		
					<tr>
						<td>'.$customer->customer_name.'</td>
						<td>'.$customer->customer_phone.'</td>
						<td>'.$customer->customer_email.'</td>
						
					</tr>';
				

		$output.='				
				</tbody>
			
		</table>

		<p>Ship hàng tới</p>
			<table class="table-styling">
				<thead>
					<tr>
						<th>Tên người nhận</th>
						<th>Địa chỉ</th>
						<th>Sdt</th>
						<th>Email</th>
						<th>Ghi chú</th>
					</tr>
				</thead>
				<tbody>';
				
		$output.='		
					<tr>
						<td>'.$shipping->shipping_name.'</td>
						<td>'.$shipping->shipping_address.'</td>
						<td>'.$shipping->shipping_phone.'</td>
						<td>'.$shipping->shipping_email.'</td>
						<td>'.$shipping->shipping_notes.'</td>
						
					</tr>';
				

		$output.='				
				</tbody>
			
		</table>

		<p>Đơn hàng đặt</p>
			<table class="table-styling">
				<thead>
					<tr>
						<th>Tên sản phẩm</th>
						<th>Mã giảm giá</th>
						<th>Phí ship</th>
						<th>Số lượng</th>
						<th>Giá sản phẩm</th>
						<th>Thành tiền</th>
					</tr>
				</thead>
				<tbody>';
			
				$total = 0;

				foreach($order_details_product as $key => $product){

					$subtotal = $product->product_price*$product->product_sales_quantity;
					$total+=$subtotal;

					if($product->product_coupon!='no'){
						$product_coupon = $product->product_coupon;
					}else{
						$product_coupon = 'không mã';
					}		

		$output.='		
					<tr>
						<td>'.$product->product_name.'</td>
						<td>'.$product_coupon.'</td>
					
						<td>'.$product->product_sales_quantity.'</td>
						<td>'.number_format($product->product_price,0,',','.').'đ'.'</td>
						<td>'.number_format($subtotal,0,',','.').'đ'.'</td>
						
					</tr>';
				}

				if($coupon_condition==1){
					$total_after_coupon = ($total*$coupon_number)/100;
	                $total_coupon = $total - $total_after_coupon;
				}else{
                  	$total_coupon = $total - $coupon_number;
				}

		$output.= '<tr>
				<td colspan="2">
					<p>Tổng giảm: '.$coupon_echo.'đ'.'</p>
                    <p>Thanh toán: '.number_format($total_coupon,0,',','.').'đ'.'</p>
			
				</td>
		</tr>';
		$output.='				
				</tbody>
			
		</table>

		<p>Ký tên</p>
			<table>
				<thead>
					<tr>
						<th width="200px">Người lập phiếu</th>
						<th width="800px">Người nhận</th>
						
					</tr>
				</thead>
				<tbody>';
						
		$output.='				
				</tbody>
			
		</table>

		';


		return $output;

	}
	public function view_order($order_code){
		$order_details = OrderDetails::with('product')->where('order_code',$order_code)->get();
		$order = Order::where('order_code',$order_code)->get();
		foreach($order as $key => $ord){
			$customer_id = $ord->customer_id;
			$shipping_id = $ord->shipping_id;
			$order_status = $ord->order_status;
		}
		$customer = Customer::where('customer_id',$customer_id)->first();
		$shipping = Shipping::where('shipping_id',$shipping_id)->first();

		$order_details_product = OrderDetails::with('product')->where('order_code', $order_code)->get();

		foreach($order_details_product as $key => $order_d){

			$product_coupon = $order_d->product_coupon;
		}
		if($product_coupon != 'no'){
			$coupon = Coupon::where('coupon_code',$product_coupon)->first();
			$coupon_condition = $coupon->coupon_condition;
			$coupon_number = $coupon->coupon_number;
		}else{
			$coupon_condition = 2;
			$coupon_number = 0;
		}
		
		return view('admin.view_order')->with(compact('order_details','customer','shipping','order_details','coupon_condition','coupon_number','order','order_status'));

	}
    public function manage_order(){
    	$order = Order::orderby('created_at','DESC')->paginate(10);
    	return view('admin.manage_order')->with(compact('order'));
    }
	public function history_cus(Request $request, $customer_id){
        $slider = Slider::orderBy('slider_id','DESC')->where('slider_status','1')->take(4)->get();
    	$cate_product = CategoryProductModel::where('category_status','0')->orderby('category_id','desc')->get();
        $brand_product = Brand::where('brand_status','0')->orderby('brand_id','desc')->get(); 
       
    	$getorder = Order::where('customer_id',$customer_id)->orderBy('order_id','DESC')->paginate(10);;
    	return view('pages.history.customer_order')->with('category',$cate_product)->with('brand',$brand_product)->with('slider',$slider)->with('getorder',$getorder);
    }
	public function view_order_cus($order_code){
		$slider = Slider::orderBy('slider_id','DESC')->where('slider_status','1')->take(4)->get();
    	$cate_product = CategoryProductModel::where('category_status','0')->orderby('category_id','desc')->get();
        $brand_product = Brand::where('brand_status','0')->orderby('brand_id','desc')->get(); 


		$order_details_cus = OrderDetails::with('product')->where('order_code',$order_code)->get();
		$order_cus = Order::where('order_code',$order_code)->get();
		foreach($order_cus as $key => $ord){
			$customer_id = $ord->customer_id;
			$order_status = $ord->order_status;
		}
		$customer = Customer::where('customer_id',$customer_id)->first();

		$order_details_product = OrderDetails::with('product')->where('order_code', $order_code)->get();

		foreach($order_details_product as $key => $order_d){

			$product_coupon = $order_d->product_coupon;
		}
		if($product_coupon != 'no'){
			$coupon = Coupon::where('coupon_code',$product_coupon)->first();
			$coupon_condition = $coupon->coupon_condition;
			$coupon_number = $coupon->coupon_number;
		}else{
			$coupon_condition = 2;
			$coupon_number = 0;
		}
		
		return view('pages.history.customer_order_history')->with('category',$cate_product)->with('brand',$brand_product)->with('slider',$slider)->with(compact('order_details_cus','customer','coupon_condition','coupon_number','order_cus','order_status'));

	}
}

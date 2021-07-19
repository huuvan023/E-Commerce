@extends('layout')
@section('content')

<section id="cart_items">
	<div class="container">
		<div class="breadcrumbs">
			<ol class="breadcrumb">
				<li><a href="{{URL::to('/')}}">Trang chủ</a></li>
				<li class="active">Thanh toán giỏ hàng</li>
			</ol>
		</div>

		<div class="register-req">
			<p>Làm ơn đăng ký hoặc đăng nhập để thanh toán giỏ hàng và xem lại lịch sử mua hàng</p>
		</div>
		<!--/register-req-->

		<div class="shopper-informations">
			<div class="row">

				<div class="col-sm-12 clearfix">
					<div class="bill-to">
						<h3>Điền thông tin gửi hàng</h3>
						<div class="form-one">

							<form method="POST">
								@csrf
								<input type="text" name="shipping_email" class="shipping_email" placeholder="Điền email" required>
								<input type="text" name="shipping_name" class="shipping_name" placeholder="Họ và tên người gửi" required>
								<input type="text" name="shipping_address" class="shipping_address" placeholder="Địa chỉ gửi hàng" required>
								<input type="text" name="shipping_phone" class="shipping_phone" placeholder="Số điện thoại" required>
								<textarea name="shipping_notes" class="shipping_notes" placeholder="Ghi chú đơn hàng của bạn" rows="5" required></textarea>


								@if(Session::get('coupon'))
								@foreach(Session::get('coupon') as $key => $cou)
								<input type="hidden" name="order_coupon" class="order_coupon" value="{{$cou['coupon_code']}}">
								@endforeach
								@else
								<input type="hidden" name="order_coupon" class="order_coupon" value="no">
								@endif



								<div class="list-group">
									<div class="mypage_tt">
										<h4>Phương thức thanh toán</h4>
									</div>
						
									<div class="custom-control custom-radio list-group-item img_hover">
										
										<label class="custom-control-label" for="pm_cod">
										<submit  class="custom-control-input blue-input send_order_vnpay" id="vnpay" name="send_order_vnpay"/>
										<img  src="{{asset('public/frontend/images/vnpaylo.png')}}" width="100px" height="40px" > Thanh toán online qua VNPAY
									
										</label>
									</div>
								
									<div class="custom-control custom-radio list-group-item img_hover">
										
										<label class="custom-control-label" for="pm_cod">
										<submit  class="custom-control-input blue-input send_order" id="cod" name="send_order"/>
										<img  id="img" src="https://static.fado.vn/uploads/payment-method/2021/01/08/Fado.VN_1610090377.8367.svg"  width="60px" height="50px"/> Thanh toán khi nhận hàng (COD)
										</label>
									</div>

							
								</div>
							</form>
			
							<form action="{{URL::to('/create-payment')}}" method="post">
								@csrf
								<div id="paypal-button">
								<label class="custom-control-label">
									<input type="image" src='https://www.paypalobjects.com/marketing/web/vn/manage-my-paypal-account/PP-AcceptanceMarkTray-NoDiscover-243x40-optimised.png' alt='Submit' /> Thanh toán online qua PayPal
								</label>
								</div>
							</form>
						</div>
						

		<div class="col-sm-12 col-md-5" id="note"> 
      <div class="note-label is-dot-list mz-mb-2">
        *Quý khách có thể nhanh chóng thanh toán đơn hàng . Thời gian thanh toán đơn hàng không bó buộc trong giờ hành chính và có thể giao dịch 24/7.
      </div>
      <div class="note-label is-dot-list mz-mb-2">
        *Tất cả các giao dịch trong ZaloPay <span class="mz-font-semibold">hoàn toàn không mất phí</span>.
      </div>
      <div class="note-label is-dot-list mz-mb-2">
        *Đối tác thanh toán: <span class="mz-font-semibold mz-text-gray-dark">VISA, Master Card, JCB, Vietcombank, Viettinbank, BIDV, Sacombank, Eximbank, SCB, Ngân hàng Bản Việt, ...</span> (Thẻ phát hành trong nước)
      </div>
    </div> 
				
						<div class="table-responsive cart_info">
							<table class="table table-condensed">
								<thead>
									<tr class="cart_menu">
										<td class="image">Hình ảnh</td>
										<td class="description">Tên sản phẩm</td>
										<td class="price">Giá sản phẩm</td>
										<td class="quantity">Số lượng</td>
										<td class="total">Thành tiền</td>
										<td></td>
									</tr>
								</thead>
								<tbody>
									@if(Session::get('cart')==true)
									@php
									$total = 0;
									@endphp
									@foreach(Session::get('cart') as $key => $cart)
									@php
									$subtotal = $cart['product_price']*$cart['product_qty'];
									$total+=$subtotal;
									@endphp

									<tr>
										<td class="cart_product">
											<img src="{{asset('public/uploads/product/'.$cart['product_image'])}}" width="90" alt="{{$cart['product_name']}}" />
										</td>
										<td class="cart_description">
											<h4><a href=""></a></h4>
											<p>{{$cart['product_name']}}</p>
										</td>
										<td class="cart_price">
											<p>{{number_format($cart['product_price'],0,',','.')}}đ</p>
										</td>
										<td class="cart_quantity">
											<div class="cart_quantity_button">


												<p>{{$cart['product_qty']}}</p>


											</div>
										</td>
										<td class="cart_total">
											<p class="cart_total_price">
												{{number_format($subtotal,0,',','.')}}đ

											</p>
										</td>

									</tr>

									@endforeach

									<td colspan="2">
										<li>Tổng tiền :<span>{{number_format($total,0,',','.')}}đ</span></li>
										@if(Session::get('coupon'))
										<li>

											@foreach(Session::get('coupon') as $key => $cou)
											@if($cou['coupon_condition']==1)
											Mã giảm : {{$cou['coupon_number']}} %
											<p>
												@php
												$total_coupon = ($total*$cou['coupon_number'])/100;
												echo '
											<p>
										<li>Tổng giảm:'.number_format($total_coupon,0,',','.').'đ</li>
										</p>';
										@endphp
										</p>
										<p>
											<li>Tổng đã giảm :{{number_format($total-$total_coupon,0,',','.')}}đ</li>
										</p>
										@elseif($cou['coupon_condition']==2)
										Mã giảm : {{number_format($cou['coupon_number'],0,',','.')}} k
										<p>
											@php
											$total_coupon = $total - $cou['coupon_number'];

											@endphp
										</p>
										<p>
											<li>Tổng đã giảm :{{number_format($total_coupon,0,',','.')}}đ</li>
										</p>

										@endif
										@endforeach



										</li>
										@endif
										<div class="col-md-12">
											@php
											$vnd= $total/23016;
											@endphp




										</div>
									</td>
									</tr>
									@else

									<tr>
										<td colspan="5">
											<center>
												@php
												echo 'Vui lòng thêm sản phẩm vào giỏ hàng';
												@endphp
											</center>
										</td>
									</tr>
									@endif
								</tbody>

								</form>

							</table>
						</div>

					</div>
				</div>
			</div>
		</div>

</section>
<!--/#cart_items-->

@endsection
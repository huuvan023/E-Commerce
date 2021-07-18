@extends('layout')
@section('content')


<div class="product-details">
	<!--product-details-->
	<div class="col-sm-5">
	@foreach($product_details as $key => $value)
		<div class="view-product">
			<div class="image-zoom">
				<p><img src="{{URL::to('/public/uploads/product/'.$value->product_image)}}" alt="image" /></p>
			</div>
			<h3>ZOOM</h3>
		</div>
		<div id="similar-product" class="carousel slide" data-ride="carousel">


		</div>

	</div>
	<div class="col-sm-7">
		<div class="product-information">
			<!--/product-information-->
			<img src="/public/frontend/images/new.jpg" class="newarrival" alt="image" />
			<h1 style="color:red;font-size:35px;font-family: Times New Roman">{{$value->product_name}}</h1>
			<p>Mã ID: {{$value->product_id}}</p>
			<img src="/public/frontend/images/rating.png" alt="image" />

			<form action="{{URL::to('/save-cart')}}" method="POST">
				@csrf
				<input type="hidden" value="{{$value->product_id}}" class="cart_product_id_{{$value->product_id}}">
				<input type="hidden" value="{{$value->product_name}}" class="cart_product_name_{{$value->product_id}}">
				<input type="hidden" value="{{$value->product_image}}" class="cart_product_image_{{$value->product_id}}">
				<input type="hidden" value="{{$value->product_price}}" class="cart_product_price_{{$value->product_id}}">

				<span>
					<span>{{number_format($value->product_price,0,',','.').'VNĐ'}}</span>

					<label>Số lượng:</label>
					<input name="qty" type="number" min="1" class="cart_product_qty_{{$value->product_id}}" value="1" />
					<input name="productid_hidden" type="hidden" value="{{$value->product_id}}" />
				</span>
                <div class="detail-action">
                    <input type="button" value="Thêm giỏ hàng" class="btn btn-primary btn-sm add-to-cart" style="margin-top: 0px"
                           data-id_product="{{$value->product_id}}" name="add-to-cart">
                    <div class="fb-share-button"
                         data-href="http://heravn.herokuapp.com/chi-tiet/{{$value -> product_slug}}"
                         data-layout="button_count">
                    </div>
                </div>
			</form>


            <p>Tình trạng: <b style="text-transform: uppercase">Còn hàng</b></p>
            <p>Điều kiện: <b style="text-transform: uppercase">Mới 100%</b></p>
			<p>Thương hiệu: <b style="text-transform: uppercase">{{$value->brand_name}}</b></p>
            <p>Danh mục: <b style="text-transform: uppercase">{{$value->category_name}}</b></p>
			<a href=""><img src="images/product-details/share.png" class="share img-responsive" alt="image" /></a>
		</div>
		<!--/product-information-->
	</div>
</div>
<!--/product-details-->

<div class="category-tab shop-details-tab">
	<!--category-tab-->
	<div class="col-sm-12">
		<ul class="nav nav-tabs">
			<li class="active"><a href="#details" data-toggle="tab">Mô tả</a></li>
			<li><a href="#companyprofile" data-toggle="tab">Chi tiết sản phẩm</a></li>

			<li><a href="#reviews" data-toggle="tab">Đánh giá</a></li>
		</ul>
	</div>
	<div class="tab-content">
		<div class="tab-pane fade active in" id="details">
			<p>{!!$value->product_desc!!}</p>

		</div>

		<div class="tab-pane fade" id="companyprofile">
			<p>{!!$value->product_content!!}</p>


		</div>

		<div class="tab-pane fade" id="reviews">
			<div class="col-sm-12">
				<ul>
					<li><a href=""><i class="fa fa-user"></i>EUGEN</a></li>
					<li><a href=""><i class="fa fa-clock-o"></i>12:41 PM</a></li>
					<li><a href=""><i class="fa fa-calendar-o"></i>31 DEC 2021</a></li>
				</ul>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
				<p><b>Write Your Review</b></p>

				<form action="#">
					<span>
						<input type="text" placeholder="Your Name" />
						<input type="email" placeholder="Email Address" />
					</span>
					<textarea name=""></textarea>
					<b>Rating: </b> <img src="images/product-details/rating.png" alt="image" />
					<button type="button" class="btn btn-default pull-right">
						Submit
					</button>
				</form>
			</div>
		</div>

	</div>
</div>
<!--/category-tab-->
@endforeach
<div class="recommended_items">
	<!--recommended_items-->
	<h2 class="title text-center">Sản phẩm liên quan</h2>
	<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
		<div class="carousel-inner">
			<div class="item active">
				@foreach($relate as $key => $lienquan)
				<div class="col-sm-4">
					<div class="product-image-wrapper">
						<div class="single-products">
							<div class="productinfo text-center">
								<form>
									@csrf
									<input type="hidden" value="{{ $lienquan->product_id}}" class="cart_product_id_{{$lienquan->product_id}}">
									<input type="hidden" value="{{$lienquan->product_name}}" class="cart_product_name_{{$lienquan->product_id}}">
									<input type="hidden" value="{{$lienquan->product_image}}" class="cart_product_image_{{$lienquan->product_id}}">
									<input type="hidden" value="{{$lienquan->product_price}}" class="cart_product_price_{{$lienquan->product_id}}">
									<input type="hidden" value="1" class="cart_product_qty_{{$lienquan->product_id}}">

									<a href="{{URL::to('/chi-tiet/'.$lienquan->product_slug)}}">
										<div class="image-zoom">
											<p> <img src="{{URL::to('public/uploads/product/'.$lienquan->product_image)}}" alt="image" /></p>
										</div>
										<h2>{{number_format($lienquan->product_price).' '.'VNĐ'}}</h2>
										<p>{{$lienquan->product_name}}</p>
									</a>
									<input type="button" value="Thêm giỏ hàng" class="btn btn-default add-to-cart" data-id_product="{{$lienquan->product_id}}" name="add-to-cart">
								</form>
							</div>

						</div>
					</div>
				</div>
				@endforeach


			</div>

		</div>

	</div>
</div>

<!--/recommended_items-->
<ul class="pagination pagination-sm m-t-none m-b-none">
	{!!$relate->links()!!}
</ul>

@endsection

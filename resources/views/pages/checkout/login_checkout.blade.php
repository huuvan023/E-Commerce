@extends('layout')
@section('content')

	<section id="form"><!--form-->
		<div class="container">
			<div class="row">
				<div class="col-sm-4 col-sm-offset-1">
					<div class="login-form"><!--login form-->
						<h2>Đăng nhập tài khoản</h2>
						<?php
            $message = Session::get('message');
            if ($message) {
                echo '<span class="text-alert"  style="color:red;">' . $message . '</span>';
                Session::put('message', null);
            }
            ?>
						<form action="{{URL::to('/login-customer')}}" method="POST">
							{{csrf_field()}}
							<input type="text" name="email_account" placeholder="Tài khoản" />
							<input type="password" name="password_account" placeholder="Password" />
							<span>
								<input type="checkbox" class="checkbox"> 
								Ghi nhớ đăng nhập
							</span>
							<button type="submit" class="btn btn-default">Đăng nhập</button>
						</form>
					</div><!--/login form-->
				</div>
				<div class="col-sm-1">
					<h2 class="or">Hoặc</h2>
				</div>
				<div class="col-sm-4">
					<div class="signup-form"><!--sign up form-->
						<h2>Đăng ký</h2>
						<form action="{{URL::to('/add-customer')}}" method="POST">
							{{ csrf_field() }}
						
							<input @error('customer_name') class="error" @enderror type="text" name="customer_name" placeholder="Họ và tên"/>
							@error('customer_name')
                            <span class="text-alert" style="color:red;">{{ $message }}</span>
                            @enderror
						
							<input @error('customer_email') class="error" @enderror type="email" name="customer_email" placeholder="Địa chỉ email"/>
							@error('customer_email')
                            <span class="text-alert" style="color:red;">{{ $message }}</span>
                            @enderror
                           
							<input @error('customer_password') class="error" @enderror type="password" name="customer_password" placeholder="Mật khẩu"/>
							@error('customer_password')
                            <span class="text-alert" style="color:red;">{{ $message }}</span>
                            @enderror
							
							<input @error('customer_phone') class="error" @enderror type="text" name="customer_phone" placeholder="Phone"/>
							@error('customer_phone')
                            <span class="text-alert" style="color:red;">{{ $message }}</span>
                            @enderror
							<button type="submit" class="btn btn-default">Đăng ký</button>
						</form>
					</div><!--/sign up form-->
				</div>
			</div>
		</div>
	</section><!--/form-->

@endsection
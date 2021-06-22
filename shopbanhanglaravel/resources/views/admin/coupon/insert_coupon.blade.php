@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm mã giảm giá
            </header>
            <?php
            $message = Session::get('message');
            if ($message) {
                echo '<span class="text-alert">' . $message . '</span>';
                Session::put('message', null);
            }
            ?>
            <div class="panel-body">

                <div class="position-center">
                    <form role="form" action="{{URL::to('/insert-coupon-code')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label @error('coupon_name') class="error" @enderror for="exampleInputEmail1">Tên mã giảm giá</label>
                            <input type="text" name="coupon_name" class="form-control" id="exampleInputEmail1">
                            @error('coupon_name')
                            <span class="text-alert">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label @error('coupon_code') class="error" @enderror for="exampleInputEmail1">Mã giảm giá</label>
                            <input type="text" name="coupon_code" class="form-control" id="exampleInputEmail1">
                            @error('coupon_code')
                            <span class="text-alert">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label @error('coupon_time') class="error" @enderror for="exampleInputPassword1">Số lượng mã</label>
                            <input type="text" name="coupon_time" class="form-control" id="exampleInputEmail1">
                            @error('coupon_time')
                            <span class="text-alert">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label @error('coupon_condition') class="error" @enderror for="exampleInputPassword1">Tính năng mã</label>
                            <select name="coupon_condition" class="form-control input-sm m-bot15">
                                <option value="1">Giảm theo phần trăm</option>
                                <option value="2">Giảm theo tiền</option>

                            </select>
                            @error('coupon_condition')
                            <span class="text-alert">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label @error('coupon_number') class="error" @enderror for="exampleInputPassword1">Nhập số % hoặc tiền giảm</label>
                            <input type="text" name="coupon_number" class="form-control" id="exampleInputEmail1">
                            @error('coupon_number')
                            <span class="text-alert">{{ $message }}</span>
                            @enderror
                        </div>


                        <button type="submit" name="add_coupon" class="btn btn-info">Thêm mã</button>
                    </form>
                </div>

            </div>
        </section>

    </div>
    @endsection
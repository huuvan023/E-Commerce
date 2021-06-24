@extends('layout')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading" style="font-size:25pt;font-family:Times New Roman, Times, serif;color:#FF8000">
                Cập nhật thông tin tài khoản
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
                    <form role="form" action="{{URL::to('/update-customer/'.$customer ->customer_id)}}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên khách hàng</label>
                            <input type="text" value="{{$customer->customer_name}}" name="customer_name" class="form-control" id="exampleInputEmail1">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email</label>
                            <input type="text" value="{{$customer->customer_email}}" name="customer_email" class="form-control" id="exampleInputEmail1">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Số điện thoại</label>
                            <input type="text" value="{{$customer->customer_phone}}" name="customer_phone" class="form-control" id="exampleInputEmail1">
                        </div>

                        <button type="submit" name="edit_customer" id="edit_customer" class="btn btn-warning">Cập nhật thông tin</button>

                    </form>
                </div>
                <a href="{{URL::to('/customer-order/'.$customer->customer_id)}}">Xem lịch sử mua hàng</a>

            </div>
        </section>

    </div>
    @endsection
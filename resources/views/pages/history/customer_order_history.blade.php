@extends('layout')
@section('content')
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="{{URL::to('/')}}">Trang chủ</a></li>
                <li class="active">Chi tiết đơn hàng đã mua</li>
            </ol>
        </div>
        <div class="table-responsive">
            <?php
            $message = Session::get('message');
            if ($message) {
                echo '<span class="text-alert">' . $message . '</span>';
                Session::put('message', null);
            }
            ?>
        </div>
        @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
        @elseif(session()->has('error'))
        <div class="alert alert-danger">
            {{ session()->get('error') }}
        </div>
        @endif
        <div class="table-responsive cart_info">
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <th></th>
                        <th>Tên sản phẩm</th>
                        <th>Mã giảm giá</th>
                        <th>Số lượng</th>
                        <th>Giá sản phẩm</th>
                        <th>Tổng tiền</th>

                        <th style="width:30px;"></th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $i = 0;
                    $total = 0;
                    @endphp
                    @foreach($order_details_cus as $key => $details)

                    @php
                    $i++;

                    $subtotal = $details->product_price*$details->product_sales_quantity;

                    $total+=$subtotal;
                    @endphp
                    <tr class="color_qty_{{$details->product_id}}">

                        <td><i>{{$i}}</i></td>
                        <td>{{$details->product_name}}</td>
                        <td>@if($details->product_coupon!='no')
                            {{$details->product_coupon}}
                            @else
                            Không mã
                            @endif
                        </td>

                        <td type="number" min="1" name="product_sales_quantity">{{$details->product_sales_quantity}}</td>
                        <td>{{number_format($details->product_price ,0,',','.')}}đ</td>
                        <td>{{number_format($subtotal ,0,',','.')}}đ</td>
                    </tr>
                    @endforeach
                    <tr>
                        <td colspan="2">
                            @php
                            $total_coupon = 0;
                            @endphp
                            @if($coupon_condition==1)
                            @php
                            $total_after_coupon = ($total*$coupon_number)/100;
                            echo 'Tổng giảm :'.number_format($total_after_coupon,0,',','.').'</br>';
                            $total_coupon = $total - $total_after_coupon ;
                            @endphp
                            @else
                            @php
                            echo 'Tổng giảm :'.number_format($coupon_number,0,',','.').'k'.'</br>';
                            $total_coupon = $total - $coupon_number ;

                            @endphp
                            @endif

                            Thanh toán: {{number_format($total_coupon,0,',','.')}}đ
                        </td>
                    </tr>
                </tbody>
            </table>


        </div>
    </div>
</section>
@endsection
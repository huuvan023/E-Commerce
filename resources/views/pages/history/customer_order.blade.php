@extends('layout')
@section('content')
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="{{URL::to('/')}}">Trang chủ</a></li>
                <li class="active">Đơn hàng đã mua</li>
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
                        <th>Thứ tự</th>
                        <th>Mã đơn hàng</th>
                        <th>Ngày tháng đặt hàng</th>
                        <th>Tình trạng đơn hàng</th>

                        <th style="width:30px;"></th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $i = 0;
                    @endphp
                    @foreach($getorder as $key => $ord)
                    @php
                    $i++;
                    @endphp
                    <tr>
                        <td><i>{{$i}}</i></label></td>
                        <td>{{ $ord->order_code }}</td>
                        <td>{{ $ord->created_at }}</td>
                        <td>@if($ord->order_status==1)
                            Đang chờ xử lý
                            @else
                            Đã xử lý-Đã giao hàng
                            @endif
                        </td>


                        <td>
                            <a href="{{URL::to('/view-order-customer/'.$ord->order_code)}}" class="active styling-edit" ui-toggle-class="">
                                Xem chi tiết</a>

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <footer class="panel-footer">
                <div class="row">

                    <div class="col-sm-5 text-center">
                        <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
                    </div>
                    <div class="col-sm-7 text-right text-center-xs">
                        <ul class="pagination pagination-sm m-t-none m-b-none">
                            {!!$getorder->links()!!}
                        </ul>
                    </div>
                </div>
            </footer>
        </div>
    </div>
</section>



@endsection
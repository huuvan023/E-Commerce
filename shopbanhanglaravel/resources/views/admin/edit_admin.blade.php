@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Cập nhật thông tin Admin
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
                    <form role="form" action="{{URL::to('/update-admin/'.$edit_admin->admin_id)}}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên Admin</label>
                            <input type="text" value="{{$edit_admin->admin_name}}" name="admin_name" class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Avatar</label>
                            <input type="file" name="admin_image" class="form-control" id="exampleInputEmail1">
                            <img src="{{URL::to('public/uploads/admin/'.$edit_admin->admin_image)}}" height="100" width="100">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email</label>
                            <input type="text" value="{{$edit_admin->admin_email}}" name="admin_email" class="form-control" id="exampleInputEmail1" placeholder="Email">

                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Số điện thoại</label>
                            <input type="text" value="{{$edit_admin->admin_phone}}" name="admin_phone" class="form-control" id="exampleInputEmail1" placeholder="Phone">

                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Hiển thị</label>
                            <select name="admin_status" class="form-control input-sm m-bot15">
                                <option value="0">Hiển thị</option>
                                <option value="1">Ẩn</option>

                            </select>

                        </div>
                        <button type="submit" name="add_admin" class="btn btn-info">Cập nhật admin </button>
                    </form>
                </div>

            </div>
        </section>

    </div>
    @endsection
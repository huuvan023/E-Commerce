@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                           Thêm Admin
                        </header>
                         <?php
                            $message = Session::get('message');
                            if($message){
                                echo '<span class="text-alert">'.$message.'</span>';
                                Session::put('message',null);
                            }
                            ?>
                        <div class="panel-body">

                            <div class="position-center">
                                <form role="form" action="{{URL::to('/insert-admin')}}" method="post" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label @error('admin_name') class="error" @enderror for="exampleInputEmail1">Tên Admin</label>
                                    <input type="text" name="admin_name" class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục">
                                    @error('admin_name')
                                   <span class="text-alert">{{ $message }}</span>
                                   @enderror
                                </div>
                                <div class="form-group">
                                    <label @error('admin_image') class="error" @enderror for="exampleInputEmail1">Avatar</label>
                                    <input type="file" name="admin_image" class="form-control" id="exampleInputEmail1" placeholder="Avatar">
                                    @error('admin_image')
                                   <span class="text-alert">{{ $message }}</span>
                                   @enderror
                                </div>
                                <div class="form-group">
                                    <label @error('admin_email') class="error" @enderror for="exampleInputEmail1">Email</label>
                                    <input type="text" name="admin_email" class="form-control" id="exampleInputEmail1" placeholder="Email">
                                    @error('admin_email')
                                   <span class="text-alert">{{ $message }}</span>
                                   @enderror
                                </div>
                                <div class="form-group">
                                    <label @error('admin_password') class="error" @enderror for="exampleInputEmail1">Password</label>
                                    <input type="text" name="admin_password" class="form-control" id="exampleInputEmail1" placeholder="Password">
                                    @error('admin_password')
                                   <span class="text-alert">{{ $message }}</span>
                                   @enderror
                                </div>
                                <div class="form-group">
                                    <label @error('admin_phone') class="error" @enderror for="exampleInputEmail1">Số điện thoại</label>
                                    <input type="text" name="admin_phone" class="form-control" id="exampleInputEmail1" placeholder="Phone">
                                    @error('admin_phone')
                                   <span class="text-alert">{{ $message }}</span>
                                   @enderror
                                </div>
                                <div class="form-group">
                                    <label @error('admin_status') class="error" @enderror for="exampleInputPassword1">Hiển thị</label>
                                      <select name="admin_status" class="form-control input-sm m-bot15">
                                            <option value="0">Hiển thị admin</option>
                                            <option value="1">Ẩn admin</option>
                                            
                                    </select>
                                    @error('admin_status')
                                   <span class="text-alert">{{ $message }}</span>
                                   @enderror
                                </div>
                                <button type="submit" name="add_admin" class="btn btn-info">Thêm admin </button>
                                </form>
                            </div>

                        </div>
                    </section>

            </div>
@endsection
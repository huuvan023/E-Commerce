@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                           Thêm Slider
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
                                <form role="form" action="{{URL::to('/insert-slider')}}" method="post" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label @error('slider_name') class="error" @enderror for="exampleInputEmail1">Tên slide</label>
                                    <input type="text" name="slider_name" class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục">
                                    @error('slider_name')
                                   <span class="text-alert">{{ $message }}</span>
                                   @enderror
                                </div>
                                <div class="form-group">
                                    <label @error('slider_image') class="error" @enderror for="exampleInputEmail1">Hình ảnh</label>
                                    <input type="file" name="slider_image" class="form-control" id="exampleInputEmail1" placeholder="Slide">
                                    @error('slider_image')
                                   <span class="text-alert">{{ $message }}</span>
                                   @enderror
                                </div>
                                <div class="form-group">
                                    <label @error('slider_desc') class="error" @enderror for="exampleInputPassword1">Mô tả slider</label>
                                    <textarea style="resize: none" rows="8" class="form-control" name="slider_desc" id="exampleInputPassword1" placeholder="Mô tả danh mục"></textarea>
                                    @error('slider_desc')
                                   <span class="text-alert">{{ $message }}</span>
                                   @enderror
                                </div>
                                <div class="form-group">
                                    <label @error('slider_status') class="error" @enderror for="exampleInputPassword1">Hiển thị</label>
                                      <select name="slider_status" class="form-control input-sm m-bot15">
                                      <option value="1">Hiển thị slider</option>
                                                  
                                      <option value="0">Ẩn slider</option>
                                         
                                    </select>
                                    @error('slider_status')
                                   <span class="text-alert">{{ $message }}</span>
                                   @enderror
                                </div>
                                <button type="submit" name="add_slider" class="btn btn-info">Thêm slider</button>
                                </form>
                            </div>

                        </div>
                    </section>

            </div>
@endsection
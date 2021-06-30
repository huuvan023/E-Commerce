@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                           Thêm thương hiệu sản phẩm
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
                                <form role="form" action="{{URL::to('/save-brand-product')}}" method="post">
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label @error('brand_product_name') class="error" @enderror for="exampleInputEmail1">Tên thương hiệu</label>
                                    <input type="text" name="brand_product_name" class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục">
                                    @error('brand_product_name')
                            <span class="text-alert">{{ $message }}</span>
                            @enderror
                                </div>
                                <div class="form-group">
                                    <label @error('brand_slug') class="error" @enderror for="exampleInputEmail1">Slug</label>
                                    <input type="text" name="brand_slug" class="form-control" id="exampleInputEmail1" placeholder="Slug">
                            @error('brand_slug')
                            <span class="text-alert">{{ $message }}</span>
                            @enderror
                                </div>
                                <div class="form-group">
                                    <label  @error('brand_product_desc') class="error" @enderror for="exampleInputPassword1">Mô tả thương hiệu</label>
                                    <textarea style="resize: none" rows="8" class="form-control" name="brand_product_desc" id="exampleInputPassword1" placeholder="Mô tả danh mục"></textarea>
                            @error('brand_product_desc')
                            <span class="text-alert">{{ $message }}</span>
                            @enderror
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Hiển thị</label>
                                      <select name="brand_product_status" class="form-control input-sm m-bot15">
                                            <option value="0">Ẩn</option>
                                            <option value="1">Hiển thị</option>
                                            
                                    </select>
                                </div>
                               
                                <button type="submit" name="add_brand_product" class="btn btn-info">Thêm thương hiệu</button>
                                </form>
                            </div>

                        </div>
                    </section>

            </div>
@endsection
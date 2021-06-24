@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm sản phẩm
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
                    <form role="form" action="{{URL::to('/save-product')}}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label @error('product_name') class="error" @enderror for="exampleInputEmail1">Tên sản phẩm</label>
                            <input type="text" name="product_name" class="form-control" id="exampleInputEmail1" placeholder="Tên sản phẩm">
                            @error('product_name')
                            <span class="text-alert">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label @error('product_quantity') class="error" @enderror for="exampleInputEmail1">SL sản phẩm</label>
                            <input type="text" name="product_quantity" class="form-control" id="exampleInputEmail1" placeholder="Điền số lượng">
                            @error('product_quantity')
                            <span class="text-alert">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label @error('product_price') class="error" @enderror for="exampleInputEmail1">Giá sản phẩm</label>
                            <input type="text" name="product_price" class="form-control" id="" placeholder="Tên danh mục">
                            @error('product_price')
                            <span class="text-alert">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label @error('product_image') class="error" @enderror for="exampleInputEmail1">Hình ảnh sản phẩm</label>
                            <input type="file" name="product_image" class="form-control" id="exampleInputEmail1">
                            @error('product_image')
                            <span class="text-alert">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label @error('product_desc') class="error" @enderror for="exampleInputPassword1">Mô tả sản phẩm</label>
                            <textarea style="resize: none" rows="8" class="form-control" name="product_desc" placeholder="Mô tả sản phẩm"></textarea>
                            @error('product_desc')
                            <span class="text-alert">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label @error('product_content') class="error" @enderror for="exampleInputPassword1">Nội dung sản phẩm</label>
                            <textarea style="resize: none" rows="8" class="form-control" name="product_content" placeholder="Nội dung sản phẩm"></textarea>
                            @error('product_content')
                            <span class="text-alert">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Danh mục sản phẩm</label>
                            <select name="product_cate" class="form-control input-sm m-bot15">
                                @foreach($cate_product as $key => $cate)
                                <option value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                                @endforeach

                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Thương hiệu</label>
                            <select name="product_brand" class="form-control input-sm m-bot15">
                                @foreach($brand_product as $key => $brand)
                                <option value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                                @endforeach

                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Hiển thị</label>
                            <select name="product_status" class="form-control input-sm m-bot15">
                                <option value="0">Ẩn</option>
                                <option value="1">Hiển thị</option>

                            </select>
                        </div>

                        <button type="submit" name="add_product" class="btn btn-info">Thêm sản phẩm</button>
                    </form>
                </div>

            </div>

        </section>

    </div>
    @endsection
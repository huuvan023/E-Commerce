<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use DB;
use Session;
use App\Slider;
use App\Product;
use App\Brand;
use App\CategoryProductModel;
use Excel;
use App\Exports\ExcelExports;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;

session_start();
class ProductController extends Controller
{
    public function AuthLogin()
    {
        $admin_id = Session::get('admin_id');
        if ($admin_id) {
            return Redirect::to('dashboard');
        } else {
            return Redirect::to('admin')->send();
        }
    }
    public function add_product(Request $request)
    {
        $this->AuthLogin();
        $data = $request->all();
        $cate_product = CategoryProductModel::orderBy('category_id', 'DESC')->get();
        $brand_product = Brand::orderBy('brand_id', 'DESC')->get();
        return view('admin.add_product')->with('cate_product', $cate_product)->with('brand_product', $brand_product);
    }
    public function all_product()
    {
        $this->AuthLogin();
        $all_product = Product::join('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')
            ->join('tbl_brand', 'tbl_brand.brand_id', '=', 'tbl_product.brand_id')
            ->orderby('tbl_product.product_id', 'desc')->paginate(10);
        $manager_product  = view('admin.all_product')->with('all_product', $all_product);
        return view('admin_layout')->with('admin.all_product', $manager_product);
    }
    public function save_product(Request $request)
    {
        $this->AuthLogin();
        
        $data = $request->validate(
            [
                'product_name' => 'required|min:3',
                'product_quantity'=> 'required|numeric',
                'product_price'=> 'required|numeric',
                'product_image' => 'mimes:jpeg,jpg,png,gif|required|max:10000',
                'product_desc' => 'required|min:3',
                'product_content' => 'required|min:3',
                'product_cate' => 'required',
                'product_brand' => 'required',
                'product_status' => 'required'
              
            ],
            [
                'product_name.required' => 'Tên sản phẩm không được để trống',
                'product_name.min' => 'Vui lòng điền lớn hơn 3 kí tự',
                'product_quantity.required' => 'Sô lượng không được để trống',
                'product_quantity.numeric' => 'Số lượng là một số',
                'product_price.required' => 'Gía không được để trống',
                'product_price.numeric' => 'Gía là một số',
                'product_image.required' => 'Hình không được để trống',
				'product_image.mimes' => 'Sai định dạng',
                'product_desc.required' => 'Mô tả không được để trống',
                'product_desc.min' => 'Vui lòng điền lớn hơn 3 kí tự',
                'product_content.required' => 'Nội dung không được để trống',
                'product_content.min' => 'Vui lòng điền lớn hơn 3 kí tự',
                'product_cate.required' => 'Danh mục không được để trống',
                'product_brand.required' => 'Thương hiệu không được để trống',
                'product_status.required' => 'Trạng thái không được để trống'
              
            ]
        );

        
        $product = new Product();

        $product->product_name = $data['product_name'];
        $product->product_quantity = $data['product_quantity'];
        $product->product_sold = 0;
     //   $product->product_slug = $data['product_slug'];
        $product->category_id = $data['product_cate'];
        $product->brand_id = $data['product_brand'];
        $product->product_desc = $data['product_desc'];
        $product->product_content = $data['product_content'];
        $product->product_price = $data['product_price'];
        $get_image = $request->file('product_image');
        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image =  $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/product', $new_image);
            $data['product_image'] = $new_image;    
        }
        $product->product_image = $data['product_image'];
        $product->product_status = $data['product_status'];

        $product->save();
        Session::put('message', 'Thêm sản phẩm thành công');
        return Redirect::to('add-product');
    }
    public function unactive_product($product_id)
    {
        $this->AuthLogin();
        Product::where('product_id', $product_id)->update(['product_status' => 1]);
        Session::put('message', 'Không kích hoạt sản phẩm thành công');
        return Redirect::to('all-product');
    }
    public function active_product($product_id)
    {
        $this->AuthLogin();
        Product::where('product_id', $product_id)->update(['product_status' => 0]);
        Session::put('message', 'Kích hoạt sản phẩm thành công');
        return Redirect::to('all-product');
    }
    public function edit_product($product_id)
    {
        $this->AuthLogin();
        $cate_product = CategoryProductModel::orderby('category_id', 'desc')->get();
        $brand_product = Brand::orderby('brand_id', 'desc')->get();
        $edit_product = Product::where('product_id', $product_id)->get();
        $manager_product  = view('admin.edit_product')->with('edit_product', $edit_product)->with('cate_product', $cate_product)->with('brand_product', $brand_product);

        return view('admin_layout')->with('admin.edit_product', $manager_product);
    }
    public function update_product(Request $request, $product_id)
    {
        $this->AuthLogin();
        $data = $request->all();
        $product_table = Product::find($product_id);
        $product_table->product_name = $data['product_name'];
        $product_table->product_quantity = $data['product_quantity'];
        $product_table->product_sold = $product_table->product_sold;
        $product_table->category_id = $data['product_cate'];
        $product_table->brand_id = $data['product_brand'];
        $product_table->product_desc = $data['product_desc'];
        $product_table->product_content = $data['product_content'];
        $product_table->product_price = $data['product_price'];
        $product_table->product_status = $data['product_status'];
        //  $product->save();
        $get_image = $request->file('product_image');


        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image =  $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/product', $new_image);
            $data['product_image'] = $new_image;
            $product_table->update($data);
            Session::put('message', 'Cập nhật sản phẩm thành công');
            return Redirect::to('all-product');
        }

        $product_table->update($data);
        Session::put('message', 'Cập nhật sản phẩm thành công');
        return Redirect::to('all-product');
    }
    public function delete_product($product_id)
    {
        $this->AuthLogin();
        Product::find($product_id)->delete();
        Session::put('message', 'Xóa sản phẩm thành công');
        return Redirect::to('all-product');
    }
    public function search_product(Request $request)
    {
        $keywords = $request->keywords_submit;
        $search_product = Product::where('product_name', 'like', '%' . $keywords . '%')->get();
        return view('admin.search_product')->with('search_product', $search_product);
    }
    //End Admin Page

    //Index
    public function details_product($product_id, Request $request)
    {
        //slide
        $slider = Slider::orderBy('slider_id', 'DESC')->where('slider_status', '1')->take(4)->get();

        $cate_product = CategoryProductModel::where('category_status', '0')->orderby('category_id', 'desc')->get();
        $brand_product = Brand::where('brand_status', '0')->orderby('brand_id', 'desc')->get();

        $details_product = Product::join('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')
            ->join('tbl_brand', 'tbl_brand.brand_id', '=', 'tbl_product.brand_id')
            ->where('tbl_product.product_id', $product_id)->get();

        foreach ($details_product as $key => $value) {
            $category_id = $value->category_id;
            //seo 
            $meta_desc = $value->product_desc;
            //$meta_keywords = $value->product_slug;
            $meta_title = $value->product_name;
            $url_canonical = $request->url();
            //--seo
        }

        $related_product = Product::join('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')
            ->join('tbl_brand', 'tbl_brand.brand_id', '=', 'tbl_product.brand_id')
            ->where('tbl_category_product.category_id', $category_id)->whereNotIn('tbl_product.product_id', [$product_id])->paginate(6);


        return view('pages.sanpham.show_details')->with('category', $cate_product)->with('brand', $brand_product)->with('product_details', $details_product)->with('relate', $related_product)->with('meta_desc', $meta_desc)->with('meta_title', $meta_title)->with('url_canonical', $url_canonical)->with('slider', $slider);
    }
    public function export_csv()
    {
        return Excel::download(new ExcelExports, 'product.xlsx');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Slider;
use App\Brand;
use App\Product;
use App\CategoryProductModel;
use App\Exports\ExcelExports;
use App\Imports\ExcelImports;
use Excel;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class CategoryProduct extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    public function add_category_product(){
        $this->AuthLogin();
    	return view('admin.add_category_product');
    }
    public function all_category_product(){
        $this->AuthLogin();
    	$all_category_product = CategoryProductModel::orderBy('category_id','DESC')->paginate(10);
    	$manager_category_product  = view('admin.all_category_product')->with('all_category_product',$all_category_product);
    	return view('admin_layout')->with('admin.all_category_product', $manager_category_product);
        
       // $all_brand_product = Brand::orderBy('brand_id','DESC')->get();
    	//$manager_brand_product  = view('admin.all_brand_product')->with('all_brand_product',$all_brand_product);
    	//return view('admin_layout')->with('admin.all_brand_product', $manager_brand_product);

    }
    public function save_category_product(Request $request){
        $this->AuthLogin();

        $data = $request->validate(
            [
                'category_product_keywords' => 'required|min:3',
                'category_product_name'=> 'required|min:3',
                'slug_category_product'=> 'required|min:3',
                'category_product_desc'=> 'required|min:3',
                'category_product_status'=> 'required'

            ],
            [
                'category_product_keywords.required' => 'Từ khóa không được để trống',
                'category_product_keywords.min' => 'Vui lòng điền lớn hơn 3 kí tự',
                'category_product_name.required' => 'Tên danh mục không được để trống',
                'category_product_name.min' => 'Vui lòng điền lớn hơn 3 kí tự',
                'slug_category_product.required'=> 'Slug không được để trống',
                'slug_category_product.min' =>  'Vui lòng điền lớn hơn 3 kí tự',
                'category_product_desc.required'=> 'Mô tả danh mục không được để trống',
                'category_product_desc.min'=> 'Vui lòng điền lớn hơn 3 kí tự',
                'category_product_status.required'=> ''
            ]
        );

        $category_product = new CategoryProductModel();
        $category_product->meta_keywords = $data['category_product_keywords'];
        $category_product->category_name = $data['category_product_name'];
        $category_product->slug_category_product = $data['slug_category_product'];
        $category_product->category_desc = $data['category_product_desc'];
        $category_product->category_status = $data['category_product_status'];

        $category_product->save();
    	Session::put('message','Thêm danh mục sản phẩm thành công');
    	return Redirect::to('add-category-product');
    }
    public function unactive_category_product($category_product_id){
        $this->AuthLogin();
        CategoryProductModel::where('category_id',$category_product_id)->update(['category_status'=>1]);
        Session::put('message','Không kích hoạt danh mục sản phẩm thành công');
        return Redirect::to('all-category-product');

    }
    public function active_category_product($category_product_id){
        $this->AuthLogin();
        CategoryProductModel::where('category_id',$category_product_id)->update(['category_status'=>0]);
        Session::put('message','Kích hoạt danh mục sản phẩm thành công');
        return Redirect::to('all-category-product');
    }
    public function edit_category_product($category_product_id){
        $this->AuthLogin();
        $edit_category_product = CategoryProductModel::find($category_product_id);

        $manager_category_product  = view('admin.edit_category_product')->with('edit_category_product',$edit_category_product);

        return view('admin_layout')->with('admin.edit_category_product', $manager_category_product);
    }
    public function update_category_product(Request $request,$category_product_id){
        $this->AuthLogin();
        $data = $request->all();
        $category_product = CategoryProductModel::find($category_product_id);
        $category_product->category_name = $data['category_product_name'];
        $category_product->slug_category_product = $data['slug_category_product'];
        $category_product->category_desc = $data['category_product_desc'];
        $category_product->save();

        Session::put('message','Cập nhật danh mục sản phẩm thành công');
        return Redirect::to('all-category-product');
    }
    public function delete_category_product($category_product_id){
        $this->AuthLogin();
        CategoryProductModel::find($category_product_id)->delete();
        Session::put('message','Xóa danh mục sản phẩm thành công');
        return Redirect::to('all-category-product');
    }

    //End Function Admin Page
    public function show_category_home(Request $request ,$slug_category_product){
       //slide
        $slider = Slider::orderBy('slider_id','DESC')->where('slider_status','1')->take(4)->get();

        $cate_product = CategoryProductModel::where('category_status','0')->orderby('category_id','desc')->get(); 
        $brand_product = Brand::where('brand_status','0')->orderby('brand_id','desc')->get(); 

        $category_by_id = Product::join('tbl_category_product','tbl_product.category_id','=','tbl_category_product.category_id')->where('tbl_category_product.slug_category_product',$slug_category_product)->paginate(6);
        $category_name = CategoryProductModel::where('tbl_category_product.slug_category_product',$slug_category_product)->limit(1)->get();

        return view('pages.category.show_category')->with('category',$cate_product)->with('brand',$brand_product)->with('category_by_id',$category_by_id)->with('category_name',$category_name)->with('slider',$slider);
    }
    public function export_csv(){
        return Excel::download(new ExcelExports , 'category_product.xlsx');
    }
    public function import_csv(Request $request){
        $path = $request->file('file')->getRealPath();
        Excel::import(new ExcelImports, $path);
        return back();
    }
  

}

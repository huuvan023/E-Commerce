<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Slider;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use DB;
class SliderController extends Controller
{
	public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    public function manage_slider(){
    	$all_slide = Slider::orderBy('slider_id','DESC')->paginate(5);;
    	return view('admin.slider.list_slider')->with(compact('all_slide'));
    }
    public function add_slider(){
    	return view('admin.slider.add_slider');
    }
    public function delete_slider($slider_id){
        $this->AuthLogin();
        Slider::find($slider_id)->delete();
        Session::put('message','Xóa slider thành công');
        return Redirect::to('manage-slider');
    }
    public function unactive_slider($slide_id){
        $this->AuthLogin();
        Slider::where('slider_id',$slide_id)->update(['slider_status'=>0]);
        Session::put('message','Không kích hoạt slider thành công');
        return Redirect::to('manage-slider');

    }
    public function active_slider($slide_id){
        $this->AuthLogin();
        Slider::where('slider_id',$slide_id)->update(['slider_status'=>1]);
        Session::put('message','Kích hoạt slider thành công');
        return Redirect::to('manage-slider');

    }


    public function insert_slider(Request $request){
    	
    	$this->AuthLogin();

        $data = $request->validate(
			[
				'slider_name' => 'required|min:3',
                'slider_image' => 'mimes:jpeg,jpg,png,gif|required|max:10000',
				'slider_status' => 'required',
				'slider_desc' => 'required|min:3',
			],
			[
				'slider_name.required' => 'Tên slider không được để trống',
				'slider_name.min' => 'Vui lòng điền lớn hơn 3 kí tự',
				'slider_image.required' => 'Hình không được để trống',
				'slider_image.mimes' => 'Sai định dạng',
				'slider_desc.required' => 'Mô tả không được để trống',
				'slider_desc.min' => 'Vui lòng điền lớn hơn 3 kí tự',
			]
		);
       	$get_image = request('slider_image');
      
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/slider', $new_image);

            $slider = new Slider();
            $slider->slider_name = $data['slider_name'];
            $slider->slider_image = $new_image;
            
            $slider->slider_status = $data['slider_status'];
            $slider->slider_desc = $data['slider_desc'];
           	$slider->save();
            Session::put('message','Thêm slider thành công');
            return Redirect::to('add-slider');
        }else{
        	Session::put('message','Làm ơn thêm hình ảnh');
    		return Redirect::to('add-slider');
        }
       	
    }
}

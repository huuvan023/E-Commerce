<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Social;
use App\Admin;
use Excel;
use Socialite;
use App\Login;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Validator;
use App\Rules\Captcha;
use App\statistic;
use Carbon\Carbon;

class AdminController extends Controller
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
    

    public function index()
    {
        return view('admin_login');
    }
    public function show_dashboard()
    {
        $this->AuthLogin();
        return view('admin.dashboard');
    }
    public function unactive_admin($admin_id){
        $this->AuthLogin();
        Admin::where('admin_id',$admin_id)->update(['admin_status'=>1]);
        Session::put('message','Không kích hoạt admin thành công');
        return Redirect::to('all-admin');

        

    }
    public function active_admin($admin_id){
        $this->AuthLogin();
        Admin::where('admin_id',$admin_id)->update(['admin_status'=>0]);
        Session::put('message','Kích hoạt admin thành công');
        return Redirect::to('all-admin');

    }
    public function dashboard(Request $request)
    {

        $admin_email = $request->admin_email;
        $admin_password = md5($request->admin_password);
        $result = Admin::where('admin_email', $admin_email)->where('admin_password', $admin_password)->first();
        if ($result == true) {
            session::put('admin_name', $result->admin_name);
            session::put('admin_image', $result->admin_image);
            session::put('admin_id', $result->admin_id);
            return Redirect::to('/dashboard');
        } else {
            session::put('message', 'Mật khẩu hoặc tài khoản không đúng. Vui lòng nhập lại');
            return Redirect::to('/admin');
        }
    }

    public function logout()
    {
        $this->AuthLogin();
        Session::put('admin_name', null);
        Session::put('admin_id', null);
        return Redirect::to('/admin');
    }
    
    public function all_admin(){
        $all_admin = Admin::orderBy('admin_id','DESC')->paginate(5);
    	$manager_admin  = view('admin.all_admin')->with('all_admin',$all_admin);
    	return view('admin_layout')->with('admin.all_admin', $manager_admin);
    }

    public function insert_admin(Request $request){
    	
    	$this->AuthLogin();
        $data = $request->validate(
			[
				'admin_name' => 'required|min:3',
                'admin_image' => 'mimes:jpeg,jpg,png,gif|required|max:10000',
                'admin_email' => 'required|email',
                'admin_password' => 'required|min:6',
                'admin_phone' => 'required|min:3',
				'admin_status' => 'required'
			],
			[
				'admin_name.required' => 'Tên admin không được để trống',
				'admin_name.min' => 'Vui lòng điền lớn hơn 3 kí tự',
				'admin_image.required' => 'Hình không được để trống',
				'admin_image.mimes' => 'Sai định dạng',
				'admin_email.required' => 'Email không được để trống',
				'admin_email.min' => 'Vui lòng điền lớn hơn 3 kí tự',
                'admin_email.email' => 'Sai định dạng email',
                'admin_password.required' => 'Password không được để trống',
				'admin_password.min' => 'Vui lòng điền lớn hơn 6 kí tự',
                'admin_phone.required' => 'Số điện thoại không được để trống',
                'admin_phone.min' => 'Vui lòng điền lớn hơn 3 kí tự',
                'admin_status.required' => 'Status không được để trống',
			]
		);
	
       	$get_image = request('admin_image');
      
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/admin', $new_image);

            $admin = new Admin();
            $admin->admin_name = $data['admin_name'];
            $admin->admin_image = $new_image;
            $admin->admin_email = $data['admin_email'];
            $admin->admin_password = md5($data['admin_password']);
            $admin->admin_phone = $data['admin_phone'];
            $admin->admin_status = $data['admin_status'];

           	$admin->save();
            Session::put('message','Thêm admin thành công');
            return Redirect::to('add-admin');
        }else{
        	Session::put('message','Làm ơn thêm hình ảnh');
    		return Redirect::to('add-admin');
        }
       	
    }

    public function add_admin(){
    	return view('admin.add_admin');
    }

    public function delete_admin($admin_id)
    {
        $this->AuthLogin();
        Admin::find($admin_id)->delete();
        Session::put('message', 'Xóa admin thành công');
        return Redirect::to('all-admin');
    }

    public function edit_admin($admin_id){
        $this->AuthLogin();
        $edit_admin = Admin::find($admin_id);
        $manager_admin  = view('admin.edit_admin')->with('edit_admin',$edit_admin);

        return view('admin_layout')->with('admin.edit_admin', $manager_admin);
    }
    public function update_admin(Request $request,$admin_id){
        $this->AuthLogin();
        $data = $request->all();
        $admin = Admin::find($admin_id);
        $admin->admin_name = $data['admin_name'];
        //$admin->admin_image = $new_image;
        $admin->admin_email = $data['admin_email'];
        $admin->admin_phone = $data['admin_phone'];
        $admin->admin_status = $data['admin_status'];
        $get_image = $request->file('admin_image');


        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image =  $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/admin', $new_image);
            $data['admin_image'] = $new_image;
            $admin->update($data);
            Session::put('message', 'Cập nhật admin thành công');
            return Redirect::to('all-admin');
        }

        $admin->update($data);
        Session::put('message', 'Cập nhật admin thành công');
        return Redirect::to('all-admin');
    }
    public function export_csv(){
        return Excel::download(new ExcelExports , 'brand_product.xlsx');
    }


    //THONGKE
    public function dashboard_filter(Request $request)
    {
        $data = $request->all();
        $dauthangnay = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString();
        $dauthangtruoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth()->toDateString();
        $cuoithangtruoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->endOfMonth()->toDateString();

        $sub7days = Carbon::now('Asia/Ho_Chi_Minh')->subDays(7)->toDateString();
        $sub365days = Carbon::now('Asia/Ho_Chi_Minh')->subDays(365)->toDateString();
       $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

        if ($data['dashboard_value'] == '7ngay') {
            $get = statistic::whereBetween('order_date', [$sub7days, $now])->orderBy('order_date', 'ASC')->get();
        } else if ($data['dashboard_value'] == 'thangtruoc') {
            $get = statistic::whereBetween('order_date', [$dauthangtruoc, $cuoithangtruoc])->orderBy('order_date', 'ASC')->get();
        } else if ($data['dashboard_value'] == 'thangnay') {
            $get = statistic::whereBetween('order_date', [$dauthangnay, $now])->orderBy('order_date', 'ASC')->get();
        } else {
            $get = statistic::whereBetween('order_date', [$sub365days, $now])->orderBy('order_date', 'ASC')->get();
        }

        foreach ($get as $key => $val) {
            $chart_data[] = array(
                'period' => $val->order_date,
                'order' => $val->total_order,
                'sales' => $val->sales,
                'quantity' => $val->quantity
            );
        }
        echo $data = json_encode($chart_data);
    }
    public function filter_by_date(Request $request)
    {
        $data = $request->all();
        $from_date = $data['from_date'];
        $to_date = $data['to_date'];
        $get = statistic::whereBetween('order_date', [$from_date, $to_date])->orderBy('order_date', 'ASC')->get();

        foreach ($get as $key => $val) {
            $chart_data[] = array(
                'period' => $val->order_date,
                'order' => $val->total_order,
                'sales' => $val->sales,
                'quantity' => $val->quantity
            );
        }

        echo $data = json_encode($chart_data);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Coupon;
use Session;
use Excel;
use App\Exports\ExcelExports;
use Illuminate\Support\Facades\Redirect;

session_start();

class CouponController extends Controller
{
	public function unset_coupon()
	{
		$coupon = Session::get('coupon');
		if ($coupon == true) {

			Session::forget('coupon');
			return redirect()->back()->with('message', 'Xóa mã khuyến mãi thành công');
		}
	}
	public function insert_coupon()
	{
		return view('admin.coupon.insert_coupon');
	}
	public function delete_coupon($coupon_id)
	{
		$coupon = Coupon::find($coupon_id);
		$coupon->delete();
		Session::put('message', 'Xóa mã giảm giá thành công');
		return Redirect::to('list-coupon');
	}
	public function list_coupon()
	{
		$coupon = Coupon::orderby('coupon_id', 'DESC')->paginate(4);
		return view('admin.coupon.list_coupon')->with(compact('coupon'));
	}
	public function insert_coupon_code(Request $request)
	{

		$data = $request->validate(
			[
				'coupon_name' => 'required|min:3',
				'coupon_number' => 'required|numeric',
				'coupon_code' => 'required|min:3',
				'coupon_time' => 'required|numeric',
				'coupon_condition' => 'required'

			],
			[
				'coupon_name.required' => 'Tên mã không được để trống',
				'coupon_name.min' => 'Vui lòng điền lớn hơn 3 kí tự',
				'coupon_number.required' => 'Số giảm không được để trống',
				'coupon_number.numeric' => 'Số giảm là 1 số',
				'coupon_code.required' => 'Mã giảm không được để trống',
				'coupon_code.min' =>  'Vui lòng điền lớn hơn 3 kí tự',
				'coupon_time.required' => 'Số lượng mã không được để trống',
				'coupon_time.numeric' => 'Số lượng mã là 1 số',
				'coupon_condition.required' => 'Tính năng mã không được để trống'
			]
		);
		$coupon = new Coupon;

		$coupon->coupon_name = $data['coupon_name'];
		$coupon->coupon_number = $data['coupon_number'];
		$coupon->coupon_code = $data['coupon_code'];
		$coupon->coupon_time = $data['coupon_time'];
		$coupon->coupon_condition = $data['coupon_condition'];
		$coupon->save();

		Session::put('message', 'Thêm mã giảm giá thành công');
		return Redirect::to('insert-coupon');
	}
	public function export_csv()
	{
		return Excel::download(new ExcelExports, 'coupon.xlsx');
	}
}

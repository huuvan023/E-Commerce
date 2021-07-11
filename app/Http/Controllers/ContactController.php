<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Email;
use App\CategoryProductModel;
use Session;
use App\Http\Requests;
use App\Slider;
use Illuminate\Support\Facades\Redirect;
use Cart;
use Excel;
use App\Exports\MailExports;
use App\Coupon;
use Newsletter;
session_start();

class ContactController extends Controller
{

    public function sendemailPost(Request $request)
    {
        if ( Newsletter::isSubscribed($request->email) ) {
            return redirect('')->with('alert2', 'Email này đã được người khác đăng ký');
        }
        if ( ! Newsletter::isSubscribed($request->email) ) {
            Newsletter::Subscribe($request->email,['FNAME'=>'', 'LNAME'=>'']);
        }
        $email = new Email();
        $email->email= $request->email;
        $email->save();
        return redirect('')->with('alert', 'Đăng ký email thành công');
    }

    public function all_email()
    {        
        $all_email = Email::orderBy('id','DESC')->paginate(10); 
    	$manager_email  = view('admin.all_email')->with('all_email',$all_email);
    	return view('admin_layout')->with('admin.all_email', $manager_email);
    }

    public function export_csv_email(){
        return Excel::download(new MailExports , 'list_mailchimp.xlsx');
    }
}

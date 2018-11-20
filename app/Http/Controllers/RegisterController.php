<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Customer;
use Illuminate\Support\Facades\DB;
use Hash;
use App\Http\Requests;
use Validator;
use Response;

class RegisterController extends Controller
{
	public function show(){
		return view('register');
	}
	//user register new account
	public function store(Request $req){
		$validator = validator::make($req->data,[
			'name' 			=> 'required',
			'password' 		=> 'required|min:4|max:20',
		],[
			'name.required'		=> 'Vui lòng nhập tên đăng kí',	
			'password.required'	=> 'Vui lòng nhập mật khẩu',
			'password.min'		=> 'Mật khẩu không được dưới 4 ký tự',
			'password.max'		=> 'Mật khẩu không được quá 20 ký tự',
		]);
        $check_name         = DB::table('customers')->where('name',strip_tags($req->data['name']))->first();
        if($check_name)
            return Response::json(['fail' => 'Thất bại, tên tài khoản đã tồn tại']);
//        $regisCode = rand(100000000,999999999);
//        $check_code         = DB::table('customer')->where('code', $regisCode)->first();
		if($validator->passes())
		{
			$user 				= new Customer();
			$user->code  		= rand(1,9999);
			$user->name 	    = strip_tags($req->data['name']);
			$user->password 	= Hash::make(strip_tags($req->data['password']));
			if(!empty($req->data['user_location'])){
				$user->location 	= json_encode($req->data['user_location']);
			}
			if(!empty($req->data['address'])){
				$user->location 	= strip_tags($req->data['address']);
			}
			$user->google_id	= $req->data['google_id'];
			$user->facebook_id	= $req->data['facebook_id'];
			$user->avatar		= json_encode($req->data['avatar']);
			$user->status 		= 1;
			if($user->save()){
				return Response::json(['success' => $user->name]);
			} return Response::json(['fail' => 'Thất bại, thử lại sau giây lát']);
		} return Response::json(['errors' => $validator->errors()]);
	}
	//user register new accout with Gmail
}	

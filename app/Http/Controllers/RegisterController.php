<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Customer;
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
		if($validator->passes())
		{
			$user 				= new Customer();
			$user->code  		= rand(1,9999);
			$user->name 	= strip_tags($req->data['name']);
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
	public function googleRegister(Request $req){
        return \http\Env\Response::json(['sd']);
		$validator = validator::make($req->all(),[
			'password' 		=> 'required|min:4|max:20',
			'phone'			=> 'required',
		],[
			'password.required'	=> 'Vui lòng nhập mật khẩu',
			'password.min'		=> 'Mật khẩu không được dưới 4 ký tự',
			'password.max'		=> 'Mật khẩu không được quá 20 ký tự',
			'address.required'	=> 'Vui lòng nhập địa chỉ của bạn',
			'phone.required'	=> 'Vui lòng nhập số điện thoại của bạn',
		]);
		if($validator->passes())
		{
			$user 				= new Customer();
			$user->name 		= strip_tags($req->name);
			$user->email 		= strip_tags($req->email);
			$user->password 	= Hash::make(strip_tags($req->password));
			$user->phone 		= strip_tags($req->phone);
			$user->address 		= strip_tags($req->address);
			$user->location 	= json_encode($req->user_location);
			$user->status 		= 1;
			if($user->save){
			} else return redirect()->route('frontend_index')->withErrors(['msg','Đăng kí thất bại vui lòng thử lại']);
		} 
		return redirect()->route('frontend_index')->withErrors(['msg','Đăng kí thất bại vui lòng thử lại']);
	}
}	

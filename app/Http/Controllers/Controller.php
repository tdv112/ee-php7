<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Response;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
     public static function Menu($prefix, $routername) {
		$MenuStyle = (object)[];
			$MenuStyle->divLogo 		=  'col-md-8 text-center';
			$MenuStyle->imgStyle 		= '';
			$MenuStyle->divStyleCenter 	= 'display : none';
			$MenuStyle->btnCenterStyle 	= '';
			$MenuStyle->preBtn 			= '';
			$MenuStyle->textBtnV		= '';
			$MenuStyle->textBtnE 		= '';
		if($prefix == '/thue-lao-dong' || $prefix == '/tim-viec'){
			$MenuStyle->divLogo        = 'col-md-4 text-right';
			$MenuStyle->imgStyle       = 'margin-top: 15px;';
			$MenuStyle->divStyleCenter = '';
			if($prefix == '/thue-lao-dong'){
				$MenuStyle->btnCenterStyle =  'background: #14A5DE!important;border: 0px !important;box-shadow: 10px 10px 30px #343538 !important;height: 80px;';
				if($routername == 'hire'){
					$MenuStyle->preBtn = route('worker');
					$MenuStyle->textBtnV = 'Thuê lao động';
				}
				if($routername == 'hire_createposts'){
					$MenuStyle->preBtn = route('hire_listposts');
					$MenuStyle->textBtnE = 'Thuê lao động';
					$MenuStyle->textBtnV = 'Đăng tin';
				}
				if($routername == 'hire_listposts'){
                    $MenuStyle->preBtn = route('hire_createposts');
                    $MenuStyle->textBtnE = 'Thuê lao động';
                    $MenuStyle->textBtnV = 'Kho thông tin';
				}
				if($routername == 'hire_detailposts'){
					$MenuStyle->preBtn = route('hire');
					$MenuStyle->textBtnV = 'Thông tin thuê lao động';
				}
			} else if($prefix == '/tim-viec'){
				$MenuStyle->btnCenterStyle =  ' background: #CEC84E  !important;border: 0px !important;box-shadow: 10px 10px 30px #343538 !important;height: 80px;';
				if($routername == 'worker'){
					$MenuStyle->preBtn = route('hire');
					$MenuStyle->textBtnV = 'Người lao động';
				}
				if($routername == 'worker_createposts'){
					$MenuStyle->preBtn = route('worker_listposts');
					$MenuStyle->textBtnE = 'Tìm việc';
					$MenuStyle->textBtnV = 'Đăng tin';
				}
				if($routername == 'worker_listposts'){
                    $MenuStyle->preBtn = route('worker_createposts');
                    $MenuStyle->textBtnE = 'Tìm việc';
                    $MenuStyle->textBtnV = 'Kho thông tin';
				}
				if($routername == 'worker_detailposts'){
					$MenuStyle->preBtn = route('worker');
					$MenuStyle->textBtnV = 'Thông tin tìm việc';
				}
			}
		}
		return $MenuStyle;
	}

	public function getlocationpost(Request $req){
		$post_id = $req->data;
		$postlocation = DB::table('posts')->where('id',$post_id)->first();
		return Response::json(['status' => 200,'location' => $postlocation->location]);
	}

	public function getmypost($id){
		$posts = DB::table('posts')->where('customer_code',$id)->orderBy('created_at','desc')->get();
		return view('mypost',compact('posts'));
	}

	public function editmypost($id){
		$post = DB::table('posts')->where('id',$id)->first();
		return view('detailmypost',compact('post'));
	}

	public function storemypost(Request $req,$id){
		$post = DB::table('posts')->where('id',$id)->update([
	        'name'            	=> $req->data['name'],
	        'phone_area'      	=> $req->data['phone_zone'],
	        'phone'     		=> $req->data['phone'],
	        'facebook'    		=> $req->data['facebook'],
	        'gmail'   			=> $req->data['gmail'],
	        'location'  		=> json_encode($req->data['location']),
	        'address' 			=> $req->data['address'],
	       'post_title'			=> $req->data['title'],
	        'post_content' 		=> $req->data['content'],
	        'customer_code' 	=> $req->data['user_id'],
		]);
       
        if($post)
            return Response::json(['status' => 200]);
        else
            return Response::json(['status' => 400]);
	}

}

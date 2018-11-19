<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Facades\File;
use Response;
use Symfony\Component\HttpFoundation\Session\Session; 

class UploadController extends Controller
{
    public function upload(){
    	$BASE_URL =  url('/');
    	dd($_FILES);
		$path = $_FILES['file']['name'];
		$tmp = $_FILES['file']['tmp_name'];
		$extension = pathinfo($path, PATHINFO_EXTENSION);

        $directory = $BASE_URL.'/public/uploads/';
        $filename = sha1(time().time()).".{$extension}";
        // mkdir($_SERVER['DOCUMENT_ROOT'] . '/public/uploads/', 0777, true);
        // chmod($_SERVER['DOCUMENT_ROOT'] . '/public/uploads/', 777);
        $upload_success = move_uploaded_file($tmp, $_SERVER['DOCUMENT_ROOT'] . '/public/uploads/'.$filename);
        if( $upload_success ) {
        	$session = new Session();
        	if($session->has('upl')){
        		$arr_img = $session->get('upl');
        		array_push($arr_img, $directory.$filename);
        		$session->set('upl',$arr_img);
        	} else $arr_img = $session->set('upl', array($directory.$filename));
        	return Response::json(['status'=> 200,'session' => $arr_img]);
        } else {
        	return Response::json(['error'=> 400]);
        }
    }
}

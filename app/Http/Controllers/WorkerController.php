<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Posts;
use Illuminate\Http\Request;
use Response;
use DB;
use Symfony\Component\HttpFoundation\Session\Session;
class WorkerController extends Controller
{
	public function show(Request $req){
		$keyword    = !empty($req->search) ? $req->search : null;
        $address    = !empty($req->address) ? $req->address : null;
        $lat        = !empty($req->lat) ? $req->lat : '10.762622';
        $lng        = !empty($req->lng) ? $req->lng : '106.660172';
        $posts      = DB::table('posts')->where('status',1)->where('post_type',1);
         
        if($address != null){
             $posts = $posts->where('address','like','%'.$address.'%');
        }
        if($keyword != null){
            $posts = $posts->where('post_title','like','%'.$keyword.'%')->orwhere('post_content','like','%'.$keyword.'%');
        }
        $posts = $posts->orderBy('created_at','desc')->paginate(10);
		return view('worker.list-posts',compact('posts','keyword','address','lat','lng'));
	}
	public function category(){
    	return view('worker.category');
    }
    public function create(){
    	return view('worker.create-posts');
	}
	public function detail($slug)
	{
		$post = DB::table('posts')->where('id',$slug)->first();
        // dd($post->name);
        // return view('hire.detail-posts',compact('post'));
		return view('worker.detail-posts',compact('post'));
	}
	 public function store(Request $req)
    {
        $posts                  = new Posts();
        $posts->code            = rand(10,100000000);
        $posts->name            = $req->data['name'];
        $posts->slug            = rand(10,100000000);
        $posts->phone_area      = $req->data['phone_zone'];
        $posts->phone           = $req->data['phone'];
        $posts->facebook        = $req->data['facebook'];
        $posts->gmail           = $req->data['gmail'];
        $posts->location        = json_encode($req->data['location']);
        $posts->address         = $req->data['address'];
        $posts->post_title     = $req->data['title'];
        $posts->post_content   = $req->data['content'];
        $posts->post_type      = 1;
        $posts->customer_code   = $req->data['user_id'];
        $posts->status          = 1;
        if($posts->save())
            return Response::json(['status' => 200]);
        else
            return Response::json(['status' => 400]);
    }
}

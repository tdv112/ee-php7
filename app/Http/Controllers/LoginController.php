<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Hash;
use DB;
use App\Http\Requests;
use Validator;
use Response;
use App\User;
use App\Customer;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Session\Session;

use Socialite;
use Exception;


class LoginController extends Controller
{
    //check login
    public function show(){
        $session = new Session();
        if ($session->has('auth')) {
            // nếu đăng nhập thàng công thì
            return redirect()->route('frontend_index');
        } else {
            // if has session redirect
            if($session->has('redirect')){
                return redirect($session->get('redirect'));
            }
            return view('login');
        }
    }
    //post login
    public function login(Request $request){
        $validator = validator::make($request->data,[
            'phone' => 'required',
            'password' => 'required|min:4|max:20',
        ],[
            'phone.required' => 'Tên đăng kí không được để trống',
            'password.required'=>'Mật khẩu không được để trống',
            'password.min'=>'Mật khẩu không được dưới 4 ký tự',
            'password.max'=>'Mật khẩu không được quá 20 ký tự',
        ]);
        if($validator->passes())
        {
            $phone      = $request->data['phone'];
            $password   = $request->data['password'];
            $session = new Session();
            // dd($password);
            $tmp_login  = DB::table('customers')->where('name',$phone)->first();
            if(empty($tmp_login)) return Response::json(['fail' => 'Tài khoản hoặc mật khẩu không đúng']);
            if(Hash::check($password, $tmp_login->password))
            {
                $session->set('auth',$tmp_login);
                return Response::json(['success' => 'success']);
            }
            else
            {
                return Response::json(['fail' => 'Tài khoản hoặc mật khẩu không đúng']);
                exit;
            }
        }
        return Response::json(['errors' => $validator->errors()]);
    }
    //logout
    public function logout(){
        $session = new Session();
        $session->remove('auth');
        return redirect()->route('frontend_index');
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->stateless()->user();
            $find = DB::table('customers')->where('google_id','=',$user->id)->first();
            if($find){
                $session = new Session();
               $session->set('auth',$find);
               return redirect()->route('frontend_index');
            }
            else {
                $customer = new Customer();
                $customer->code = rand(1,9999);
                $customer->name = $user->name;
                $customer->email = $user->email;
                $customer->google_id = $user->id;
                $customer->avatar = $user->avatar;
                $customer->save();
                $session = new Session();
                $session->set('auth',$customer);
                // session()->push('auth',$customer);
                // \Illuminate\Support\Facades\Session::save();
                return redirect()->route('frontend_index');
            }
        } catch (Exception $e) {
            var_dump($e);
            return redirect()->route('frontend_index');
        }
    }

    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback()
    {
        try {

            $user = Socialite::driver('facebook')->stateless()->user();
            $find = DB::table('customers')->where('facebook_id','=',$user->id)->first();
            if($find){
                $session = new Session();
               $session->set('auth',$find);
               return redirect()->route('frontend_index');
            }
            else {
                $customer = new Customer();
                $customer->code = rand(1,9999);
                $customer->name = $user->name;
                $customer->email = $user->email;
                $customer->facebook_id = $user->id;
                $customer->avatar = $user->avatar;
                $customer->save();
                $session = new Session();
                $session->set('auth',$customer);
                // session()->push('auth',$customer);
                // \Illuminate\Support\Facades\Session::save();
                return redirect()->route('frontend_index');
            }
        } catch (Exception $e) {
            var_dump($e);
            return redirect()->route('frontend_index');
        }
    }
}

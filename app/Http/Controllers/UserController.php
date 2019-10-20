<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

class UserController extends Controller
{
    public function getLogin(){
    	if(Auth::check()){
    		return back();
    	}

    	return view('user.login');
    }

    public function postLogin(Request $request){
    	$this->validate($request,[
    		'email' =>'required|email',
    		'password' => 'required'
    	],[

    	]);


    	$email = $request->email;
    	$password = $request->password;

        $user = User::checkType($email,1);
        if(!$user){
            return back()->with('error','Login failed. Please recheck and try again.');
        }

    	if( Auth::attempt(['email' => $email, 'password' =>$password])) {
    			return redirect()->route('home');
    	} else {
    			return back()->with('error','Login failed. Please recheck and try again.');
    	}
    }

    public function logout() {
	   Auth::logout();
	   return redirect()->route('login');
	}

}

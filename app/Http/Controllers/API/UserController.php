<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Auth;
use Validator;

class UserController extends Controller
{
    public function login(Request $request) {

        $user = User::checkType($request->email,2);
        if(!$user){
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $credentials = request(['email', 'password']);
        
        if (!$token = auth('api')->attempt($credentials)) {          
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return response()->json([
            'token' => $token,
            // 'type' => 'bearer', 
            // 'expires' => auth('api')->factory()->getTTL() * 60, // time to expiration
        ]);
    }

    public function register(Request $request){
        $validate = Validator::make($request->all(),[
            'email' => 'unique:users,email'
        ]);
        
        if($validate->fails()){
           return response()->json(['status'=>0,'msg'=>$validate->messages()->getMessages()],401);
        }

        $arr = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ];

        User::create($arr);

        return response()->json(['status'=>1,'msg'=>'created successfully'],201);
    }

    public function getInfo(){
        return auth('api')->user(); 
    }

    public function updateProfile(Request $request){
        $arr = [
            'name' => $request->name,
            'image' => $request->image,
        ];

        return response()->json(['status'=>1,'msg'=>'updated successfully'],200);
    }

    public function updatePassword(Request $request){
        $user = User::updatePasswordByEmail($request->email,$request->oldPassword,$request->newPassword);

        if(!$user){
            return response()->json(['status'=>0,'msg'=>'failed to update'],401);
        }

        return response()->json(['status'=>1,'msg'=>'updated successfully'],200);
    }
}
<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\KepalaUnitModel;
use App\UserModel;
use App\AdminHRDModel;
use App\AdminModel;
use Cookie;

class PassportAuthController extends Controller
{
	// public function register(Request $request)
	// {
	// 	$this->validate($request, [
	// 		'name' => 'required|min:4',
	// 		'email' => 'required|email',
	// 		'password' => 'required|min:8',
	// 	]);
		
	// 	$user = User::create([
	// 		'name' => $request->name,
	// 		'email' => $request->email,
	// 		'password' => bcrypt($request->password)
	// 	]);
		
	// 	$token = $user->createToken('Laravel8PassportAuth')->accessToken;
		
	// 	return response()->json(['token' => $token], 200);
	// }
	
    /**
     * Login Req
     */
    public function login(Request $request)
    {
    	$username = $request->username;
        $email = $request->email;
        $password = $request->password;
        $reTypePassword = $request->reTypePassword;
        if($request->role != ""){
            $role = $request->role;
        }else{
            $role = 'user';
            $request->merge(['role' => $role]);
        }
        if($password != $reTypePassword){
            return response(["status" => "ERROR","message" => "Password Tidak Sama"],200);
        }

        if($role == "admin"){
              $user = AdminModel::where('username',$username)->first();
        }else if($role == "admin-hrd"){
            $user = AdminHRDModel::where('username',$username)->first();
        }else if($role == "kepala-unit"){
             $user = KepalaUnitModel::where('username',$username)->first();
        }else if($role == "user"){
            if($email != ""){
                $user = UserModel::where('email',$email)->first();
            }else{
             $user = UserModel::where('username_sim_sdm',$username)->first();
            }
            
        }else{
              return response(["status" => "ERROR","message" => "Unknown Error"],200);
        }
        if($user){

            if($user->password == $password){
                $token = $user->createToken('Laravel Password Grant Client',[$role])->accessToken;
                $response = [
                    'status' => "OK",
                    'message' => "Login Berhasil",
                    'token' => $token
                ];
                $cookie = $this->getCookieDetails($token);
                return response($response, 200)->cookie($cookie['name'], $cookie['value'], $cookie['minutes'], $cookie['path'], $cookie['domain'], $cookie['secure'], $cookie['httponly'], $cookie['samesite']);
            }else{
               return response(["status" => "ERROR","message" => "Password yang anda masukkan salah !"],200);
            }
        }else{
             return response(["status" => "ERROR","message" => "User Tidak Ditemukan"],200);
        }

        return response (["status" => "ERROR","message" => "Unknown Error"],401);
    }

    private function getCookieDetails($token)
    {
        return [
            'name' => '_token',
            'value' => $token,
            'minutes' => 1440,
            'path' => null,
            'domain' => null,
            // 'secure' => true, // for production
            'secure' => null, // for localhost
            'httponly' => true,
            'samesite' => true,
        ];
    }
    
    // public function userInfo() 
    // {
    	
    // 	$user = auth()->user();
    	
    // 	return response()->json(['user' => $user], 200);
    	
    // }
}

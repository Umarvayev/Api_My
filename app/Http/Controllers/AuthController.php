<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{

    public function register(Request $request){
        
        $attr = $request->validate([
            'name'=> 'required|string|max:255',
            'email'=> 'required|string|email|unique:users,email',
            'password'=> 'required|string|min:6|confirmed',
        ]);

          
        $user = User :: create([
            'name' => $attr['name'],
            'email' => $attr['email'],
            'password' => bcrypt($attr['password']),
        ]);

        

        $token = $user->createToken('API Token')->plainTextToken;
        $code  = 200;
        return response()->json([
            'status' =>'Success',
            'message' =>'successfull registered',
            'data' => $token,

        ],$code); 
    }

    public function login(Request $request){
        $attr = $request->validate([
            'email'=> 'required|string|email|',
            'password'=> 'required|string|min:6|',
        ]);

         if(!Auth::attempt($attr)){
             return $this->error('Credentials not match', 401);

         }  
         $token = auth()->user()->createToken('API Token')->plainTextToken;
         
         $code  = 200;
         return response()->json([
             'status' =>'Success',
             'message' =>'successfull registered',
             'data' => $token,
 
         ],$code); 

    }

    public function logout(){
         
        auth()->user()->tokens()->delete();


        $code = 200;
        return response()->json([
            'status' =>'Success',
            'message' => 'Token Revoked',
        ],$code);
    }

    
    public function list(){

        $user = User::get();
      
        $code = 200;
        return response()->json([
            'status' =>'Success',
            'message' => 'Token Revoked',
            'data' => $user,
        ],$code);
    }


}
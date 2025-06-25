<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Auth;

class AuthController extends Controller
{
    public function login(Request $req){
        $this->validate($req,[
            'email' => 'required|string|max:100',
            'password' => 'required|string|min:4'
        ]);
        $user=User::where('email',$req['email'])->first();
        if (!$user || !Hash::check($req['password'],$user->password)){
            return response([
                "message"=>'wrong password or email',

            ],401);
        }
        $token =$user->createToken('myapptoken')->plainTextToken;
        $response =[
            'token' => $token ];
        return response( $response,200);
    }


    public function register(Request $req){
        $this->validate($req,[
            'name' => 'required|string',
            'email' => 'required|string|max:100|unique:users,email',
            'password' => 'required|string|min:4|confirmed'
        ]);
        $user=User::create([
            'name' => $req['name'],
            'email' => $req['email'],
            'password' => bcrypt($req['password']),
        ]);
        $token =$user->createToken('myapptoken')->plainTextToken;
        $response =[
           'token' => $token ];
        return response( $response,200);
    }






     public function logout(Request $request){
         Auth::user()->tokens()->delete();
         return ['message'=> 'logge out'];

     }
}

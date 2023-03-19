<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;




class AuthHandler extends Controller
{   // this validates the user info

    public function register(Request $request){

        $field = $request->validate([
            'name'=> 'required|string',
            'email' => "required|string|unique:users,email",
            'password' => "required|confirmed"
        ]);
        // this creates the user 
        $user = User::create(
            [
                'name' => $field['name'],
                'email' => $field['email'],
                'password' =>bcrypt( $field['password'])
            ]
        ); // this create the token to access protected routes
        $token = $user->createToken('MyappToken')->plainTextToken;
        // this is the response to display after the user has registered
        $response = [
            'name' => $user,
            'token' => $token
        ];
        // this returns the response and statu(201 means the request was successful and it has created something)
        return response($response, 201);

    }

    public function logout(Request $request)
        {
            auth()->user()->tokens()->delete();
            return response(['user has logged out'], 201);
        }
    public function login(Request $request){
        $values = $request->validate([
            'name'=> 'required',
            'password'=>'required'
        ]);
        $user = User::where('name', $values['name'])->first();
        if(!$user ||!Hash::check($values['password'], $user->password))
        {
            return response(['Wrong Email or Password. Try again'], 401);
        }
        $token = $user->createToken("myAppToken")->plainTextToken;
        $response = [
            'user'=> $user,
            'token' => $token
        ];
        return response($response, 201);

    }
}

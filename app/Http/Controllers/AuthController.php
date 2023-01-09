<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

//Include controller
class AuthController extends Controller
{
    //Reg user
    public function register(Request $request) {
        //Validate user input
        $validatedUser = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required'
            ]);

    //Run fail method if validation method fails
    if($validatedUser->fails()) {
        return  response()->json([
            'message' => 'Add valid user information',
            //Return list of errors
            'error' => $validatedUser->errors()
        ], 401);
    }

    //Correst input values - creates a user - return a token
    $user = User::create([
        'name' => $request['name'],
        'email' => $request['email'],
        //Hash password
        'password' => bcrypt($request['password'])
    ]); 

    //User logs in direct after registration, returns a token
    $token = $user->createToken('APITOKEN')->plainTextToken;

    //Creates a varible as array with message, user info and token
    $response = [
        'message' => 'User created successfully',
        'user' => $user,
        'token' => $token
    ];

    //Return response and 201 code
    return response($response, 201);

    }

    //Log in user
    public function login(Request $request){
        //Validate user
        $validatedUser = Validator::make(
            $request->all(),
            [
                'email' => 'required|email',
                'password' => 'required'
            ]);

            //Check if validate method fails
            if($validatedUser->fails()) {
                return  response()->json([
                    'message' => 'Wrong email or password',
                    //Return list of errors
                    'error' => $validatedUser->errors()
                ], 401);
            }

            //Check if login is correct - use auth method, do an attempt and use input email and password
            if(!auth()->attempt($request->only('email', 'password'))) {
                return response()->json([
                    'message' => 'Invalid email or password'
                ], 401);
            }

            //Store user info in variable
            $user = User::where('email', $request->email)->first();

            //Return message and token if user log in correct
            return response()->json([
                'message' => 'User logged in',
                'token' => $user->createToken('APITOKEN')->plainTextToken
            ], 201);
            }

            //Log out user and destroy token
            public function logout(Request $request) {
                $request->user()->currentAccessToken()->delete();

                $response = [
                    'message' => 'User logged out'
                ];

                return response($response, 200);
            }

    }



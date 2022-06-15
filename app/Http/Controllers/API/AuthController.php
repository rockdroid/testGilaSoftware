<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Helpers;

class AuthController extends Controller
{
    public function checkUser(Request $request)
    {
        // dd($request->all());
        $name = strtoupper($request->name);
        $check = User::where("name", $name)->first();

        if(is_null($check)){
            return Helpers::resp(200, 'SUCCESS', "true");
        } else {
            return Helpers::resp(200, 'FAIL', "false");
        }
    }

    public function checkEmail(Request $request)
    {
        $email = strtolower($request->email);
        $check = User::where("email", $email)->first();

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return Helpers::resp(200, 'Invalid email format', "false");
        } else {
            if(is_null($check)){
                return Helpers::resp(200, 'SUCCESS', "true");
            } else {
                return Helpers::resp(200, 'FAIL', "false");
            }
        }
    }

    public function login(Request $request)
    {
        echo "login";
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credentials = $request->only(['email', 'password']);

        if(Auth::attempt($credentials)) {
            $user = Auth::user();
            $success['token'] = $user->createToken('MyApp')->accessToken;
            return response()->json(['success' => $success], 200);
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }

    public function logout (Request $request) {
        $token = $request->user()->token();
        $token->revoke();
        $response = ['message' => 'You have been successfully logged out!'];
        return response($response, 200);
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $success['name'] = $user->name;
        $success['token'] = $user->createToken('MyApp')->accessToken;
        return response()->json(['success' => $success], 200);
    }

    public function adminLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credentials = $request->only(['email', 'password']);

        if(Auth::attempt($credentials)){
            $user = Auth::user();
            $success['token'] = $user->createToken('MyApp', ['*'])->accessToken;
            return response()->json(['success' => $success], 200);
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }

    public function adminRegister(Request $request)
	{
		$request->validate([
            'name' => 'required',
			'email' => 'required|email',
			'password' => 'required',
			'c_password' => 'required|same:password',
        ]);

		$user = User::create([
			'name' => $request->name,
			'email' => $request->email,
			'password' => bcrypt($request->password),
		]);
		$success['name'] = $user->name;
		$success['token'] = $user->createToken('MyApp', ['*'])->accessToken;
		return response()->json(['success' => $success], 200);
	}
}

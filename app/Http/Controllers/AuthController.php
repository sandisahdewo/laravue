<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Hash;

class AuthController extends Controller
{
    public function register(Request $request) {
    	$this->validate($request, [
    		'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
    	]);

    	$user = new User($request->all());
    	$user->password = bcrypt($request->password);
    	$user->save();

        return response()
		        ->json([
		        	'registered' => true
		        ]);
    }

    public function login(Request $request) {
    	$this->validate($request, [
    		'email' => 'required|string|email|max:255',
    		'password' => 'required|string|min:6'
    	]);

    	$user = User::whereEmail($request->email)
    				->first();

    	if($user && Hash::check($request->password, $user->password)) {
    		$user->api_token = str_random(90);
    		$user->save();

    		return response()
    			->json([
    				'logged_in' => true,
    				'api_token' => $user->api_token,
    				'user_id' => $user->id
    			]);
    	}

    	return response()
    		->json([
    			'failed' => true,
    			'message' => 'These credentials do not match our records.'
    		]);
    }

    public function logout(Request $request) {
        $user = User::find($request->id);
        $user->api_token = null;
        $user->save();

        return response()
            ->json(['logged_out' => true]);
    }
}

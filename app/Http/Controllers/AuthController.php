<?php

namespace App\Http\Controllers;

use Hash;
use JWTAuth;
use App\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;

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

    /*public function login(Request $request) {
        $credentials = $request->only('email', 'password');

        try {
            // attempt to verify the credentials and create a token for the user
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        // all good so return the token
        return response()->json(compact('token'));
    }*/

    public function login(Request $request) {
    	$this->validate($request, [
    		'email' => 'required|string|email|max:255',
    		'password' => 'required|string|min:6'
    	]);

    	$user = User::whereEmail($request->email)
    				->first();

    	if($user && Hash::check($request->password, $user->password)) {
            $apiToken = JWTAuth::fromUser($user);
    		$user->api_token = $apiToken;
    		$user->save();

    		return response()
    			->json([
    				'logged_in' => true,
    				'api_token' => $user->api_token,
    				'user_id' => $user->id
    			]);
    	}

    	return response('These credentials do not match our records.', 501);
    }

    public function logout(Request $request) {
        $user = User::find($request->id);
        $user->api_token = null;
        $user->save();

        return response()
            ->json(['logged_out' => true]);
    }
}

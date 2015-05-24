<?php

use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;

Route::group(['middleware'=>['jwt.auth']], function() {
	Route::get('auth', function(){
		$user = currentUser();
		return response()->json(compact('user'), 200);
	});

	Route::get('protected', function(){
		return ['message'=>'Yolo!'];
	});
});

Route::post('auth', function(Request $request){
	$credentials = $request->only('email', 'password');

	try {
		// attempt to verify the credentials and create a token for the user
		if (! $token = jwt()->attempt($credentials)) {
			return response()->json(['error' => 'invalid_credentials'], 401);
		}
	} catch (JWTException $e) {
		// something went wrong whilst attempting to encode the token
		return response()->json(['error' => 'could_not_create_token'], 500);
	}

	// all good so return the token
	return response()->json(compact('token'));
});
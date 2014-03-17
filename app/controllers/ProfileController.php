<?php

class ProfileController extends BaseController {

	public function show($username){
		$user = User::where('username', '=', $username)->first();
		$info = UserInfo::where('user_id', '=', $user->id)->first();
		//return $data->toArray();

		$data['info'] = $info;
		$data['username']= $username;
		$data['email']  = $user->email;

		$email = trim($user->email);
		$email = strtolower( $email ); // "myemailaddress@example.com"
		$email = md5( $email );
		$data['avatar'] = $email;
		return View::make('site/profile/profile', $data);
	}

}
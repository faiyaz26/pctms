<?php

class ProfileController extends BaseController {

	public function show($username){
		$user = User::where('username', '=', $username)->first();
		$info = UserInfo::where('user_id', '=', $user->id)->first();
		//return $data->toArray();

		$data['info'] = $info;
		$data['fullname'] = $user->fullname;
		$data['username']= $username;
		$data['email']  = $user->email;

		$email = trim($user->email);
		$email = strtolower( $email ); // "myemailaddress@example.com"
		$email = md5( $email );
		$data['avatar'] = $email;
		return View::make('site/profile/profile', $data);
	}

	public function test(){
		$curl = new anlutro\cURL\cURL;
		$source = 'print ("hello")';
		$data =  array(
			'client_secret' =>  '4dcf103f2d07dc9c9ab2ab58de0c164054afb899',
		    'source' =>  $source,
		    'lang' => 5,
		    'time_limit' => 5,
		    'memory_limit' => 262144,
		);
		$url = "http://api.hackerrank.com/checker/submission.json";
		$response = $curl->post($url, $data);
		return $response;
	}

	public function test2(){
		/*
		$curl = new anlutro\cURL\cURL;
		
		$source = 'print ("hello")';
		$data =  array(
			'client_secret' =>  '4dcf103f2d07dc9c9ab2ab58de0c164054afb899',
		    'source' =>  $source,
		    'lang' => 5,
		    'time_limit' => 5,
		    'memory_limit' => 262144,
		);
		$url = "http://api.hackerrank.com/checker/submission.json";
		$response = $curl->post($url, $data);
        */
		$url = "http://localhost:8080/pctms/public/assets/files/Summary%20-%20Programming%20Contest.htm";
		$html = new Htmldom($url);
		//$html->load_file($url);
		//$html = new Htmldom("http://localhost:8000/assets/files/Summary%20-%20Programming%20Contest.htm");

		return $html;//->find('div.info',0)->find('ul',0)->find('li',0)->find('span', 0)->innertext;
	}

}
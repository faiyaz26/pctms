<?php

class ProfileController extends BaseController {

	public function show($username = null){

		if(isset($username) == false){
			if(Auth::guest()) return Redirect::to('/');
			$username = Auth::user()->username;
			return Redirect::to('profile/'.$username.'/');
		}


		$user = User::where('username', '=', $username)->first();

		if(isset($user->id) == false){
			return Redirect::to('/');
		}



		$info = UserInfo::where('user_id', '=', $user->id)->first();

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

	public function test2($username){
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
		$url = "http://localhost:8080/pctms/public/assets/files/Summary%20-%20Programming%20Contest.htm";
		$html = new Htmldom($url);
		//$html->load_file($url);
		//$html = new Htmldom("http://localhost:8000/assets/files/Summary%20-%20Programming%20Contest.htm");

		return $html;//->find('div.info',0)->find('ul',0)->find('li',0)->find('span', 0)->innertext;

		*/

		$user = User::where('username' , '=', $username)->first();


		$contest_data = array();
		$division = Division::all();
		$season = Season::all();

		foreach ($division as $div) {
			$sea = array();

			foreach ($season as $s) {
				$ret = Contest::where('division_id', '=', $div->id )->where('season_id', $s->id)->get();
				if($ret){

				}
			}
		}

		return $ret;

	}


	public function getSettings(){
		if(Auth::guest()){
			return Redirect::to('/login');
		}
		$username = Auth::user()->username;
		$user = User::where('username' , '=' , $username)->first();
        $info = UserInfo::where('user_id', '=', $user->id)->first();
            // Title
        $title = Lang::get('admin/users/title.user_update');
        	// mode

        return View::make('site/profile/edit', compact('user','title','info'));
	}

	public function postSettings(){
		if(Auth::guest()){
			return Redirect::to('/login');
		}
		$username = Auth::user()->username;
		$user = User::where('username' , '=' , $username)->first();
		$user->fullname = Input::get('fullname');
        $user->email = Input::get( 'email' );
        

        // The password confirmation will be removed from model
        // before saving. This field will be used in Ardent's
        // auto validation.

        if(Input::get('password')){
            $user->password = Input::get( 'password' );
            $user->password_confirmation = Input::get( 'password_confirmation' );
        }


        // Permissions are currently tied to roles. Can't do this yet.
        //$user->permissions = $user->roles()->preparePermissionsForSave(Input::get( 'permissions' ));

        // Save if valid. Password field will be hashed before save
        

        if ( $user->updateUniques() )
        {
            // Save roles. Handles updating.

            $info = UserInfo::find($user->id);

            $info->user_id = $user->id;
            $info->cf_handle = Input::get('cf_handle');
            $info->cc_handle = Input::get('cc_handle');
            $info->cm_handle = Input::get('cm_handle');
            $info->loj_handle = Input::get('loj_handle');
            $info->uva_handle = Input::get('uva_handle');
            $info->spoj_handle = Input::get('spoj_handle');
            $info->hustoj_handle = Input::get('hustoj_handle');
            $info->sgu_handle = Input::get('sgu_handle');
            $info->tc_handle = Input::get('tc_handle');

            $info->save();

            // Redirect to the new user page
            return Redirect::to('profile/' . $user->username . '/settings')->with('success', "Information Updated successfully");
        }
        else
        {
            // Get validation errors (see Ardent package)
            $error = $user->errors()->all();
            return Redirect::to('profile/' . $user->username . '/settings')
                ->with( 'error', $error );
        }
	}


	public function contest($username){
		$contest_data = ContestSummary::where('username' , $username)->get();
		$data['contest_data'] = $contest_data;
		$data['title'] = "Contest Record of ".$username;
		$data['username'] = $username;
		return View::make('site/profile/contest', $data);
	}
}
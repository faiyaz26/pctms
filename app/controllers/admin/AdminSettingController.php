<?php

class AdminSettingController extends AdminController {

	/**
	 * Admin dashboard
	 *
	 */
	public function getIndex()
	{
		$site_name = Setting::get('site_name');
		$contestannlimit = $lim = Setting::get('contest_view_limit');
		$error = $success = null;
		$data['error'] = $error;
		$data['success'] = $success;
		return View::make('admin/setting', $data);
	}

	public function postSite(){
		$error = null;
		$success = null;
		if(Input::get('site_name') == '' || !Input::get('site_name')){
			$error = "Please give a Site Name";
		}else{
			$success = "Site Name Updated.";
			Setting::set('site_name', Input::get('site_name'));
		}
		if(preg_match('/^[0-9]+$/', Input::get('contest_view_limit')) == false){
			if(isset($error)){
				$error = "";
			}
			$error = $error." Please give a valid Integer for Contest Announcement Limit";
		}else{
			if(isset($success)== false) $success = "";
			$success = $success." Contest view limit updated.";
			Setting::set('contest_view_limit', Input::get('contest_view_limit'));
		}

		$data['error'] = $error;
		$data['success'] = $success;
		return View::make('admin/setting', $data);
	}

}
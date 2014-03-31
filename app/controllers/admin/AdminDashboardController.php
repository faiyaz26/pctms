<?php

class AdminDashboardController extends AdminController {

	/**
	 * Admin dashboard
	 *
	 */
	public function getIndex()
	{

		$usercnt = User::count();


		$data ['usercnt'] = $usercnt;

		$contestcnt = ContestAnnouncement::where('contest_datetime', '>', date('Y-m-d H:i:s'))->count();
		$data ['contestcnt'] = $contestcnt;
        return View::make('admin/dashboard', $data);
	}

}
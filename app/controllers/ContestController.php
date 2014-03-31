<?php

class ContestController extends BaseController {
	public function getIndex(){
		$contest = Contest::orderBy('contest_date', 'asc')->get();
		$contest_ann = ContestAnnouncement::where('contest_datetime', '>', date('Y-m-d H:i:s'))->orderBy('contest_datetime', 'asc')->get();
		return View::make('site/contest/index', compact('contest', 'contest_ann'));
	}
}
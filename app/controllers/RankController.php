<?php

class RankController extends BaseController {
	public function getIndex(){
		

		$division = Division::all();
		$season = Season::all();

		$divid = -1;

		if(Input::get('division')){
			$divid = Input::get('division');
		}

		$seaid = -1;

		if(Input::get('season')){
			$seaid = Input::get('season');
		}

		$rank = null;
		if($seaid == -1 && $divid  == -1){
			$d = DB::table('contests')->join('contest_summary', 'contests.id', '=', 'contest_summary.contest_id')
			->groupBy('contest_summary.username')->select(array('contest_summary.username', DB::raw("SUM(contest_summary.points) as points")))->orderBy('points','desc')->get();
			$rank  = $d;
		}else if($seaid == -1){
			$d = DB::table('contests')->where('contests.division_id', '=', $divid)->join('contest_summary', 'contests.id', '=', 'contest_summary.contest_id')
			->groupBy('contest_summary.username')->select(array('contest_summary.username', DB::raw("SUM(contest_summary.points) as points")))->orderBy('points','desc')->get();
			$rank  = $d;
		}else if($divid == -1){
			$d = DB::table('contests')->where('contests.season_id', '=', $seaid)->join('contest_summary', 'contests.id', '=', 'contest_summary.contest_id')
			->groupBy('contest_summary.username')->select(array('contest_summary.username', DB::raw("SUM(contest_summary.points) as points")))->orderBy('points','desc')->get();
			$rank  = $d;
		}else{
			$d = DB::table('contests')->where('contests.division_id', '=', $divid)->where('contests.season_id', '=', $seaid)->join('contest_summary', 'contests.id', '=', 'contest_summary.contest_id')
			->groupBy('contest_summary.username')->select(array('contest_summary.username', DB::raw("SUM(contest_summary.points) as points")))->orderBy('points','desc')->get();
			$rank  = $d;
		}

		return View::make('site/rank/index', compact('division', 'season', 'divid', 'seaid', 'rank'));
	}
}
<?php
use anlutro\cURL\cURL;
class AdminContestController extends AdminController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

	

	public function index()
	{
		$data ['title'] =  "Contest";
		return View::make('admin/contest/index', $data);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{

		$div = Division::all();
		$season = Season::all();
		$data ['title'] =  "Contest";
		$data ['div']  = $div;
		$data ['season'] = $season;
		return View::make('admin/contest/create', $data);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
		$contest = new Contest;
		$contest->contest_name = Input::get('contest_name');
		$contest->contest_date = Input::get('contest_date');
		$contest->contest_description = Input::get('contest_description');
		$contest->season_id = Input::get('season_id');
		$contest->division_id = Input::get('division_id');
		$contest->contest_standing_url =  Input::get('contest_standing_url');
		$contest->contest_judge_data_url = Input::get('contest_judge_data_url');

		if($contest->save()){
			if($this->parser($contest)== true){
				$data ['title'] = "Message";
				$data ['success']  = "Contest Added";
				return View::make('admin/message', $data);
			}else{
				$contest->delete();
				$data ['title'] = "Message";
				$data ['error']  = "Contest not Added, Error Occured";
				return View::make('admin/message', $data);
			}
		}else{
			$error = $contest->errors()->all();
			return Redirect::to('admin/contest/create')
			->withInput(Input::all())
			->with( 'error', $error );
		}
		
} 


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
		$contest= Contest::find($id);
		$div = Division::find($contest->division_id);
		$season = Season::find($contest->season_id);
		$data ['title'] =  "Contest";
		$data ['contest'] = $contest;
		$data ['division']  = $div;
		$data ['season'] = $season;

		return View::make('admin/contest/show', $data);
	}




	public function delete($id){
		$contest = Contest::find($id);
		$data['contest'] = $contest;
		$data['title']  = "Contest";
		return View::make('admin/contest/delete', $data);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$con = Contest::find($id);
		$data ['title'] = "Message";
		$tmp = $con;
		if($con->delete()){
			DB::table('contest_summary')->where('contest_id', '=', $id)->delete();
			$data['success'] = "Contest Named ".$tmp->contest_name." is Deleted";
		}else{
			$data['error'] = "Contest: ".$tmp->contest_name." is not Deleted, Some Error Occured. Please Try Again";		
		}
		return View::make('admin/message', $data);
	}

	public function parser(Contest $contest){

		$curl = new cURL;
		$url = $contest->contest_standing_url;
		$page = $curl->get($url);
			//dd($page->body);
		if($page->info['http_code'] == 404){
			return false;
		}

		$data = array();

		$html = new Htmldom($page->body);


		$html = $html->find('table', 0);
		$ret = $html->find('tr');
		$i = 0;
		$sz = count($ret);
		//return $sz;
		foreach ($ret as $row) {
			$i++;
			if($i < 3 || $i >= $sz) continue;
			$d = array();
			$d['pos'] = $row->find('td', 0)->plaintext;
			
			
			$name = $row->find('td', 1)->plaintext;
			$names = explode('[', $name);
			$names = explode(']',$names[count($names)-1]);

			$d['username']  = $names[0];

			$d['solved']  =    $row->find('td', 2)->plaintext;


			$info = $row->last_child()->plaintext;

			$val = explode('/', $info);

			$d['attempt'] = $val[0];

			//dd($d);
			array_push($data, $d);
		}

		foreach ($data as $d) {
			$summary = new ContestSummary;
			$summary->contest_id = $contest->id;
			$summary->username = $d['username'];
			$summary->solved = $d['solved'];
			$summary->attempt = $d['attempt'];
			$summary->position = $d['pos'];
			$v = $summary->attempt;
			if($v > 0) $v = 1;
			$pnt = Setting::get('points.'.$d['pos']);
			if($pnt == "[]" || $pnt==null){
				$pnt = 0;
			}
			$summary->points = $v * $pnt;

			$summary->save();
		}
		return true;
	}

	public function data(){
		$contests = Contest::select(array('contests.id', 'contests.contest_name', 'contests.contest_description', 'contests.contest_date'));
		return Datatables::of($contests)
		->add_column('actions', '<a href="{{{ URL::to(\'admin/contest/\' . $id  ) }}}" class="iframe btn btn-xs btn-default">Show</a>
			<a href="{{{ URL::to(\'admin/contest/\' . $id . \'/del\' ) }}}" class="iframe btn btn-xs btn-danger">{{{ Lang::get(\'button.delete\') }}}</a>
			')

		->remove_column('id')
		->make();
	}
}

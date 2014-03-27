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
				$contest->delete();
				return "OK";
			}else{
				$contest->delete();
				return "Error";
			}
		}else{
			$error = $contest->errors()->all();
			return Redirect::to('admin/contest/create')
                    ->withInput(Input::all())
                    ->with( 'error', $error );
		}
		/*
		if($contest->save()){
			$data['title'] = "Contest Announcement";
			$data['contest'] = $contest;
			$data['success'] = "Contest Announcement Entry Added";
			return View::make('admin/contest/edit', $data);
		}else{
			$error = $div->errors()->all();
			return Redirect::to('admin/contest/create')
                    ->withInput(Input::all())
                    ->with( 'error', $error );
		} */
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
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
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
		return true;
	}

	public function data(){
		$contests = Contest::select(array('contests.id', 'contests.contest_name', 'contests.contest_description', 'contests.contest_date'));
		return Datatables::of($contests)
		->add_column('actions', '<a href="{{{ URL::to(\'admin/contest/\' . $id . \'/edit\' ) }}}" class="iframe btn btn-xs btn-default">{{{ Lang::get(\'button.edit\') }}}</a>
                                <a href="{{{ URL::to(\'admin/contest/\' . $id . \'/del\' ) }}}" class="iframe btn btn-xs btn-danger">{{{ Lang::get(\'button.delete\') }}}</a>
                    ')

        ->remove_column('id')
        ->make();
	}
}

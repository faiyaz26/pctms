<?php

class AdminSeasonController extends AdminController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
    protected $season;
    public function __construct(Season $div)
    {
        parent::__construct();
        $this->season = $div; 
    }
	public function index()
	{
		$data['title'] = "Season";
		return View::make('admin/season/index', $data);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$data['title'] = "Season";
		return View::make('admin/season/create', $data);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$div = new Season;
		$div->season_name = Input::get('season_name');
		$div->season_description = Input::get('season_description');

		if($div->save()){
			$data['title'] = "Season";
			$data['div'] = $div;
			$data['success'] = "Season Entry Added";
			
			return View::make('admin/season/edit', $data);
		}
		else{
			$error = $div->errors()->all();
			return Redirect::to('admin/season/create')
                    ->withInput(Input::all())
                    ->with( 'error', $error );
		}
		return "Error";
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
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{

		$div = Season::find($id);
		
		$data['title'] = "Season";
		$data['div'] = $div;
		return View::make('admin/season/edit', $data);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$div = Season::find($id);
		$div->season_name = Input::get('season_name');
		$div->season_description = Input::get('season_description');
		if($div->updateUniques()){
			$data['title'] = "Season";
			$data['div'] = $div;
			$data['success'] = "Season Entry Updated";
			return View::make('admin/season/edit', $data);
		}
		else{
			$error = $div->errors()->all();
			return Redirect::to('admin/season/'.$div->id.'/edit')
                    ->withInput(Input::all())
                    ->with( 'error', $error );
		}
		return "Error";
	}


	public function delete($id){
		$div = Season::find($id);
		$data ['div'] = $div;
		$data ['title'] = "Delete";
		return View::make('admin/season/delete', $data);
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$div = Season::find($id);
		$name = $div->season_name;
		$data ['title'] = "Message";
		if($div->delete()){
			$data['success'] = "Season Named ".$name." is Deleted";
		}else{
			$data['error'] = $name." is not Deleted, Some Error Occured. Please Try Again";
		}
		return View::make('admin/message', $data);
	}


	public function data(){
		//(array('seasons.id',  'seasons.season_name', 'seasons.season_description')
		$seasons = Season::select(array('seasons.id', 'seasons.season_name', 'seasons.season_description'));
		return Datatables::of($seasons)
		->add_column('actions', '<a href="{{{ URL::to(\'admin/season/\' . $id . \'/edit\' ) }}}" class="iframe btn btn-xs btn-default">{{{ Lang::get(\'button.edit\') }}}</a>
                                <a href="{{{ URL::to(\'admin/season/\' . $id . \'/del\' ) }}}" class="iframe btn btn-xs btn-danger">{{{ Lang::get(\'button.delete\') }}}</a>
                    ')

        ->remove_column('id')
        ->make();
	}

}

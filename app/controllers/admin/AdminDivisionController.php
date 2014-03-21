<?php

class AdminDivisionController extends AdminController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
    protected $division;
    public function __construct(Division $div)
    {
        parent::__construct();
        $this->division = $div; 
    }
	public function index()
	{
		$data['title'] = "Division";
		return View::make('admin/division/index', $data);
		
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$data['title'] = "Division";
		return View::make('admin/division/create', $data);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$div = new Division;
		$div->division_name = Input::get('division_name');
		$div->division_description = Input::get('division_description');

		if($div->save()){
			$data['title'] = "Division";
			$data['div'] = $div;
			$data['success'] = "Division Entry Added";
			
			return View::make('admin/division/edit', $data);
		}
		else{
			$error = $div->errors()->all();
			return Redirect::to('admin/division/create')
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

		$div = Division::find($id);
		
		$data['title'] = "Division";
		$data['div'] = $div;
		return View::make('admin/division/edit', $data);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$div = Division::find($id);
		$div->division_name = Input::get('division_name');
		$div->division_description = Input::get('division_description');
		if($div->updateUniques()){
			$data['title'] = "Division";
			$data['div'] = $div;
			$data['success'] = "Division Entry Updated";
			return View::make('admin/division/edit', $data);
		}
		else{
			$error = $div->errors()->all();
			return Redirect::to('admin/division/'.$div->id.'/edit')
                    ->withInput(Input::all())
                    ->with( 'error', $error );
		}
		return "Error";
	}


	public function delete($id){
		$div = Division::find($id);
		$data ['div'] = $div;
		$data ['title'] = "Delete";
		return View::make('admin/division/delete', $data);
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$div = Division::find($id);
		$name = $div->division_name;
		$data ['title'] = "Message";
		if($div->delete()){
			$data['success'] = "Division Named ".$name." is Deleted";
		}else{
			$data['error'] = $name." is not Deleted, Some Error Occured. Please Try Again";
		}
		return View::make('admin/message', $data);
	}


	public function data(){
		//(array('divisions.id',  'divisions.division_name', 'divisions.division_description')
		$divisions = Division::select(array('divisions.id', 'divisions.division_name', 'divisions.division_description'));
		return Datatables::of($divisions)->add_column('users', '{{{ DB::table(\'user_infos\')->where(\'division_id\', \'=\', $id)->count() }}}')
		->add_column('actions', '<a href="{{{ URL::to(\'admin/division/\' . $id . \'/edit\' ) }}}" class="iframe btn btn-xs btn-default">{{{ Lang::get(\'button.edit\') }}}</a>
                                <a href="{{{ URL::to(\'admin/division/\' . $id . \'/del\' ) }}}" class="iframe btn btn-xs btn-danger">{{{ Lang::get(\'button.delete\') }}}</a>
                    ')

        ->remove_column('id')
        ->make();
	}

}

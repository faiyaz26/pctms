<?php

class AdminContestAnnouncementController extends AdminController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$data ['title'] = "Contest Announcement";
		return View::make('admin/announcement/index', $data);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$data['title'] = "Contest Announcement";
		return View::make('admin/announcement/create', $data);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
		$contest = new ContestAnnouncement;
		$contest->contest_name = Input::get('contest_name');
		$contest->contest_datetime = Input::get('contest_datetime');
		$contest->contest_description = Input::get('contest_description');

		if($contest->save()){
			$data['title'] = "Contest Announcement";
			$data['contest'] = $contest;
			$data['success'] = "Contest Announcement Entry Added";
			return View::make('admin/announcement/edit', $data);
		}else{
			$error = $div->errors()->all();
			return Redirect::to('admin/announcement/create')
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
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$data['title'] = "Contest Announcement";
		$data['contest'] = ContestAnnouncement::find($id);
		return View::make('admin/announcement/edit', $data);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$contest = ContestAnnouncement::find($id);
		$contest->contest_name = Input::get('contest_name');
		$contest->contest_datetime = Input::get('contest_datetime');
		$contest->contest_description = Input::get('contest_description');
		if($contest->save()){
			$data['title'] = "Contest Announcement";
			$data['contest'] = $contest;
			$data['success'] = "Contest Announcement Entry Updated";
			return View::make('admin/announcement/edit', $data);
		}else{
			$error = $contest->errors()->all();
			return Redirect::to('admin/announcement/'.$id.'/edit')
                    ->withInput(Input::all())
                    ->with( 'error', $error );
		}
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$con = ContestAnnouncement::find($id);
		$name = $con->contest_name;
		$data ['title'] = "Message";
		if($con->delete()){
			$data['success'] = "Contest Announcement Named <strong>".$name."</strong> is Deleted";
		}else{
			$data['error'] = $name." is not Deleted, Some Error Occured. Please Try Again";
		}
		return View::make('admin/message', $data);
	}


	public function delete($id){
		$contest = ContestAnnouncement::find($id);
		$data['contest'] = $contest;
		$data['title']  = "Contest";
		return View::make('admin/announcement/delete', $data);
	}



	public function data(){
		$contests = ContestAnnouncement::select(array('contest_announcement.id', 'contest_announcement.contest_name', 'contest_announcement.contest_description', 'contest_announcement.contest_datetime'));
		return Datatables::of($contests)
		->add_column('actions', '<a href="{{{ URL::to(\'admin/announcement/\' . $id . \'/edit\' ) }}}" class="iframe btn btn-xs btn-default">{{{ Lang::get(\'button.edit\') }}}</a>
                                <a href="{{{ URL::to(\'admin/announcement/\' . $id . \'/del\' ) }}}" class="iframe btn btn-xs btn-danger">{{{ Lang::get(\'button.delete\') }}}</a>
                    ')

        ->remove_column('id')
        ->make();
	}
}

<?php

class AdminUsersController extends AdminController {


    /**
     * User Model
     * @var User
     */
    protected $user;

    /**
     * Role Model
     * @var Role
     */
    protected $role;

    /**
     * Permission Model
     * @var Permission
     */
    protected $permission;

    protected $user_infos;

    /**
     * Inject the models.
     * @param User $user
     * @param Role $role
     * @param Permission $permission
     */
    public function __construct(User $user, Role $role, Permission $permission)
    {
        parent::__construct();
        $this->user = $user;
        $this->role = $role;
        $this->permission = $permission;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function getIndex()
    {
        // Title
        $title = Lang::get('admin/users/title.user_management');

        // Grab all the users
        $users = $this->user;

        // Show the page
        return View::make('admin/users/index', compact('users', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function getCreate()
    {
        // All roles
        $roles = $this->role->all();

        // Get all the available permissions
        $permissions = $this->permission->all();

        // Selected groups
        $selectedRoles = Input::old('roles', array());

        // Selected permissions
        $selectedPermissions = Input::old('permissions', array());

		// Title
		$title = Lang::get('admin/users/title.create_a_new_user');

		// Mode
		$mode = 'create';

        return View::make('admin/users/create',compact('roles', 'title', 'selectedRoles'));
		// Show the page
		return View::make('admin/users/create_edit', compact('roles', 'permissions', 'selectedRoles', 'selectedPermissions', 'title', 'mode'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function postCreate()
    {
        $this->user->fullname = Input::get('fullname');
        $this->user->username = Input::get( 'username' );
        $this->user->email = Input::get( 'email' );
        $this->user->password = Input::get( 'password' );

        // The password confirmation will be removed from model
        // before saving. This field will be used in Ardent's
        // auto validation.
        $this->user->password_confirmation = Input::get( 'password_confirmation' );
        $this->user->confirmed = Input::get( 'confirm' );

        // Permissions are currently tied to roles. Can't do this yet.
        //$user->permissions = $user->roles()->preparePermissionsForSave(Input::get( 'permissions' ));

        // Save if valid. Password field will be hashed before save
        $this->user->save();

        if ($this->user->id)
        {
            // Save roles. Handles updating.
            $this->user->saveRoles(Input::get( 'roles' ));

            $info = new UserInfo;

            $info->user_id = $this->user->id;
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
            return Redirect::to('admin/users/' . $this->user->id . '/edit')->with('success', Lang::get('admin/users/messages.create.success'));
        }
        else
        {
            // Get validation errors (see Ardent package)
            $error = $this->user->errors()->all();

            return Redirect::to('admin/users/create')
                ->withInput(Input::except('password'))
                ->with( 'error', $error );
        }
    }

    /**
     * Display the specified resource.
     *
     * @param $user
     * @return Response
     */
    public function getShow($user)
    {
        // redirect to the frontend
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $user
     * @return Response
     */
    public function getEdit($user)
    {
        if ( $user->id )
        {
            $roles = $this->role->all();
            $permissions = $this->permission->all();
            $info = UserInfo::where('user_id' , '=', $user->id)->first();
            // Title
        	$title = Lang::get('admin/users/title.user_update');
        	// mode
        	$mode = 'edit';

        	return View::make('admin/users/edit', compact('user', 'roles', 'permissions', 'title', 'mode', 'info'));
        }
        else
        {
            return Redirect::to('admin/users')->with('error', Lang::get('admin/users/messages.does_not_exist'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param $user
     * @return Response
     */
    public function postEdit($user)
    {

        $user->fullname = Input::get('fullname');
        $user->username = Input::get( 'username' );
        $user->email = Input::get( 'email' );
        

        // The password confirmation will be removed from model
        // before saving. This field will be used in Ardent's
        // auto validation.

        if(Input::get('password')){
            $user->password = Input::get( 'password' );
            $user->password_confirmation = Input::get( 'password_confirmation' );
        }

        
        $user->confirmed = Input::get( 'confirm' );

        // Permissions are currently tied to roles. Can't do this yet.
        //$user->permissions = $user->roles()->preparePermissionsForSave(Input::get( 'permissions' ));

        // Save if valid. Password field will be hashed before save
        

        if ( $user->updateUniques() )
        {
            // Save roles. Handles updating.
            $user->saveRoles(Input::get( 'roles' ));

            $info = UserInfo::where('user_id', '=', Auth::user()->id)->first();

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
            return Redirect::to('admin/users/' . $user->id . '/edit')->with('success', "User Updated successfully");
        }
        else
        {
            // Get validation errors (see Ardent package)
            $error = $user->errors()->all();

            return Redirect::to('admin/users/' . $user->id . '/edit')
                ->withInput(Input::except('password'))
                ->with( 'error', $error );
        }
    }

    /**
     * Remove user page.
     *
     * @param $user
     * @return Response
     */
    public function getDelete($user)
    {
        // Title
        $title = Lang::get('admin/users/title.user_delete');

        // Show the page
        return View::make('admin/users/delete', compact('user', 'title'));
    }

    /**
     * Remove the specified user from storage.
     *
     * @param $user
     * @return Response
     */
    public function postDelete($user)
    {
        // Check if we are not trying to delete ourselves
        if ($user->id === Confide::user()->id)
        {
            // Redirect to the user management page
            return Redirect::to('admin/users')->with('error', Lang::get('admin/users/messages.delete.impossible'));
        }

        AssignedRoles::where('user_id', $user->id)->delete();

        $id = $user->id;
        $user->delete();

        // Was the comment post deleted?
        $user = User::find($id);
        if ( empty($user) )
        {
            // TODO needs to delete all of that user's content
            return Redirect::to('admin/users')->with('success', Lang::get('admin/users/messages.delete.success'));
        }
        else
        {
            // There was a problem deleting the user
            return Redirect::to('admin/users')->with('error', Lang::get('admin/users/messages.delete.error'));
        }
    }

    /**
     * Show a list of all the users formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function getData()
    {
        $users = User::leftjoin('assigned_roles', 'assigned_roles.user_id', '=', 'users.id')
                    ->leftjoin('roles', 'roles.id', '=', 'assigned_roles.role_id')
                    ->select(array('users.id', 'users.username','users.email', 'roles.name as rolename', 'users.confirmed', 'users.created_at'));
        return Datatables::of($users)
        // ->edit_column('created_at','{{{ Carbon::now()->diffForHumans(Carbon::createFromFormat(\'Y-m-d H\', $test)) }}}')

        ->edit_column('confirmed','@if($confirmed)
                            Yes
                        @else
                            No
                        @endif')

        ->add_column('actions', '<a target = "_blank" href="{{{ URL::to(\'admin/users/\' . $id . \'/edit\' ) }}}" class="btn btn-xs btn-default">{{{ Lang::get(\'button.edit\') }}}</a>
                                @if($username == \'admin\')
                                @else
                                    <a href="{{{ URL::to(\'admin/users/\' . $id . \'/delete\' ) }}}" class="iframe btn btn-xs btn-danger">{{{ Lang::get(\'button.delete\') }}}</a>
                                @endif
            ')

        ->remove_column('id')

        ->make();
    }
}

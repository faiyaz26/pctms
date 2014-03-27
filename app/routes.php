<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

/** ------------------------------------------
 *  Route model binding
 *  ------------------------------------------
 */
Route::model('user', 'User');
Route::model('comment', 'Comment');
Route::model('post', 'Post');
Route::model('role', 'Role');



/** ------------------------------------------
 *  Route constraint patterns
 *  ------------------------------------------
 */
Route::pattern('comment', '[0-9]+');
Route::pattern('post', '[0-9]+');
Route::pattern('user', '[0-9]+');
Route::pattern('role', '[0-9]+');
Route::pattern('token', '[0-9a-z]+');

/** ------------------------------------------
 *  Admin Routes
 *  ------------------------------------------
 */
Route::group(array('prefix' => 'admin', 'before' => 'auth'), function()
{

    # Comment Management
    Route::get('comments/{comment}/edit', 'AdminCommentsController@getEdit');
    Route::post('comments/{comment}/edit', 'AdminCommentsController@postEdit');
    Route::get('comments/{comment}/delete', 'AdminCommentsController@getDelete');
    Route::post('comments/{comment}/delete', 'AdminCommentsController@postDelete');
    Route::controller('comments', 'AdminCommentsController');

    # Blog Management
    Route::get('blogs/{post}/show', 'AdminBlogsController@getShow');
    Route::get('blogs/{post}/edit', 'AdminBlogsController@getEdit');
    Route::post('blogs/{post}/edit', 'AdminBlogsController@postEdit');
    Route::get('blogs/{post}/delete', 'AdminBlogsController@getDelete');
    Route::post('blogs/{post}/delete', 'AdminBlogsController@postDelete');
    Route::controller('blogs', 'AdminBlogsController');

    # User Management
    Route::get('users/{user}/show', 'AdminUsersController@getShow');
    Route::get('users/{user}/edit', 'AdminUsersController@getEdit');
    Route::post('users/{user}/edit', 'AdminUsersController@postEdit');
    Route::get('users/{user}/delete', 'AdminUsersController@getDelete');
    Route::post('users/{user}/delete', 'AdminUsersController@postDelete');
    Route::controller('users', 'AdminUsersController');

    # User Role Management
    Route::get('roles/{role}/show', 'AdminRolesController@getShow');
    Route::get('roles/{role}/edit', 'AdminRolesController@getEdit');
    Route::post('roles/{role}/edit', 'AdminRolesController@postEdit');
    Route::get('roles/{role}/delete', 'AdminRolesController@getDelete');
    Route::post('roles/{role}/delete', 'AdminRolesController@postDelete');
    Route::controller('roles', 'AdminRolesController');


    #Division Management
    Route::get('division/data', 'AdminDivisionController@data');
    Route::get('division/{division}/del', 'AdminDivisionController@delete');
    Route::resource('division', 'AdminDivisionController');


    Route::get('announcement/data', 'AdminContestAnnouncementController@data');
    Route::get('announcement/{announcement}/del', 'AdminContestAnnouncementController@delete');
    Route::resource('announcement', 'AdminContestAnnouncementController');




    #Season Management
    Route::get('season/data', 'AdminSeasonController@data');
    Route::get('season/{season}/del', 'AdminSeasonController@delete');
    Route::resource('season', 'AdminSeasonController');


    #Season Management
    Route::get('contest/data', 'AdminContestController@data');
    Route::get('contest/{contest}/del', 'AdminContestController@delete');
    Route::resource('contest', 'AdminContestController');

    //Route::get('division', 'AdminDivisionController@index');

    # Admin Dashboard
    Route::controller('/', 'AdminDashboardController');
});


/** ------------------------------------------
 *  Frontend Routes
 *  ------------------------------------------
 */

// Profile Show routes
Route::get('/settings', 'ProfileController@getSettings');
Route::post('/settings', 'ProfileController@postSettings');
Route::get('/profile/{username?}', 'ProfileController@show');

Route::get('/profile/{username}/test2', 'ProfileController@test2');


Route::get('profile/{username}/contests', 'ProfileController@contest');

Route::get('/test', function(){
    Setting::set('points', array('1' => 20, '2' => 15, '3' => 12., '4' => 10, '5' => 8, '6' => 6, '7' => 4, '8' => 3, '9'=> 2, '10' => 1));
     $p = 1;
     $pnt = Setting::get('ponts'.$p);
     if($pnt == "[]" || $pnt==null){
        return 0;
     }
     return $pnt;
});
// User reset routes
Route::get('user/reset/{token}', 'UserController@getReset');
// User password reset
Route::post('user/reset/{token}', 'UserController@postReset');
//:: User Account Routes ::
Route::post('user/{user}/edit', 'UserController@postEdit');

//:: User Account Routes ::
Route::post('user/login', 'UserController@postLogin');

# User RESTful Routes (Login, Logout, Register, etc)
Route::controller('user', 'UserController');
Route::get('/register', 'UserController@getCreate');
Route::get('/login', 'UserController@getLogin');
//:: Application Routes ::

# Filter for detect language
Route::when('contact-us','detectLang');

# Contact Us Static Page
Route::get('contact-us', function()
{
    // Return about us page
    return View::make('site/contact-us');
});

# Posts - Second to last set, match slug
Route::get('{postSlug}', 'BlogController@getView');
Route::post('{postSlug}', 'BlogController@postView');

# Index Page - Last route, no matches
Route::get('/', array('before' => 'detectLang','uses' => 'BlogController@getIndex'));

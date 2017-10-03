<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::any('/articles/{catname?}/{subcatname?}', 'ArticlesController@index');
Route::any('/articledetail/{articleurl}', 'ArticlesController@articledetail');
Route::any('/newsdetail/{articleurl}', 'ArticlesController@newsdetail');
Route::any('/makedeletearticle/{id}', 'ArticlesController@deletearticle');
Route::any('/discussions', 'DiscussionController@index');
Route::any('/discussiondetail/{url}', 'DiscussionController@discussionshow');
Route::any('/delete_discussion/{id}', 'DiscussionController@deletediscussion');
Route::any('/digital-locker', 'DigitallockerController@index');

Route::any('/deletejob/{id}', 'JobController@deletejob');


///////////////job listing
Route::any('/joblisting', 'JobController@joblisting');
Route::any('/userlisting', 'UserController@userlisting');
Route::any('/setappointment/{jobid}/{userid}', 'JobController@setappointment');
Route::any('/appointment', 'JobController@allappointment');

Route::any('/editappointment/{id}', 'JobController@editappointment');


Route::any('/postjob', 'JobController@postjob');
Route::any('/joblist/{pagename?}', 'JobController@userjobslist');
Route::any('/applylist/{id}', 'JobController@applylist');
Route::any('/makenews', 'UserController@makenews');
Route::any('/companycredibility', 'UserController@companycredibility');

Route::any('/deletcompenews/{id}', 'UserController@deletenews');
Route::any('/jobdetail/{pagename?}', 'JobController@jobdetail');
Route::any('/compnaydetail/{id}', 'UserController@compnaydetail');
Route::any('/see-all-connections-page', 'UserController@allconnections');
Route::any('/see-all-saves', 'UserController@allsaves');

/////////////////////////// profile//////////
Route::any('/profile/{pagename?}', 'UserController@index');
Route::any('/editprofile/{pagename?}', 'UserController@editprofile');
Route::any('/companyprofile', 'UserController@companyprofile');
Route::any('/editcompany', 'UserController@editcompany');
Route::any('/createsubuser', 'UserController@createsubuser');
Route::any('/userdetail/{id}', 'UserController@userdetail');

//////////////////////////////////////
Route::post('career/postjob', 'mainController@postjob');
Route::get('/contactus', 'mainController@contactus');
Route::get('/super-fast-&-accurate-recuruiting', 'mainController@superfast');
Route::get('/corporate-connections', 'mainController@corporate');


Route::get('/professional-skill', 'mainController@professionalskill');

Route::get('/avail-digital-locker', 'mainController@availdigitallocker');

Route::get('/cookie-policy', 'mainController@cookiepolicy');


Route::get('/privacy-policy', 'mainController@cookiepolicy');

Route::get('/avail-digital-locker', 'mainController@availdigitallocker');

Route::get('faq', 'mainController@faq');
Route::get('/','mainController@index');

/////////////////////////////// ajax login////
Route::post('/reportincorrectbox','ajaxRequestController@reportincorrect');
Route::post('/savereportincorrect','ajaxRequestController@savefreportincorrectdata');

Route::post('/subcatlistajax','ajaxRequestController@subcatlistajax');
Route::any('/getuserlist','ajaxRequestController@getuserlist');
Route::any('/getuniversity','ajaxRequestController@getuniversity');
Route::any('/savedetails','ajaxRequestController@savedetails');
Route::post('/ajaxlogin','ajaxRequestController@loginform');
Route::get('/ajaxauthnticate','Auth\AuthController@postLoginajax');
Route::post('/getsubcourselist','ajaxRequestController@getsubcourselist');

Route::post('/statelist','ajaxRequestController@statelist');
Route::post('/citylist','ajaxRequestController@citylist');
Route::post('/userupdates','ajaxRequestController@userupdates');
/*adding terms and policy page */
Route::get('/terms', 'mainController@terms');
Route::get('/privacy-policy', 'mainController@privacy');
Route::any('/contactus', 'mainController@contactus');
// Route::post('/contactus', 'mainController@saveContactFormInfo');
 // Password reset link request routes...
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');

// Password reset routes...
Route::get('password/reset/{token}/{email?}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');

/////////////////////////////////////////////////////////////////////////////

Route::post('/loadsharebox','DigitallockerController@sharedocument');
Route::post('/sharedocument','DigitallockerController@makesharedocument');
Route::post('/deletedocument','DigitallockerController@deletedocument');
///////////////////////////////////////////////////////////////////////
Route::post('/connectmailbox','ajaxRequestController@connectviamailbox');
Route::get('/search/{pagename}','SearchController@makesearch');

Route::group(array('namespace'=>'admin'), function()
{   
			Route::get('/admin', 'AdminController@index');
			Route::post('/postIndex', 'AdminController@postIndex');
			Route::get('/admin/dashboard', 'AdminController@dashboard');
			Route::get('/admin/logout', 'AdminController@getLogout');
			Route::get('/admin/user/manage', 'AdminController@manageuser');
			Route::any('/admin/makeuser', 'AdminController@makeuser');
			Route::any('/editadminuser/{userID}', 'AdminController@editadminuser');
			Route::any('/admin/makeuser/edit/{userID}', 'AdminController@makeuser');
			Route::get('updateuserstatus/{id}/{status}', 'AdminController@adminuserstatus');
			Route::any('/admin/location/{type?}/{id?}', 'AdminController@locationtype');
			Route::any('/locationstatus/{type?}/{id?}', 'AdminController@changelocationstatus');

			Route::any('/admin/articles/{type?}/{id?}', 'AdminController@articlesmaster');
			Route::any('/categorystatus/{type?}/{id?}', 'AdminController@changecategorystatus');
			Route::any('/articlelist', 'AdminController@articlelist');
			Route::any('/deletearticle/{id}', 'AdminController@deletearticle');
			Route::any('/articlestatus/{id}', 'AdminController@articlestatus');
			Route::any('/discussionlist', 'AdminController@discussionlist');
			Route::any('/deletediscussion/{id}', 'AdminController@deletediscussion');
			Route::any('/discussionstatus/{id}', 'AdminController@discussionstatus');
			Route::any('/invitationlisting', 'AdminController@invitationlist');
			Route::any('/reportincorrect', 'AdminController@reportincorrect');

            Route::any('/article-comment-list', 'AdminController@article_comment');
			Route::any('/discussion-comment-list', 'AdminController@discussion_comment');
            Route::any('/deletecomment/{id}', 'AdminController@deletecomment');
			Route::any('/commentstatus/{id}', 'AdminController@commentstatus');
			//////////////locker////
			Route::any('/digitallocker', 'AdminController@digitallocker');
			Route::any('/admin/schooboardlist/{id?}', 'AdminController@schoolist');
			Route::any('/admin/industrylist/{id?}', 'AdminController@industrylist');
			Route::any('/admin/mediumlist/{id?}', 'AdminController@mediumlist');
			Route::any('/admin/courselist/{id?}', 'AdminController@coursetype');
			Route::any('/admin/subcourselist/{id?}', 'AdminController@subcourselist');
			Route::get('admin/changepassword', 'AdminController@changepassword');
			Route::post('admin/postpassword', 'AdminController@postpassword');
			Route::any('/changestatuscommon/{id}/{statusfor}', 'AdminController@changestatuscommon');
			/////////////compnay master////////
			Route::any('/admin/companylist', 'AdminController@companylist');
			Route::any('/admin/newslist', 'AdminController@newslist');
			Route::any('/deletenews/{id}', 'AdminController@deletenews');
			Route::any('/newsstatus/{id}', 'AdminController@newsstatus');
			/////////////////////// job list//////
			Route::any('/admin/joblist/{pagename?}', 'AdminController@joblist');
			//////// broadcast message////
			Route::any('/admin/broadcast/{id?}', 'AdminController@broadcastmsg');
			Route::any('/admin/applylist', 'AdminController@applylistall');

			/////// credibilty//////
			Route::any('/admin/credibiltycategory/{type?}/{id?}', 'AdminController@credibiltycategory');
			Route::any('/admin/allappointment', 'AdminController@allappointment');
			// Route::any('/admin/credibiltyfactors', 'AdminController@credibiltyfactors');
    
});

Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::get('auth/admin', 'Auth\AuthController@getadminlogin');
Route::post('auth/login', 'Auth\AuthController@userlogin_register');
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');
Route::get('auth/logout', 'Auth\AuthController@getLogout');
Route::get('/saveuseraction','ajaxRequestController@saveuseraction');
Route::any('eventviewcounter/', 'ajaxRequestController@eventviewcounter');

Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');
Route::get('resetandroidpassword', 'Auth\PasswordController@sendpasswordreselink');

// Password reset routes...
Route::get('password/reset/{token}/{email?}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');

/*social login routes*/
Route::get('/sociallogin/{provider?}',[
    'uses' => 'Auth\AuthController@getSocialAuth',
    'as'   => 'auth.getSocialAuth'
]);


Route::get('/sociallogin/callback/{provider?}',[
    'uses' => 'Auth\AuthController@getSocialAuthCallback',
    'as'   => 'auth.getSocialAuthCallback'
]);

Route::get('error404', 'eventController@errorpage');

Route::get('/errorpage', 'eventController@commonerror');






<?php
/*

|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|

| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which

| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {



//     return view('welcome');



// });



Route::get('ma-xac-nhan.html', array('as' => 'captcha', function()



{ 



    return Extend\Validator\Captcha::render();



}));







Route::get('/', [
    'as' => 'home',  
    'uses' => '\Nova\Home\Http\Controllers\IndexController@home'
]);

Route::post('user-post-article', [
    'as' => 'user.postArticle',  
    'uses' => '\Nova\Home\Http\Controllers\IndexController@storeArticle'
]);

/***************************************** Admin route ********************************************************/

Route::get('/admin', function () {



    return Redirect::route('admin.login');



});



Route::get('admin/login',  array('as' => 'admin.login',  'uses' => '\Nova\Admin\Http\Controllers\IndexController@login'));


Route::post('admin/logged', array('as' => 'admin.logged', 'uses' => '\Nova\Admin\Http\Controllers\IndexController@logged'));







/******************************** End admin route not login ******************************************/



Route::group(['middleware' => 'Admin'], function () {



	//Admin route has loged



	Route::get('admin/home', [



    'as'   => 'admin.home',


    	'uses' => '\Nova\Admin\Http\Controllers\IndexController@blogList'
	    //'uses'   => '\Nova\Admin\Http\Controllers\IndexController@listForm'



	]);



	Route::get('admin/changePass', [



	    'as'   => 'admin.change_pw',  



	    'uses' => '\Nova\Admin\Http\Controllers\IndexController@change_pw'



	]);

	Route::get('admin/logout', [
	    'as'   => 'admin.logout',  
	    'uses' => '\Nova\Admin\Http\Controllers\IndexController@logout'
	]);

	Route::get('admin/admin-info', [
	    'as'   => 'admin.adminInfo',  
	    'uses' => '\Nova\Admin\Http\Controllers\IndexController@adminInfo'
	]);

	Route::post('admin/admin-info-submit', [
	    'as'   => 'admin.adminInfoSubmit',  
	    'uses' => '\Nova\Admin\Http\Controllers\IndexController@adminInfoSubmit'
	]);



	Route::get('admin/email-template', [


	    'as'   => 'admin.emailtemplate', 



	    'uses' => '\Nova\Admin\Http\Controllers\IndexController@emailTemplate'



	]);

	Route::get('admin/email-template-add-{id?}', [
	    'as' => 'admin.addEmailTemplate', 
	    'uses' => '\Nova\Admin\Http\Controllers\IndexController@addEmailTemplate'
	]);

	Route::post('admin/email-template-store', [
	    'as' => 'admin.storemailTemplate', 
	    'uses' => '\Nova\Admin\Http\Controllers\IndexController@storemailTemplate'
	]);

	Route::post('get-data-job', [
	    'as' => 'admin.getDataJob', 
	    'uses' => '\Nova\Home\Http\Controllers\IndexController@getDataJob'
	]);

	Route::post('admin/sendEmailTest', [
	    'as' => 'admin.sendEmailTest', 
	    'uses' => '\Nova\Admin\Http\Controllers\IndexController@sendEmailTest'
	]);

	Route::get('admin/del-email-template-{tem_id?}', [
	    'as'   => 'admin.delEmailTemplate', 
	    'uses' => '\Nova\Admin\Http\Controllers\IndexController@delEmailTemplate'
	]);

	Route::get('admin/list-form', [
	    'as'   => 'admin.listForm',  
	    'uses' => '\Nova\Admin\Http\Controllers\IndexController@listForm'
	]);



	Route::any('admin/blog-list', [
	    'as'   => 'admin.blogList',  
	    'uses' => '\Nova\Admin\Http\Controllers\IndexController@blogList'
	]);

	Route::get('admin/template-setting', [
	    'as'   => 'admin.configTemplate',  
	    'uses' => '\Nova\Admin\Http\Controllers\IndexController@configTemplate'
	]);


	Route::get('admin/intro-text', [
	    'as'   => 'admin.introTxt',  
	    'uses' => '\Nova\Admin\Http\Controllers\IndexController@introTxt'
	]);

	Route::post('admin/intro-text-submit', [
	    'as'   => 'admin.introTxtSubmit',  
	    'uses' => '\Nova\Admin\Http\Controllers\IndexController@introTxtSubmit'
	]);

	Route::get('admin/update-blogs/{id?}', [
	    'as'   => 'admin.updateBlog',  
	    'uses' => '\Nova\Admin\Http\Controllers\IndexController@updateBlog'
	]);

	Route::post('admin/upate-blog-submit', [
	    'as'   => 'admin.updateBlogSubmit',  
	    'uses' => '\Nova\Admin\Http\Controllers\IndexController@updateBlogSubmit'
	]);

	Route::get('admin/update-template/{id?}', [
	    'as'   => 'admin.updateTemplate',  
	    'uses' => '\Nova\Admin\Http\Controllers\IndexController@updateTemplate'
	]);

	Route::post('admin/update-template-submit', [
	    'as'   => 'admin.updateTemp.Submit',  
	    'uses' => '\Nova\Admin\Http\Controllers\IndexController@updateTemplateSubmit'
	]);

	Route::post('admin/remove-logo-top-navbar', [
	    'as'   => 'admin.removeLogoTopBar',  
	    'uses' => '\Nova\Admin\Http\Controllers\IndexController@removeLogoTopBar'
	]);

	Route::post('admin/remove-photo-contact', [
	    'as'   => 'admin.removePhotoContact',  
	    'uses' => '\Nova\Admin\Http\Controllers\IndexController@removePhotoContact'
	]);

	Route::get('admin/view-content-email', [
	    'as'   => 'admin.viewEmail',  
	    'uses' => '\Nova\Admin\Http\Controllers\IndexController@viewEmail'
	]);

	Route::get('admin/view-form-submited', [
	    'as'   => 'admin.viewfrmSubmit',  
	    'uses' => '\Nova\Admin\Http\Controllers\IndexController@viewfrmSubmit'
	]);

	Route::get('admin/export-contact-form-submited', [
	    'as' => 'admin.exContactFormSubmited', 
	    'uses' => '\Nova\Admin\Http\Controllers\IndexController@exContactFormSubmited'
	]);

	Route::post('admin/del-form', [
	    'as'   => 'admin.delForm',  
	    'uses' => '\Nova\Admin\Http\Controllers\IndexController@delForm'
	]);


	Route::post('admin/publish-blog', [
	    'as'   => 'admin.publishBlog',  
	    'uses' => '\Nova\Admin\Http\Controllers\IndexController@publishBlog'
	]);

	Route::post('admin/del-blog-submited', [
	    'as'   => 'admin.delBlogSubmited',  
	    'uses' => '\Nova\Admin\Http\Controllers\IndexController@delBlogSubmited'
	]);

	Route::post('admin/del-apply-submited', [
	    'as'   => 'admin.delApplySubmited',  
	    'uses' => '\Nova\Admin\Http\Controllers\IndexController@delApplySubmited'
	]);

	Route::post('admin/del-form-submited', [
	    'as'   => 'admin.delFormSubmited',  
	    'uses' => '\Nova\Admin\Http\Controllers\IndexController@delFormSubmited'
	]);

	Route::get('admin/new-form/{id?}', [
	    'as'   => 'admin.newForm',  
	    'uses' => '\Nova\Admin\Http\Controllers\IndexController@newForm'
	]);


	Route::get('admin/webmaster-plan/{id?}', [

	    'as'   => 'admin.webPlan',  

	    'uses' => '\Nova\Admin\Http\Controllers\IndexController@webPlan'
	]);


	Route::post('admin/webmaster-plan-submit/{id?}', [

	    'as'   => 'admin.webPlanSubmit',  

	    'uses' => '\Nova\Admin\Http\Controllers\IndexController@webPlanSubmit'
	]);

	Route::post('admin/newForm-submit', [



	    'as' => 'admin.newForm.Submit', 



	    'uses' => '\Nova\Admin\Http\Controllers\IndexController@newFromSubmit'



	]);







	Route::get('admin/changePass', [



	    'as'   => 'admin.change_pw',  



	    'uses' => '\Nova\Admin\Http\Controllers\IndexController@change_pw'



	]);







	Route::post('admin/changePassSubmit', [



	    'as'   => 'admin.changePassSubmit',  



	    'uses' => '\Nova\Admin\Http\Controllers\IndexController@changePassSubmit'



	]);







	Route::get('admin/list-customers', [



	    'as' => 'admin.listUser', 



	    'uses' => '\Nova\Admin\Http\Controllers\IndexController@listUser'



	]);







	Route::get('admin/list-subscribe', [



	    'as' => 'admin.subscribe', 



	    'uses' => '\Nova\Admin\Http\Controllers\IndexController@listSubscribe'



	]);







});


/********************************************** User route **********************************************************/
Route::get('user/login', [
	'as' => 'user.login',  
	'uses' => '\Nova\User\Http\Controllers\IndexController@login'
]);

Route::get('user-active-account', [
    'as' => 'user.activeAccount', 
    'uses' => '\Nova\User\Http\Controllers\IndexController@activeAccount'
]);

Route::post('user/login', [
	'as' => 'user.loginSubmit', 
	'uses' => '\Nova\User\Http\Controllers\IndexController@logged'
]);

Route::get('register', [
	'as' => 'user.create', 
    'uses' => '\Nova\User\Http\Controllers\IndexController@register'
]);

Route::post('store-user', [
	'as' => 'user.store',  
	'uses' => '\Nova\User\Http\Controllers\IndexController@store'
]);

Route::get('account-sign-out',[
    'as' => 'user.logout',
    'uses' => '\Nova\User\Http\Controllers\IndexController@logout'
]);

/************** End User route not login ********/



Route::group(['middleware' => 'User'], function () {



	//User route has loged



	Route::get('home', [



	    'as' => 'user.home',



	    'uses' => '\Nova\User\Http\Controllers\IndexController@index' 



	    



	]);



});










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

Route::get('/', function () {
	$id= Auth::id();
	if(empty($id))
	{
   		return view ('auth.login');
   }
   else{
   	return redirect()->route('home');
   }
})->name('public');

Auth::routes();
Route::get('/testmail',"AppUsersCtrl@sendMail");

Route::get('/become-a-client',function(){
	return view('auth.become_client');
})->name("becomeClient")->middleware(['guest']);

Route::post('/client-registration',"Auth\BecomeClient@register")->name("clientReg")->middleware(['guest']);

Route::get('/register/verify/{token}', 'Auth\RegisterController@verify')->name('mailVerify'); 
Route::get('/showform/{hint}', 'ShowFormCtrl@form')->name('form'); 
/*############## freelancers route ###########*/
Route::group(['middleware'=>'auth'],function(){
	Route::get('/home', 'HomeController@index')->name('home');

	Route::get('my-profile',"HomeController@setting")->name('myProfile');

	Route::post('update-skill',"HomeController@updateSkill")->name('updateSkill');

	Route::post('update-industry',"HomeController@updateIndustry")->name('updateIndustry');

	Route::get('detail-information',"HomeController@detailInformation")->name('detailInformation');

	Route::get('change-password',"HomeController@changePassword")->name('changePassword');

	Route::post('update-profile',"HomeController@updateProfile")->name('updateProfile');

	Route::post('update-detail',"HomeController@updateDetailInfo")->name('updateDetailInfo');

	Route::post('update-password',"HomeController@updatePassword")->name('updatePassword');
	Route::get('freelancer-activity',"HomeController@freelancerActivity")->name('freelancerActivity');

	Route::post('add-report',"HomeController@addReport")->name('addReport');

	Route::get('view-report/{id}',"HomeController@viewReport")->name('viewReport')->where('id','[0-9]+');
});
/*############## freelancers route end ###########*/

/*############## clients route ###########*/
Route::group(['namespace'=>'Clients'],function(){

	Route::get('/active-request',"ClientsCtrl@index")->name('clientDashboard');

	Route::get('/company-profile',"ClientsCtrl@comProfile")->name('comProfile');

	Route::get('/support-ticket',"ClientsCtrl@supportTicket")->name('supportTicket');

	Route::get('/add-support-ticket',"ClientsCtrl@addTick")->name('addTick');

	Route::get('/update-support-ticket',"ClientsCtrl@updateTick")->name('updateTick');

	Route::post('/create-ticket',"ClientsCtrl@createTick")->name('createTick');

	Route::get('/delete-ticket/{id}',"ClientsCtrl@deleteTick")->name('deleteTick')->where('id','[0-9]+');

	Route::get('/add-request',"ClientsCtrl@addReq")->name('addReq');

	Route::post('/create-request',"ClientsCtrl@createReq")->name('createReq');

	Route::get('/edit-request/{id}',"ClientsCtrl@editReq")->name('editReq')->where('id','[0-9]+');

	Route::post('/update-request',"ClientsCtrl@updateReq")->name('updateReq');

	Route::post('/create-request',"ClientsCtrl@createReq")->name('createReq');

	Route::get('/closed-project',"ClientsCtrl@closedProject")->name('closedProject');

	Route::get('/contracts',"ClientsCtrl@clientContract")->name('clientContract');
	
	Route::get('/reports',"ClientsCtrl@clientReport")->name('clientReport');

	Route::get('/assigned-freelancer',"ClientsCtrl@assignedFreelancer")->name('assignedFreelancer');

});
/*############## clients route end ###########*/

/*############## admin route ###########*/
Route::group([], function(){
	Route::get('/dashbaord',"AdminDashboardCtrl@index")->name('admin');

	Route::get('setting',"AdminDashboardCtrl@setting")->name('adminSetting');

	Route::post('update-account',"AdminDashboardCtrl@updateAccount")->name('updateAccount');

	Route::get('dashboard/change-password',"AdminDashboardCtrl@adminChangePassword")->name('adminChangePassword');

	Route::post('dashboard/update-password',"AdminDashboardCtrl@adminUpdatePassword")->name('adminUpdatePassword');	

	Route::get('dashboard/freelancer-filter',"AdminDashboardCtrl@freelancerFilter")->name('freelancerFilter');

//filteting for freelancers
	Route::post('/skill-wise-filtering',"AdminDashboardCtrl@skillFilter")->name('skillFilter');

	Route::post('/industry-wise-filtering',"AdminDashboardCtrl@industryFilter")->name('industryFilter');

	Route::post('/seniority-wise-filtering',"AdminDashboardCtrl@seniorityFilter")->name('seniorityFilter');

	Route::post('/buyingprice-wise-filtering',"AdminDashboardCtrl@buyingFilter")->name('buyingFilter');

	Route::post('/sellingprice-wise-filtering',"AdminDashboardCtrl@sellingFilter")->name('sellingFilter');

	Route::post('/project-complexity-wise-filtering',"AdminDashboardCtrl@proComFilter")->name('proComFilter');

	Route::post('/hour-wise-filtering',"AdminDashboardCtrl@hourFilter")->name('hourFilter');

	Route::post('/technical-wise-filtering',"AdminDashboardCtrl@technicalFilter")->name('technicalFilter');

	Route::post('/manager-wise-filtering',"AdminDashboardCtrl@managerFilter")->name('managerFilter');

//filteting for freelancers end		
});
//active ctrl
Route::group([],function(){
	Route::get('/activities',"ActivityCtrl@activities")->name('activities');
	
	Route::post('/save-activity', "ActivityCtrl@saveActivity")->name('saveActivity');

	Route::post('/update-activity', "ActivityCtrl@updateActivity")->name('updateActivity');

	Route::get('/delete-activity/{id}', "ActivityCtrl@deleteActivity")->name('deleteActivity')->where('id','[0-9]+');

	Route::get('/getprojects-asper-client/{id}',"ActivityCtrl@getProjectsAsperClient")->name('getProjectsAsperClient')->where('id','[0-9]+');

	Route::get('/assgined-freelancers/{id}',"ActivityCtrl@assignedFreelancerAsperProject")->name('assignedFreelancerAsperProject')->where('id','[0-9]+');

});
//active ctrl end

Route::group([],function(){
	Route::get('/performance',"PerformanceCtrl@performance")->name('performance');

	Route::post('/save-performance', "PerformanceCtrl@savePerformance")->name('savePerformance');	
	Route::post('/update-performance', "PerformanceCtrl@updatePerformance")->name('updatePerformance');	
	/*

	Route::post('/update-service', "ServicesCtrl@updateService")->name('updateService');
	Route::get('/delete-service/{id}', "ServicesCtrl@deleteService")->name('deleteService')->where('id','[0-9]+');
	*/

});
//Freelancer management start
Route::group([],function(){
	Route::get('/freelancers',"Users@getUsers")->name('users');
	Route::get('/freelancer-detail/{user_id}',"Users@usersDetailInfo")->name('usersDetailInfo')->where('id','[0-9]+');
	Route::post('/save-freelancer', "Users@saveUser")->name('saveUser');
	Route::post('/update-freelancer', "Users@updateUser")->name('updateUser');
	Route::get('/delete-freelancer/{id}', "Users@deleteUser")->name('deleteUser')->where('id','[0-9]+');
});
//Freelancer management end

//Clients management start
Route::group([],function(){
	Route::get('/all-clients',"AppUsersCtrl@getUsers")->name('appUsers');

	Route::get('/client-detail/{id}',"AppUsersCtrl@clientDetail")->name('clientDetail')->where('id','[0-9]+');

	Route::get('/update-role/{id}/{role}',"AppUsersCtrl@updateRole")->name('updateRole');

	Route::post('/save-app-user', "AppUsersCtrl@saveUser")->name('saveAppUser');
	Route::post('/update-app-user', "AppUsersCtrl@updateUser")->name('updateAppUser');
	Route::get('/delete-app-user/{id}', "AppUsersCtrl@deleteUser")->name('deleteAppUser')->where('id','[0-9]+');

	Route::get('/clients/active-request',"AppUsersCtrl@activeReq")->name('clientActiveReq');

	Route::get('/clients/closed-project',"AppUsersCtrl@closedProject")->name('clientClosedPro');	
	Route::get('/clients/close-project/{id}',"AppUsersCtrl@markasClose")->name('markasClose')->where('id','[0-9]+');

	Route::get('/clients/support-tickets',"AppUsersCtrl@supportTicket")->name('clientsupportTicket');

	Route::post('/clients/reply-tickets',"AppUsersCtrl@replyTick")->name('replyTick');

	Route::get('/clients/contracts',"AppUsersCtrl@adminContract")->name('adminContract');	
	Route::post('/clients/add-contracts',"AppUsersCtrl@addContract")->name('addContract');

	Route::get('/delete-admincontract/{id}',"AppUsersCtrl@deleteContract")->name('deleteContract')->where('id','[0-9]+');

	Route::get('/client-account-approval',"AppUsersCtrl@clientApproveMail")->name('clientApproveMail');	

});
//clients management end
/*############## admin route end ###########*/


//Route::get('/admin', 'AdminCtrl@index');
Route::get('/test','HomeController@test');






//Features management start
Route::group([],function(){
	Route::get('/features',"FeaturesCtrl@getFeatures")->name('getFeatures');
	
	Route::post('/save-feature', "FeaturesCtrl@saveFeature")->name('saveFeature');

	Route::post('/update-feature', "FeaturesCtrl@updateFeature")->name('updateFeature');

	Route::get('/delete-feature/{id}', "FeaturesCtrl@deleteFeature")->name('deleteFeature')->where('id','[0-9]+');

});
//Features management end

//worklog operation
Route::get('/work-log', 'HomeController@workLog')->name('workLog');
Route::post('/save-worklog', 'HomeController@saveWorklog');
Route::post('/update','HomeController@updateWorklog')->name('updateForm');
Route::get('/delete/{id}',"HomeController@deleteWorklog")->name('delete');
Route::get('/pdf',"HomeController@downloadPDF")->name('pdf');
//worklog operation

/*
name route
Route::get('/route',function(){
	

	echo route('shewa');

})->name('shewa');
*/
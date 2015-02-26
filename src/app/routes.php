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

Route::group(array('before' => 'auth.basic'), function()
{
	
	log::info('Inside route');
	if(Auth::check())
	{
	log::info('inside AUTH');
	$role = Auth::user()->role;
	log::info($role);
	if($role=='1')
	{
		// ADMIN SECTION
		
		Route::controller('/login', 'LoginController');
		Route::get('/admin/user/pagination/{page?}', 'UserController@paginate');
		Route::get('/admin/user/ban/{uid?}', 'UserController@banUser');
		Route::get('/admin/user/del/{uid?}', 'UserController@deleteUser');
		Route::get('/admin/user/searchbycharacter/{character?}', 'UserController@searchByCharacter');
	//	Route::get('/admin/user/searchbycharacter', 'UserController@searchByCharacter');
		Route::resource('/admin/user/find', 'UserController@searchUsers');
		Route::resource('/admin/user', 'UserController');
		Route::resource('/admin/configuration/updateDBAbbreviation', 'ConfigurationController@updateDBAbbreviation');
		Route::resource('/admin/fieldsettings', 'ConfigurationController');
		
		Route::get('/admin/state/updatestate/{sid?}', 'StateController@updateState');
		Route::resource('/admin/state', 'StateController');
		Route::resource('/admin/configuration/savefooterproperties' , 'ConfigurationController@saveFooterProperties');
		Route::resource('/admin/configuration', 'ConfigurationController');
		Route::get('/admin/institution/updateinstitution/{iid?}', 'InstitutionController@updateInstitute');
		Route::get('/admin/institution-subdivision/updatesubinstitution/{sid?}' , 'InstitutionSubdivisionController@updateSubInstitution');
		Route::resource('/admin/institution', 'InstitutionController');
		Route::resource('/admin/institution-subdivision', 'InstitutionSubdivisionController');
		Route::get('admin/document/ajax/{type?}/{institutionId?}', 'SolrDocumentController@ajax');
		Route::resource('/admin/document/editindex', 'SolrDocumentController@editIndex');
		Route::resource('/admin/document/get', 'SolrDocumentController@getDocument');
		Route::post('admin/document/getSerial', 'SolrDocumentController@getSerial');
		Route::post('admin/document/destorydoc', 'SolrDocumentController@destorydoc');
		Route::resource('/admin/document', 'SolrDocumentController');
		Route::get('/admin/reference/pagination/{page?}', 'DocumentReferenceController@paginate');
		Route::get('/admin/reference/searchbycharacter/{character?}', 'DocumentReferenceController@searchByCharacter');
		Route::resource('/admin/reference/filterTags', 'DocumentReferenceController@searchTags');
		Route::resource('/admin/reference/updatetagvalues', 'DocumentReferenceController@updatetagvalues');
		Route::resource('/admin/reference', 'DocumentReferenceController');
		Route::resource('/admin/statistics/postStat','StatisticsController@postStat');
		Route::resource('/admin/statistics/user','StatisticsController@getStatistics');
		Route::resource('/admin/statistics', 'StatisticsController');
		Route::resource('/admin/usernotification', 'UserNotificationController');
		Route::get('admin/logout', 'AdminController@logout');
	}
	
	if($role=='2')
	{
		Route::resource('/admin/document', 'SolrDocumentController');
		Route::resource('/admin/reference', 'DocumentReferenceController');
		Route::resource('/admin/document/editindex', 'SolrDocumentController@editIndex');
		Route::resource('/admin/reference/filterTags', 'DocumentReferenceController@searchTags');
		Route::resource('/admin/reference/updatetagvalues', 'DocumentReferenceController@updatetagvalues');
		Route::resource('/admin/reference', 'DocumentReferenceController');
		Route::get('admin/logout', 'AdminController@logout');
	}
		
	Route::get('delivery/emaildocument/{res?}', 'SolrController@emailDocument');
	Route::get('delivery/downloaddocument/{res?}', 'SolrController@downloadDocument');		
	Route::get('delivery/emailresults/{res?}/{hits?}', 'SolrController@emailResults'); 
	Route::get('delivery/downloadresults/{res?}/{hits?}', 'SolrController@downloadResults');
	Route::get('delivery/savedownloadstatsforuser/{res?}/{hits?}', 'SolrController@saveDownloadStatisticsForResults');
	Route::get('delivery/savedownloadstatsfordocument/{res?}', 'SolrController@saveDownloadStatisticsForDocument');
	Route::get('setAlert', 'AlertController@setAlertForUser');	
	
    // FRONTEND SECTION
	//Route::get('document/{id}/{name}', 'SearchController@openDocument');
    
	
    //Route::get('browse/{institutionId?}/{sort?}/{direction?}/{page?}/{year?}/{letter?}', 'SearchController@showBrowse');

    //Route::get('browse/{sort?}/{direction?}/{page?}/{year?}/{letter?}', 'SearchController@showBrowse');
    //Route::get('browse', array('as' => 'browse', 'uses' => 'SearchController@showBrowse'));
	
	//Route::controller('/', 'SolrController');
}
Route::controller('/admin', 'AdminController');
});

Route::get('register/verify/{confirmationCode}', [
    'as' => 'confirmation_path',
    'uses' => 'RegisterController@confirm'
]);
Route::resource('/alert', 'AlertController');

Route::get('unsetalerts/{id?}', 'AlertController@unSetAlerts');
Route::get('noteup', 'SearchController@getNoteUpList');
Route::get('document/{id}', 'SearchController@showDocument');
Route::get('d/{shortlink}', 'SearchController@showDocumentByPermaLink');
Route::get('/about', 'FooterController@openAboutPage');
Route::get('/termsandconditions', 'FooterController@openTermsAndConditionsPage');
Route::get('/help', 'FooterController@openHelpPage');
Route::controller('/login/{pg?}', 'LoginController');
Route::resource('/register/termsandconditions', 'RegisterController@openTermsAndConditions');
Route::resource('/register/user', 'RegisterController@register');
Route::resource('/user/passwordreset', 'RegisterController@resetPassword');
Route::resource('/user/deleteaccount', 'RegisterController@deleteAccount');
Route::get('password/reset', array('uses' => 'PasswordController@remind','as' => 'password.remind'));
Route::post('password/reset', array('uses' => 'PasswordController@request','as' => 'password.request'));
Route::get('password/reset/{token}', array('uses' => 'PasswordController@reset', 'as' => 'password.reset'));
Route::post('password/reset/{token}', array('uses' => 'PasswordController@update','as' => 'password.update'));

Route::resource('/user/logout', 'RegisterController@logout');
Route::resource('/user/register', 'RegisterController');
Route::get('/user/researchtrail/pagination/{page?}', 'RegisterController@paginate');
Route::resource('/user/researchtrail/export', 'RegisterController@exportRecords');
Route::resource('/user/researchtrail/delete', 'RegisterController@deleteRecords');
Route::resource('/user/researchtrail/filter', 'RegisterController@filterRecordsByDates');
Route::resource('/user/researchtrail', 'RegisterController@getResearchTrail');
Route::get('browse/{institutionId?}/{sort?}/{direction?}/{page?}/{year?}/{letter?}', 'SearchController@showBrowse');

Route::controller('/', 'SolrController');


	


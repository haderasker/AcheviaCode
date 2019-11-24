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

Route::get('/', 'HomeController@welCome');
Route::post('client-landing-page', 'HomeController@landingStore');

Auth::routes();

Route::middleware(['auth'])->group(function () {

    Route::get('/home', 'HomeController@index')->name('home');

    /**
     * action routes
     */
    Route::get('actions', 'ActionController@index');
    Route::get('action-create', 'ActionController@create');
    Route::post('action-store', 'ActionController@store');
    Route::get('action-edit', 'ActionController@edit');
    Route::patch('action-update/{id}', 'ActionController@update');
    Route::delete('action-delete/{id}', 'ActionController@destroy');

    /**
     * project routes
     */
    Route::get('projects', 'ProjectController@index');
    Route::get('project-create', 'ProjectController@create');
    Route::post('project-store', 'ProjectController@store');
    Route::get('project-edit', 'ProjectController@edit');
    Route::patch('project-update/{id}', 'ProjectController@update');
    Route::delete('project-delete/{id}', 'ProjectController@destroy');

    /**
     * city routes
     */
    Route::get('cities', 'ProjectCityController@index');
    Route::get('city-create', 'ProjectCityController@create');
    Route::post('city-store', 'ProjectCityController@store');
    Route::get('city-edit', 'ProjectCityController@edit');
    Route::patch('city-update/{id}', 'ProjectCityController@update');
    Route::delete('city-delete/{id}', 'ProjectCityController@destroy');

    /**
     * method routes
     */
    Route::get('methods', 'MethodController@index');
    Route::get('method-create', 'MethodController@create');
    Route::post('method-store', 'MethodController@store');
    Route::get('method-edit', 'MethodController@edit');
    Route::patch('method-update/{id}', 'MethodController@update');
    Route::delete('method-delete/{id}', 'MethodController@destroy');

    /**
     * team routes
     */
    Route::get('teams', 'TeamController@index');
    Route::get('team-create', 'TeamController@create');
    Route::post('team-store', 'TeamController@store');
    Route::get('team-edit', 'TeamController@edit');
    Route::patch('team-update/{id}', 'TeamController@update');
    Route::delete('team-delete/{id}', 'TeamController@destroy');

    /**
     * user routes
     */
    Route::get('users', 'UserController@index');
    Route::get('user-create', 'UserController@create');
    Route::post('user-store', 'UserController@store');
    Route::get('user-edit', 'UserController@edit');
    Route::patch('user-update/{id}', 'UserController@update');
    Route::delete('user-delete/{id}', 'UserController@destroy');

    /**
     * client routes
     */
    Route::get('clients', 'ClientController@index');
    Route::get('api/dropdown', 'ClientController@dropDown');
    Route::get('api/dropdown/sales', 'ClientController@dropDownSale');
    Route::get('api/dropdown/marketer', 'ClientController@dropDownMarketer');
    Route::get('client-create', 'ClientController@create');
    Route::post('client-store', 'ClientController@store');
    Route::get('client-quick-create', 'ClientController@quickCreate');
    Route::post('client-quick-store', 'ClientController@quickStore');
    Route::get('client-upload-view', 'ClientController@uploadView');
    Route::post('client-upload', 'ClientController@upload');
    Route::get('client-edit/{id}', 'ClientController@edit');
    Route::post('client-update', 'ClientController@update');
    Route::delete('client-delete/{id}', 'ClientController@destroy');


    /**
     * client actions routes
     */
    Route::get('all-clients', 'ClientActionController@allClients');
    Route::get('client/get_all_data', 'ClientActionController@getAllData');
    Route::get('new-clients', 'ClientActionController@newClients');
    Route::get('client/get_data/{id}', 'ClientActionController@getData');
    Route::get('action-client/{id}', 'ClientActionController@actionClient');
    Route::get('history-clients/{id}', 'ClientActionController@history');
    Route::get('client/get_history/{id}', 'ClientActionController@getHistory');
    Route::get('duplicated-clients', 'ClientActionController@duplicated');
    Route::get('client/get_duplicated_data', 'ClientActionController@getDuplicatedData');
    Route::get('transfered-clients', 'ClientActionController@transfered');
    Route::get('client/get_transfered_data', 'ClientActionController@getTransferedData');
    Route::get('new-requests', 'ClientActionController@newRequests');
    Route::get('client/get_new_requests_data', 'ClientActionController@getNewRequestsData');

//    Route::get('following-clients', 'ClientActionController@following');
//    Route::get('coming-visit-clients', 'ClientActionController@comingVisit');
//    Route::get('cancellation-clients', 'ClientActionController@cancellation');
//    Route::get('done-deal-clients', 'ClientActionController@doneDeal');
//    Route::get('meeting-clients', 'ClientActionController@meeting');
//    Route::get('not-interested-clients', 'ClientActionController@notInterested');

    /**
     * reports routes
     */
    Route::get('team-report/{id}', 'ReportController@teamReport');
    Route::get('sale-man-report/{id}', 'ReportController@saleManReport');
    Route::get('all-reports', 'ReportController@AllReports');


});

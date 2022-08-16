<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

// frontend related routes
$routes->get('/', 'Home::index',["as"=>"home"]);
$routes->post('check-in','Home::checkIn');
$routes->post('leaves','Home::leaves');

$routes->group('users',['namespace'=> 'App\Controllers\User'],function ($routes){

// route for user profile dashboard
$routes->get('user-profile','UserProfileController::index',["filter" => "userauth"]);

// route to logout user
$routes->get('logout','UserProfileController::logout');

});


// admin related routes
$routes->group('admin', ['namespace' => 'App\Controllers\Admin'], function ($routes) {
    $routes->get('/','AdminController::login',["as" => "login"]);
    $routes->post('auth','AdminController::auth');

    // route to show admin dashboard
    $routes->get('dashboard','AdminController::dashboard',["filter" => "myauth"],['as'=>'admindashboard']);

    // route to show user list
    $routes->get('users','UserController::index',["filter" => "myauth"],['as'=>'adminuser']);
    // route to laod datatable
    $routes->post('ajax-load-data', 'UserController::ajaxLoadData',["filter" => "myauth"]);

    // route to show user add form
    $routes->get('add-users','UserController::addUsers',["filter" => "myauth"],['as'=>'adminadduser']);
    // route to store user data
    $routes->post('store-users','UserController::storeUsers',["filter" => "myauth"]);

    // route to show user edit form
    $routes->get('edit-users/(:num)','UserController::editUsers/$1',["filter" => "myauth"],['as'=>'adminedituser']);
    // route to update user data
    $routes->post('update-users/(:num)','UserController::updateUsers/$1',["filter" => "myauth"],['as'=>'adminupdateuser']);

    // route to show user details
    $routes->get('show-users/(:num)','UserController::showUsers/$1',["filter" => "myauth"],['as'=>'adminshowuser']);

    // route for change the status
    $routes->post('change-user-status','UserController::changeStatus',["filter" => "myauth"]);

    // route for see the checkin user list
    $routes->get('user-checkin','AttendanceController::index',["filter" => "myauth"]);
    // route for load the user-checkin data
    $routes->post('ajax-load-checkin','AttendanceController::loadCheckin',["filter" => "myauth"]);

    // route for see the list of leaves user
    $routes->get('user-leaves','AttendanceController::userLeaves',["filter" => "myauth"]);
    // route for load the user-leave data
    $routes->post('ajax-load-leaves','AttendanceController::loadLeaves',["filter" => "myauth"]);

    // route for export data
    $routes->Post('export-data','AttendanceController::exportData',["filter" => "myauth"]);

    // route for export leave data
    $routes->post('export-leave-data','AttendanceController::exportLeaveData',["filter" => "myauth"]);
    
    // route to do entry in not-checkin table
    $routes->post('not-checkin','AttendanceController::notCheckin',["filter" => "myauth"]);

    // route for move checkin to leave
    $routes->post('move-leave','AttendanceController::moveLeave',["filter" => "myauth"]);

    // route for delete the multiple checkin record
    $routes->post('delete-checkin','AttendanceController::deleteCheckinRecord',['filter'=>"myauth"]);

    // route for move leave to checkin
    $routes->post('move-checkin','AttendanceController::moveCheckin',["filter" => "myauth"]);

    // route for payroll
    $routes->get('pay-roll','PayrollController::index',["filter" => "myauth"]);

    // route for employee payroll layout
    $routes->post('payroll-layout','PayrollController::payrollLayout',["filter" => "myauth"]);

    // route for upload payslip
    $routes->post('upload-payslip','PayrollController::uploadPayslip',['filter'=>"myauth"]);

    // route for upload excel payslip
    $routes->post('upload-excel-payslip','PayrollController::uploadExcelPayslip',['filter'=>"myauth"]);

    // route for download excel sample
    $routes->post('download-excel-sample','PayrollController::downloadExcelSample',['filter'=>"myauth"]);

    // route to delete upload payslip
    $routes->post('delete-payslip','PayrollController::removePayslip',['filter'=>"myauth"]);

    // route to logout admin
    $routes->get('logout','AdminController::logout',["filter" => "myauth"],['as'=>'adminlogout']);
});


/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}

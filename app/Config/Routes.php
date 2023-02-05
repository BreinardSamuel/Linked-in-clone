<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('FbController');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */
// $routes->get('/ok', 'FbController::index');


// We get a performance increase by specifying the default
// route since we don't have to scan directories.

//route for login
$routes->get('/', 'FbController::login');
$routes->get('/register','FbController::register');
$routes->post('/register-user','FbController::add');

$routes->get('/login', 'FbController::login');
$routes->post('/login-user', 'FbController::newlogin');
$routes->get('/home', 'FbController::home');
$routes->get('/admin-login', 'FbController::admin');


$routes->get('/admin-home', 'FbController::adminhome');

//login to admin account
$routes->post('/admin_login_verify', 'FbController::verifyAdminLogin');


$routes->get('/adminDashboard', 'FbController::dashboard');

//$routes->get('/user-profile', 'FbController::displayuserprofile');
//$routes->post('/user-home-details', 'FbController::displayuserprofile');

///logout
$routes->post('/logout', 'FbController::logout');

//'/upload-cover
$routes->post('/upload-cover', 'FbController::uploadCoverPicture');

///crop
$routes->post('/upload-cover-image-check', 'FbController::imgcheck');

//upload post
$routes->post('/upload-post-image-check', 'FbController::uploadpost');

//fetching my post by limitting the result
$routes->post('/fetch-post', 'FbController::fetch');

//view post by using modal popup
$routes->post('/view-post', 'FbController::viewPost');

//Forgot password page
$routes->get('/forgot-password', 'FbController::forgotPasswordPage');

//change password
$routes->post('/change-password', 'FbController::changePassword');

//send mail when someone changes the password or someone registers 
$routes->post('/send-mail', 'FbController::sendMail');



/*/register-user
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
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}

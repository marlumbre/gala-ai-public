<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['Home'] = 'Home/index';
$route['About'] = 'Home/about';
$route['Services'] = 'Home/services';
$route['Packages'] = 'Home/packages';
$route['Blog'] = 'Home/blog';
$route['Contact'] = 'Home/contact';
$route['Booking'] = 'Home/form';

$route['Login'] = 'Login';
$route['Logout'] = 'Login/logout';
$route['Register'] = 'Register';

$route['register'] = 'Register/index';
$route['register/submit'] = 'Register/register';


$route['Search/query'] = 'Search/query'; 
$route['Search/query_tripadvisor'] = 'Search/query_tripadvisor';
$route['Recommendations/query'] = 'Home/query';

$route['Recommendations/get_places_db'] = 'Home/get_places_db';
$route['Recommendations/save'] = 'Home/save_place_db';

$route['Admin'] = 'Admin/index';
$route['process/get_places'] = 'TripAdvisor/get_places';

$route['default_controller'] = 'Home';
$route['(:any)'] = 'Oops';

$route['services/searchLocations'] = 'services/searchLocations';

$route['404_override'] = 'Oops';
$route['translate_uri_dashes'] = FALSE;
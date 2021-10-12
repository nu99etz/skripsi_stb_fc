<?php

defined('BASEPATH') OR exit('No direct script access allowed');


// Pegawai
$route['pegawai/ajax'] = 'UserController/ajax';
$route['pegawai'] = 'UserController/index';
$route['pegawai/form'] = 'UserController/form';
$route['pegawai/store'] = 'UserController/store';
$route['pegawai/edit/(:any)'] = 'UserController/edit/$1';
$route['pegawai/update/(:any)'] = 'UserController/update/$1';
$route['pegawai/destroy/(:any)'] = 'UserController/destroy/$1';

// User
$route['user/ajax'] = 'UserController/ajaxUser';
$route['user'] = 'UserController/indexUser';
$route['user/form'] = 'UserController/formUser';
// $route['pegawai/store'] = 'UserController/store';
$route['user/edit/(:any)'] = 'UserController/editUser/$1';
$route['user/update/(:any)'] = 'UserController/updateUser/$1';
$route['user/destroy/(:any)'] = 'UserController/destroyUser/$1';

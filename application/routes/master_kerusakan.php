<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// Gejala
$route['gejala/ajax'] = 'GejalaController/ajax';
$route['gejala'] = 'GejalaController/index';
$route['gejala/form'] = 'GejalaController/form';
$route['gejala/store'] = 'GejalaController/store';
$route['gejala/edit/(:any)'] = 'GejalaController/edit/$1';
$route['gejala/update/(:any)'] = 'GejalaController/update/$1';
$route['gejala/destroy/(:any)'] = 'GejalaController/destroy/$1';

// Kerusakan
$route['kerusakan/ajax'] = 'KerusakanController/ajax';
$route['kerusakan'] = 'KerusakanController/index';
$route['kerusakan/form'] = 'KerusakanController/form';
$route['kerusakan/store'] = 'KerusakanController/store';
$route['kerusakan/edit/(:any)'] = 'KerusakanController/edit/$1';
$route['kerusakan/update/(:any)'] = 'KerusakanController/update/$1';
$route['kerusakan/destroy/(:any)'] = 'KerusakanController/destroy/$1';

// Penyebab Kerusakan
$route['penyebab_kerusakan/ajax'] = 'PenyebabKerusakanController/ajax';
$route['penyebab_kerusakan'] = 'PenyebabKerusakanController/index';
$route['penyebab_kerusakan/form'] = 'PenyebabKerusakanController/form';
$route['penyebab_kerusakan/store'] = 'PenyebabKerusakanController/store';
$route['penyebab_kerusakan/edit/(:any)'] = 'PenyebabKerusakanController/edit/$1';
$route['penyebab_kerusakan/update/(:any)'] = 'PenyebabKerusakanController/update/$1';
$route['penyebab_kerusakan/destroy/(:any)'] = 'PenyebabKerusakanController/destroy/$1';

// Solusi Kerusakan
$route['solusi_kerusakan/ajax'] = 'SolusiKerusakanController/ajax';
$route['solusi_kerusakan'] = 'SolusiKerusakanController/index';
$route['solusi_kerusakan/form'] = 'SolusiKerusakanController/form';
$route['solusi_kerusakan/store'] = 'SolusiKerusakanController/store';
$route['solusi_kerusakan/edit/(:any)'] = 'SolusiKerusakanController/edit/$1';
$route['solusi_kerusakan/update/(:any)'] = 'SolusiKerusakanController/update/$1';
$route['solusi_kerusakan/destroy/(:any)'] = 'SolusiKerusakanController/destroy/$1';
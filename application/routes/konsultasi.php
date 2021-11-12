<?php

defined('BASEPATH') OR exit('No direct script access allowed');

$route['konsultasi'] = 'KonsultasiController/rootQuestion';
$route['konsultasi/ajax_perbaikan'] = 'KonsultasiController/ajax_perbaikan';
$route['konsultasi/form_perbaikan/(:any)'] = 'KonsultasiController/perbaikanForm/$1';
$route['konsultasi/storePerbaikan'] = 'KonsultasiController/storePerbaikan';
$route['konsultasi/store'] = 'KonsultasiController/getAnswer';
$route['konsultasi/edit/(:any)'] = 'KonsultasiController/viewKonsultasi/$1';
$route['konsultasi/rootquestion'] = 'KonsultasiController/rootQuestion';
$route['konsultasi/nextquestion/(:any)/(:any)'] = 'KonsultasiController/getNextQuestion/$1/$2';
$route['konsultasi/stopquestion/(:any)/(:any)'] = 'KonsultasiController/getStopQuestion/$1/$2';

$route['perbaikan'] = 'KonsultasiController/index';
$route['perbaikan/detailPerbaikan/(:any)'] = 'KonsultasiController/viewPerbaikan/$1';
$route['perbaikan/selesai/(:any)'] = 'KonsultasiController/selesaiPerbaikan/$1';
<?php

defined('BASEPATH') OR exit('No direct script access allowed');

$route['konsultasi'] = 'KonsultasiController/index';
$route['konsultasi/ajax_konsultasi'] = 'KonsultasiController/ajax_konsultasi';
$route['konsultasi/form'] = 'KonsultasiController/konsultasiForm';
$route['konsultasi/store'] = 'KonsultasiController/getAnswer';
$route['konsultasi/edit/(:any)'] = 'KonsultasiController/viewKonsultasi/$1';
$route['konsultasi/nextquestion/(:any)'] = 'KonsultasiController/getNextQuestion/$1';
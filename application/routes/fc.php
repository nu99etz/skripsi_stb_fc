<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// $route['question'] = 'ForwardChainingController/index';
// $route['question/store'] = 'ForwardChainingController/getAnswer';

$route['konsultasi'] = 'ForwardChainingController/index';
$route['konsultasi/ajax'] = 'ForwardChainingController/ajax';
$route['konsultasi/form'] = 'ForwardChainingController/form';
$route['konsultasi/store'] = 'ForwardChainingController/getAnswer';
$route['konsultasi/edit/(:any)'] = 'ForwardChainingController/view/$1';
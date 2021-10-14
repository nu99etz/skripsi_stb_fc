<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// Aturan
$route['rule/ajax'] = 'RuleController/ajax';
$route['rule'] = 'RuleController/index';
$route['rule/form'] = 'RuleController/form';
$route['rule/store'] = 'RuleController/store';
$route['rule/edit/(:any)'] = 'RuleController/edit/$1';
$route['rule/update/(:any)'] = 'RuleController/update/$1';
$route['rule/destroy/(:any)'] = 'RuleController/destroy/$1';
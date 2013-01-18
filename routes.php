<?php

if (!defined('INCLUDE_GUARD')) { header("HTTP/1.0 403 Forbidden"); die(); }

$routes = array(
  array('home',         'GET',  'Site',    'showHome'),
  array('dashboard',    'GET',  'Site',    'showDashboard'),
  array('user_new',     'GET',  'User',    'showRegistrationForm'),
  array('user_new',     'POST', 'User',    'registerUser'),
  array('login',        'GET',  'Login',   'showLoginForm'),
  array('login',        'POST', 'Login',   'doLogin'),
  array('logout',       'GET',  'Login',   'doLogout'),
  array('user_list',    'GET',  'User',    'showUsers'),
  array('number_list',  'GET',  'Number',  'showNumbers'),
  array('number_new',   'GET',  'Number',  'showNewNumberForm'),
  array('number_new',   'POST', 'Number',  'addNewNumber'),
  array('autocomplete', 'POST', 'Ajax',    'getAutocompleteSuggestions')
);

?>
<?php

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'online_date_db');
define('URLROOT', 'online-date');
define('bootstrap', 'public/bootstrap-5.1.3/');
define('js', 'public/js/');
define('css', 'public/css/');
define('assets', 'public/assets/');
if(!isset($_SESSION)) 
{ 
    session_start(); 
} 

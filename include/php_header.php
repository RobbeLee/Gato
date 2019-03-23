<?php
/*

    Mike Schaatsbergen - 12/03/19
    This document will be included at the top of every page.

*/

// Get the current full URL
$_URL = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

// Define the website name so I can easily change it if I want to
$_BRAND = "Gato";

// Get the current date
$_DATE = date('Y-m-d H:i:s');

// Current directory
$fetchDir = basename($_URL);

// Checks if session exists, if not make one
if (session_status() == PHP_SESSION_NONE) session_start();

// Get the IP of the user
if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip=$_SERVER['HTTP_CLIENT_IP'];
} else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $ip=$_SERVER['REMOTE_ADDR'];
}

date_default_timezone_set('Europe/Amsterdam');
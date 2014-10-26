<?php
/*
 * Site : http:www.smarttutorials.net
 * Author :muni
 * 
 */
 
define('BASE_PATH','http://exousia14.com/events/demo/');
define('DB_HOST', 'localhost');
define('DB_NAME', 'exousia');
define('DB_USER','varun');
define('DB_PASSWORD','varunraj.in@2662');

$con=mysqli_connect( DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

?>
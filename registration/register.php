<?php
require "config.php";
$uname=$_POST['uname'];
$gen=$_POST['ugender'];
$email=$_POST['email'];
$mobile=$_POST['unum'];
$col=$_POST['cname'];
$dept=$_POST['udept'];
$year=$_POST['uyear'];
mysqli_query( $con, "INSERT INTO attendee ( name,gender,email,mobile,college,department,year,status )VALUES ( '$uname','$gen','$email','$mobile','$col','$dept','$year','1')")or die(mysql_error());
print("Registered Successfully");
?>
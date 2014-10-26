<?php

 require_once 'config.php';

 if(!empty($_POST['uid'])){
     $uid=$_POST['uid'];
     $res=mysqli_query( $con, "select * from attendee where id='$uid' and status=1") or die(mysql_error()); 
     $count=mysqli_fetch_array($res);
     if($count[0]==0){
         echo 'false';
     }else{
         echo 'true';
     }
 }
?>
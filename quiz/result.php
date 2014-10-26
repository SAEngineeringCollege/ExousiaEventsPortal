<?php
session_start();

require 'config.php';
if(!empty($_SESSION['uid'])){
    
    $right_answer=0;
    $wrong_answer=0;
    $unanswered=0; 
  
   $keys=array_keys($_POST);
   $order=join(",",$keys);
   
   //$query="select * from questions id IN($order) ORDER BY FIELD(id,$order)";
  // echo $query;exit;
   
   $response=mysqli_query( $con, "select id,ans from quiz_event where id IN($order) ORDER BY FIELD(id,$order)")   or die(mysql_error());
   
   while($result=mysqli_fetch_array($response)){
       if($result['ans']==$_POST[$result['id']]){
               $right_answer++;
           }else if($_POST[$result['id']]==5){
               $unanswered++;
           }
           else{
               $wrong_answer++;
           }
   }
   $uid=$_SESSION['uid'];
	$tot_ans=$wrong_answer+ $right_answer;
   mysqli_query( $con, "update quiz_attendee set tot_pts='$right_answer',uid='$uid',tot_ans='$tot_ans' where uid='$uid'");

	session_destroy();
	
?>
<!DOCTYPE html>
<html>
    <head>
		<title>Exousia 14 Web Designing Event</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Bootstrap -->
       	<link href="../assets/css/bootstrap.min.css" rel="stylesheet" media="screen">
		<link href="../assets/css/style.css" rel="stylesheet" media="screen">
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
		<script src="../../assets/js1/html5shiv.js"></script>
		<script src="../../assets/js1/respond.min.js"></script>
		<![endif]-->

    </head>
    <body>
        <h1 class="header">
			<a href="index.php">Quiz</a>
			</h1>
        <div class="container result">
           
           <h1>
			   Thanks for attending !
			</h1>
        </div>
      
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
      <script src="../assets/js/jquery-1.10.2.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="../assets/js/bootstrap.min.js"></script>
        <script src="../assets/js/jquery.validate.min.js"></script>

        

    </body>
</html>
<?php }

else{
    
 header( 'Location: index.php' ) ;
      
}?>
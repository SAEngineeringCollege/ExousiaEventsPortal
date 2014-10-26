
<?php
session_start();
?>
<!---
Site : http:www.smarttutorials.net
 Author :muni
--->
<!DOCTYPE html>
<html>
	<head>
		<title>Exousia 14 Debugging Event</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!-- Bootstrap -->
			<link href="../assets/css/bootstrap.min.css" rel="stylesheet" media="screen">
		<link href="../assets/css/style.css" rel="stylesheet" media="screen">
	
<?php 
require 'config.php';

$category='';
 if(!empty($_POST['uid'])){
     $uid=$_POST['uid'];
	 $email=$_POST['email'];
    $uid=str_replace("EX14","",$uid);
	   
	 $check= mysqli_query( $con,"select * from attendee where id='$uid' and email='$email' ") or die(mysql_error()); 
	 $valid=mysqli_num_rows($check);
	 if($valid>0)
		 {
	 $res= mysqli_query( $con,"select * from debug_attendee where uid='$uid'") or die(mysql_error()); 

     $count=mysqli_num_rows($res);

     if($count!=0){

    echo "<h3 class='already'>Opps It Seams You've Already Attended Debugging Event</h3>";
		 exit();
        
     }
    else if($count==0){
		
    mysqli_query( $con, "INSERT INTO debug_attendee ( uid)VALUES ( '$uid')") or die(mysql_error());
     $_SESSION['uid']= $uid;
     $_SESSION['id'] = mysqli_insert_id();
		
	}
		 
 }
	 else if($valid==0){
			   echo "<h3 class='already'>Please Check Your Credentials !</h3>";
		 }
 }

if(!empty($_SESSION['uid'])){
?>

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
		<script src="../../assets/js1/html5shiv.js"></script>
		<script src="../../assets/js1/respond.min.js"></script>
		<![endif]-->
		
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="../assets/js/jquery-1.10.2.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="../assets/js/bootstrap.min.js"></script>
        <script src="../assets/js/jquery.validate.min.js"></script>
		<script src="../assets/js/countdown.js"></script>
		<style>
			.container {
				margin-top: 110px;
			}
			.error {
				color: #B94A48;
			}
			.form-horizontal {
				margin-bottom: 0px;
			}
			.hide{display: none;}
		</style>
	</head>
	<body>
	   <h1 class="header">
				Debugging
			</h1>
        <div id='timer'>
            <script type="application/javascript">
            var myCountdownTest = new Countdown({
                                    time: 1800, 
                                    width:200, 
                                    height:80, 
                                    rangeHi:"minute"
                                    });
           </script>
            
        </div>
        
		<div class="container question">
			<div class="col-xs-12 col-sm-8 col-md-8 col-xs-offset-4 col-sm-offset-3 col-md-offset-3">
				
				
				<form class="form-horizontal" role="form" id='login' method="post" action="result.php">
					<?php
					$number_question = 1;
					$row = mysqli_query( $con, "select * from debug_event ORDER BY RAND()");
					$rowcount = mysqli_num_rows( $row );
					$remainder = $rowcount/$number_question;
					$i = 0;
					$j = 1; $k = 1;
					?>
					<?php while ( $result = mysqli_fetch_assoc($row) ) {
						 if ( $i == 0) echo "<div class='cont' id='question_splitter_$j'>";?>
						<div id='question<?php echo $k;?>' >
						<p class='questions' id="qname<?php echo $j;?>"> <?php echo $k?>.<?php echo $result['question'];?><pre  class="prettyprint " ><?php echo $result['program'];?></pre></p>


							<hr>
						<input type="radio" value="1" id='radio1_<?php echo $result['id'];?>' name='<?php echo $result['id'];?>'/><?php echo $result['op1'];?>
						<br/>
						<input type="radio" value="2" id='radio1_<?php echo $result['id'];?>' name='<?php echo $result['id'];?>'/><?php echo $result['op2'];?>
						<br/>
						<input type="radio" value="3" id='radio1_<?php echo $result['id'];?>' name='<?php echo $result['id'];?>'/><?php echo $result['op3'];?>
						<br/>
						<input type="radio" value="4" id='radio1_<?php echo $result['id'];?>' name='<?php echo $result['id'];?>'/><?php echo $result['op4'];?>
						<br/>
						<input type="radio" checked='checked' style='display:none' value="5" id='radio1_<?php echo $result['id'];?>' name='<?php echo $result['id'];?>'/>                                                                      
						<br/>
						</div>
						<?php
							 $i++; 
							 if ( ( $remainder < 1 ) || ( $i == $number_question && $remainder == 1 ) ) {
							 	echo "<button id='".$j."' class='next btn btn-success' type='submit'>Finish</button>";
							 	echo "</div>";
							 }  elseif ( $rowcount > $number_question  ) {
							 	if ( $j == 1 && $i == $number_question ) {
									echo "<button id='".$j."' class='next btn btn-success' type='button'>Next</button>";
									echo "</div>";
									$i = 0;
									$j++;           
								} elseif ( $k == $rowcount ) { 
									echo " <button id='".$j."' class='previous btn btn-success' type='button'>Previous</button>
												<button id='".$j."' class='next btn btn-success' type='submit'>Finish</button>";
									echo "</div>";
									$i = 0;
									$j++;
								} elseif ( $j > 1 && $i == $number_question ) {
									echo "<button id='".$j."' class='previous btn btn-success' type='button'>Previous</button>
							                    <button id='".$j."' class='next btn btn-success' type='button' >Next</button>";
									echo "</div>";
									$i = 0;
									$j++;
								}
								
							 }
							  $k++;
					     } ?>	
				</form>
			</div>
		</div>
 


<?php

if(isset($_POST[1])){ 
   $keys=array_keys($_POST);
   $order=join(",",$keys);
   
   //$query="select * from questions id IN($order) ORDER BY FIELD(id,$order)";
  // echo $query;exit;
   
   $response=mysql_query("select id,ans from debug_event where id IN($order) ORDER BY FIELD(id,$order)")   or die(mysql_error());
   $right_op=0;
   $wrong_op=0;
   $unoped=0;
   while($result=mysql_fetch_array($response)){
       if($result['ans']==$_POST[$result['id']]){
               $right_op++;
           }else if($_POST[$result['id']]==5){
               $unoped++;
           }
           else{
               $wrong_op++;
           }
       
   }
   
   
   echo "right_op : ". $right_op."<br>";
   echo "wrong_op : ". $wrong_op."<br>";
   echo "unoped : ". $unoped."<br>";
}
?>
		
		
		<script>
		$('.cont').addClass('hide');

		$('#question_splitter_1').removeClass('hide');
		 
		$(document).on('click','.next',function(){
		    last=parseInt($(this).attr('id'));  console.log( last );   
		    nex=last+1;
		    $('#question_splitter_'+last).addClass('hide');
		    
		    $('#question_splitter_'+nex).removeClass('hide');
		});
		
		$(document).on('click','.previous',function(){
		    last=parseInt($(this).attr('id'));     
		    pre=last-1;
		    $('#question_splitter_'+last).addClass('hide');
		    
		    $('#question_splitter_'+pre).removeClass('hide');
		});
            
         setTimeout(function() {
             $("form").submit();
          }, 1800000);
		</script>
	</body>
</html>
<?php }else{
    
 header( 'Location: http://localhost/new_quiz/index.php' ) ;
      
}
?>
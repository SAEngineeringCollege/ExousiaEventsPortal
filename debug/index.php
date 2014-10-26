<?php
session_start();
?>
<!---
Site : http:www.smarttutorials.net
Author :muni
--->

<?php
//require 'config.php';
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Exousia 14 Debugging Event</title>
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
				Debugging
			</h1>
		
		<div class="container">
			<div class="row">
				
				<div class="col-md-4 col-md-offset-4">
					<div class="intro">
					
					
						    <form class="form-signin" method="post" id='signin' name="signin" action="questions.php">
							<div class="form-group">
								<label>Exousia Unique ID</label>
								<input type="text" id='uid' name='uid' class="form-control" placeholder="Eg. EX141450"/>
								<span class="help-block"></span>
								<label>Email ID</label>
								<input type="email" id='email' name='email' class="form-control" placeholder="Eg. abc@def.ghi"/>
							</div>
					
							<br>
							<button class="btn btn-success btn-block" type="submit">Enter</button>
						</form>
						
					</div>
				</div>
			</div>
		</div>
	
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		  <script src="../assets/js/jquery-1.10.2.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="../assets/js/bootstrap.min.js"></script>
        <script src="../assets/js/jquery.validate.min.js"></script>


		<script>
			$(document).ready(function() {
				$("#signin").validate({
					submitHandler : function() {
					    console.log(form.valid());
						if (form.valid()) {
						    alert("sf");
							return true;
						} else {
							return false;
						}

					},
					rules : {
						uid : {
							required : true,
							minlength : 3,
							remote : {
								url : "check_name.php",
								type : "post",
								data : {
									uid : function() {
										return $("#uid").val().replace("EX14", "");
									}
								}
							}
						},
						
						
						
					},
					messages : {
						uid : {
							required : "Please enter your unique ID",
							remote : "Only Registered Participants can attend the events"
						},
					
                       
					},
					errorPlacement : function(error, element) {
						$(element).closest('.form-group').find('.help-block').html(error.html());
					},
					highlight : function(element) {
						$(element).closest('.form-group').removeClass('has-success').addClass('has-error');
					},
					success : function(element, lab) {
						var messages = new Array("That's Great!", "Looks good!", "You got it!", "Great Job!", "Smart!", "That's it!");
						var num = Math.floor(Math.random() * 6);
						$(lab).closest('.form-group').find('.help-block').text(messages[num]);
						$(lab).addClass('valid').closest('.form-group').removeClass('has-error').addClass('has-success');
					}
				});
			});
		</script>

	</body>
</html>

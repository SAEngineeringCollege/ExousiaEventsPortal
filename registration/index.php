<?php
session_start();
?>


<?php
//require 'config.php';
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Exousia 14 Spot Registration</title>
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
				Registration
			</h1>
		
		<div class="container">
			<div class="row">
				
				<div class="col-md-4 col-md-offset-4">
					<div class="intro">
					
					
						    <form class="form-register" method="post" id='register' name="register" action="register.php">
							<div class="form-group">
								<label>Name</label>
								<input type="text" id='uid' name='uname' class="form-control"/>
								<span class="help-block"></span>
								<label>Gender</label>
								<input type="radio" id='gen' name='ugender' class="form-control" value="1">Male</input>
								<input type="radio" id='gen' name='ugender' class="form-control" value="0">Female</input>
								<span class="help-block"></span>
								<label>Email ID</label>
								<input type="email" id='email' name='email' class="form-control" placeholder="Eg. abc@def.ghi"/>
								<span class="help-block"></span>
								<label>Mobile Number</label>
								<input type="text" id='num' name='unum' class="form-control"/>
								<span class="help-block"></span>
								<label>College Name</label>
								<input type="text" id='cname' name='cname' class="form-control"/>
								<span class="help-block"></span>
								<label>Department</label>
								<input type="text" id='dept' name='udept' class="form-control"/>
								<span class="help-block"></span>
								<label>Year</label>
								<input type="text" id='year' name='uyear' class="form-control"/>
								</div>
					
							<br>
							<button class="btn btn-success btn-block" type="submit">Register</button>
						</form>
						
					</div>
				</div>
			</div>
		</div>
	
	</body>
</html>

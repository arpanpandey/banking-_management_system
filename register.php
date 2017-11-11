<?php
	$server="localhost";
	$user="root";
	$password="";
	$db="bank";
	$con=mysqli_connect($server,$user,$password,$db)or die(mysqli_error());
	
?>
<html>
<head>
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/font-awesome.css">
	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.js"></script>
	<link rel="stylesheet" href="style2.css">
	<link rel="stylesheet" href="bootstrap.min.css">
	<link href="css/bootstrap-imgupload.css" rel="stylesheet">
	<style>
	@import url("http://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css");
	/* 
		FORM STYLING
	*/
	#fileselector {
		margin: 20px; 
	}
	#upload-file-selector {
		display:none;   
	}
	.margin-correction {
		margin-right: 10px;   
	}

	#div1{
		width:300px;
		height:500px;
		float:left;
		
	}
	#div2{
		width:1000px;
		float:left;
		height:500px;
		
	}
	.fa-upload{
		
	}
	.form-horizontal{
				margin:20px 0;
			}

	.form-horizontal input{
		box-shadow:inset 0 0 10px silver,0 0 0 lightgreen;
		border:1px solid gray;
		outline:none;
		transition:box-shadow 1s;
	}
	.form-group input:focus{
		box-shadow:inset 0 0 0 silver,0 0 10px lightgreen;
	}
	#div5{
		background:radial-gradient(silver,#f1f1f1);
		width:200px;
		height:200px;
		border:3px solid black;
		margin:5px;
		text-shadow:8px 6px 8px black;
		float:left;
	}
	
	
	</style>
</head>
<body>
	<header>
		
	</header>
	</br></br></br>
	<main>
		
		
			<form method="post">
			<div class="col-md-4">
			
				
				<section class="col-md-3">			
					<div id="div5"></div>

					
						<span id="fileselector">
							<label class="btn btn-default" for="upload-file-selector">
							<input id="upload-file-selector" type="file">
							<i class="fa fa-upload"></i> upload
							</label>
						</span>
					
				</section>


			
			</div>
			<div class="col-md-7">
				
				<div class="form-horizontal">
					<label  class="control-label">Registration Number</label>
					<input name="reg" type="text" class="form-control">
				</div>
				
				<div class="form-horizontal">
					<label  class="control-label">Account Name</label>
					<input name="user" type="text" class="form-control">
				</div>
				
				<div class="form-horizontal">
					<label  class="control-label">Account Password</label>
					<input name="pass" type="password" class="form-control">
				</div>
				
				<div class="form-horizontal">
					<label  class="control-label">Unique Pin</label>
					<input name="pin" type="text" class="form-control">
				</div>
				
				<div class="form-horizontal">
					<label  class="control-label">Mobile Number</label>
					<input name="mob_number" type="tel" class="form-control">
				</div>
				
				<div class="form-horizontal">
					<label  class="control-label">E-mail</label>
					<input name="email" type="email" class="form-control">
				</div>
				
				<div class="form-horizontal">
				<div class="col-md-4 col-md-offset-3">
				<button class="btn btn-danger btn-block" name="submit_user_btn">Submit Form</button>
				</div>
				</div>
				</br></br></br></br></br></br>
			</div> 
			</form>
		</div>
	</main>
	<footer>
	<nav class="navbar navbar-inverse navbar-fixed-bottom">
			
				<ul class="nav navbar-nav navbar-center ">
					<li><a href="#about_us" data-toggle="tab">About Us</a></li>
					<li><a href="#terms" data-toggle="tab">Terms & Conditions</a></li>
					<li><a href="#policies" data-toggle="tab">Policies</a></li>
				</ul>
				
			</nav>
	</footer>
</body>
</html>

<?php
	if(isset($_POST['submit_user_btn']))
	{
		$reg=mysqli_real_escape_string($con,strip_tags($_POST['reg']));
		$user=mysqli_real_escape_string($con,strip_tags($_POST['user']));
		$pass=mysqli_real_escape_string($con,strip_tags($_POST['pass']));
		$pin=mysqli_real_escape_string($con,strip_tags($_POST['pin']));
		$mob_number=mysqli_real_escape_string($con,strip_tags($_POST['mob_number']));
		$email=mysqli_real_escape_string($con,strip_tags($_POST['email']));
		$fetch_sql="SELECT * FROM student_account ";
		$fetch_run=mysqli_query($con,$fetch_sql);
		$flag=false;
		while($fetch_rows=mysqli_fetch_assoc($fetch_run))
		{
			if($fetch_rows['registration_number']==$reg && $fetch_rows['unique_pin']==$pin)
			{
				$flag=true;
				break;
			}
		}
		if($flag)
		{
			$insert_Sql="INSERT INTO student_details (registration_number,stud_name,'password',mob_number,e-mail) VALUES ('$reg','$user','$pass','$mob_number','$email')";
			var_dump($insert_Sql);
			$insert_run=mysqli_query($con,$insert_Sql);
			var_dump($insert_run);
		}
		else
		{
				echo "<script> alert('Not Succesful'); </script>";
		}
	}
	?>
	
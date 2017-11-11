<?php
$server="localhost";
$user="root";
$password="";
$db="customer";
$con=mysqli_connect($server,$user,$password,$db);
?>



<html>
<head>
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/font-awesome.css">
	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.js"></script>
	<link rel="stylesheet" href="style1.css">

	<title>
	Online Banking
	</title>
	
	
</head>
<body>
	
		<header>
			<div id="left_header">
				<h3 style="color:#fff333;">Online Banking</h3>
		
		</header>
		<main>
	
			<div class="col-md-8" >
			
				<div class="carousel slide" id="carousel1" data-ride="carousel">
					<ol class="carousel-indicators">
						<li data-target="#carousel1" data-slide-to="0" class="active"></li>
						<li data-target="#carousel1" data-slide-to="1"></li>
						<li data-target="#carousel1" data-slide-to="2"></li>
						<li data-target="#carousel1" data-slide-to="3"></li>
						<li data-target="#carousel1" data-slide-to="4"></li>
					</ol>
					
					<div class="carousel-inner">
						<div class="item active">
							<img src="5.jpg"  style="width:100%; height:510px;">
						</div>
						<div class="item">
							<img src="3.jpg"  style="width:100%; height:510px;">
						</div>
						<div class="item">
							<img src="8.png"  style="width:100%; height:510px;">
						</div>
						<div class="item">
							<img src="4.jpg"  style="width:100%; height:510px;">
						</div>
						<div class="item">
							<img src="7.jpg"  style="width:100%; height:510px;">
						</div>
					</div>
					<a href="#carousel1" data-slide="prev" class="left carousel-control"><span class="glyphicon glyphicon-chevron-left"></span></a>
					<a href="#carousel1" data-slide="next" class="right carousel-control"><span class="glyphicon glyphicon-chevron-right"></span></a>
				</div>	
			</div>
			<div class="col-md-4">
				<aside>
				<form method="POST">
					<div class="form-group">
						<label class="control-label">Username</label>
						<input type="text" class="form-control" name="user" required>
					</div>
					<div class="form-group">
						<label class="control-label">Password</label>
						<input type="password" class="form-control" name="pass" required>
					</div>
					<div class="form-group">
						<input type="submit" class="btn btn-success" value="SUBMIT" name="submit_usr_button">
					</div>
					<div class="form-group">
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;
						<a href="register.php" class="btn btn-info">Create New Account</a>
					</div>
				</form>
				</aside>
				<div style="clear:both"></div>
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
	if(isset($_POST['submit_usr_button']))
	{
		session_start();
		$name=$_POST['user'];
		$pwd=$_POST['pass'];
		//session set
		$_SESSION['name']="$name";
		$_SESSION['pwd']="$pwd";
		$sqlquery="select registration_number,username,account_balance,phone_number from customer_account where username='$name' and password='$pwd'";
		$result=mysqli_query($con,$sqlquery);
		$rows=mysqli_num_rows($result);
		if($rows==1)
		{?>
			<script>window.location="pracsignin_succ.php"</script>
		<?php 
		}
		else{
			?><script>window.location="firstpage.php"</script>
		<?php
		}
	}
?>
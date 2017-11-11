<?php
session_start();
$server="localhost";
$user="root";
$password="";
$db="customer";
$con=mysqli_connect($server,$user,$password,$db);

$name=$_SESSION['name'];
$pwd=$_SESSION['pwd'];
echo "<br>";
?>
<html>
<head>
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/font-awesome.css">
	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.js"></script>
	<style>
	body{
		background:black;
	}
	.jumbotron{
		background:url('home.jpg');
		
	}
	#use{
		color:#ff3333;
		margin-top:190px;
	}
	</style>
</head>
<body>
<main>
		<div class="container">
		<div class="jumbotron " style="height:300px;">
			<?php echo"<h2 id='use'>Welcome  $name </h2>";?>
		</div>
		<div class="nav pull-right"><a href="firstpage.php" class="btn btn-danger"> Logout</a></div>
			<ul class="nav nav-tabs">
				<li><a href="#account" data-toggle="tab">Account Details</a></li>
				<li><a href="#transactions" data-toggle="tab">Transactions</a></li>
				<li><a href="#transfer" data-toggle="tab">Money Transfer</a></li>
			</ul>
			<div class="table tab-content ">
				<div id="account" class="tab-pane fade">
				<h2 style="color:white;">Account Details</h2>
					<table class="table table-hover table-responsive">
					<tbody>
						<tr>
							<td>Name</td>
							<td><?php $sqlquery="select username from customer_account where username='$name' and password='$pwd'";
										$result=mysqli_query($con,$sqlquery);
										$rows=mysqli_fetch_assoc($result);
										echo $rows['username']; 
										?>
							</td>
						</tr>
						<tr>
							<td>Registration Number</td>
							<td><?php $sqlquery="select registration_number from customer_account where username='$name' and password='$pwd'";
										$result=mysqli_query($con,$sqlquery);
										$rows=mysqli_fetch_assoc($result);
										echo $rows['registration_number']; 
										?>
										
							</td>
						</tr>
						<tr>
							<td>Phone Number</td>
							<td>
							<?php $sqlquery="select phone_number from customer_account where username='$name' and password='$pwd'";
										$result=mysqli_query($con,$sqlquery);
										$rows=mysqli_fetch_assoc($result);
										echo $rows['phone_number']; 
										?>
							</td>
						</tr>
						<tr>
							<td>Current Balance</td>
							<td><?php $sqlquery="select account_balance from customer_account where username='$name' and password='$pwd'";
										$result=mysqli_query($con,$sqlquery);
										$rows=mysqli_fetch_assoc($result);
										echo $rows['account_balance']; 
										?>
							</td>
						</tr>
						
					</tbody>
					</table>
				</div>
			
				<div id="transactions" class="tab-pane fade">
					
					<h2 style="color:white;">Transactions</h2>
					<table class="table table-striped table-hover">
						<thead>
							<tr>
								<th>S.No</th>
								<th>From</th>
								<th>To</th>
								<th>Amount</th>
								<th>Credit/Debit</tH>
							</tr>
						</thead>
							
										
						<tbody>
						<?php $sqlquery="select * from debit where username='$name'";
							$result=mysqli_query($con,$sqlquery);
							$count=1;
							while($rows=mysqli_fetch_assoc($result))
							{ ?>
													
								<tr>
								<td><?php echo $count; ?></td>
								<td><?php 
											echo $rows['username']; 
											?> </td>
								<td><?php
											echo $rows['action']; 
											?></td>
								<td><?php
											echo $rows['Amount']; 
											?></td>
								<td><?php
											echo $rows['debit']; 
											$count++;
							}?> </td>
							</tr>
								<?php $sqlquery="select * from credit where username='$name'";
											$result=mysqli_query($con,$sqlquery);
											while($rows=mysqli_fetch_assoc($result))
											{ ?>
								<tr>
								<td><?php echo $count; ?></td>
								<td><?php 
											echo $rows['username']; 
											?> </td>
								<td><?php
											echo $rows['action']; 
											?></td>
								<td> <?php
											echo $rows['Amount']; 
											?></td>
								<td><?php
											echo $rows['credit']; 
											$count++;}?> </td>
								</tr>
						</tbody>
					</table>
				</div>
				<div id="transfer" class="tab-pane fade">
				<h2 style="color:white;">Transfer</h2>
					<table class="table table-hover table-responsive">
						<tbody>
						<form method="post">
							<tr>
								<td>Registration Number</td>
								<td><input type="text" name="reg"></td>
							</tr>
							<tr>
								<td>From</td>
								<td><input type="text" name="sender"></td>
							</tr>
							<tr>
								<td>To</td>
								<td><input type="text" name="receiver"></td>
							</tr>
							<tr>
								<td>Amount</td>
								<td><input type="text" name="amount"></td>
							</tr>
						
						</tbody>
					</table>
						<div class="form-group">
							<button class="btn btn-block btn-success" name="send_money_btn">Send Money</button>
						</div>
					</form>
					</div>
				</div>
			</div>
		</div>	
</main>
</body>
</html>

<?php
	if(isset($_POST['send_money_btn']))
	{
		$reg=mysqli_real_escape_string($con,strip_tags($_POST['reg']));
		$from=mysqli_real_escape_string($con,strip_tags($_POST['sender']));
		$to=mysqli_real_escape_string($con,strip_tags($_POST['receiver']));
		$amount=mysqli_real_escape_string($con,strip_tags($_POST['amount']));
		
		
		$sqlquery11="select * from customer_account where username='$from'";
		$result11=mysqli_query($con,$sqlquery11);
		$rows11=mysqli_fetch_assoc($result11);
		$amount_sender=$rows11['account_balance']-$amount; 
		
		$sqlquery22="select * from customer_account where username='$to'";
		$result22=mysqli_query($con,$sqlquery22);
		$rows22=mysqli_fetch_assoc($result22);
		$amount_receiver=$rows22['account_balance']+$amount; 
		
		
		
		$query1="update customer_account set account_balance='$amount_receiver' where username='$to'";
		$result1=mysqli_query($con,$query1);
		
		$query2="update customer_account set account_balance='$amount_sender' where username='$from'";
		$result2=mysqli_query($con,$query2);
		
		$insertd="insert into debit(username,action,debit,amount) values('$from','$to','debit','$amount')";
		$sqlqueryd=mysqli_query($con,$insertd);
		
		$insertc="insert into credit(username,action,credit,amount) values('$to','$from','credit','$amount')";
		$sqlqueryc=mysqli_query($con,$insertc);
		
		if($result1 && $result2)
		{
			?>
			<script>window.location="pracsignin_succ.php"</script>
		<?php 
		}
		else{
			?><script>alert("Wrong Info");</script>
		<?php
		}
	}	
		?>
	
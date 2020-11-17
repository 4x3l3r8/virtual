<!DOCTYPE html>
<?php
//error_reporting(1);
include("connect.php");
	session_start();

if(isset($_POST['login'])){
	$email=$_POST['email'];
	$password=$_POST['password'];
	
	if($_POST['category']=='admin'){
		$sql=mysqli_query($conn, "select * from admin where email='$email' AND password='$password'");
	if(mysqli_num_rows($sql)>0){
		$row=mysqli_fetch_array($sql);
		session_start();
		$_SESSION['admin_id']=$row['id'];
		echo '<script>
	location.href="admin_home.php"
	</script>';
	}else{
	$error="<font color='crimson'>Oops!  Invalid Email or Password...</font>";	
	}
	
		
	}else{
		$sql=mysqli_query($conn, "select * from lecturer where email='$email' AND password='$password'");
	if(mysqli_num_rows($sql)>0){
		$row=mysqli_fetch_array($sql);
		session_start();
		$_SESSION['lecturer_id']=$row['id'];
		$_SESSION['lecturer_name']=$row['fullname'];
		echo '<script>
	location.href="../lecturer/home.php"
	</script>';
	}else{
	$error="<font color='crimson'>Oops!  Invalid Email or Password...</font>";	
	}
	}
	
	
}
	
?>
<html lang = "eng">
	<head>
		<title>Virtual Learning System</title>
		<meta charset = "utf-8" />
		<meta name = "viewport" content = "width=device-width, initial-scale=1" />
		<link rel = "stylesheet" type = "text/css" href = "css/bootstrap.css" />
		<link rel = "stylesheet" type = "text/css" href = "css/style.css" />
	</head>
	<body>
		<nav class = "navbar navbar-inverse navbar-fixed-top">
			<div class = "container-fluid">
				<div class = "navbar-header">
			<img src="../img/Icon-01studen writting exam.png" width="11%">
					<h1 class = "navbar-text pull-right" style="text-align:center; margin-right:-1%; font-size:30px; color:white;">Virtual Learning System</h1>
				</div>
			</div>
		</nav>
		
		<div class = "container" style = "margin-top:12%;">
			<div class = "row row-centered">
				<div class = "col-lg-2 col-centered"></div>
				<div class = "col-lg-2 col-centered"></div>
				<div class = "col-lg-4 col-centered"><?php echo $error.'<br><br>';?>
					<div class = "panel panel-primary">
						<div class = "panel-heading">
							<h4>Admin/Lecturer Login</h4>
							
						</div>
						<div class = "panel-body">
							<form method="post">
								<div id = "username_warning" class = "form-group">
									<label class = "control-label">Email:</label>
									<input type = "email" name="email" id = "username" class = "form-control"  required />
								</div>
								<div id = "username_warning" class = "form-group">
									<label class = "control-label">Category:</label>
									<select name="category" class = "form-control"  required />
									<option value="admin">Administrator</option>
									<option value="lecturer">Lecturer</option>
									</select>
								</div>
								
								<div id = "password_warning" class = "form-group">
									<label class = "control-label">Password:</label>
									<input type = "password" name="password" maxlength = "12" id = "password" class = "form-control" required />
								</div>
								
								<br />
								<button type = "submit" class = "btn btn-primary btn-block" name="login" ><span class = "glyphicon glyphicon-save"></span> Login</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php include("../footer.php");?>
	</body>
	<script src = "js/jquery.js"></script>
	<script src = "js/bootstrap.js"></script>
	<script src = "js/login.js"></script>
</html>
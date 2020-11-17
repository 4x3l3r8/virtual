<?php
include("connect.php");
if(isset($_POST['signup'])){
	
	$date=date("Y-m-d h:i:sa");
$file=$_FILES['image']['tmp_name'];
$image = $_FILES["image"] ["name"];
$image_name= addslashes($_FILES['image']['name']);
$size = $_FILES["image"] ["size"];
$error = $_FILES["image"] ["error"];
$mat=$_POST['matric_no'];
$usern=$_POST['username'];
    
  $target_file = "student_image".basename($_FILES["image"]["name"]);
   $Type = pathinfo($target_file,PATHINFO_EXTENSION);
   
if($Type == "jpg" || $Type == "png" || $Type == "gif" || $Type == "jpeg"){
	
	move_uploaded_file($_FILES["image"]["tmp_name"],"student_image/" . $_FILES["image"]["name"]);			
	$location="student_image/" . $_FILES["image"]["name"];
	
	
	$qry=mysqli_query($conn, "select * from student where matric_no='$mat' OR username='$usern'");
	if(mysqli_num_rows($qry)<=0){
mysqli_query($conn, "insert into student(fullname,username,matric_no,email,image,password,department,level,date) 
values('".$_POST['fullname']."','".$_POST['username']."','".$_POST['matric_no']."','".$_POST['email']."','$location','".$_POST['password']."','".$_POST['department']."','".$_POST['level']."','$date')");
	echo '<script>
	alert("Registration Successful \n Redirecting to Login page");
	location.href="index.php"
	</script>';
		
	}else{
		$error="<font color='crimson'>Oops!  Student Exists</font>";
	}
}else{
	$error="<font color='crimson'>Error! Only an image can be uploaded...</font>";
}





}



if(isset($_POST['login'])){
	$username=$_POST['username'];
	$password=$_POST['password'];
	$sql=mysqli_query($conn,"select * from student where username='$username' AND password='$password'");
	if(mysqli_num_rows($sql)>0){
		$row=mysqli_fetch_array($sql);
		session_start();
		$_SESSION['id']=$row['id'];
		$_SESSION['username']=$row['username'];
		$_SESSION['matric_no']=$row['matric_no'];
		echo '<script>
	location.href="home.php"
	</script>';
	}else{
	$error='<script> alert("Oops!  Invalid Username or Password...")</script>';	
	}
	
}
?>

<!DOCTYPE html>
<html lang = "eng">
	<head>
		<meta charset = "utf-8" />
		<title>Virtual Learning System</title>
		<meta name = "viewport" content = "width=device-width, initial-scale=1" />
		<link rel = "stylesheet" type = "text/css" href = "css/bootstrap.css"/>
		<style>
		body{
			background-image:url('img/o-TEEN-BOY-TYPING-ON-LAPTOP-facebook.jpg');
			background-attachment:fixed;
			background-position:center;
			background-size:100%;
			background-repeat:no-repeat;
		}
		</style>
	</head>
	<body class = "alert-info">
		<nav class = "navbar navbar-inverse navbar-fixed-top">
			<div class = "container-fluid">
				<div class = "navbar-header">
					<img src="img/Icon-01studen writting exam.png" width="11%">
					<h1 class = "navbar-text pull-right" style="text-align:center; margin-right:-1%; font-size:30px; color:white;">Virtual Learning System</h1>
				</div>
			</div>
		</nav>
		
			<br />
			<br />
			<br />
			<br />
			<br />
			<br />
			<br /> <div align="center" style="margin-top:-1%; margin-bottom:2%;"> <h2 style="font-size:39px; color:black; text-shadow:0px 2px black;">Student Portal</h2></div>
			<div class = "col-lg-3"></div>
			<div class = "col-lg-5 well" style="border:1px solid black; box-shadow: 0 4px 8px 0 black; opacity:0.95; margin-bottom:5%;">
				
				<br />
				<div id = "result"></div>
				<br />
				<br />
				
				
				<?php if(isset($_GET['signup'])){?>
				
				<form action="" method="post" enctype = "multipart/form-data">
				<?php echo $error; ?>
				<div align="center" style="margin-top:-9%;"><h2> Registration</h2></div><hr>
					<div class = "form-group">
						<label>Fullname:</label>
						<input type = "text" name="fullname" id = "student" class = "form-control" required = "required"/>
						<br />
						<label>Username:</label>
						<input type = "text" name="username" id = "student" class = "form-control" required = "required"/>
						<br />
						<label>Matric No:</label>
						<input type = "text" name="matric_no" id = "student" class = "form-control" required = "required"/>
						<br />
						<label>Department:</label>
						<input type = "text" name="department" id = "student" class = "form-control" required = "required"/>
						<br />
						<label>Level:</label>
						<select name="level" id = "student" class = "form-control" required = "required"/>
						<option value="100">100Level</option>
						<option value="200">200Level</option>
						<option value="300">300Level</option>
						<option value="400">400Level</option>
						<option value="500">500Level</option>
						</select>
						<br />
						<label>Email:</label>
						<input type = "email" name="email" id = "student" class = "form-control" required = "required"/>
						<br />
						<label>Password:</label>
						<input type = "password" name="password" id = "student" class = "form-control" required = "required"/>
						
						<br />
						<label>Upload Image:</label>
						<input type = "file" name="image" id = "student" style="" required = "required"/>
						<br /><br />
						
						<div id = "error"></div>
						<br />
						<button type = "submit" name="signup" id = "login" class = "btn btn-primary btn-block"><span class = "glyphicon glyphicon-login"></span>Sign up</button>
						</br>
						<a href="index.php">Already have an account?</a>
					</div>
				</form>
				<?php } else{ ?>
				<form action="" method="post" enctype = "multipart/form-data">
				<?php echo $error; ?>
				<div align="center" style="margin-top:-9%;"><h2> Login</h2></div><hr>
					<div class = "form-group">
						
						<br />
						<label>Username:</label>
						<input type = "text" name="username" id = "student" class = "form-control" required = "required"/>
						<br />
						<label>password:</label>
						<input type = "password" name="password" id = "student" class = "form-control" required = "required"/>
						<br />
						
						<br />
						<br />
						<div id = "error"></div>
						<br />
						<button type = "submit" name="login" id = "login" class = "btn btn-primary btn-block"><span class = "glyphicon glyphicon-login"></span>Sign up</button>
						</br>
						<a href="index.php?signup=registration">Don't have an account?</a>
					</div>
				</form>
				<?php } ?>
				
			</div>
		</div>
		<?php include("footer.php");?>
	</body>
	<script src = "js/jquery.js"></script>
	<script src = "js/bootstrap.js"></script>
	<script src = "js/login.js"></script>
</html>
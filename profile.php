<?php
include("connect.php");
session_start();
if(!isset($_SESSION['id'])){
	echo '<script>
	location.href="index.php"
	</script>';
}
$ses_id=$_SESSION['id'];
if(isset($_POST['upd'])){
	$username=$_POST['username'];
	$email=$_POST['email'];
	$password=$_POST['password'];
	
	$file=$_FILES['image']['tmp_name'];
$image = $_FILES["image"] ["name"];
$image_name= addslashes($_FILES['image']['name']);
$size = $_FILES["image"] ["size"];
$error = $_FILES["image"] ["error"];
    
  $target_file = "student_image".basename($_FILES["image"]["name"]);
   $Type = pathinfo($target_file,PATHINFO_EXTENSION);
   
if($Type != "jpg" && $Type != "png" && $Type != ""){
		$error="<font color='crimson'>Error! Only an image can be uploaded...</font>";
		
	}else{
	
	if($_POST['image']==''){
		$location=$_POST['imgs'];
	}else{
	move_uploaded_file($_FILES["image"]["tmp_name"],"student_image/" . $_FILES["image"]["name"]);			
	
	$location="student_image/" . $_FILES["image"]["name"];
	}
	
mysqli_query($conn, "update student set username='$username',email='$email',password='$password',image='$location' where id='$ses_id'");
	echo '<script>
	alert("Update Successful");
	location.href="profile.php"
	</script>';
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
		.sidenav {
    height: 100%;
    width: 0;
    position: fixed;
    z-index: 1;
    top: 0;
    left: 0;
    background-color: #111;
    overflow-x: hidden;
    transition: 0.5s;
    padding-top: 60px;
}

.sidenav a {
    padding: 8px 8px 8px 32px;
    text-decoration: none;
    font-size: 18px;
    color: #818181;
    display: block;
    transition: 0.3s
}

.sidenav a:hover, .offcanvas a:focus{
    color: #f1f1f1;
}

.closebtn {
    position: absolute;
    top:0;
	margin-top:18px;
    right: 25px;
    font-size: 19px !important;
    margin-left: 55px;
}

@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}
span.menu:hover{
	color:lightyellow;
	transition-duration:2s;
}
a.active{
	background-color:black;
	font-size:17px;
}
		</style>
	</head>
	<body class = "alert-info">
		<nav class = "navbar navbar-inverse navbar-fixed-top">
			<div class = "container-fluid">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#example-nav-collapse">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>

<div class = "navbar-header" style="margin-top:1%; margin-bottom:-2.5%;">
<span style="font-size:30px; cursor:pointer; color:white; float:left; margin-left:5%; padding-top:3px;" class="menu" title="Menu" onclick="openNav()">&#9776;</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<img src="img/Icon-01studen writting exam.png" width="11%" style="margin-left:2%;">
					<a href="home.php"><h1 class = "navbar-text pull-right" style="text-align:center; margin-right:-1%; font-size:30px; color:white;">Virtual Learning System</h1></a>
				</div>
			</div>
							<!--FOR SIDE NAV-->
			<div class="collapse navbar-collapse" id="example-nav-collapse">
			<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&#9932;</a>
  <hr>
  <a href="groups.php" >Groups</a>		
  <a href="joined.php" >Joined Group</a>		
  <a href="message.php" >Message</a>		
  <a href="members.php">Members</a>			
  <a href="lecturers.php">Lecturers</a>						
  <a href="quiz.php">Quiz</a>						
  <a href="tutorial.php">Tutorial</a>						
  <a href="profile.php" class="active">Profile</a>						
 			
</div>
<span class="normalFont"><a href="logout.php" class="btn btn-success navbar-right navbar-btn"><strong>Sign Out</strong></a></span>
     
          
          
          
        </div>
			<!--END SIDE NAV-->	
		</nav>
		
			<br />
			<br />
			<br />
			<br />
			<br />
			<br />
			<br /> <div align="center" style="margin-top:-1%; margin-bottom:2%;"> <h2 style="font-size:30px; color:black; text-shadow:0px 2px black;"> Profile</h2></div>
			<div class = "col-lg-3"></div>
			<div class = "col-lg-6 well" style="border:1px solid black; margin-bottom:5%; box-shadow: 0 4px 8px 0 black; opacity:0.95;">
				<?php
				$ses_id=$_SESSION['id'];
				$ses_name=$_SESSION['username'];
				$qry=mysqli_query($conn, "select * from student where id='$ses_id'");
				$row=mysqli_fetch_array($qry);
				
				
				if(isset($_GET['update'])){
				?>
				
				<form action="" method="post" enctype = "multipart/form-data" style="">
				<?php echo $error; ?>
				
					<div class = "form-group">
					<div align="center" style="margin-top:%;"><h2>Update Profile</h2></div><hr>
					
					<label>Username:</label>
					<input type = "hidden" name="imgs" value="<?php echo $row['image'];?>" id = "student" class = "form-control" />
						<input type = "text" name="username" value="<?php echo $row['username'];?>" id = "student" class = "form-control" required = "required"/>
						<br />
						<label>Email:</label>
						<input type = "text" name="email" value="<?php echo $row['email'];?>" id = "student" class = "form-control" required = "required"/>
						<br />
						<label>Password:</label>
						<input type = "text" name="password" value="<?php echo $row['password'];?>" id = "student" class = "form-control" required = "required"/>
						<br />
						
						<label>Change Profile Pics:</label>
						<input type = "file" name="image" id = "student" style=""/>
						<br /><br />
						
						<div id = "error"></div>
						<br />
						<button type = "submit" name="upd" id = "login" class = "btn btn-warning" style="width:25%; float:right; margin-right:6%;">Update</button>
						</br>
						
					</div>
				</form>
				
				
				
				
				
				
				<?php } else{ ?>
				<img src="<?php echo $row['image'];?>" style="width:18%; border:3px solid silver; border-radius:4px;">
				<div align="center" style="margin-top:-7%; margin-left:37%; color:black; font-size:18px;">
				<div align="left">
				<p><b>Fullname:</b> <?php echo ucwords($row['fullname']);?></p>
				<p><b>Username:</b> <?php echo ucwords($row['username']);?></p>
				<p><b>Matric No:</b> <?php echo ucwords($row['matric_no']);?></p>
				<p><b>Email:</b> <?php echo ucwords($row['email']);?></p>
				<p><b>Department:</b> <?php echo ucwords($row['department']);?></p>
				<p><b>Level:</b> <?php echo ucwords($row['level'].'Level');?></p>
				</br></br>
				<a href="profile.php?update=<?php echo $ses_id;?>" class="btn btn-primary">Update Profile</a>
				</div></div>
				
				<?php } ?>
				<br />
				<div id = "result"></div>
				
				
				
				
			</div>
	<?php include("footer.php");?>
	</body>
	<script>
function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
}
</script>
	<script src = "js/jquery.js"></script>
	<script src = "js/bootstrap.js"></script>
	<script src = "js/login.js"></script>
</html>
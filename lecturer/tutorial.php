<?php
include("connect.php");
session_start();
if(!isset($_SESSION['lecturer_id'])){
	echo '<script>
	location.href="../admin/index.php"
	</script>';
}

?>
<?php
$lid=$_SESSION['lecturer_id'];
if(isset($_POST['login'])){
	$new=$_POST['new'];
	$old=$_POST['old'];
	if($_POST['rnew'] == $_POST['new']){
		$qry=mysqli_query($conn, "select * from lecturer where id='$lid' AND password='$old'");
		if(mysqli_num_rows($qry)>0){
			
			mysqli_query($conn, "update lecturer set password='$new' where id='$lid'");
			echo '<script>
	alert("Password Changed Successfully!")
	location.href="cpassword.php"
	</script>';
		}
		else{
			echo $error="Oops!  Incorrect Password";
		}
	}else{
		echo $error="Oops!  Password does not match";
	}
	
}

if(isset($_GET['del'])){
	$del=$_GET['del'];
	$output=mysqli_query($conn, "delete from forum where forum='$del'");
	if($output){
		echo '<script>
	alert("All posts deleted successfully!")
	location.href="chat.php"
	</script>';
	}else{
		echo '<script>
	alert("Oops! Unable to delete posts!")
	location.href="chat.php"
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
			background-image:url('../img/wallpaper-patterns-pattern-honeycomb-abstract-minimalistic-images.jpg.png');
			background-attachment:fixed;
			background-position:top center;
			background-size:100%;
			background-repeat:no-repeat;
		}
	/* The Modal (background) */
.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    padding-top: 25px; /* Location of the box */
    left: 280;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.0); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
    position: relative;
    background-color: #fefefe;
    margin-left:30%;
    padding: 0;
    border: 5px solid lavender;
	border-radius:0px 0px 20px 20px;
	margin-top:11%;
    width: 40%;
	height:67%;
	
    box-shadow: 0px 0px 4px 0px black;
    -webkit-animation-name: animatetop;
    -webkit-animation-duration: 0.4s;
    animation-name: animatetop;
    animation-duration: 0.4s
}

/* Add Animation */
@-webkit-keyframes animatetop {
    from {top:-300px; opacity:0} 
    to {top:0; opacity:1}
}

@keyframes animatetop {
    from {top:-300px; opacity:0}
    to {top:0; opacity:1}
}

/* The Close Button */
.close {
    color: white;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: #000;
    text-decoration: none;
    cursor: pointer;
}

.modal-header {
    padding: 3px 10px;
    background-color:darkslategray;
    color: white;
	height:45px;
}

.modal-footer {
    padding: 2px 16px;
    background-color: darkslategray;
    color: white;
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
					<img src="../img/Icon-01studen writting exam.png" width="11%" style="margin-left:2%;">
					<a href="home.php"><h1 class = "navbar-text pull-right" style="text-align:center; margin-right:-1%; font-size:30px; color:white;">Virtual Learning System</h1></a>
				</div>
			</div>
							<!--FOR SIDE NAV-->
			<div class="collapse navbar-collapse" id="example-nav-collapse">
			<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&#9932;</a>
  <hr>
<a href="home.php" >Groups</a>			
  <a href="chat.php" >Chat</a>		
  <a href="tutorial.php" class="active">Tutorial</a>		
  <a href="message.php" >Message</a>		
  <a href="quiz.php" >Quiz</a>
 <a href="quiz_result.php">Quiz Results</a>  
  <a href="cpassword.php" >Change Password</a>	
						
 			
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
			<br /> <div align="center" style="margin-top:3%; margin-bottom:2%;"> <h2 style="font-size:36px; color:black; text-shadow:0px 2px black;"> </h2></div>
			
			<div class = "col-lg-3"></div>
			
			<div class = "col-lg-4 well" style="margin-bottom:5%; margin-left:8%;">
			<!--<div class = "col-lg-5 well" style="margin-bottom:5%; border:1px solid black; box-shadow: 0 4px 8px 0 black; opacity:0.95;">-->
				
				
			
		
		</br></br>
		<div align="center" style="margin-top:-12%;"><h3 style="font-size:25px;"><img src="../img/people.png" width="11%" />&nbsp;&nbsp;Tutorial</h3></div><hr>
		<br>
			<?php
				$qry=mysqli_query($conn, "select * from course where lecturer_id='$lid'");
				if(mysqli_num_rows($qry)>0){
					while($row=mysqli_fetch_array($qry)){
						echo '<div style="border:1px solid silver; border-bottom:3px solid gray;">
		<a href="tutorialexe.php?tutorial='.$row['course_code'].'" >
		<h4 style="color:black; text-align:center; padding:7px;">
		
		
		&nbsp;&nbsp;'.strtoupper($row['course_code'].' Group').'</h4></a>
						</div>';
					}
				}else{
					echo 'No Group Found !';
				}
				?>
			
				<div id = "result"></div>
				<br />
				
				
				
				
			</div>
		<?php include("../footer.php");?>
	</body>
	
	
	<script>
// Get the modal
var modal = document.getElementById('myModal');

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
    modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>
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
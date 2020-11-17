<?php
include("connect.php");
session_start();
if(!isset($_SESSION['id'])){
	echo '<script>
	location.href="index.php"
	</script>';
}

?>

<!DOCTYPE html>
<html lang = "eng">
	<head>
		<meta charset = "utf-8" />
		<title>Virtual Learning System</title>
		<meta name = "viewport" content = "width=device-width, initial-scale=1" />
		<link rel = "stylesheet" type = "text/css" href = "css/bootstrap.css"/>
		
		<link rel="stylesheet" href="slider/style.css" type="text/css" media="screen" />
  <script type="text/javascript">var _siteRoot='index.html',_root='index.html';</script>
  <script type="text/javascript" src="slider/js/jquery.js"></script>
  <script type="text/javascript" src="slider/js/scripts.js"></script>
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
  <a href="profile.php">Profile</a>						
 			
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
			<br /> <div align="center" style="margin-top:-1%; margin-bottom:2%;"> <h2 style="font-size:39px; color:black; text-shadow:0px 2px black;"> </h2></div>
			<div class = "col-lg-3"></div>
			<div class = "col-lg-7 well" style="margin-top:5%; margin-left:-3.5%; height:54%; margin-bottom:5%; border:1px solid black; box-shadow: 0 4px 8px 0 black; opacity:0.95;">
				
				<!--slider starts here -->
				  <div id="header"><div class="wrap" >
   <div id="slide-holder" >
<div id="slide-runner" style="height:200%;">
    <img id="slide-img-1" src="slider/1.jpg" class="slide" alt="" style="border:2px solid black; height:370px; width:760px;"/>
    <img id="slide-img-2" src="slider/2.jpg" class="slide" alt="" style="border:2px solid black; height:370px; width:760px;"/>
    <img id="slide-img-3" src="slider/3.jpg" class="slide" alt="" style="border:2px solid black; height:370px; width:760px;"/>
    <img id="slide-img-4" src="slider/4.jpg" class="slide" alt="" style="border:2px solid black; height:370px; width:760px;"/>
    <img id="slide-img-5" src="slider/5.jpg" class="slide" alt="" style="border:2px solid black; height:370px; width:760px;"/>
    <img id="slide-img-6" src="slider/6.jpg" class="slide" alt="" style="border:2px solid black; height:370px; width:760px;"/>
	<img id="slide-img-7" src="slider/7.jpg" class="slide" alt="" style="border:2px solid black; height:370px; width:760px;"/>
   <div id="slide-controls">
     <p id="slide-client" class="text" style="margin-top:-44%; color:white; font-size:13px; font-weight:600; text-shadow:0px 1px 1px black;"><strong>FEATURES: </strong><span></span></p>
     <p id="slide-desc" class="text" style="margin-top:-40%; color:dodgerblue; font-size:13px; font-weight:600; text-shadow:0px 1px 1px black;"></p>
     
    </div>
</div>
	

   </div></div></div>
			<!--slider ends here -->		
				
				<br />
				<div id = "result"></div>
				<br />
				<br />
				
				
				
			</div>
		<div class = "navbar navbar-fixed-bottom alert-warning">
			<div class = "container-fluid">
				<label class = "pull-left">&copy; Virtual learning system 2017 - <?php echo date("Y"); ?></label>
			</div>	
		</div>
	</body>
<script type="text/javascript">
    if(!window.slider) var slider={};slider.data=[{"id":"slide-img-1","client":"Course-forum","desc":"Each group is based on a course..."},
	{"id":"slide-img-2","client":"Tutorial","desc":"The system provide a platfrom for Coordnators to upload materials like ebooks, tutorial videos etc. to help students in their various courses.. "},
	{"id":"slide-img-3","client":"Messenger","desc":"The system enable students to have direct interaction with their lecturers/coordinators..."},
	{"id":"slide-img-4","client":"Quiz","desc":"Virtual learning system is a platform that give room for coodinators of each groups to give quiz to students..."},
	{"id":"slide-img-5","client":"Ebook","desc":"A platform to download ebooks uploaded by lecturers"},
	{"id":"slide-img-6","client":"Member Profile","desc":"Each student have their own profile that speaks for them"},
	{"id":"slide-img-7","client":"Interaction","desc":"With embeded Messenger and forum, the system brings one to one interaction to users of the system"}];
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
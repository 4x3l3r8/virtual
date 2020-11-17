<?php
include("connect.php");
session_start();
if(!isset($_SESSION['id'])){
	echo '<script>
	location.href="index.php"
	</script>';
}
$ses_id=$_SESSION['id'];
$ses_username=$_SESSION['username'];

$res=mysqli_query($conn,"select * from student where id='$ses_id'");
$call=mysqli_fetch_assoc($res);
?>
<?php
if(isset($_GET['details'])){
	$did=$_GET['details'];
	$crs=$_GET['course'];
	$query=mysqli_query($conn, "select * from course where id='$did'");
	$col=mysqli_fetch_assoc($query);
	
	$qy=mysqli_query($conn, "select * from registered_group where group_name='$crs'");
	$count=mysqli_num_rows($qy);
	
	
	$display= '<div align="center" style="height:355px; margin-left:28%; font-size:17px; margin-bottom:5%; border:5px solid lavender; box-shadow:0px 0px 4px 0px black; background-color:snow; padding-bottom:14px; padding:10px; width:700px;">
			<a href="groups.php" title="close"><b style="color:black; float:right; font-size:17px;">&#9932;</b></a><br>
			<form enctype="multipart/form-data" action="" name="form" method="post">
				<div style="margin-top:-6%; margin-bottom:10%;"><H3>Group Info</H3><hr></div>
				<div align="center" style="margin-top:-7%; margin-left:3%; color:black; font-size:18px;">
				<div align="left">
				<p><b>Group Name: &nbsp;&nbsp;&nbsp;</b>'.strtoupper($col['course_code']).'</p>
				<p><b>Description:&nbsp;&nbsp;&nbsp;</b>'.ucwords($col['course_title']).'</p>
				<p><b>Level:&nbsp;&nbsp;&nbsp;</b>'.ucwords($col['level']).'Level</p>
				<p><b>Course Unit:&nbsp;&nbsp;&nbsp;</b>'.ucwords($col['unit']).'Units</p>
				<p><b>Active:&nbsp;&nbsp;&nbsp;</b>'.ucwords($col['semester']).'&nbsp; Semester</p>
				<p><b>Registered Members:&nbsp;&nbsp;&nbsp;</b>'.$count.'</p>
				<p><b>Group Coordinator:&nbsp;&nbsp;&nbsp;</b>'.ucwords($col['fullname']).'</p>
				
				</div></div>
				</div>';
				
	
}

if(isset($_GET['join'])){
	$ccos=$_GET['join'];
	$date=date("Y-m-d h:i:sa");
	$coke=mysqli_query($conn, "select * from registered_group where student_id='$ses_id' AND group_name='$ccos'");
	if(mysqli_num_rows($coke)<=0){
		$fat=mysqli_query($conn, "select * from course where course_code='$ccos' AND lecturer_id !='0' AND fullname !=''");
		if(mysqli_num_rows($fat)>0){
		mysqli_query($conn, "insert into registered_group(student_id,student_username,group_name,reg_date) values('$ses_id','$ses_username','$ccos','$date')");
			echo '<script>
		alert("'.$ccos.' group joined successfully");
		location.href="groups.php"
		</script>';
			
		}else{
		echo '<script>
		alert("Oops! '.$ccos.' Group is not yet active");
		location.href="groups.php"
		</script>';
	}
		
	}else{
		echo '<script>
		alert("Oops! You are already a member of '.$ccos.' Group");
		location.href="groups.php"
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
  <a href="groups.php" class="active">Groups</a>		
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
			<?php echo $display;?><div class = "col-lg-3"></div> 
			<div class = "col-lg-6 well" style="margin-bottom:5%; border:1px solid black; box-shadow: 0 4px 8px 0 black; opacity:0.95;">
				<h2 style="font-size:22px; text-align:center;">Groups Available for <?php echo $call['level'].'Level'; ?> Students</h2><hr>
				<?php
				$qry=mysqli_query($conn, "select * from course where level='".$call['level']."'");
				if(mysqli_num_rows($qry)>0){
					while($row=mysqli_fetch_array($qry)){
						echo '<div style="border:1px solid silver; border-bottom:3px solid gray;">
						<h4 style="color:black; text-align:center; padding:7px;">
						<a href="groups.php?details='.$row['id'].'&course='.$row['course_code'].'" style="float:left; font-size:15px;" class="btn btn-warning">See Group Info</a>
						<img src="img/sig.png" width="4.5%">&nbsp;&nbsp;'.strtoupper($row['course_code'].' Group').'<a href="groups.php?join='.$row['course_code'].'" style="float:right; font-size:16px;" class="btn btn-warning">Join</a></h4>
						</div>';
					}
				}else{
					echo 'No Group Found !';
				}
				?>
				
				
				
				
				
				
				
				<br />
				<div id = "result"></div>
				<br />
				<br />
				
				
				
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
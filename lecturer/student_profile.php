<?php
include("connect.php");
session_start();
if(!isset($_SESSION['lecturer_id'])){
	echo '<script>
	location.href="../admin/index.php"
	</script>';
}
$ses_id=$_SESSION['lecturer_id'];
$ses_name=$_SESSION['lecturer_name'];
?>
<?php
if(isset($_GET['del'])){
	$sid=$_GET['del'];
	mysqli_query($conn, "delete from student where id='$sid'");
	mysqli_query($conn, "delete from registered_group where student_id='$sid'");
	echo '<script>
	alert("Member deleted Successfully")
	location.href="home.php"
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
		<style>
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
body{
			background-image:url('../img/wallpaper-patterns-pattern-honeycomb-abstract-minimalistic-images.jpg.png');
			background-attachment:fixed;
			background-position:top center;
			background-size:100%;
			background-repeat:no-repeat;
		}
		
button.accordion {
    background-color: #eee;
    color: #444;
    cursor: pointer;
    padding: 18px;
    width: 100%;
    border: none;
    text-align: left;
    outline: none;
    font-size: 15px;
    transition: 0.4s;
}

button.accordion.active, button.accordion:hover {
    background-color: #ddd; 
}

div.panel {
    padding: 0 18px;
    display: none;
    background-color: white;
}

div.panel.show {
    display: block !important;
}
tr,td,th{
	padding:7px;
	color:black;
	text-align:center;
}
th{
	background-color:black;
	color:white;
}
table,tr,td,th{
	border:1px solid silver;
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
  		
  <a href="home.php">Groups</a>		
  <a href="chat.php">Chat</a>		
  <a href="tutorial.php" >Tutorial</a>		
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
			<br /> <div align="center" style="margin-top:-1%; margin-bottom:2%;"> <h2 style="font-size:36px; color:black; text-shadow:0px 2px black;">Lecturer Portal </h2></div>
			
			<div class = "col-lg-3"></div>
			
			<!-- <div class = "col-lg-7 well" style="margin-bottom:5%; margin-left:-3.9%;"> -->
			<div class = "col-lg-6 well" style="margin-bottom:5%; border:1px solid black; box-shadow: 0 4px 8px 0 black; opacity:0.95;">
				
				<?php
				$sis=$_GET['profile'];
				$qry=mysqli_query($conn, "select * from student where id='$sis'");
				$row=mysqli_fetch_array($qry);
				?>
			<h3 style="text-align:center;">Student Profile</h3>
		<img src="../<?php echo $row['image'];?>" style="width:18%; border:3px solid silver; border-radius:4px;">
				<div align="center" style="margin-top:-7%; margin-left:37%; color:black; font-size:18px;">
				<div align="left">
				<p><b>Fullname: &nbsp;&nbsp;&nbsp;</b> <?php echo ucwords($row['fullname']);?></p>
				<p><b>Username: &nbsp;&nbsp;&nbsp;</b> <?php echo ucwords($row['username']);?></p>
				<p><b>Matric No: &nbsp;&nbsp;&nbsp;</b> <?php echo ucwords($row['matric_no']);?></p>
				<p><b>Email: &nbsp;&nbsp;&nbsp;</b> <?php echo ucwords($row['email']);?></p>
				<p><b>Department: &nbsp;&nbsp;&nbsp;</b> <?php echo ucwords($row['department']);?></p>
				<p><b>Level: &nbsp;&nbsp;&nbsp;</b> <?php echo ucwords($row['level'].'Level');?></p>
				</br></br>
				<a href="home.php" class="btn btn-primary">Back</a>
				</div></div>
				
				
				<br />
				<div id = "result"></div>
				
				
				
				
			</div></div>
		<?php include("../footer.php");?>
	</body>
	
<script>
var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
    acc[i].onclick = function(){
        this.classList.toggle("active");
        this.nextElementSibling.classList.toggle("show");
  }
}
</script>	
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
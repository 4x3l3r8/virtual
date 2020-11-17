<?php
include("connect.php");
session_start();
if(!isset($_SESSION['admin_id'])){
	echo '<script>
	location.href="index.php"
	</script>';
}

?>
<?php
if(isset($_POST['lec_add'])){
	$ln=$_POST['lec_fullname'];
	$le=$_POST['lec_email'];
	$lc=$_POST['lec_contact'];
	$lpd=$_POST['lec_password'];
	$date=date("Y-m-d h:i:sa");
	
	$result = mysqli_query($conn, "SELECT * FROM lecturer where email='$le'");
$count=mysqli_num_rows($result);
if($count==0)
{
mysqli_query($conn, "INSERT INTO lecturer (fullname, email, contact, password, reg_date) VALUES ('$ln', '$le', '$lc', '$lpd', '$date')");

echo '<script>
alert("Lecturer Added Successfully")
window.location="admin_home.php"
</script>';

}
else{
	$error="<font color='crimson'>Oops! User Exists...</font>";
}
}

if(isset($_GET['rdr'])){
	$pid=$_GET['rdr'];
	mysqli_query($conn, "DELETE FROM lecturer where id='$pid'");
	
	echo '<script>
	alert("Deleted")
	window.location("admin_home.php")
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
					<img src="images/lasu_icon.jpg" width="11%" style="margin-left:2%;">
					<a href="home.php"><h1 class = "navbar-text pull-right" style="text-align:center; margin-right:-1%; font-size:30px; color:white;">Virtual Learning System</h1></a>
				</div>
			</div>
							<!--FOR SIDE NAV-->
			<div class="collapse navbar-collapse" id="example-nav-collapse">
			<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&#9932;</a>
  <hr>
  <a href="admin_home.php" class="active" >Add Lecturers</a>		
  <a href="course.php" >Add Course</a>		
  <a href="student.php" >Students</a>		
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
			<br /> <div align="center" style="margin-top:-1%; margin-bottom:2%;"> <h2 style="font-size:36px; color:black; text-shadow:0px 2px black;">Admin Portal </h2></div>
			
			<div class = "col-lg-3"></div>
			
			<div class = "col-lg-7 well" style="margin-bottom:5%;">
			<!--<div class = "col-lg-5 well" style="margin-bottom:5%; border:1px solid black; box-shadow: 0 4px 8px 0 black; opacity:0.95;">-->
				
				
			
		<button id="myBtn" class="btn btn-warning">Add lecturer</button>
		<?php echo '<font style="margin-left:5%;">'.$error.'</font>'; ?>
		<div id="myModal" class="modal">
  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
	
      <span class="close" title="close">&#8855;</span>
    </div>
    <div class="modal-body">
	
        <div align="center" style="margin-top:8%;">
		<form enctype="multipart/form-data" action="" name="form" method="post">
				<H3>Add Lecturer</H3>
				<input type="text" name="lec_fullname" class="form-control" placeholder="Full Name" style="width:350px; height:35px;" required><br>
				<input type="email" name="lec_email" class="form-control" placeholder="Email" style="width:350px; height:35px;" required><br>
				<input type="text" name="lec_contact" class="form-control"  value="" placeholder="Contact" style="width:350px; height:35px;" required><br>
				<input type="text" value="12345" class="form-control" name="lec_password" placeholder="password" style="width:350px; height:35px;" readonly required>
				
				
<br><br><br>
					<input type="submit" name="lec_add" id="submit" value="Submit" class="btn btn-success" style="width:350px"/>
			</form>
		</div></div></div></div>
				<!--end modal--></br></br></br>
			<table cellpadding="0" cellspacing="0" border="0" class = "table table-bordered" id="example">
			<thead>
				<tr><th align="center">S/N</th>
					<th width="90%" align="center">Full name</th>
					<th width="90%" align="center">Email</th>
					<th align="center">Contact</th>
					<th align="center">Password</th>
					<th align="center">Reg Date</th>
					<th align="center">Delete</th>
						
				</tr>
			</thead>
			<?php
			$no=0;
			$query=mysqli_query($conn, "select * from lecturer  order by fullname desc");
			if(mysqli_num_rows($query)>0){
			while($row=mysqli_fetch_assoc($query)){
				$name=$row['fullname'];
				
				$no=$no+1;
				
			?>
			<tr>
			<td><?php echo $no;?></td>
				<td>
					<?php echo ucwords($name); ?>
				</td>
				<td>
					<?php echo ucwords($row['email']); ?>
				</td>
				<td>
					<?php echo $row['contact']; ?>
				</td>
				
				<td>
					<?php echo $row['password']; ?>
				</td>
				<td>
					<?php echo $row['reg_date']; ?>
				</td>
				<td style="text-align:center;">
				<a href="admin_home.php?rdr=<?php echo $row['id']; ?>"><img src="../img/delete.gif" alt="delete" style="cursor:pointer;"/></a>
				</td>
			</tr>
			<?php }} else { ?>
			<tr><td colspan="8">No Record Found!</td></tr>
			<?php } ?>
		</table>	
				
				
				
				<br />
				<div id = "result"></div>
				<br />
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
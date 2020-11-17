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
if(isset($_POST['add'])){
	$code=$_POST['code'];
	$title=$_POST['title'];
	$level=$_POST['level'];
	$unit=$_POST['unit'];
	$status=$_POST['status'];
	$semester=$_POST['semester'];
	$lecturer_id=$_POST['lecturer'];
	
	$result = mysqli_query($conn, "SELECT * FROM course where course_code='$code'");
$count=mysqli_num_rows($result);
if($count==0)
{
	$r = mysqli_query($conn, "SELECT * FROM lecturer where id='$lecturer_id'");
	$p=mysqli_fetch_array($r);
	$lecturer=$p['fullname'];
mysqli_query($conn, "INSERT INTO course (course_code,course_title,level,semester,status,unit,lecturer_id,fullname) VALUES ('$code', '$title', '$level', '$semester', '$status','$unit','$lecturer_id','$lecturer')");

echo '<script>
alert("Course Added Successfully")
window.location="course.php"
</script>';

}
else{
	$error="<font color='crimson'>Oops! Course Exists...</font>";
}
}

if(isset($_GET['rdr'])){
	$pid=$_GET['rdr'];
	mysqli_query($conn, "DELETE FROM course where id='$pid'");
	
	echo '<script>
	alert("Deleted")
	location.href="course.php"
	</script>';
	
}


if(isset($_POST['update'])){
	$cid=$_POST['cid'];
	$c_code=$_POST['c_code'];
	$c_title=$_POST['c_title'];
	$c_level=$_POST['c_level'];
	$c_unit=$_POST['c_unit'];
	$c_status=$_POST['c_status'];
	$c_semester=$_POST['c_semester'];
	$c_lecturer_id=$_POST['c_lecturer'];
	

	$i = mysqli_query($conn, "SELECT * FROM lecturer where id='$c_lecturer_id'");
	$x=mysqli_fetch_array($i);
	$c_lecturer=$x['fullname'];
	
	mysqli_query($conn, "update course set	course_code='$c_code', course_title='$c_title',	level='$c_level', unit='$c_unit', semester='$c_semester', status='$c_status', lecturer_id='$c_lecturer_id', fullname='$c_lecturer' where id='$cid'");
echo '<script>
	alert("Update Successful")
	location.href="course.php"
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
  <a href="admin_home.php"  >Add Lecturer</a>		
  <a href="course.php" class="active">Add Course Group</a>		
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
			
			<div class = "col-lg-7 well" style="margin-bottom:5%; margin-left:-5%;">
			<!--<div class = "col-lg-5 well" style="margin-bottom:5%; border:1px solid black; box-shadow: 0 4px 8px 0 black; opacity:0.95;">-->
				<?php
				if(isset($_GET['edit'])){
			$rid=$_GET['edit'];
			$qry=mysqli_query($conn, "select * from course where id='$rid'");
			while($col=mysqli_fetch_array($qry)){
				
				
				echo '<div align="center" style=" margin-left:13%; font-size:17px; margin-bottom:5%; border:5px solid lavender; box-shadow:0px 0px 4px 0px black; background-color:snow; padding-bottom:14px; padding:10px; width:700px;">
			<a href="course.php" title="close"><b style="color:black; float:right; font-size:17px;">&#9932;</b></a><br>
			<form enctype="multipart/form-data" action="" name="form" method="post">
				<H3>Edit Course Group</H3>
				<input type="hidden" name="cid" value="'.$col['id'].'" >
				<input type="text" name="c_code" value="'.$col['course_code'].'" class="form-control" placeholder="Course Code" style="width:350px; height:35px;" required><br>
				<input type="text" name="c_title" value="'.$col['course_title'].'" class="form-control" placeholder="Course Description" style="width:350px; height:35px;" required><br>
				<input type="text" name="c_level" value="'.$col['level'].'" class="form-control"  value="" placeholder="Level" style="width:350px; height:35px;" required><br>
				<input type="text" name="c_unit" class="form-control"  value="'.$col['unit'].'" placeholder="Unit" style="width:350px; height:35px;" required><br>
				<input type="text" name="c_semester" class="form-control"  value="'.$col['semester'].'" placeholder="Semester e.g. First or Second" style="width:350px; height:35px;" required><br>
				<input type="text" name="c_status" class="form-control"  value="'.$col['status'].'" placeholder="Status e.g C or E" style="width:350px; height:35px;" required><br>';
				
				}
				
			?>
			<select name="c_lecturer" class="form-control" style="width:350px; height:35px;" required>
				<option value="">--Select Lecturer--</option>
				<?php 
				$rest=mysqli_query($conn, "select * from lecturer order by fullname asc");
				while($sol=mysqli_fetch_assoc($rest)){
				echo '<option value="'.$sol['id'].'">'.ucwords($sol['fullname']).'</option>';
				}
				?>
				</select><br>
			<input type="submit" name="update" id="submit" value="Update" class="btn btn-success" style="width:350px"/>
			</form>
			<br>
			</div>
			<hr>
		<?php } ?>
				
				
				
				
				
			
		<button id="myBtn" class="btn btn-warning">Add Course Group</button>
		<?php echo '<font style="margin-left:5%;">'.$error.'</font>'; ?>
		<h1 style="text-align:center; margin:-2%; font-size:25px;">Course Group</h1>
		<div id="myModal" class="modal" style="margin-left:-3%;">
  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
	
      <span class="close" title="close">&#8855;</span>
	  <div align="center" style="margin-top:-2%;"><H3>Add Course Group</H3></div>
    </div>
    <div class="modal-body">
	
        <div align="center" style="margin-top:0%;">
		<form method="post">
				
				<input type="text" name="code" class="form-control" placeholder="Course Code" style="width:350px; height:35px;" required><br>
				<input type="text" name="title" class="form-control" placeholder="Course Description" style="width:350px; height:35px;" required><br>
				<input type="number" name="level" class="form-control" placeholder="Level" style="width:350px; height:35px;" required><br>
				<input type="number" name="unit" class="form-control" placeholder="Unit" style="width:350px; height:35px;" required><br>
				<input type="text" name="semester" class="form-control" placeholder="Semester e.g. First or Second" style="width:350px; height:35px;" required><br>
				<input type="text" name="status" class="form-control" placeholder="Status e.g C or E" style="width:350px; height:35px;" required><br>
				
				<select name="lecturer" class="form-control" style="width:350px; height:35px;" required>
				<option value="">--Select Lecturer--</option>
				<?php 
				$rest=mysqli_query($conn, "select * from lecturer order by fullname asc");
				while($sol=mysqli_fetch_assoc($rest)){
				echo '<option value="'.$sol['id'].'">'.ucwords($sol['fullname']).'</option>';
				}
				?>
				</select>
				<br>
				
		<input type="submit" name="add" id="submit" value="Submit" class="btn btn-success" style="width:350px"/>
			</form>
		</div></div></div></div>
				<!--end modal--></br></br></br>
			<table cellpadding="0" cellspacing="0" border="0" class = "table table-bordered" id="example">
			<thead>
				<tr><th align="center">S/N</th>
					<th width="90%" align="center">Course Code</th>
					<th width="90%" align="center">Description</th>
					<th align="center">Level</th>
					<th align="center">Unit</th>
					<th align="center">Semester</th>
					<th align="center">Status</th>
					<th align="center">Lecturer</th>
					<th align="center">Action</th>
						
				</tr>
			</thead>
			<?php
			$no=0;
			$query=mysqli_query($conn, "select * from course  order by course_code asc");
			if(mysqli_num_rows($query)>0){
			while($row=mysqli_fetch_assoc($query)){
				
				
				$no=$no+1;
				
			?>
			<tr>
			<td><?php echo $no;?></td>
				<td>
					<?php echo ucwords($row['course_code']); ?>
				</td>
				<td>
					<?php echo ucwords($row['course_title']); ?>
				</td>
				<td>
					<?php echo $row['level']; ?>
				</td>
				<td>
					<?php echo $row['unit']; ?>
				</td>
				<td>
					<?php echo ucwords($row['semester']); ?>
				</td>
				<td>
					<?php echo ucfirst($row['status']); ?>
				</td>
				
				<td>
					<?php echo ucwords($row['fullname']); ?>
				</td>
				
				<td style="text-align:center;" colspan="2">
				<a href="course.php?rdr=<?php echo $row['id']; ?>"><img src="../img/delete.gif" alt="delete" title="delete" style="cursor:pointer;"/></a>&nbsp;
				<a href="course.php?edit=<?php echo $row['id']; ?>"><img src="../img/edit.gif" alt="delete" title="edit" style="cursor:pointer;"/></a>
				</td>
			</tr>
			<?php }} else { ?>
			<tr><td colspan="9">No Record Found!</td></tr>
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
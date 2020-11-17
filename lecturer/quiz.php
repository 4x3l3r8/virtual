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
$lname=$_SESSION['lecturer_name'];
if(isset($_POST['add'])){
	$rid=rand(10,1000000);
	
	$question=$_POST['question'];
	$forum=$_POST['forum'];
	$correct=$_POST['correct'];
	$opt_a=$_POST['opt_a'];
	$opt_b=$_POST['opt_b'];
	$opt_c=$_POST['opt_c'];
	
	
	mysqli_query($conn, "insert into test_choice(qid,forum,coordinator_id,opt) values('$rid','$forum','$lid','$correct')");
	mysqli_query($conn, "insert into test_choice(qid,forum,coordinator_id,opt) values('$rid','$forum','$lid','$opt_a')");
	mysqli_query($conn, "insert into test_choice(qid,forum,coordinator_id,opt) values('$rid','$forum','$lid','$opt_b')");
	mysqli_query($conn, "insert into test_choice(qid,forum,coordinator_id,opt) values('$rid','$forum','$lid','$opt_c')");
	
	$out=mysqli_query($conn, "insert into test(qid,forum,coordinator_id,coordinator_name,question,correct_opt,opt_a,opt_b,opt_c,activation,date) values('$rid','$forum','$lid','$lname','$question','$correct','$opt_a','$opt_b','$opt_c','','')");

	if($out){
		$msg='</br><p style="color:seagreen;">Question added successfully!</p>';
	}
	else{
		$error='</br><p style="color:crimson;">Oops! Unable to add Question!</p>';
	}
	
}
if(isset($_GET['del'])){
	$qid=$_GET['del'];
	mysqli_query($conn, "delete from test where id='$qid'");
	$msg='</br><p style="color:crimson;">Question deleted successfully!</p>';
}

if(isset($_POST['activate'])){
	$grp=$_POST['group'];
	
	mysqli_query($conn, "update test set activation='yes' where forum='$grp'");
	$msg='</br><p style="color:seagreen;">'.$grp.' Quiz successfully Activated!</p>';
}

if(isset($_POST['deactivate'])){
	$grp=$_POST['group'];
	
	mysqli_query($conn, "update test set activation='' where forum='$grp'");
	$msg='</br><p style="color:crimson;">'.$grp.' Quiz successfully Deactivated!</p>';
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
  <a href="member.php" >Members</a>		
  <a href="chat.php" >Chat</a>		
  <a href="tutorial.php" >Tutorial</a>		
  <a href="message.php" >Message</a>		
  <a href="quiz.php" class="active">Quiz</a>		
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
			
			<div class = "col-lg-8 well" style="margin-bottom:5%; margin-left:-8%;">
			<!--<div class = "col-lg-5 well" style="margin-bottom:5%; border:1px solid black; box-shadow: 0 4px 8px 0 black; opacity:0.95;">-->
				
				
			
		
		
		<h1 style="text-align:center; margin:-2%; font-size:23px; margin-top:1%;">Quiz Question</h1><hr>
				<button id="myBtn" class="btn btn-warning">Add Question</button>
				
				<div align="right" style="margin-top:-3.1%;">
				<form method="post">
				<select name="group" class="form-control" style="width:350px; height:35px;" required>
				<option value="">--Select Group Question--</option>
				<?php 
				$rest=mysqli_query($conn, "select * from course where lecturer_id='$lid' AND fullname='$lname'");
				while($sol=mysqli_fetch_assoc($rest)){
				echo '<option value="'.$sol['course_code'].'">'.strtoupper($sol['course_code']).'</option>';
				}
				?>
				</select>
				<br>
				
		<input type="submit" name="deactivate" id="submit" value="Deactivate Question" class="btn btn-primary" style="width:17%"/>
		<input type="submit" name="activate" id="submit" value="Activate Question" class="btn btn-success" style="width:17%"/>
				</form></div>
				
		<?php echo $error;
		echo $msg;
		?>
		
		<div id="myModal" class="modal" style="margin-left:-3%;">
  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
	
      <span class="close" title="close">&#8855;</span>
	  <div align="center" style="margin-top:-2%;"><H3>Add Quiz Question</H3></div>
    </div>
    <div class="modal-body">
	
        <div align="center" style="margin-top:0%;">
		<form method="post">
				
				<textarea name="question" class="form-control" placeholder="Your question here" style="width:350px; height:90px; resize:none;" required></textarea><br>
				<input type="text" name="correct" class="form-control" placeholder="Correct answer" style="width:350px; height:35px;" required><br>
				<input type="text" name="opt_a" class="form-control" placeholder="Option A" style="width:350px; height:35px;" required><br>
				<input type="text" name="opt_b" class="form-control" placeholder="Option B" style="width:350px; height:35px;" required><br>
				<input type="text" name="opt_c" class="form-control" placeholder="Option C" style="width:350px; height:35px;" required><br>
				
				
				<select name="forum" class="form-control" style="width:350px; height:35px;" required>
				<option value="">--Select Group--</option>
				<?php 
				$rest=mysqli_query($conn, "select * from course where lecturer_id='$lid' AND fullname='$lname'");
				while($sol=mysqli_fetch_assoc($rest)){
				echo '<option value="'.$sol['course_code'].'">'.strtoupper($sol['course_code']).'</option>';
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
					<th width="20%" align="center">Group Name</th>
					<th width="90%" align="center">Question</th>
					<th align="center">Correct Answer</th>
					<th align="center">Option A</th>
					<th align="center">Option B</th>
					<th align="center">Option C</th>
					<th align="center">Activation</th>
					<th align="center">Delete</th>
				</tr>
			</thead>
			<?php
			$no=0;
			$query=mysqli_query($conn, "select * from test where coordinator_id='$lid' AND coordinator_name='$lname' order by forum asc");
			if(mysqli_num_rows($query)>0){
			while($row=mysqli_fetch_assoc($query)){				
				$no=$no+1;
		
			?>
			<tr>
			<td><?php echo $no;?></td>
				<td>
					<?php echo strtoupper($row['forum']); ?>
				</td>
				<td>
					<?php echo ucfirst($row['question']); ?>
				</td>
				<td>
					<?php echo ucfirst($row['correct_opt']); ?>
				</td>
				<td>
					<?php echo ucfirst($row['opt_a']); ?>
				</td>
				<td>
					<?php echo ucfirst($row['opt_b']); ?>
				</td>
				<td>
					<?php echo ucfirst($row['opt_c']); ?>
				</td>
				
				<td>
					<?php echo ucfirst($row['activation']); ?>
				</td>
				
				<td style="text-align:center;" colspan="2">
				<a href="quiz.php?del=<?php echo $row['id']; ?>"><img src="../img/delete.gif" alt="delete" title="delete" style="cursor:pointer;"/></a>&nbsp;
				</td>
			</tr>
			<?php }} else { ?>
			<tr><td colspan="9">No Question Found!</td></tr>
			<?php } ?>
		</table>
				
			
				
				
			
				<div id = "result"></div>
				
				
				
				
				
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
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

if(isset($_POST['upload'])){
	
	$date=date("Y-m-d h:i:sa");

$cos=$_POST['course'];
$file_type=$_POST['category'];
$text=$_POST['text'];
$size = $_FILES["image"] ["size"];
  $target_file = "tutorial_file".basename($_FILES["image"]["name"]);
   $Type = pathinfo($target_file,PATHINFO_EXTENSION);
   
   
if($Type == "mp3" || $Type == "wav" || $Type == "flv" || $Type == "avi"){
		$error="<font color='crimson' style='text-align:center;'>Error! File type not allowed...</font>";
		
	}else{
	
	move_uploaded_file($_FILES["image"]["tmp_name"],"tutorial_file/" . $_FILES["image"]["name"]);			
	$location="tutorial_file/" . $_FILES["image"]["name"];

	
mysqli_query($conn, "insert into tutorial(lecturer_id,course,file,file_type,text,date) 
values('$lid','$cos','$location','$file_type','$text','$date')");
	echo '<script>
	alert("File uploaded successfully");
	
	</script>';
		
										
}
}




if(isset($_GET['del'])){
	$del=$_GET['del'];
	$output=mysqli_query($conn, "delete from tutorial where id='$del'");
	if($output){
		echo '<script>
	alert("Tutorial deleted successfully!")
		location.href="tutorialexe.php?tutorial='.$_GET['tutorial'].'"
	</script>';
	}else{
		echo '<script>
	alert("Oops! Unable to delete tutorial!")
location.href="tutorialexe.php?tutorial='.$_GET['tutorial'].'"
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
			
			<div class = "col-lg-8 well" style="margin-bottom:5%; margin-left:-8%;">
			<!--<div class = "col-lg-5 well" style="margin-bottom:5%; border:1px solid black; box-shadow: 0 4px 8px 0 black; opacity:0.95;">-->
				
		</br></br>
		<div align="center" style="margin-top:-8%; margin-bottom:-2%;"><h3 style="font-size:25px;"><img src="../img/people.png" width="11%" />&nbsp;&nbsp; <?php echo strtoupper($_GET['tutorial']);?> Tutorial</h3></div><hr>
		<?php echo $error; ?><br></br> 
		<div align="center"> 
		<form method="post" enctype = "multipart/form-data">
		
				<input type="file" name="image" style="width:410px; height:30px;" required ><div style="margin-left:-30%;"><i>( Max file: 15mb )</i></div></br>
				<input type="hidden" name="course" value="<?php echo $_GET['tutorial']; ?>">
				<textarea style="width:410px; height:120px; resize:none;" name="text" class="form-control" placeholder="Description here" required></textarea></br>
				
				<select name="category" class="form-control" style="width:410px;" required>
				<option value="">--Select Tutorial File Type--</option>
				<option value="ebook">Ebook</option>
				<option value="picture">Picture</option>
				<option value="video">Video</option>
				</select></br></br>
				<input type="submit" name="upload" value="Upload" class="btn btn-primary" style="width:410px;">
				
				</form>
		</div>
		
		
		
		
		
		
		
		
		<br />
			<br />
			<br />
		<table cellpadding="0" cellspacing="0" border="0" class = "table table-bordered" id="example">
			<thead>
				<tr><th align="center">S/N</th>
					<th align="center">Group</th>
					<th width="10%" align="center">File Type</th>
					<th width="50%" align="center">File</th>
					<th width="40%" align="center">Text</th>
					<th width="20%" align="center">Date</th>
					<th align="center">Delete</th>
						
				</tr>
			</thead>
		
			<?php
			$tutorial=$_GET['tutorial'];
			$no=0;
			
				$qry=mysqli_query($conn, "select * from tutorial where lecturer_id='$lid' AND course='$tutorial'");
				if(mysqli_num_rows($qry)>0){
					while($col=mysqli_fetch_array($qry)){
							$no=$no+1;
						echo '<tr><td>'.$no.'</td><td>'.strtoupper($col['course']).'</td>
						<td>'.$col['file_type'].'</td>
						<td>'.$col['file'].'</td>
						<td>'.$col['text'].'</td>
						<td>'.$col['date'].'</td>
						<td><a href="tutorialexe.php?tutorial='.$tutorial.'&del='.$col['id'].'"><img src="../img/delete.gif"></a></td>
						</tr>';
						
					}
				}else{
					echo '<tr><td colspan="7">No Record Found!</td></tr>';
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
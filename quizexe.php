<?php
include("connect.php");
session_start();
if(!isset($_SESSION['id'])){
	echo '<script>
	location.href="index.php"
	</script>';
}

$ses_id=$_SESSION['id'];
$ses_matric=$_SESSION['matric_no'];
$ses_username=$_SESSION['username'];
$res=mysqli_query($conn, "select * from student where id='$ses_id'");
$call=mysqli_fetch_assoc($res);
?>

<?php
if(isset($_POST['submit'])){
	$date=date("Y-m-d h:i:sa");
	$course=$_POST['course'];
	$num=$_POST['num'];

	mysqli_query($conn, "insert into student_score(student_id,matric_no,username,course,score,status,date) values('$ses_id','$ses_matric','$ses_username','$course','','','$date')");
	
$questionid=$_POST['qqqq'];
$answer=$_POST['answer'];


$N = count($questionid); 

for($i=0; $i < $N; $i++)
	{
	$ip_sqlq=mysqli_query($conn, "SELECT * FROM test WHERE qid='$questionid[$i]' AND correct_opt='$answer[$i]'");
		$countq=mysqli_num_rows($ip_sqlq);
		$row = mysqli_fetch_array($ip_sqlq);

		if($countq==1)
		{   
	
			mysqli_query($conn, "UPDATE student_score SET score=score+1, status='marked' where student_id='$ses_id' AND course='$course'");
		}
	}
	
	$dos=mysqli_query($conn, "select * from student_score where student_id='$ses_id' AND course='$course' AND status='marked'");
	$lin=mysqli_fetch_array($dos);
	$scr=$lin['score'];
	
	echo '<script>
	alert("You scored '.$scr.' question(s) correctly out of '.$num.' questions")
	location.href="quiz.php"
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
		body{
			background-image:url('img/preview800x500.jpg');
			background-attachment:fixed;
			background-position:center;
			background-size:%;
			background-repeat:;
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

	.node{
		padding:3px;
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
  <a href="quiz.php" class="active">Quiz</a>		
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
			<div align="center" style="margin-top:2%; margin-bottom:1%;"> <h2 style="font-size:30px; color:white; text-shadow:0px 2px black; font-family:;"> <?php echo strtoupper($_GET['quiz']); ?> Quiz </h2></div>
			
			<br /> <div align="center" style="margin-top:-1%; margin-bottom:2%;"> <h2 style="font-size:39px; color:black; text-shadow:0px 2px black;"> </h2></div>
			<div class = "col-lg-3"></div>
			<div class = "col-lg-6 well" style="margin-bottom:5%; background-color:white;">
			<!--<div class = "col-lg-5 well" style="margin-bottom:5%; border:1px solid black; box-shadow: 0 4px 8px 0 black; background-color:white;">-->
				
				<form method="post">
				<?php
				$quiz=$_GET['quiz'];
				$no=0;
				$qry=mysqli_query($conn, "select * from test where forum='$quiz' AND activation='yes' order by rand()");
				if($count=mysqli_num_rows($qry)>0){
					$count=mysqli_num_rows($qry);
				
					$mol=mysqli_query($conn, "select * from student_score where student_id='$ses_id' AND course='$quiz' AND status='marked'");
					if(mysqli_num_rows($mol)<=0){
					
					echo '<h4 style="text-align:center; font-size:20px; margin:-1%;">'.$count. ' Questions</h4><HR>';
					echo '<input type="hidden" name="num" value="'.$count.'" />';
					while($row=mysqli_fetch_array($qry)){
						$no=$no+1;
						$qid=$row['qid'];
						$cos=$row['forum'];
					echo '<p class="node" style="color:black; font-size:16px;">'.$no.'. &nbsp;'.ucfirst($row['question']).'</p>';
					echo '<input type="hidden" name="qqqq[]" value="'.$qid.'" />';
					echo '<input type="hidden" name="course" value="'.$cos.'" />';
					echo '<select name="answer[]" class="form-control" style="width:350px;">
					<option value="" style="padding:2px;">--Select Answer--</option>';
					
					$sql=mysqli_query($conn, "select * from test_choice where qid='$qid' order by rand()");
					while($col=mysqli_fetch_array($sql)){
					
					
						echo '<option value="'.$col['opt'].'" style="padding:2px;">'.strtoupper($col['opt']).'</option>';
						
					}
						echo '</select></br>';
					}
					echo '</br><div align="center">
				<input type="submit" name="submit" class="btn btn-success" value="submit" style="width:25%;">
				</div>';
					
					}else{
					echo '<h4>Oops! You have sat for this quiz..</h4>';
						}
				
					
					
				}else{
					echo '<h4>Oops! Quiz not yet activated..</h4>';
				}
				
				?>
				
				
				</form>
				
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
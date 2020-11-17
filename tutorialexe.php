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

$res=mysqli_query($conn, "select * from student where id='$ses_id'");
$call=mysqli_fetch_assoc($res);
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
thead{
	background-color:black;
	color:white;
	
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
  <a href="groups.php">Groups</a>		
  <a href="joined.php">Joined Group</a>		
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
			<div class = "col-lg-7 well" style="margin-left:-4%; margin-bottom:5%; border:1px solid black; box-shadow: 0 4px 8px 0 black; opacity:0.95;">
				<h2 style="font-size:22px; text-align:center;"><img src="img/read3.png" width="8%" />&nbsp;&nbsp; <?php echo strtoupper($_GET['tutorial']); ?> Tutorial Materials</h2><hr>
				
				
			
			<?php
			if(($_GET['stream'])){
				$stream=$_GET['stream'];
				$sql=mysqli_query($conn, "select * from tutorial where id='$stream'");
				$con=mysqli_fetch_assoc($sql);
				$fl=$con['file'];
				?>
			<div align="center">
			
			<video id="videoPlayer" width="500" STYLE="border-radius:5px; box-shadow:0px 0px 3px 0px black; border:3px solid lavender;" controls>
			<source src="lecturer/<?php echo $fl; ?>" type="video/mp4"> 
			</video>
  </div>
				
				
				<?php
			}
			
			?>
			
			
			
				<table cellpadding="0" cellspacing="0" border="0" class = "table table-bordered" id="example">
			<thead>
				<tr><th align="center">S/N</th>
					<th width="20%" align="center">File Type</th>
					<th width="60%" align="center">Content</th>
					<th width="20%" align="center">Date</th>
					<th align="center">Download</th>
					<th align="center">View/Play</th>
						
				</tr>
			</thead>
				<?php
				$tutorial=$_GET['tutorial'];
				$no=0;
				$qry=mysqli_query($conn, "select * from tutorial where course='$tutorial' order by date desc");
				if(mysqli_num_rows($qry)>0){
					while($row=mysqli_fetch_array($qry)){
						
						if(strtolower($row['file_type'])=='ebook'){
							$icon='<img src="img/ebook-2-256x256.png" width="45%">';
						}else if(strtolower($row['file_type'])=='picture'){
							$icon='<img src="img/open-file.ico" width="45%">';
						}else if(strtolower($row['file_type'])=='video'){
							$icon='<img src="img/Apps-Player-Video-icon.png" width="45%">';
						}else{ }
						
						
						if(strtolower($row['file_type'])=='ebook'){
							$pl='#';
						}else if(strtolower($row['file_type'])=='picture'){
							$pl='lecturer/'.$row['file'];
						}else if(strtolower($row['file_type'])=='video'){
							$pl='tutorialexe.php?tutorial='.$tutorial.'&stream='.$row['id'];
						}else{ }
						
						
						$no=$no+1;
						echo '<tr><td>'.$no.'</td><td align="center">'.$icon.'</td>
						<td>'.ucwords($row['text']).'</td>
						<td>'.$row['date'].'</td>
						<td align="center"><a href="lecturer/'.$row['file'].'"><img src="img/icon-download21.png" width="45%"></a></td>
						<td align="center"><a href="'.$pl.'"><img src="img/ply.png" width="45%"></a></td>
						</tr>';
						
						
						
						
					}
				}else{
					echo '<tr><td colspan="6">No Record Found !</td></tr>';
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
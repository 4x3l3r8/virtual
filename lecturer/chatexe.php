<?php
include("connect.php");
session_start();
if(!isset($_SESSION['lecturer_id'])){
	echo '<script>
	location.href="../admin/index.php"
	</script>';
}
$_SESSION['forum']=$_GET['chat'];
$ses_forum=$_SESSION['forum'];
?>
<?php
$lid=$_SESSION['lecturer_id'];
$lname=$_SESSION['lecturer_name'];
if(isset($_POST['post'])){
	$date=date("Y-m-d h:i:sa");
	$message=$_POST['message'];
	$group=$_POST['course'];
	mysqli_query($conn, "insert into forum(forum,member_id,member_name,member_category,post,date) values('$group','$lid','$lname','coordinator','$message','$date')");
}

if(isset($_GET['del'])){
	
	$pid=$_GET['del'];
	$cos=$_GET['cos'];
	$salt=mysqli_query($conn, "delete from forum where id='$pid'");
	if($salt){
	
	echo '<script>
	alert("Post Deleted!")
	location.href="chatexe.php?chat='.$cos.'"
	</script>';
	
	}
	else{
		echo '<script>
	alert("Oops! Unable to Delete Post.")
	location.href="chatexe.php?chat='.$cos.'"
	</script>';
	}
}
?>
<?php
function time_stamp($session_time) 
{ 
 
$time_difference = time() - $session_time ; 
$seconds = $time_difference ; 
$minutes = round($time_difference / 60 );
$hours = round($time_difference / 3600 ); 
$days = round($time_difference / 86400 ); 
$weeks = round($time_difference / 604800 ); 
$months = round($time_difference / 2419200 ); 
$years = round($time_difference / 29030400 ); 

if($seconds <= 60)
{
echo"$seconds seconds ago"; 
}
else if($minutes <=60)
{
   if($minutes==1)
   {
     echo"one minute ago"; 
    }
   else
   {
   echo"$minutes minutes ago"; 
   }
}
else if($hours <=24)
{
   if($hours==1)
   {
   echo"one hour ago";
   }
  else
  {
  echo"$hours hours ago";
  }
}
else if($days <=7)
{
  if($days==1)
   {
   echo"one day ago";
   }
  else
  {
  echo"$days days ago";
  }


  
}
else if($weeks <=4)
{
  if($weeks==1)
   {
   echo"one week ago";
   }
  else
  {
  echo"$weeks weeks ago";
  }
 }
else if($months <=12)
{
   if($months==1)
   {
   echo"one month ago";
   }
  else
  {
  echo"$months months ago";
  }
 
   
}

else
{
if($years==1)
   {
   echo"one year ago";
   }
  else
  {
  echo"$years years ago";
  }

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
			background-image:url('../img/AAEAAQAAAAAAAAZiAAAAJDQwMzAyYTA5LWNjYTgtNGYxMC05Njg2LTMyYmUxZTczMzk5ZA.jpg');
			background-attachment:fixed;
			background-position:center;
			background-size:100%;
			background-repeat:no-repeat;
		}
	.chip {
    display: inline-block;
    padding: 0 25px;
    height: 70px;
    font-size: 18px;
    line-height: 70px;
    border-radius: 25px;
    background-color: #f1f1f1;
}

.chip img {
    float: left;
    margin: 0 10px 0 -25px;
    height: 70px;
    width: 70px;
    border-radius: 50%;
}

.closebtn {
    padding-left: 10px;
    color: #888;
    font-weight: bold;
    float: right;
    font-size: 20px;
    cursor: pointer;
}

.closebtn:hover {
    color: #000;
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
div.box{
	background-image:url('../img/chatbox-left.png');
	background-position:center;
	background-size:70% 100%;
	background-repeat:no-repeat;
}
div.bus{
	background-image:url('../img/chatbox-right.png');
	background-position:center;
	background-size:70% 100%;
	background-repeat:no-repeat;
}
		</style>
	</head> <!--<img src="../img/chatbox-left.png" style="width:620px; height:170px;">-->
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
   <a href="chat.php" class="active">Chat</a>
  <a href="tutorial.php" >Tutorial</a>		
  <a href="message.php" >Message</a>		
  <a href="quiz.php" >Quiz</a>		
   <a href="quiz_result.php">Quiz Results</a>
  <a href="cpassword.php" class="active">Change Password</a>	
						
 			
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
			<br /> <div align="center" style="margin-top:-1%; margin-bottom:2%;"> 
			<h2 style="font-size:30px; color:white; text-shadow:0px 2px black;"><img src="../img/Designcontest-Ecommerce-Business-Chat.ico" width="4%"> <?php echo strtoupper($_GET['chat']);?> FORUM </h2></div>
		
		
			
			
			<div class = "col-lg-3"></div>
			
			<div class = "col-lg-8 well" style="margin-bottom:2%; margin-left:-8%;">
			<!--<div class = "col-lg-5 well" style="margin-bottom:5%; border:1px solid black; box-shadow: 0 4px 8px 0 black; opacity:0.95;">-->
				<?php
				echo $msg;
				echo $error;
				?>
				<div style="overflow:auto; height:500px;">
			<?php
		$chat=$_GET['chat'];
		$result=mysqli_query($conn, "select * from forum where forum='$chat' order by date desc");
		if(mysqli_num_rows($result)>0){
			$count=mysqli_num_rows($result);
			echo '<h4 style="text-align:center; color:black; margin-bottom:-0.6%;">'.$count.' Post(s)</h4><hr>';
			while($row=mysqli_fetch_array($result)){
				
				if($row['member_category']=='coordinator'){
					$class="bus";
				}else{
					$class="box";
				}
				
				
				if($row['member_id']==$lid && $row['member_category']=='coordinator'){
					$close ='<a href="chatexe.php?del='.$row['id'].'&cos='.$row['forum'].'" title="delete"><b style="color:black; float:right; font-size:17px;"><img src="../img/x.png" width="22%"></b></a>';
				}
				else{
					$close='';
				}
				?>
				</br>
				
			<?php 
			if($row['member_category']=='coordinator'){
					?>
					<div class="box" align="center" style="padding:5px;">
				<?php echo $close; ?>
			<br>
			<div align="center" style="border:0 solid black; width:60.6%; margin-left:-6.6%; background-color:darkorange; padding:2px;">
			<font style="color:white; font-size:15px; font-family:Arial;"><?php echo ucfirst($row['post']); ?></font></div>
			<div style="color:gold; font-weight:600; margin-bottom:-1%; margin-top:1%;"><font style="margin-left:-9%;"><?php echo ucwords($row['member_category']).': &nbsp;'.ucwords($row['member_name'])?></font> &nbsp;&nbsp;&nbsp;&nbsp;
			<font style="margin-left:20%;"><?php
$d=strtotime($row['date']);
				$dte=time_stamp(strtotime(date("Y-m-d h:i:sa",$d)));
			echo $dte; ?> </font></div></br>
				
				
				</div>
					<?php
				}else{ ?>
				
<div class="bus" align="center" style="padding:5px; ">
				<?php echo $close; ?>
			<br>
			<div align="center" style="border:0 solid black; width:60.7%; margin-left:1.8%; background-color:steelblue; padding:2px;">
			<font style="color:white; font-size:15px; font-family:Arial;"><?php echo ucfirst($row['post']); ?></font></div>
			<div style="color:skyblue; font-weight:600; margin-bottom:-1%; margin-top:1%;"><font style="margin-left:-1%;"><?php echo ucwords($row['member_name'])?></font> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<font style="margin-left:27%;"><?php
$d=strtotime($row['date']);
				$dte=time_stamp(strtotime(date("Y-m-d h:i:sa",$d)));
			echo $dte; ?> </font></div></br>
				
				
				</div>
				
			<?php	}
			
			
			?>
			
				 <!-- <hr> -->
				
				
			
			
			<?php	
			}
		}
		else{
			echo '<p>No Discussion Yet, be the first !</p>';
		}
		
		?>	
			
		</div>
		
		
				
				
			
				<div id = "result"></div>
				<br />
			</div>
			<div class = "col-lg-7 well" style="margin-bottom:5%; margin-left:21%; border:1px solid black; box-shadow: 0 4px 8px 0 black; opacity:0.95;">
			<form method="post">
			<div align="center">
			<input type="hidden" name="course" value="<?php echo $chat;?>">
			<textarea name="message" style="resize:none; width:400px; height:150px;" class="form-control" placeholder="Your post here!"></textarea></br></br>
			<button type="submit"  name="post" class="btn btn-primary" style="width:40%; padding-top:2px; padding-bottom:2px; font-weight:bold; font-size:17px;"><img src="../img/Chat_talk_voice_bubble_phone_message_text.png" width="10%"> &nbsp;&nbsp;&nbsp;Post</button>
			</div>
			</form>
			
			
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
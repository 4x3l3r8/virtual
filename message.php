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
if(isset($_GET['inbox_del'])){
	$sid=$_GET['inbox_del'];
	
	mysqli_query($conn, "delete from inbox where id='$sid'");
	echo '<script>
	alert("Message deleted Successfully")
	location.href="message.php"
	</script>';
}

 if(isset($_GET['outbox_del'])){
	$si=$_GET['outbox_del'];
	
	mysqli_query($conn, "delete from outbox where id='$si'");
	echo '<script>
	alert("Message deleted Successfully")
	location.href="message.php?sent='.$ses_id.'"
	</script>';
}

if(isset($_POST['send'])){
	$date=date("Y-m-d h:i:sa");
	$to=$_POST['to'];
	$sid=$_POST['sid'];
	$msg=$_POST['text'];
	mysqli_query($conn, "insert into outbox (sender_id,sender_name,reciever_id,reciever_name,message,date,sender_category,reciever_category,status) values('$ses_id','$ses_name','$sid','$to','$msg','$date','student','lecturer','')");
	mysqli_query($conn, "insert into inbox (sender_id,sender_name,reciever_id,reciever_name,message,date,sender_category,reciever_category,status) values('$ses_id','$ses_name','$sid','$to','$msg','$date','student','lecturer','')");
	
	echo '<script>
	alert("Message Sent Successfully")
	location.href="message.php?sent="
	</script>';
	
}

if(($_GET['inbox_read'])){
	$rid=$_GET['inbox_read'];
	mysqli_query($conn, "update inbox set status='read' where id='$rid'");
			$qry=mysqli_query($conn, "select * from inbox where id='$rid'");
			$col=mysqli_fetch_array($qry);
				
				
				$display='<div align="center" style=" margin-left:11%; font-size:17px; margin-bottom:5%; border:5px solid lavender; box-shadow:0px 0px 4px 0px black; background-color:snow; padding-bottom:14px; padding:10px; width:600px;">
			<a href="message.php" title="close"><b style="color:black; float:right; font-size:17px;">&#9932;</b></a><br>
			<form enctype="multipart/form-data" action="" name="form" method="post">
			
				<label>From: </label><input type="text" name="c_code" value="'.ucwords($col['sender_name']).'" class="form-control" style="width:350px; height:39px;" readonly></br>
<textarea name="text" class="form-control" style="resize:none; width:400px; height:150px;" readonly>'.ucfirst($col['message']).'</textarea><br></div><br></br>';
}

if(($_GET['outbox_read'])){
	$rid=$_GET['outbox_read'];
	
			$qry=mysqli_query($conn, "select * from outbox where id='$rid'");
			$col=mysqli_fetch_array($qry);
				
				
				$display='<div align="center" style=" margin-left:11%; font-size:17px; margin-bottom:5%; border:5px solid lavender; box-shadow:0px 0px 4px 0px black; background-color:snow; padding-bottom:14px; padding:10px; width:600px;">
			<a href="message.php?sent=" title="close"><b style="color:black; float:right; font-size:17px;">&#9932;</b></a><br>
			<form enctype="multipart/form-data" action="" name="form" method="post">
			
				<label>To (Coordinator): </label><input type="text" name="c_code" value="'.ucwords($col['reciever_name']).'" class="form-control" style="width:350px; height:39px;" readonly></br>
<textarea name="text" class="form-control" style="resize:none; width:400px; height:150px;" readonly>'.ucfirst($col['message']).'</textarea><br></div><br></br>';
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
			background-image:url('img/o-TEEN-BOY-TYPING-ON-LAPTOP-facebook.jpg');
			background-attachment:fixed;
			background-position:center;
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
  <a href="joined.php" >Joined Group</a>		
  <a href="message.php" class="active">Message</a>		
  <a href="members.php">Members</a>			
  <a href="lecturers.php" >Lecturers</a>						
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
			<br /> <div align="center" style="margin-top:-1%; margin-bottom:2%;"> <h2 style="font-size:36px; color:black; text-shadow:0px 2px black;"> </h2></div>
			
			<div class = "col-lg-3"></div>
			
			<!-- <div class = "col-lg-7 well" style="margin-bottom:5%; margin-left:-3.9%;"> -->
			<div class = "col-lg-6 well" style="margin-bottom:5%; border:1px solid black; box-shadow: 0 4px 8px 0 black; opacity:0.98;">
				<?php echo $display; ?>
				<?php
				if(isset($_GET['message'])){
				$sis=$_GET['message'];
				$qry=mysqli_query($conn, "select * from lecturer where id='$sis'");
				$row=mysqli_fetch_array($qry);
				?>
			<h3 style="text-align:center;">Compose Message</h3><hr>
		<form method="post">
		<div align="center">
		<input type="hidden" name="sid" value="<?php echo $row['id']; ?>">
		<label>To (Group Coordinator): </label><input type="text" class="form-control" name="to" value="<?php echo ucwords($row['fullname']); ?>"style="width:400px; height:38px;" readonly><br>
		<textarea name="text" class="form-control" placeholder="Your message here"style="resize:none; width:400px; height:150px;"></textarea><br></br>
		<input type="submit"  class="btn btn-primary" name="send" value="Send" style="width:20%;"></div>
		</form>
				<?php }else if(isset($_GET['sent'])){ ?>
				<h3 style="text-align:center;">Sent Message</h3><hr>
				<a href="message.php" class="btn btn-warning">Inbox</a></br></br>
				<table cellpadding="0" cellspacing="0" border="0" class = "table table-bordered" id="example">
			<thead>
				<tr><th align="center">S/N</th>
					<th width="20%" align="center">Recipient</th>
					<th width="90%" align="center">Message</th>
					<th align="center">Date</th>
					<th align="center">Delete</th>
					<th align="center">Read</th>
						
				</tr>
			</thead>
			<?php
			$no=0;
			$query=mysqli_query($conn, "select * from outbox  where sender_id='$ses_id' AND sender_category='student' AND reciever_category='lecturer' order by date desc");
			if(mysqli_num_rows($query)>0){
			while($row=mysqli_fetch_assoc($query)){
				$no=$no+1;
			?>
			<tr>
			<td><?php echo $no;?></td>
				<td>
					<?php echo ucwords($row['reciever_name']); ?>
				</td>
				<td>
					<?php echo ucwords($row['message']); ?>
				</td>
				<td>
					<?php echo $row['date']; ?>
				</td>
				
				<td style="text-align:center;">
				<a href="message.php?outbox_del=<?php echo $row['id']; ?>"><img src="img/delete.gif" alt="delete" title="delete" style="cursor:pointer;"/></a></td>
				<td><a href="message.php?outbox_read=<?php echo $row['id']; ?>"><img src="img/e-mail_search-512.png" width="75%" alt="delete" title="view" style="cursor:pointer;"/></a>
				</td>
			</tr>
			<?php }} else { ?>
			<tr><td colspan="6">No Message Found!</td></tr>
			<?php } ?>
		</table>	
				
				
				
				<?php }else{ ?>
				<h3 style="text-align:center;">Inbox Message</h3><hr>
				<a href="message.php?sent=<?php echo rand(10,100000); ?>" class="btn btn-warning">Sent</a></br></br>
				<table cellpadding="0" cellspacing="0" border="0" class = "table table-bordered" id="example">
			<thead>
				<tr><th align="center">S/N</th>
					<th width="15%" align="center">Sender</th>
					<th width="90%" align="center">Message</th>
					<th align="center">Date</th>
					<th align="center">Delete</th>
					<th align="center">Read</th>
						
				</tr>
			</thead>
			<?php
			$no=0;
			$query=mysqli_query($conn, "select * from inbox where reciever_id='$ses_id' AND sender_category='lecturer' AND reciever_category='student' order by date desc");
			if(mysqli_num_rows($query)>0){
			while($row=mysqli_fetch_assoc($query)){
				$no=$no+1;
			if($row['status']==''){
				$mess='<b style="color:seagreen;">'.$row['message'].'</b>';
			}
			else{
				$mess=$row['message'];
			}
				
			?>
			<tr>
			<td><?php echo $no;?></td>
				<td>
					<?php echo ucwords($row['sender_name']); ?>
				</td>
				<td>
					<?php echo ucfirst($mess); ?>
				</td>
				<td>
					<?php echo $row['date']; ?>
				</td>
				
				<td style="text-align:center;">
				<a href="message.php?inbox_del=<?php echo $row['id']; ?>"><img src="img/delete.gif" alt="delete" title="delete" style="cursor:pointer;"/></a></td>
				<td><a href="message.php?inbox_read=<?php echo $row['id']; ?>"><img src="img/e-mail_search-512.png" width="75%" alt="delete" title="view" style="cursor:pointer;"/></a>
				</td>
			</tr>
			<?php }} else { ?>
			<tr><td colspan="6">No Message Found!</td></tr>
			<?php } ?>
		</table>
				<?php } ?>
				<br />
				<div id = "result"></div>
				
				
				
				
			</div></div>
		<?php include("footer.php");?>
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
<?php
include("connect.php");
session_start();
$lid=$_SESSION['lecturer_id'];
$lname=$_SESSION['lecturer_name'];


	$date=date("Y-m-d h:i:sa");
	$message=$_POST['message'];
	$group=$_POST['course'];
	mysqli_query($conn, "insert into forum(forum,member_id,member_name,member_category,post,date) values('$group','$lid','$lname','coordinator/lecturer','$message','$date')");
	if($result){
		echo 'Done';
	}
	else{
		echo 'Failed';
	}
	
	?>
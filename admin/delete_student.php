<?php
	require_once 'connect.php';
	$conn->query("DELETE FROM `student` WHERE `student_id` = '$_REQUEST[student_id]'") or die(mysqlii_error());
	header('location:student.php');
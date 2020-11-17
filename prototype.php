<?PHP
INCLUDE("connect.php");

mysqli_query($conn, "INSERT INTO test_choice(qid,forum,coordinator_id,opt) VALUES('2','csc 120','33','good')");






	//mysqli_query($conn, "insert into opt(group,lid,ques_id,op) values('$forum','$lid','$rid','$opt_a')");
	//mysqli_query($conn, "insert into opt(group,lid,ques_id,op) values('$forum','$lid','$rid','$opt_b')");
	//mysqli_query($conn, "insert into opt(group,lid,ques_id,op) values('$forum','$lid','$rid','$opt_c')");
?>
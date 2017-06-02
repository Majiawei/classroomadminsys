<?php 
require_once '../include.php';
$username=$_POST['username'];
$username=addslashes($username);
$password=md5($_POST['password']);
$verify=$_POST['verify'];
$verify1=$_SESSION['verify'];
$autoFlag=$_POST['autoFlag'];
if($verify==$verify1){
    $sql="select * from admin where admin_name='{$username}' and password='{$password}'";
//	$sql="select * from admin";
	$row=checkAdmin($sql);
 	if($row){
		//如果选了一周内自动登陆
		if($autoFlag){
			setcookie("adminId",$row['admin_no'],time()+7*24*3600);
			setcookie("adminName",$row['admin_name'],time()+7*24*3600);
		}
		$_SESSION['adminName']=$row['admin_name'];
		$_SESSION['adminId']=$row['admin_no'];
		//var_dump($row);
		alertMes("登陆成功","index.php");
	}else{
		alertMes("登陆失败，重新登陆","login.php");
	}
}else{
	alertMes("验证码错误","login.php");
}
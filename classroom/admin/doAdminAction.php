<?php 
require_once '../include.php';
checkLogined();
$act=$_REQUEST['act'];
$id=$_REQUEST['id'];
if($act=="logout"){
	logout();
}elseif($act=="addAdmin"){
	$mes=addAdmin();
}elseif($act=="editAdmin"){
	$mes=editAdmin($id);
}elseif($act=="delAdmin"){
	$mes=delAdmin($id);
}elseif($act=="addCate"){
	$mes=addCate();
}elseif($act=="editCate"){
	$where="id={$id}";
	$mes=editCate($where);
}elseif($act=="delCate"){
	$mes=delCate($id);
}elseif($act=="addPro"){
	$mes=addPro();
}elseif($act=="editPro"){
	$mes=editPro($id);
}elseif($act=="delPro"){
	$mes=delPro($id);
}elseif($act=="addUser"){
	$mes=addUser();
}elseif($act=="delUser"){
		$mes=delUser($id);
}elseif($act=="editUser"){
	$mes=editUser($id);	}
	elseif($act=="perorder"){
	    $mes=perorder($id);	}
	    elseif($act=="noper"){
	        $mes=noperorder($id);
}elseif($act=="addNotice"){
    $mes=addNotice();
}elseif($act=="editNotice"){
    $mes=editNotice($id);
}elseif ($act=="delNotice"){
    $mes=delNotice($id);
}elseif ($act =="addperorder"){
    $mes = addperorder();
}elseif ($act =="delperorder"){
    $mes = delperorder($id);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Insert title here</title>
</head>
<body>
<?php 
	if($mes){
		echo $mes;
	}
?>
</body>
</html>
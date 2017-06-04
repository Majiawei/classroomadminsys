<?php 
/**
 * 检查管理员是否存在
 * @param unknown_type $sql
 * @return Ambigous <multitype:, multitype:>
 */
function checkAdmin($sql){
	return fetchOne($sql);
}
/**
 * 检测是否有管理员登陆.
 */
function checkLogined(){
	if($_SESSION['adminId']==""&&$_COOKIE['adminId']==""){
		alertMes("请先登陆","login.php");
	}
}
/**
 * 添加管理员
 * @return string
 */
function addAdmin(){
	//$arr=$_POST;
    //$array = array(''=>'');
    $arr['admin_name']=$_POST['username'];
	$arr['password']=md5($_POST['password']);
	$arr['phone_num']=$_POST['phone'];
	$arr['mail']=$_POST['email'];
	
	if(insert("admin",$arr)){
		$mes="添加成功!<br/><a href='addAdmin.php'>继续添加</a>|<a href='listAdmin.php'>查看管理员列表</a>";
	}else{
		$mes="添加失败!<br/><a href='addAdmin.php'>重新添加</a>";
	}
	return $mes;
}

/**
 * 得到所有的管理员
 * @return array
 */
function getAllAdmin(){
	
	$sql="select admin_no,admin_name,phone_num,mail from admin ";
	$rows=fetchAll($sql);
	return $rows;
}
function getAdminByPage($pageSize=2){
    $sql="select * from admin";
    $pageSize=2;
    $totalRows=getResultNum($sql);
    global $totalPage;
    $totalPage=ceil($totalRows/$pageSize);
    $page=$_REQUEST['page']?(int)$_REQUEST['page']:1;
    if($page<1||$page==null||!is_numeric($page)){
        $page=1;
    }
    if($page>=$totalPage)$page=$totalPage;
    $offset=($page-1)*$pageSize;
    $sql="select admin_no,admin_name,mail,phone_num from admin limit {$offset},{$pageSize}";
    $rows=fetchAll($sql);
// 	$sql="select * from imooc_admin";
// 	global $totalRows;
// 	$totalRows=getResultNum($sql);
// 	global $totalPage;
// 	$totalPage=ceil($totalRows/$pageSize);
// 	if($page<1||$page==null||!is_numeric($page)){
// 		$page=1;
// 	}
// 	if($page>=$totalPage)$page=$totalPage;
// 	$offset=($page-1)*$pageSize;
// 	$sql="select id,username,email from imooc_admin limit {$offset},{$pageSize}";
// 	$rows=fetchAll($sql);
	return $rows;
}

/**
 * 编辑管理员
 * @param int $id
 * @return string
 */
function editAdmin($id){
	//$arr=$_POST;
    $arr['admin_name']=$_POST['username'];
    $arr['password']=md5($_POST['password']);
    $arr['phone_num']=$_POST['phone'];
    $arr['mail']=$_POST['email'];
	//$arr['password']=md5($_POST['password']);
	if(update("admin", $arr,"admin_no={$id}")){
		$mes="编辑成功!<br/><a href='listAdmin.php'>查看管理员列表</a>";
	}else{
		$mes="编辑失败!<br/><a href='listAdmin.php'>请重新修改</a>";
	}
	return $mes;
}

/**
 * 删除管理员的操作
 * @param int $id
 * @return string
 */
function delAdmin($id){
	if(delete("admin","admin_no={$id}")){
		$mes="删除成功!<br/><a href='listAdmin.php'>查看管理员列表</a>";
	}else{
		$mes="删除失败!<br/><a href='listAdmin.php'>请重新删除</a>";
	}
	return $mes;
}

/**
 * 注销管理员
 */
function logout(){
	$_SESSION=array();
	if(isset($_COOKIE[session_name()])){
		setcookie(session_name(),"",time()-1);
	}
	if(isset($_COOKIE['adminId'])){
		setcookie("adminId","",time()-1);
	}
	if(isset($_COOKIE['adminName'])){
		setcookie("adminName","",time()-1);
	}
	session_destroy();
	header("location:login.php");
}
/**
 * 添加用户的操作
 * @param int $id
 * @return string
 */
function addUser(){
	$arr=$_POST;
	$arr['password']=md5($_POST['password']);
	$arr['regTime']=time();
	$uploadFile=uploadFile("../uploads");
	//print_r($arr);
	//print_r($uploadFile);
	if($uploadFile&&is_array($uploadFile)){
		$arr['face']=$uploadFile[0]['name'];
	}else{
		return "添加失败<a href='addUser.php'>重新添加</a>";
	}
	if(insert("user", $arr)){
		$mes="添加成功!<br/><a href='addUser.php'>继续添加</a>|<a href='listUser.php'>查看列表</a>";
	}else{
		$filename="../uploads/".$uploadFile[0]['name'];
		if(file_exists($filename)){
			unlink($filename);
		}
		$mes="添加失败!<br/><a href='arrUser.php'>重新添加</a>|<a href='listUser.php'>查看列表</a>";
	}
	return $mes;
}
/**
 * 删除用户的操作
 * @param int $id
 * @return string
 */
function delUser($id){
	$sql="select face from user where id=".$id;
	$row=fetchOne($sql);
	$face=$row['face'];
	if(file_exists("../uploads/".$face)){
		unlink("../uploads/".$face);
	}
	if(delete("user","id={$id}")){
		$mes="删除成功!<br/><a href='listUser.php'>查看用户列表</a>";
	}else{
		$mes="删除失败!<br/><a href='listUser.php'>请重新删除</a>";
	}
	return $mes;
}
/**
 * 编辑用户的操作
 * @param int $id
 * @return string
 */
function editUser($id){
	$arr=$_POST;
	$arr['password']=md5($_POST['password']);
	if(update("user", $arr,"id={$id}")){
		$mes="编辑成功!<br/><a href='listUser.php'>查看用户列表</a>";
	}else{
		$mes="编辑失败!<br/><a href='listUser.php'>请重新修改</a>";
	}
	return $mes;
}


function perorder($id){
    $sql="update order_tab  set permit =1 where id ={$id}";
    if(!getResultNum($sql)){
        $mes="处理成功!<br/><a href='listOrder.php'>查看预约列表</a>";
    }else{
        $mes="处理失败!<br/><a href='listOrder.php'>请重新处理</a>";
    }
    return $mes;
}
function noperorder($id){
    $sql="update order_tab  set permit =2 where id ={$id}";
    if(!getResultNum($sql)){
        $mes="处理成功!<br/><a href='listOrder.php'>查看预约列表</a>";
    }else{
        $mes="处理失败!<br/><a href='listOrder.php'>请重新处理</a>";
    }
    return $mes;
}

function addNotice(){
    $arr=$_POST;
    $arr['pubtime']=time();
    if(insert("notice_tab",$arr)){
        $mes="公告发布成功!<br/><a href='addNotice.php'>继续发布</a>|<a href='listNotice.php'>查看公告列表</a>";
    }else{
        $mes="公告发布失败！<br/><a href='addNotice.php'>重新发布</a>|<a href='listNotice.php'>查看公告列表</a>";
    }
    return $mes;
}
function getNoticeById($id){
    $sql="select id,title,content from notice_tab where id={$id}";
    return fetchOne($sql);
}

function editNotice($id){
    $arr=$_POST;
    $arr['pubtime']=time();
    if(update("notice_tab", $arr,"id={$id}")){
        $mes="更改成功!<br/><a href='listNotice.php'>查看公告列表</a>";
    }else{
        $mes="更新失败!<br/><a href='listNotice.php'>请重新更新</a>";
    }
    return $mes;
}
function delNotice($id){
    if(delete("notice_tab","id={$id}")){
        $mes="删除成功!<br/><a href='listNotice.php'>查看公告列表</a>";
    }else{
        $mes="删除失败!<br/><a href='listNotice.php'>请重新删除</a>";
    }
    return $mes;
}
function addperorder(){
    $arr=$_POST;
    if(insert("perorder",$arr)){
        $mes="添加成功!<br/><a href='addperorder.php'>继续发布</a>|<a href='listperorder.php'>查看公告列表</a>";
    }else{
        $mes="添加失败！<br/><a href='addperorder.php'>重新发布</a>|<a href='listperorder.php'>查看公告列表</a>";
    }
    return $mes;
}
function delperorder($id){
    if(delete("perorder","id={$id}")){
        $mes="删除成功!<br/><a href='listperorder.php'>查看公告列表</a>";
    }else{
        $mes="删除失败!<br/><a href='listperorder.php'>请重新删除</a>";
    }
    return $mes;
}
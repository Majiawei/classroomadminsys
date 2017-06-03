<?php 
//require_once '../configs/configs.php';
/**
 * 连接数据库
 * @return resource
 */
function connect(){
    $link=mysqli_connect(DB_HOST,DB_USER,DB_PWD,DB_DBNAME);
    if (mysqli_connect_errno($link))
    {
        echo "连接 MySQL 失败: " . mysqli_connect_error();
    }
    mysqli_set_charset($link,DB_CHARSET);
    return $link;
}
//     $link=mysqli_connect(DB_HOST,DB_USER,DB_PWD);
//     if (mysqli_connect_errno($link))
//     {
//         echo "连接 MySQL 失败: " . mysqli_connect_error();
//     }
//     mysqli_set_charset($link,DB_CHARSET);
//     mysqli_select_db($link,DB_DBNAME) or die("指定数据库打开失败");
    /**
     *得到指定一条记录
     * @param string $sql
     * @param string $result_type
     * @return multitype:
     */
   function fetchOne($sql,$result_type=MYSQLI_ASSOC){
// $username="king";
// $psw=md5("king");
// $sql='select * from admin';
        $link=mysqli_connect(DB_HOST,DB_USER,DB_PWD,DB_DBNAME);
        if (mysqli_connect_errno($link))
        {
            echo "连接 MySQL 失败: " . mysqli_connect_error();
        }
        mysqli_set_charset($link,DB_CHARSET);
       // mysqli_select_db($link,DB_DBNAME) or die("指定数据库打开失败");
        $result=mysqli_query($link,$sql);
        $row=mysqli_fetch_array($result,MYSQLI_ASSOC);
        mysqli_close($link);
        //var_dump($row);
       return $row;
   }

/**
 * 完成记录插入的操作
 * @param string $table
 * @param array $array
 * @return number
 */
function insert($table,$array){
	$keys=join(",",array_keys($array));
	$vals="'".join("','",array_values($array))."'";
	$sql="insert {$table}($keys) values({$vals})";
	$link=mysqli_connect(DB_HOST,DB_USER,DB_PWD,DB_DBNAME);
	if (mysqli_connect_errno($link))
	{
	    echo "连接 MySQL 失败: " . mysqli_connect_error();
	}
	mysqli_set_charset($link,DB_CHARSET);
	mysqli_query($link,$sql);
	return mysqli_insert_id($link);
}
//update imooc_admin set username='king' where id=1
/**
 * 记录的更新操作
 * @param string $table
 * @param array $array
 * @param string $where
 * @return number
 * 
 * 
 */
// $arr['admin_name']="123456";
// $arr['password']="123456";
// $arr['phone_num']="123456";
// $arr['mail']="123456";
// echo  update("admin", $arr,"admin_no= 8");
function update($table,$array,$where=null){
    $str=null;
	foreach($array as $key=>$val){
        if($str==null){
			$sep="";
		}else{
			$sep=",";
		}
		$str.=$sep.$key."='".$val."'";
	}
		$sql="update {$table} set {$str} ".($where==null?null:" where ".$where);
		$link=mysqli_connect(DB_HOST,DB_USER,DB_PWD,DB_DBNAME);
		if (mysqli_connect_errno($link))
		{
		    echo "连接 MySQL 失败: " . mysqli_connect_error();
		}
		mysqli_set_charset($link,DB_CHARSET);
		$result=mysqli_query($link,$sql);
// 		var_dump($result);
// 		var_dump(mysqli_affected_rows($link));
		if($result){
		    return mysqli_affected_rows($link);
		}else{
			return false;
		}
}

/**
 *	删除记录
 * @param string $table
 * @param string $where
 * @return number
 */
function delete($table,$where=null){
	$where=$where==null?null:" where ".$where;
	$sql="delete from {$table} {$where}";
	$link=mysqli_connect(DB_HOST,DB_USER,DB_PWD,DB_DBNAME);
	if (mysqli_connect_errno($link))
	{
	    echo "连接 MySQL 失败: " . mysqli_connect_error();
	}
	mysqli_set_charset($link,DB_CHARSET);
	mysqli_query($link,$sql);
	return mysqli_affected_rows($link);
}




/**
 * 得到结果集中所有记录 ...
 * @param string $sql
 * @param string $result_type
 * @return multitype:
 */
function fetchAll($sql,$result_type=MYSQLI_ASSOC){
    $link=mysqli_connect(DB_HOST,DB_USER,DB_PWD,DB_DBNAME);
    if (mysqli_connect_errno($link))
    {
        echo "连接 MySQL 失败: " . mysqli_connect_error();
    }
    mysqli_set_charset($link,DB_CHARSET);
    $result=mysqli_query($link,$sql);
	while(@$row=mysqli_fetch_array($result,$result_type)){
		$rows[]=$row;
	}
	mysqli_close($link);
	return $rows;
}

/**
 * 得到结果集中的记录条数
 * @param unknown_type $sql
 * @return number
 */
function getResultNum($sql){
    $link=connect();
    $result=mysqli_query($link,$sql);
	return mysqli_num_rows($result);
}

/**
 * 得到上一步插入记录的ID号
 * @return number
 */
function getInsertId(){
    $link=connect();
    return mysqli_insert_id($link);
}


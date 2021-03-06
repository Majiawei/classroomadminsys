<?php 

function addAlbum($arr){
	insert("room_album", $arr);
}

/**
 * 根据商品id得到商品图片
 * @param int $id
 * @return array
 */
function getProImgById($id){
	$sql="select albumPath from room_album where pid={$id} limit 1";
	$row=fetchOne($sql);
	return $row;
}

/**
 * 根据商品id得到所有图片
 * @param int $id
 * @return array
 */
function getProImgsById($id){
	$sql="select albumPath from room_album where pid={$id} ";
	$rows=fetchAll($sql);
	return $rows;
}
function getDateById($id){
    $sql="select id,date,w_time from perorder where pid={$id} ";
    $rows=fetchAll($sql);
    return $rows;
}
function getDateTimeById($id){
    $sql="select date,w_time from perorder where id={$id} ";
    $rows=fetchAll($sql);
    return $rows;
}
/**
 * 文字水印的效果
 * @param int $id
 * @return string
 */
function doWaterText($id){
	$rows=getProImgsById($id);
	foreach($rows as $row){
		$filename="../image_800/".$row['albumPath'];
		waterText($filename);
	}
	$mes="操作成功";
	return $mes;
}

/**
 *图片水印
 * @param int $id
 * @return string
 */
function doWaterPic($id){
	$rows=getProImgsById($id);
	foreach($rows as $row){
		$filename="../image_800/".$row['albumPath'];
		waterPic($filename);
	}
	$mes="操作成功";
	return $mes;
}





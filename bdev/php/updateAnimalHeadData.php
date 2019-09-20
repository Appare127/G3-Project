<?php
$errMsg = "";
// echo $_REQUEST['head_name'];
try{
	require_once("connectg3.php");
	$sql = "update head SET head_name=:head_name, head_environment1=:head_environment1, head_environment2=:head_environment2, head_environment3=:head_environment3, head_status=:head_status , head_ch_name=:head_ch_name WHERE head_no=:head_no";
	$animal_head = $pdo->prepare($sql);
	$animal_head->bindValue(":head_name",$_REQUEST['head_name']);
	$animal_head->bindValue(":head_environment1",$_REQUEST['head_environment1']);
	$animal_head->bindValue(":head_environment2",$_REQUEST['head_environment2']);
	$animal_head->bindValue(":head_environment3",$_REQUEST['head_environment3']);
	$animal_head->bindValue(":head_status",$_REQUEST['head_status']);
	$animal_head->bindValue(":head_ch_name",$_REQUEST['head_ch_name']);
	$animal_head->bindValue(":head_no", $_REQUEST["head_no"]);
	$animal_head->execute();
  
   
	// 看你傳入的欄位值是 head_img or head_img_combination
	function add ($name){    //name = head_img  or  head_img_combination

		$head_name = $_REQUEST['head_name'];
		$head_no= $_REQUEST["head_no"];
		
		// 後台的存檔路徑
		$upload_dir = "../img/modify/";

		//實際寫進資料庫 給前台使用的路徑
		$save_directory = "img/modify/";

		//先檢查modify資料夾存不存在
		if( file_exists("modify") === false){
			mkdir("modify");
		}

		//檔案名稱都要變成head_xxx.png or p_head_xxx.png
		if($name == "head_img_combination"){ //如果是左側組合圖
			$fileName = "p_head_" . $head_name .".png";
		}else if($name == "head_img"){ //如果是右側選單圖
			$fileName = "head_" . $head_name .".png";
		}

		// 你要copy的檔案路徑
		$from = $_FILES[ $name ]["tmp_name"];
		$to = "$upload_dir" . "$fileName";
		copy( $from, $to);

		// 資料庫
		$dsn = "mysql:host=localhost;port=3306;dbname=dd102g3;charset=utf8";
		$user = "root";
		$password = "123456";
		$options=array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION, PDO::ATTR_CASE=>PDO::CASE_NATURAL);
		$pdoa = new PDO($dsn, $user, $password, $options);
	
		//將檔案名稱寫回資料庫
		$sql = "update head set $name = :$name where head_no = $head_no";
		$newhead = $pdoa->prepare($sql);
		$newhead -> bindValue(":$name", "$save_directory"."$fileName");
		$newhead -> execute();

		echo " $name 新增成功~";
	}

	if( $_FILES["head_img"]["error"] == UPLOAD_ERR_OK){
		add("head_img");
	}


	if( $_FILES["head_img_combination"]["error"] == UPLOAD_ERR_OK){
		add("head_img_combination");
	}

    header('Location:animalHead.php');

}catch(PDOException $e){
  echo $e->getMessage();
}
?>
<?php 
$errMsg = "";
try {
    require_once('../connectg3.php');
    

  if( $_FILES["upFile"]["error"] == UPLOAD_ERR_OK){

	  
	$members=$pdo->prepare('update user set user_name=:user_name,user_psw=:user_psw,user_tel=:user_tel,hint_answer=:hint_answer where user_id=:user_id');

	$members->bindValue(':user_id',$_REQUEST["user_id"]);
	$members->bindValue(':user_name',$_REQUEST["user_name"]);
	$members->bindValue(':user_psw',$_REQUEST["user_psw"]);
	$members->bindValue(':user_tel',$_REQUEST["user_tel"]);
	$members->bindValue(':hint_answer',$_REQUEST["hint_answer"]);
	$members->execute();
	// echo "異動成功~" ;
	header("location:../../member.php");


		// $sql = "INSERT INTO `user` (`psn`, `pname`, `price`, `author`, `pages`, `image`) values(null, :pname, :price, :author, :pages, '' )";
		//為什麼要反斜線 讓他等於字串 不能用"" 
		//讓image先為''
		// $products = $pdo->prepare( $sql );
		// $products -> bindValue(":pname", $_POST["pname"]);
		// $products -> bindValue(":price", $_POST["price"]);
		// $products -> bindValue(":author", $_POST["author"]);
		// $products -> bindValue(":pages", $_POST["pages"]);
		// $products -> execute();

		//取得自動創號的key值
		// $psn = $pdo->lastInsertId();

		//先檢查images資料夾存不存在
		$dir ="../../img/memberimg/";

		if(!file_exists($dir)){
			mkdir($dir);
		}
		//將檔案copy到要放的路徑
		$fileInfoArr = pathinfo($_FILES["upFile"]["name"]); //原本使用者放的路徑

		$fileName = "{$_REQUEST["user_id"]}.{$fileInfoArr["extension"]}";  //9.gif

		$from = $_FILES["upFile"]["tmp_name"];//暫存檔的路徑名稱
		$to = $dir."$fileName";
		copy( $from, $to);//從暫存檔的路徑名稱複製到images

    //將檔案名稱寫回資料庫
    

		$sql = "update user set user_img=:user_img where user_id=:user_id";
		$memberImg = $pdo->prepare($sql);
    	$memberImg -> bindValue(":user_img", $fileName);//把9.gif給image
    	$memberImg -> bindValue(':user_id',$_REQUEST["user_id"]);
		$memberImg -> execute();
		echo "新增成功~";

	}else if($_FILES["upFile"]["error"] == 4){ //如果未指定上傳檔案
		header("location:../../member.php");
	}
	else{
		echo "錯誤代碼 : {$_FILES["upFile"]["error"]} <br>";
		echo "新增失敗";
	}


} catch (PDOException $e) {
	$errMsg = $errMsg . "錯誤訊息: " . $e->getMessage() . "</br>";
    $errMsg .= "錯誤行號: " . $e->getLine() . "<br>";
    echo $errMsg;
}
?>   
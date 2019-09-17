<?php
$errMsg = "";
try {
		require_once("connectg3.php");
		
		
		$sql = "insert into product (product_no, product_name, product_img, product_price, product_status, product_description) values (null, :product_name, :product_img, :product_price, :product_status, :product_description)";
		$newProduct = $pdo->prepare($sql);
		$newProduct->bindValue(":product_name",$_REQUEST['product_name']);
		$newProduct->bindValue(":product_img",$_REQUEST['product_img']);
		$newProduct->bindValue(":product_price",$_REQUEST['product_price']);
		$newProduct->bindValue(":product_status",$_REQUEST['product_status']);
		$newProduct->bindValue(":product_description",$_REQUEST['product_description']);
		$newProduct->execute();
		//取得自動創號的地區號碼
        $product_no = $pdo->lastInsertId();
        echo "新增商品成功";
    	header('Location:product.php');
	} catch (PDOException $e) {
		$errMsg = $errMsg . "錯誤訊息: " . $e->getMessage() . "</br>";
		$errMsg .= "錯誤行號: " . $e->getLine() . "<br>";
        // $pdo->rollback();
        echo $errMsg;
	}

?>
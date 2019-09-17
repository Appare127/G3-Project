<?php
$errMsg = "";
try{
  require_once("connectg3.php");
  $sql = "update product SET product_name=:product_name, product_img=:product_img, product_price=:product_price, product_status=:product_status, product_description=:product_description WHERE product_no=:product_no";
  $product = $pdo->prepare($sql);
  $product->bindValue(":product_name",$_REQUEST['product_name']);
  $product->bindValue(":product_img",$_REQUEST['product_img']);
  $product->bindValue(":product_price",$_REQUEST['product_price']);
  $product->bindValue(":product_status",$_REQUEST['product_status']);
  $product->bindValue(":product_description",$_REQUEST['product_description']);
  $product->bindValue(":product_no",$_REQUEST['product_no']);
  $product->execute(); 

  if( $product->rowCount() == 0 ){ //找不到
    //傳回空的JSON字串
    echo "{}";
  }else{ //找得到
    echo "修改成功";
    header('Location:product.php');
  }	
}catch(PDOException $e){
  echo $e->getMessage();
}
?>
<?php
$errMsg = "";
try{
  require_once("connectg3.php");
  $sql = "update resv_order SET order_status=:order_status, resv_status=:resv_status WHERE booking_no=:booking_no";
  $resvOrder = $pdo->prepare($sql);
  $resvOrder->bindValue(":order_status",$_REQUEST['order_status']);
  $resvOrder->bindValue(":resv_status",$_REQUEST['resv_status']);
  $resvOrder->bindValue(":booking_no",$_REQUEST['booking_no']);
  $resvOrder->execute(); 

  if( $resvOrder->rowCount() == 0 ){ //找不到
    //傳回空的JSON字串
    echo "{}";
  }else{ //找得到
    echo "修改成功";
    header('Location:resvOrder.php');
  }	
}catch(PDOException $e){
  echo $e->getMessage();
}
?>
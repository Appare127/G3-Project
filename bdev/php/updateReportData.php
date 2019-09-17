<?php
$errMsg = "";
try{
  require_once("connectg3.php");
  $sql = "update report SET report_status=:report_status WHERE report_no=:report_no";
  $report = $pdo->prepare($sql);
  $report->bindValue(":report_status",$_REQUEST['report_status']);
  $report->bindValue(":report_no",$_REQUEST['report_no']);
  $report->execute(); 

  if( $report->rowCount() == 0 ){ //找不到
    //傳回空的JSON字串
    echo "{}";
  }else{ //找得到
    echo "修改成功";
    header('Location:report.php');
  }	
}catch(PDOException $e){
  echo $e->getMessage();
}
?>
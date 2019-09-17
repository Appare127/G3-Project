<?php
$errMsg = "";
try{
  require_once("connectg3.php");
  $sql = "update leg SET leg_name=:leg_name, leg_img=:leg_img, leg_jump=:leg_jump, leg_environment1=:leg_environment1, leg_environment2=:leg_environment2, leg_environment3=:leg_environment3, leg_status=:leg_status , leg_ch_name=:leg_ch_name WHERE leg_no=:leg_no";
  $animal_leg = $pdo->prepare($sql);
  $animal_leg->bindValue(":leg_name",$_REQUEST['leg_name']);
  $animal_leg->bindValue(":leg_img",$_REQUEST['leg_img']);
  $animal_leg->bindValue(":leg_jump",$_REQUEST['leg_jump']);
  $animal_leg->bindValue(":leg_environment1",$_REQUEST['leg_environment1']);
  $animal_leg->bindValue(":leg_environment2",$_REQUEST['leg_environment2']);
  $animal_leg->bindValue(":leg_environment3",$_REQUEST['leg_environment3']);
  $animal_leg->bindValue(":leg_status",$_REQUEST['leg_status']);
  $animal_leg->bindValue(":leg_ch_name",$_REQUEST['leg_ch_name']);
  $animal_leg->bindValue(":leg_no", $_REQUEST["leg_no"]);
  $animal_leg->execute(); 

  if( $animal_leg->rowCount() == 0 ){ //找不到
    //傳回空的JSON字串
    echo "{}";
  }else{ //找得到
    echo "修改成功";
    header('Location:animalLeg.php');
  }	
}catch(PDOException $e){
  echo $e->getMessage();
}
?>
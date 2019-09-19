<?php
$errMsg = "";
// $user_no=$_GET["user_no"];
$user_no=13;
try {
    require_once("../connectg3.php");
    session_start();
//取出動物排行
    $sql_user_ctn = 
    "select u.last_vote_date,u.vote_remain
    from user u
    where  u.user_no = {$user_no}  ";
    $user_ctn = $pdo->prepare($sql_user_ctn);
    $user_ctn ->execute();
}
catch (PDOException $e) {
    $errMsg = $errMsg . "錯誤訊息: " . $e->getMessage() . "<br>";
    $errMsg .= "錯誤行號: " . $e->getLine() . "<br>";
}

$user_ctnRow= $user_ctn -> fetch(PDO::FETCH_ASSOC);
$time=date("Y-m-d");
if($user_ctnRow['last_vote_date']>$time){
    echo json_encode( "1");
}else if($user_ctnRow['last_vote_date']=$time){


//sql timestamp not null
echo json_encode( "2");}
else {
    echo json_encode( "3");}
    echo json_encode( "4");

?>
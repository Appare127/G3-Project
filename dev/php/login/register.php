<?php
session_start();
try{
require_once('../connectg3.php');
// {"id":"aaa","psw":"09871","name":"aaa","email":"1@zoo.com","ans":"qqq","hint_no":"1"}
if(isset($_POST['data'])){
    $data=json_decode($_POST['data']);
    // print_r($data);

    $sql="INSERT INTO `user` (`user_no`, `user_id`, `user_psw`, `user_name`, `user_email`, `hint_answer`,  `hint_no`, `user_status`,`my_animal_img`,`my_animal_bg_img`,`my_animalbg_img`) VALUES (null,:id,:psw,:name,:email,:ans,:hint_no,1,'img/member/user0_bg.png','img/member/user0_aml.png','img/member/user0_amlbg.png')";

    
    $user=$pdo->prepare($sql);
    
    foreach ($data as $i => $n) {
        $user->bindValue(":{$i}",$n);
    }
    $user->execute();
    

    $user_no = $pdo->lastInsertId();

    $_SESSION['user_no']=$user_no;
   

    $login=$pdo->query("select * from user where user_no = $user_no");
    $loginRow=$login->fetch(PDO::FETCH_ASSOC);
    
    echo json_encode($loginRow);


}else{
    $qsn=$pdo->query("select * from prompts");
    $qsnRow=$qsn->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($qsnRow);
}



}catch (PDOException $e) {
	$errMsg = $errMsg . "錯誤訊息: " . $e->getMessage() . "</br>";
	$errMsg .= "錯誤行號: " . $e->getLine() . "<br>";
}
?>


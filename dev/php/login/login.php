<?php
session_start();

try{
    require_once("connectg3.php");
    $sql='select * from user where user_id=:user_id and user_psw=:user_psw;';
    //  $sql='select * from user;';

    $user=$pdo->prepare($sql);
    $user->bindValue(':user_id',$_POST['user_id']);
    $user->bindValue(':user_psw',$_POST["user_psw"]);
    $user->execute();
    if($user->rowCount() == 0){
        echo 'loginError';
    }else{
        $userRow=$user->fetchAll(PDO::FETCH_ASSOC);
      
        foreach ($userRow[0] as $i => $data) {
            $_SESSION[$i]=$data;
        }
        echo json_encode($userRow);
    };


}catch(PDOException $e){
    // echo $e->getMessage();
    echo "sysError";

}
?>
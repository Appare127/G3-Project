<?php 
session_start();
session_destroy();


// try{
//     require_once("connectg3.php");
//     $sql='select * from user where user_no=:user_no';
//     //  $sql='select * from user;';

//     $user=$pdo->prepare($sql);
//     $user->bindValue(':user_no',$_POST['user_no']);
//     $user->execute();
//     if($user->rowCount() == 0){
//         echo 'loginError';
//     }else{
//         $userRow=$user->fetchAll(PDO::FETCH_ASSOC);
      
//         foreach ($userRow[0] as $i => $data) {
//             $_SESSION[$i]=$data;
//         }
//         echo json_encode($userRow);
//     };


// }catch(PDOException $e){
//     // echo $e->getMessage();
//     echo "sysError";

// }
?>
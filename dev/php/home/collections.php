
<?php
 $errMsg = "";
 try {
     $dsn = "mysql:host=localhost;port=3306;dbname=dd102g3;charset=utf8";
     $user = "root";
     $password = "123456";
     $options = array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION, PDO::ATTR_CASE=>PDO::CASE_NATURAL);
     $pdo = new PDO($dsn, $user, $password, $options);
     $sql_rank = 
     "select c.bg_img,c.cmp_img
     from collections c
     where  YEAR(work_date) = 2019 
     order by c.vote desc";
     $user_ctn = $pdo->prepare($sql_rank);
     $user_ctn ->execute();
     $item = "select count(*) from collections";
 } catch (PDOException $e) {
     $errMsg = $errMsg . "錯誤訊息: " . $e->getMessage() . "<br>";
     $errMsg .= "錯誤行號: " . $e->getLine() . "<br>";
 }
 if( $errMsg != ""){
     echo "<center>$errMsg</center>";
     exit();}
     for($i=0;$i<3;$i++){
      $user_ctnRow[$i] = $user_ctn -> fetch(PDO::FETCH_ASSOC);
     };
     echo json_encode( $user_ctnRow );
?>

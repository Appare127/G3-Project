
<?php
 $errMsg = "";
 try {
    require_once("../connectg3.php");
    $imgs  = $pdo->query("select amlbg_img from collections order by vote desc limit 3");
    $imgsRow=$imgs->fetchAll(PDO::FETCH_ASSOC);

    $prod= $pdo->query("select product_name,product_img,product_price from product limit 1");
    $prodRow=$prod->fetch(PDO::FETCH_ASSOC);
    // print_r(json_encode($prodRow));
    // print_r(json_encode($imgsRow));
    $data[]=json_encode($prodRow);
    $data[]=json_encode($imgsRow);
    print_r(json_encode($data));

//   [{"amlbg_img":"img\/collections\/work_amlbg_5.png"},{"amlbg_img":"img\/collections\/work_amlbg_1.png"},{"amlbg_img":"img\/collections\/work_amlbg_3.png"}]


 } catch (PDOException $e) {
     $errMsg = $errMsg . "錯誤訊息: " . $e->getMessage() . "<br>";
     $errMsg .= "錯誤行號: " . $e->getLine() . "<br>";
 }

?>

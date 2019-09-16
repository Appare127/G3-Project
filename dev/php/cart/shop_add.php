<?php
session_start();

try{
    // $_SESSION['cart']=[];
    $data=$_GET['data'];
    $data=json_decode($data);
    // print_r($data);
    
    // $_SESSION['cart']=[];

    $_SESSION['cart'][$data->prodInfo[0]]=$data;


    // foreach ($data as $i => $n) {
    //     $_SESSION['cart'][]=
    // }
    print_r( $_SESSION['cart']);
}catch(PDOException $e){
    $errMsg = $errMsg . "錯誤訊息: " . $e->getMessage() . "</br>";
	$errMsg .= "錯誤行號: " . $e->getLine() . "<br>";
}
?>
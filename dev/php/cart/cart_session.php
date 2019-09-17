<?php
session_start();

try{
    if(isset($_GET['data'])){
        $add=$_GET['data'];
        $add=json_decode($add);
        $_SESSION['cart'][$add->prodInfo[0]]=$add;
        print_r( $_SESSION['cart']);
    
    }else if(isset($_GET['num'])){
        $data=$_GET['num'];
        $id=explode(",",$data)[0];
        $num=explode(",",$data)[1];

        $_SESSION['cart'][$id]->num=$num;
        echo  $_SESSION['cart'][$id]->num*$_SESSION['cart'][$id]->prodInfo[2];


    }else if(isset($_GET['delete'])){
        $delete=$_GET['delete'];
        unset($_SESSION['cart'][$delete]);
    }
}catch(PDOException $e){
    $errMsg = $errMsg . "錯誤訊息: " . $e->getMessage() . "</br>";
	$errMsg .= "錯誤行號: " . $e->getLine() . "<br>";
}
?>
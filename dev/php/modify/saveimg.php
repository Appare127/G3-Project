<?php
    session_start();





    try {
        require_once("connectg3.php");

    } catch (PDOException $e) {
        $errMsg = $errMsg . "錯誤訊息: " . $e->getMessage() . "</br>";
        $errMsg .= "錯誤行號: " . $e->getLine() . "<br>";
    }


?>
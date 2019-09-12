<?php

    $upload_dir = "../../img/customize//";  //檢查資料夾存不存在
    if( ! file_exists($upload_dir )){
        mkdir($upload_dir);
    }
    
    $imgDataStr = $_POST['url_data'];//收到convas.toDataURL()送來的資料
    $imgDataStr = str_replace('data:image/png;base64,', '', $imgDataStr); //將檔案格式的資訊拿掉
    // $imgDataStr = str_replace(' ', '+', $imgDataStr);
    $data = base64_decode($imgDataStr);
    
    //準備好要存的filename
    $user_no = $_POST["user_no"];
    // $aml_name = $_POST["name_data"];
    // $fileName2 = date("Ymd");
    
    $file = $upload_dir . "user" . $user_no . "_aml" . ".png";
    $success = file_put_contents($file, $data);
    
    // echo $success ? $file : 'error';

    $file_src = "img/customize/" . "user" . $user_no . "_aml" . ".png";


    try {
        require_once("connectg3.php");

        $sql ="update user set my_animal_img = :my_animal_img , 
        my_animal_name = :my_animal_name , 
        environ_adapt_1 = :environ_adapt_1 , 
        environ_adapt_2 = :environ_adapt_2 , 
        environ_adapt_3 = :environ_adapt_3 , 
        animal_life = :animal_life , 
        animal_jump = :animal_jump  where user_no=:user_no";
        $userData = $pdo->prepare( $sql);
        $userData->bindValue(":my_animal_img", $file_src);
        $userData->bindValue(":my_animal_name", $_POST["myanimal_name"]);
        $userData->bindValue(":environ_adapt_1", $_POST["environ_adapt_1"]);
        $userData->bindValue(":environ_adapt_2", $_POST["environ_adapt_2"]);
        $userData->bindValue(":environ_adapt_3", $_POST["environ_adapt_3"]);
        $userData->bindValue(":animal_life", $_POST["animal_life"]);
        $userData->bindValue(":animal_jump", $_POST["animal_jump"]);
        $userData->bindValue(":user_no", $_POST["user_no"]);
        $userData->execute();
        echo "動物存檔成功";

    } catch (PDOException $e) {
        $errMsg = $errMsg . "錯誤訊息: " . $e->getMessage() . "</br>";
        $errMsg .= "錯誤行號: " . $e->getLine() . "<br>";
    }


?>
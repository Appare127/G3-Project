<?php


//設定要上傳的php伺服器的資料夾路徑，如果路徑上沒有此資料，則新建一個
    $upload_dir = "../../img/customize//";  
    if( ! file_exists($upload_dir )){
        mkdir($upload_dir);
    }

// 以下為儲存動物的部分，用一般input text的單筆資料送的：
//收到convas.toDataURL()送來的資料，把base64資料的前面說明文字去掉再碼回圖片檔案
    $imgDataStr = $_POST['url_data'];
    $imgDataStr = str_replace('data:image/png;base64,', '', $imgDataStr); //將檔案格式的資訊拿掉
    // $imgDataStr = str_replace(' ', '+', $imgDataStr);
    $data = base64_decode($imgDataStr);
    
//準備好要存的檔名，抓到user_no
    $user_no = $_POST["user_no"];
    // $aml_name = $_POST["name_data"];
    // $fileName2 = date("Ymd");

//存檔路徑與檔名
    $file = $upload_dir . "user" . $user_no . "_aml" . ".png";

// 儲存檔案
    $success = file_put_contents($file, $data);
    
    // echo $success ? $file : 'error';



// 以下為儲存背景的部分，用input file的型式送的：
// 用switch檢查送過來的檔案
    switch($_FILES['up_bg_file']['error']){
        case UPLOAD_ERR_OK:
                $upload_dir = "../../img/customize//";

                $from = $_FILES['up_bg_file']['tmp_name'];
                $to = $upload_dir . "user" . $user_no . "_aml" ."_bg" . ".png";;
                copy($from, $to);
                // echo "上傳成功<br>";
                break;	
        case UPLOAD_ERR_INI_SIZE:
                echo "上傳檔案太大,不得超過", ini_get("upload_max_filesize"),"<br>";
                break;
        case UPLOAD_ERR_FORM_SIZE:
                // echo "上傳檔案太大, 不得超過{$_POST["MAX_FILE_SIZE"]}位元組<br>";
                break;
        case UPLOAD_ERR_PARTIAL:
                echo "上傳檔案不完整<br>";
                break;
        case UPLOAD_ERR_NO_FILE:
                // echo "没選送檔案<br>";
                break;
        default:
                echo "請聯絡網站維護人員<br>";
                echo "error code : ", $_FILES['up_bg_file']['error'],"<br>";
    }


// 要放資料庫的動物圖片路徑
    $file_src = "img/customize/" . "user" . $user_no . "_aml" . ".png";
// 要放資料庫的背景圖片路徑
    $file_bg_src = "img/customize/" . "user" . $user_no . "_aml" . "_bg" . ".png";




    try {
        require_once("connectg3.php");

        $sql ="update user set my_animal_img = :my_animal_img,
        my_animal_name = :my_animal_name,
        my_animal_bg_img = :my_animal_bg_img,
        environ_adapt_1 = :environ_adapt_1,
        environ_adapt_2 = :environ_adapt_2,
        environ_adapt_3 = :environ_adapt_3,
        animal_life = :animal_life,
        animal_jump = :animal_jump  where user_no=:user_no";
        $userData = $pdo->prepare( $sql);
        $userData->bindValue(":my_animal_img", $file_src);
        $userData->bindValue(":my_animal_name", $_POST["myanimal_name"]);
        $userData->bindValue(":my_animal_bg_img", $file_bg_src);
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
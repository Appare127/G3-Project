<?php
$errMsg = "";
$user_no=$_GET["user_no"];
try {
    $dsn = "mysql:host=localhost;port=3306;dbname=dd102g3;charset=utf8";
    $user = "root";
    $password = "123456";
    $options = array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION, PDO::ATTR_CASE=>PDO::CASE_NATURAL);
    $pdo = new PDO($dsn, $user, $password, $options);
    session_start();
//取出動物排行
    $sql_user_ctn = 
    "select u.user_no,u.my_animal_name,u.my_animal_img, u.my_animal_bg_img
    from user u
    where  u.user_no = {$user_no}  ";
    $user_ctn = $pdo->prepare($sql_user_ctn);
    $user_ctn ->execute();
    $sql_work_no = 
    "select work_no
    from collections
    ORDER BY work_no DESC ";
    $work_no = $pdo->prepare($sql_work_no);
    $work_no ->execute();

}
catch (PDOException $e) {
    $errMsg = $errMsg . "錯誤訊息: " . $e->getMessage() . "<br>";
    $errMsg .= "錯誤行號: " . $e->getLine() . "<br>";
}
$item_user_ctnRow=0;
while( $user_ctnRow[$item_user_ctnRow]= $user_ctn -> fetch(PDO::FETCH_ASSOC)){
   $item_user_ctnRow++;
}
for ($i=0; $i < 1; $i++) { 
    $work_no_box=  $work_no -> fetch(PDO::FETCH_ASSOC);
    $work_no_box['work_no'] =$work_no_box['work_no']+1;
}
$time=date("Y-m-d");
$sql_INSERT =
"INSERT INTO `collections` (`work_no`, `vote`,`cmp_img`,`work_name`,`work_date`,`bg_img`,`user_no`) VALUES
(null, 0, 'img/collections/work_{$work_no_box['work_no']}.png', '{$user_ctnRow[0]['my_animal_name']}', '{$time}', 'img/collections/work_bg_{$work_no_box['work_no']}.png', '{$user_ctnRow[0]['user_no']}');";
$data_INSERT = $pdo->prepare($sql_INSERT);
$data_INSERT ->execute();

// $sql_INSERT =
// "INSERT INTO `collections` (`work_no`, `vote`,`cmp_img`,`work_name`,`work_date`,`bg_img`,`amlbg_img`,`user_no`) VALUES
// (null, 0, 'img/collections/work_{$work_no_box['work_no']}.png', '{$user_ctnRow[0]['my_animal_name']}', '{$time}', 'img/collections/work_bg_{$work_no_box['work_no']}.png', 'img/collections/work_amlbg_{$work_no_box['work_no']}.png', '{$user_ctnRow[0]['user_no']}');";
// $data_INSERT = $pdo->prepare($sql_INSERT);
// $data_INSERT ->execute();
 copy("../../img/comtumize/user{$user_no}_aml.png", "../../img/collections/work_{$work_no_box['work_no']}.png");	
 copy("../../img/comtumize/user{$user_no}_aml_bg.png", "../../img/collections/work_bg_{$work_no_box['work_no']}.png");
 copy("../../img/comtumize/user{$user_no}_amlbg.png", "../../img/collections/work_amlbg_{$work_no_box['work_no']}.png");	

//sql timestamp not null
echo json_encode( $work_no_box['work_no']);

?>
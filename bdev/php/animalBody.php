<?php
  // $_REQUEST['admin_no']=1;
  $errMsg = "";
  try{
    require_once("connectg3.php");

    $sql = "select * from body";
    $bodys  = $pdo->query($sql);
    $bodyRows = $bodys -> fetchAll(PDO::FETCH_ASSOC);

  }catch(PDOException $e){
    $errMsg .= "錯誤原因 : ".$e -> getMessage(). "<br>";
    $errMsg .= "錯誤行號 : ".$e -> getLine(). "<br>";
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  <title>CoreUI Free Bootstrap Animal Head Template</title>
  <style>
    input[name="body_img"] {
      width: 200px;
    }
    input[name="body_img_combination"] {
      width: 180px;
    }
    .body_btnimg{
      padding-top:23px;
    }
    .tr_title{
      border: 2px solid #ccc;
    }
  </style>
  
  <!-- Icons-->
  @@include('../html/layout/inputcss.html')
</head>

<body class="app header-fixed sidebar-fixed aside-menu-fixed sidebar-lg-show">
  <!-- top_header -->
  @@include('../html/layout/top_header.html')
  <div class="app-body">
    <div class="sidebar">
      <!-- sidebar menu-->
      @@include('../html/layout/sidebar_nav.html')
      <button class="sidebar-minimizer brand-minimizer" type="button"></button>
    </div>
    <main class="main">
      <!-- Breadcrumb-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">動物部件管理</li>
        <li class="breadcrumb-item active">動物身體</li>

      </ol>
      <div class="container-fluid">
        <!-- 中間內容 -->
        <!-- style="overflow-x: scroll -->
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">動物身體</div>

              <div class="card-body">
                <table class="table table-responsive-sm table-bordered">
                  <thead>
                    <tr>
                      <th>身體編號</th>
                      <th>身體名稱</th>
                      <th>選單圖</th>
                      <th>組合圖</th>
                      <th>生命力</th>
                      <th>環境1適應力</th>
                      <th>環境2適應力</th>
                      <th>環境3適應力</th>
                      <th>狀態(0:下架; 1:上架)</th>
                      <th>身體中文名稱</th>
                      <th colspan="2"></th>
                    </tr>
                  </thead>
                  <tbody>
                    <!-- 新增 -->
                    <form action="addAnimalBodyData.php" method="get">
                        <!-- 標題列 -->
                        <tr class="tr_title">
                            <td></td>
                            <td>
                                <input type="text" name="body_name" id="">
                            </td>
                            <td>
                                <img width="45%" src="" id="body_img_preview">
                                <input type="file" id="select_body_img" name="body_img" accept="image/*">
                            </td>
                            <td>
                                <img img width='50%' src="" id="body_img_combination_preview">
                                <input type="file" id="select_body_img_combination" name="body_img_combination" accept="image/*"><br>
                            </td>
                            <td>
                                <input type="text" name="body_health" id="" size="4">
                            </td>
                            <td>
                                <input type="text" name="body_environment1" id="" size="10">
                            </td>
                            <td>
                                <input type="text" name="body_environment2" id="" size="10">
                            </td>
                            <td>
                                <input type="text" name="body_environment3" id="" size="10">
                            </td>
                            <td>
                                <input type="text" name="body_status" id="" size="10">
                            </td>
                            <td>
                                <input type="text" name="body_ch_name" id="">
                            </td>
                            <td colspan="3">
                                <input class="btn btn-block btn-outline-primary addbtn" type="submit" value="新增">
                            </td>
                        </tr>
                    </form>
                    <?php
                    if( $errMsg != ""){ //例外
                            echo "<div><center>$errMsg</center></div>";
                        }elseif($bodys->rowCount()==0){
                            echo "<div><center>無動物身體資料</center></div>";
                        }else{
                    ?>

                    <?php
                    
                    foreach( $bodyRows as $i => $bodyRow){
                        // echo "<pre>";
                        // print_r($haedRow);
                        // echo "</pre>";
                    ?>
                        <!-- 內容列 -->
                        <form action="updateAnimalBodyData.php">
                          <tr>
                            <td><?php echo $bodyRow['body_no'];?><input name="body_no" type="hidden" value="<?= $bodyRow['body_no']?>"></td>
                            <td><input type="text" name="body_name" value="<?= $bodyRow['body_name']?>" readonly="true"></td>
                            <td><img width="45%" src="../<?= $bodyRow['body_img']?>" alt="" class="image"><input type="file" class="body_btnimg" name="body_img" size="10" style="display:none"></td>
                            <td><img width='50%' src="../<?= $bodyRow['body_img_combination']?>" alt=""><input type="file" class="combination_btnimg"name="body_img_combination" size="10" style="display:none"></td>
                            <td><input type="text" name="body_health" value="<?= $bodyRow['body_health']?>" readonly="true" size="4"></td>
                            <td><input type="text" name="body_environment1" value="<?= $bodyRow['body_environment1']?>" readonly="true" size="10"></td>
                            <td><input type="text" name="body_environment2" value="<?= $bodyRow['body_environment2']?>" readonly="true" size="10"></td>
                            <td><input type="text" name="body_environment3" value="<?= $bodyRow['body_environment3']?>" readonly="true" size="10"></td>
                            <td><input type="text" name="body_status" value="<?= $bodyRow['body_status']?>" readonly="true" size="10"></td>
                            <td><input type="text" name="body_ch_name" value="<?= $bodyRow['body_ch_name']?>" readonly="true" size="10"></td>
                            
                            <td>
                                <input class="btn btn-block btn-outline-primary btn1" type="button" value="編輯">
                            </td>
                            <td>
                                <input class="btn btn-block btn-outline-primary" type="submit"  value="修改完成">
                            </td>
                          </form>
                        </tr>
                    
                    <?php
                     }
                    }
                    ?>
                  </tbody>
                </table>

                <!-- 切換頁數 -->
                <ul class="pagination">
                  <li class="page-item">
                    <a class="page-link" href="#">Prev</a>
                  </li>
                  <li class="page-item active">
                    <a class="page-link" href="#">1</a>
                  </li>
                  <li class="page-item">
                    <a class="page-link" href="#">2</a>
                  </li>
                  <li class="page-item">
                    <a class="page-link" href="#">3</a>
                  </li>
                  <li class="page-item">
                    <a class="page-link" href="#">4</a>
                  </li>
                  <li class="page-item">
                    <a class="page-link" href="#">Next</a>
                  </li>
                </ul>

              </div>
            </div>
          </div>
        </div>
        <!-- @@include('layout/content.html') -->
        <!-- end -->
      </div>
    </main>

  </div>
  @@include('../html/layout/footer.html')
  <!-- CoreUI and necessary plugins-->
  @@include('../html/layout/inputjs.html')

  <script>

    function $id(id) {
			return document.getElementById(id);
    }

    // 控制哪些欄位可修改start  
    function reversechange(e){
        console.log(e.target.parentNode.parentNode.children[1]);   
        console.log(e.target.parentNode.parentNode.children[2].lastChild);   
        e.target.parentNode.parentNode.children[1].firstChild.removeAttribute("readonly");   
        e.target.parentNode.parentNode.children[2].firstChild.removeAttribute("readonly");   
        e.target.parentNode.parentNode.children[2].lastChild.style.display='block';
        e.target.parentNode.parentNode.children[3].firstChild.removeAttribute("readonly");   
        e.target.parentNode.parentNode.children[3].lastChild.style.display='block';
        e.target.parentNode.parentNode.children[4].firstChild.removeAttribute("readonly");   
        e.target.parentNode.parentNode.children[5].firstChild.removeAttribute("readonly");   
        e.target.parentNode.parentNode.children[6].firstChild.removeAttribute("readonly");   
        e.target.parentNode.parentNode.children[7].firstChild.removeAttribute("readonly");   
    }
      
    var btn1= document.getElementsByClassName('btn1');
    function doFirst(){
      for(i=0; i<btn1.length;i++){
        btn1[i].addEventListener('click',reversechange,false);
      }
    }
    window.addEventListener('load',doFirst);
    // 控制哪些欄位可修改end


    // 控制新增選單圖片時的預覽
    window.addEventListener("load", function () {
      $id("body_img_preview").style.display="none";   
      $id("select_body_img").onchange = function (e) {
          let file = e.target.files[0];

          let reader = new FileReader(); //建立新的 FileReader 物件
          reader.onload = function (e) {

            $id("body_img_preview").style.display="block";   
            $id("body_img_preview").src = reader.result;
          }

          reader.readAsDataURL(file);
        }
    })
    
    // 控制新增組合圖片時的預覽
    window.addEventListener("load", function () {
      $id("body_img_combination_preview").style.display="none";   
      $id("select_body_img_combination").onchange = function (e) {
          let file = e.target.files[0];

          let reader = new FileReader(); //建立新的 FileReader 物件
          reader.onload = function (e) {

            // 執行onchange事件後才會顯示
            $id("body_img_combination_preview").style.display="block";

            $id("body_img_combination_preview").src = reader.result;
          }

          reader.readAsDataURL(file);
        }
    })

    // 控制修改選單圖片時的預覽
    var btnimg=document.getElementsByClassName('btnimg');

    function changeImg(e){
      let file = e.target.files[0];
      //  console.log(e.target.previousSibling); //找點到那一個的上一個節點 就是img  

      let showImg = e.target.previousSibling; //<img.......>

      let reader = new FileReader(); //建立新的 FileReader 物件
      reader.onload = function() {

        // console.log(e.target);   
        showImg.src = reader.result;
      }

      reader.readAsDataURL(file);
    }
   
    window.addEventListener('load',function(){
        for(i=0; i<btnimg.length;i++){
        btnimg[i].addEventListener('change',changeImg,false);
      }
    });

    // 控制修改組合圖片時的預覽
    var combination_btnimg = document.getElementsByClassName('combination_btnimg');

    function changeCombinationImg(e){
      let file = e.target.files[0];
      //  console.log(e.target.previousSibling); //找點到那一個的上一個節點 就是img  

      let showImg = e.target.previousSibling; //<img.......>

      let reader = new FileReader(); //建立新的 FileReader 物件
      reader.onload = function() {

        // console.log(e.target);   
        showImg.src = reader.result;
      }

      reader.readAsDataURL(file);
    }
   
    window.addEventListener('load',function(){
        for(i=0; i<combination_btnimg.length;i++){
        combination_btnimg[i].addEventListener('change',changeCombinationImg,false);
      }
    });


    
  </script>
</body>

</html>
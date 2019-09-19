<?php
  // $_REQUEST['admin_no']=1;
  $errMsg = "";
  try{
    require_once("connectg3.php");

    $sql = "select * from leg";
    $legs  = $pdo->query($sql);
    $legRows = $legs -> fetchAll(PDO::FETCH_ASSOC);

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
        <li class="breadcrumb-item active">動物腿部</li>

      </ol>
      <div class="container-fluid">
        <!-- 中間內容 -->
        <!-- style="overflow-x: scroll -->
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">動物腿部</div>

              <div class="card-body">
                <table class="table table-responsive-sm table-bordered">
                  <thead>
                    <tr>
                      <th>腿部編號</th>
                      <th>腿部名稱</th>
                      <th>選單圖</th>
                      <th>組合圖</th>
                      <th>跳躍力</th>
                      <th>環境1適應力</th>
                      <th>環境2適應力</th>
                      <th>環境3適應力</th>
                      <th>狀態(0:下架; 1:上架)</th>
                      <th>腿部中文名稱</th>
                      <th colspan="2"></th>
                    </tr>
                  </thead>
                  <tbody>
                    <!-- 新增 -->
                    <form action="addAnimalLegData.php" method="post" enctype="multipart/form-data">
                        <!-- 標題列 -->
                        <tr class="tr_title">
                            <td></td>
                            <td>
                                <input type="text" name="leg_name" id="">
                            </td>
                            <td>
                                <img width="45%" src="" id="leg_img_preview">
                                <input type="file" id="select_leg_img" name="leg_img" accept="image/*">
                            </td>
                            <td>
                                <img img width='50%' src="" id="leg_img_combination_preview">
                                <input type="file" name="leg_img_combination" id="select_leg_img_combination" size="4" accept="image/*">
                            </td>
                            <td>
                                <input type="text" name="leg_jump" id="" size="6">
                            </td>
                            <td>
                                <input type="text" name="leg_environment1" id="" size="6">
                            </td>
                            <td>
                                <input type="text" name="leg_environment2" id="" size="6">
                            </td>
                            <td>
                                <input type="text" name="leg_environment3" id="" size="6">
                            </td>
                            <td>
                                <input type="text" name="leg_status" id="" size="4">
                            </td>
                            <td>
                                <input type="text" name="leg_ch_name" id="" >
                            </td>
                            <td colspan="2">
                                <input class="btn btn-block btn-outline-primary addbtn" type="submit" value="新增">
                            </td>
                        </tr>
                    </form>
                    <?php
                    if( $errMsg != ""){ //例外
                            echo "<div><center>$errMsg</center></div>";
                        }elseif($legs->rowCount()==0){
                            echo "<div><center>無動物腿部資料</center></div>";
                        }else{
                    ?>

                    <?php
                    
                    foreach( $legRows as $i => $legRow){
                        // echo "<pre>";
                        // print_r($haedRow);
                        // echo "</pre>";
                    ?>
                        <!-- 內容列 -->
                        <form action="updateAnimalLegData.php" method="post" enctype="multipart/form-data">
                          <tr>
                            <td><?php echo $legRow['leg_no'];?><input name="leg_no" type="hidden" value="<?= $legRow['leg_no']?>"></td>
                            <td><input type="text" name="leg_name" value="<?= $legRow['leg_name']?>" readonly="true"></td>
                            <td><img width="45%" src="../<?= $legRow['leg_img']?>" alt="" class="image"><input type="file" class="leg_btnimg" name="leg_img" size="10" style="display:none" readonly="true"></td>
                            <td><img width='50%' src="../<?= $legRow['leg_img_combination']?>" alt=""><input type="file" class="combination_btnimg"name="leg_img_combination" size="10" style="display:none" readonly="true"></td>
                            <td><input type="text" name="leg_jump" value="<?= $legRow['leg_jump']?>" readonly="true" size="4"></td>
                            <td><input type="text" name="leg_environment1" value="<?= $legRow['leg_environment1']?>" readonly="true" size="6"></td>
                            <td><input type="text" name="leg_environment2" value="<?= $legRow['leg_environment2']?>" readonly="true" size="6"></td>
                            <td><input type="text" name="leg_environment3" value="<?= $legRow['leg_environment3']?>" readonly="true" size="6"></td>
                            <td><input type="text" name="leg_status" value="<?= $legRow['leg_status']?>" readonly="true" size="4"></td>
                            <td><input type="text" name="leg_ch_name" value="<?= $legRow['leg_ch_name']?>" readonly="true"></td>
                            
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
    e.target.parentNode.parentNode.children[1].firstChild.removeAttribute("readonly");   
    e.target.parentNode.parentNode.children[2].firstChild.removeAttribute("readonly");
    e.target.parentNode.parentNode.children[2].lastChild.style.display='block';   
    e.target.parentNode.parentNode.children[3].firstChild.removeAttribute("readonly");
    e.target.parentNode.parentNode.children[3].lastChild.style.display='block';
    e.target.parentNode.parentNode.children[4].firstChild.removeAttribute("readonly");   
    e.target.parentNode.parentNode.children[5].firstChild.removeAttribute("readonly");   
    e.target.parentNode.parentNode.children[6].firstChild.removeAttribute("readonly");   
    e.target.parentNode.parentNode.children[7].firstChild.removeAttribute("readonly");   
    e.target.parentNode.parentNode.children[8].firstChild.removeAttribute("readonly");   
    e.target.parentNode.parentNode.children[9].firstChild.removeAttribute("readonly");   
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
      $id("leg_img_preview").style.display="none";   
      $id("select_leg_img").onchange = function (e) {
          let file = e.target.files[0];

          let reader = new FileReader(); //建立新的 FileReader 物件
          reader.onload = function (e) {

            $id("leg_img_preview").style.display="block";   
            $id("leg_img_preview").src = reader.result;
          }

          reader.readAsDataURL(file);
        }
    })
    
    // 控制新增組合圖片時的預覽
    window.addEventListener("load", function () {
      $id("leg_img_combination_preview").style.display="none";   
      $id("select_leg_img_combination").onchange = function (e) {
          let file = e.target.files[0];

          let reader = new FileReader(); //建立新的 FileReader 物件
          reader.onload = function (e) {

            // 執行onchange事件後才會顯示
            $id("leg_img_combination_preview").style.display="block";

            $id("leg_img_combination_preview").src = reader.result;
          }

          reader.readAsDataURL(file);
        }
    })

    // 控制修改選單圖片時的預覽
    var btnimg=document.getElementsByClassName('leg_btnimg');

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
<?php
  // $_REQUEST['admin_no']=1;
  $errMsg = "";
  try{
    require_once("connectg3.php");

    $sql = "select * from head";
    $heads  = $pdo->query($sql);
    $headRows = $heads -> fetchAll(PDO::FETCH_ASSOC);

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
    #imgPreview {
			width: 100px;
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
        <li class="breadcrumb-item active">動物頭部</li>

      </ol>
      <div class="container-fluid">
        <!-- 中間內容 -->
        <!-- style="overflow-x: scroll -->
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">動物頭部</div>

              <div class="card-body">
                <table class="table table-responsive-sm table-bordered">
                  <thead>
                    <tr>
                      <th>頭部編號</th>
                      <th>頭部名稱</th>
                      <th>圖片</th>
                      <th>環境1適應力</th>
                      <th>環境2適應力</th>
                      <th>環境3適應力</th>
                      <th>狀態(0:下架; 1:上架)</th>
                      <th>頭部中文名稱</th>
                      <th colspan="3"></th>
                    </tr>
                  </thead>
                  <tbody>
                    <!-- 新增 -->
                    <form action="addAnimalHeadData.php" method="post" enctype="multipart/form-data">
                        <!-- 標題列 -->
                        <tr>
                            <td></td>
                            <td>
                                <input type="text" name="head_name" id="">
                            </td>
                            <td>
                                <input type="file" name="head_img" accept="image/*"><br>
                                <!-- <img src="" id="imgPreview"> -->
                            </td>
                            <td>
                                <input type="text" name="head_environment1" id="">
                            </td>
                            <td>
                                <input type="text" name="head_environment2" id="">
                            </td>
                            <td>
                                <input type="text" name="head_environment3" id="">
                            </td>
                            <td>
                                <input type="text" name="head_status" id="">
                            </td>
                            <td>
                                <input type="text" name="head_ch_name" id="">
                            </td>
                            <td colspan="3">
                                <input class="btn btn-block btn-outline-primary addbtn" type="submit" value="新增">
                            </td>
                        </tr>
                    </form>
                    <?php
                    if( $errMsg != ""){ //例外
                            echo "<div><center>$errMsg</center></div>";
                        }elseif($heads->rowCount()==0){
                            echo "<div><center>無動物頭部資料</center></div>";
                        }else{
                    ?>

                    <?php
                    
                    foreach( $headRows as $i => $headRow){
                        // echo "<pre>";
                        // print_r($haedRow);
                        // echo "</pre>";
                    ?>
                        <!-- 內容列 -->
                        <form action="updateAnimalHeadData.php" method="post" enctype="multipart/form-data">
                          <tr>
                            <td><?php echo $headRow['head_no'];?><input name="head_no" type="hidden" value="<?= $headRow['head_no']?>"></td>
                            <td><input type="text" name="head_name" value="<?= $headRow['head_name']?>" readonly="true"></td>
                            <td><img width='75' src="../<?= $headRow['head_img']?>" alt=""><input type="file" id="aa" name="head_img" style="display:none"></td>
                            <!-- <td><input type="text" name="head_img" value="<?= $headRow['head_img']?>" readonly="true"></td> -->
                            <td><input type="text" name="head_environment1" value="<?= $headRow['head_environment1']?>" readonly="true"></td>
                            <td><input type="text" name="head_environment2" value="<?= $headRow['head_environment2']?>" readonly="true"></td>
                            <td><input type="text" name="head_environment3" value="<?= $headRow['head_environment3']?>" readonly="true"></td>
                            <td><input type="text" name="head_status" value="<?= $headRow['head_status']?>" readonly="true"></td>
                            <td><input type="text" name="head_ch_name" value="<?= $headRow['head_ch_name']?>" readonly="true"></td>
                            
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

  
  <!-- 控制哪些欄位可修改 -->
  <script>
    function reversechange(e){
    console.log(e.target.parentNode.parentNode.children[1]);   
    console.log(e.target.parentNode.parentNode.children[2].lastChild);   
    e.target.parentNode.parentNode.children[1].firstChild.removeAttribute("readonly");   
    e.target.parentNode.parentNode.children[2].firstChild.removeAttribute("readonly");   
    e.target.parentNode.parentNode.children[2].lastChild.style.display='block';
    e.target.parentNode.parentNode.children[3].firstChild.removeAttribute("readonly");   
    e.target.parentNode.parentNode.children[4].firstChild.removeAttribute("readonly");   
    e.target.parentNode.parentNode.children[5].firstChild.removeAttribute("readonly");   
    e.target.parentNode.parentNode.children[6].firstChild.removeAttribute("readonly");   
    }
      
    var btn1= document.getElementsByClassName('btn1');
    function doFirst(){

      for(i=0; i<btn1.length;i++){
        btn1[i].addEventListener('click',reversechange,false);
      }
    }
    window.addEventListener('load',doFirst);
    
  </script>

  
</body>

</html>
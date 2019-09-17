<?php
  // $_REQUEST['admin_no']=1;
  $errMsg = "";
  try{
    require_once("connectg3.php");

    $sql = "select * from area";
    $areas  = $pdo->query($sql);
    $areaRows = $areas -> fetchAll(PDO::FETCH_ASSOC);

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
  <title>CoreUI Free Bootstrap Admin Template</title>
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
        <li class="breadcrumb-item">遊戲管理</li>
        <li class="breadcrumb-item">地區管理</li>

      </ol>
      <div class="container-fluid">
        <!-- 中間內容 -->
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">地區管理</div>
      
              <div class="card-body">
                <table class="table table-responsive-sm table-bordered">
                  <thead>
                    <tr>
                      <th>地區編號</th>
                      <th>地區名稱</th>
                      <th>圖片</th>
                      <th></th>
                      <th></th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                  <form action="addAreaData.php">
                    <tr> 
                      <td>
      
                      </td>
                      <td>
                        <input type="text" name="area_name" id="">
                      </td>
                      <td>
                        <input type="file" name="area_img" id="">
                      </td>
                      <td colspan="3">
                        <input class="btn btn-block btn-outline-primary addbtn" type="submit" value="新增">
                      </td>
                    </tr>
                  </form>
<?php
if( $errMsg != ""){ //例外
        echo "<div><center>$errMsg</center></div>";
    }elseif($areas->rowCount()==0){
        echo "<div><center>無地區資料</center></div>";
    }else{
?>
<?php

  
    foreach( $areaRows as $i => $areaRow){
    
?>
                  <form action="updateAreaData.php">
                    <tr>
                      <td><?php echo $areaRow['area_no'];?><input name="area_no" type="hidden" value="<?= $areaRow['area_no']?>"></td>
                      <td><input type="text" name="area_name" value="<?= $areaRow['area_name']?>" readonly="true"></td>
                      <td><input type="text" name="area_img" value="<?= $areaRow['area_img']?>" readonly="true"></td>
                      <td>
                        <input class="btn btn-block btn-outline-primary btn1" type="button" value="編輯">
                      </td>
                      <td>
                        <input class="btn btn-block btn-outline-primary" type="submit"  value="修改完成">
                      </td>
                      </form>
                      <td>
                        <form action="deleteAreaData.php">
                            <input name="area_no" type="hidden" value="<?= $areaRow['area_no']?>">
                            <input class="btn btn-block btn-outline-primary" type="submit" value="刪除">
                        </form>

                        <!-- </div> -->
                      </td>
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
      
        <!-- end -->
      </div>
    </main>

  </div>
  @@include('../html/layout/footer.html')
  <!-- CoreUI and necessary plugins-->
  @@include('../html/layout/inputjs.html')
  
  <script>
      function reversechange(e){
        console.log(e.target.parentNode.parentNode.children[1]);   
        e.target.parentNode.parentNode.children[1].firstChild.removeAttribute("readonly");   
        e.target.parentNode.parentNode.children[2].firstChild.removeAttribute("readonly");
      }
      
    
    var btn1= document.getElementsByClassName('btn1');
    function doFirst(){

      for(i=0; i<btn1.length;i++){
        btn1[i].addEventListener('click',reversechange,false);
      }
    }
    window.addEventListener('load',doFirst);
    
  </script>
 
  
  <script>
  </script>

</body>

</html>
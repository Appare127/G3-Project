<?php
  // $_REQUEST['admin_no']=1;
  $errMsg = "";
  try{
    require_once("connectg3.php");

    $sql = "select * from report";
    $reports  = $pdo->query($sql);
    $reportRows = $reports -> fetchAll(PDO::FETCH_ASSOC);

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
        <li class="breadcrumb-item">選怪排行管理</li>
        <li class="breadcrumb-item">留言檢舉管理</li>

      </ol>
      <div class="container-fluid">
        <!-- 中間內容 -->
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">留言檢舉管理</div>
      
              <div class="card-body">
                <table class="table table-responsive-sm table-bordered">
                  <thead>
                    <tr>
                      <th>留言檢舉編號</th>
                      <th>檢舉人會員編號</th>
                      <th>留言編號</th>
                      <th>檢舉原因</th>
                      <th>檢舉日期</th>
                      <th>狀態(0:隱藏;1:公開)</th>
                      <th colspan="2"></th>
                    </tr>
                  </thead>
                  <tbody>
                  
<?php
if( $errMsg != ""){ //例外
        echo "<div><center>$errMsg</center></div>";
    }elseif($reports->rowCount()==0){
        echo "<div><center>無留言檢舉資料</center></div>";
    }else{
?>
<?php

  
    foreach( $reportRows as $i => $reportRow){
    
?>
                  <form action="updateReportData.php">
                    <tr>
                      <td><?php echo $reportRow['report_no'];?><input name="report_no" type="hidden" value="<?= $reportRow['report_no']?>"></td>
                      <td><input type="text" name="user_no" value="<?= $reportRow['user_no']?>" readonly="true"></td>
                      <td><input type="text" name="msg_no" value="<?= $reportRow['msg_no']?>" readonly="true"></td>
                      <td><input type="text" name="report_reason" value="<?= $reportRow['report_reason']?>" readonly="true"></td>
                      <td><input type="text" name="report_date" value="<?= $reportRow['report_date']?>" readonly="true"></td>
                      <td><input type="text" name="report_status" value="<?= $reportRow['report_status']?>" readonly="true"></td>
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
        e.target.parentNode.parentNode.children[5].firstChild.removeAttribute("readonly");   
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
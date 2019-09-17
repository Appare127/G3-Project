<?php
  // $_REQUEST['admin_no']=1;
  $errMsg = "";
  try{
    require_once("connectg3.php");

    $sql = "select * from product";
    $products  = $pdo->query($sql);
    $productRows = $products -> fetchAll(PDO::FETCH_ASSOC);

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
        <li class="breadcrumb-item">商品管理</li>

      </ol>
      <div class="container-fluid">
        <!-- 中間內容 -->
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">商品管理</div>
      
              <div class="card-body">
                <table class="table table-responsive-sm table-bordered">
                  <thead>
                    <tr>
                      <th>商品編號</th>
                      <th>商品名稱</th>
                      <th>商品圖片</th>
                      <th>商品價格</th>
                      <th>狀態(0:下架;1:上架)</th>
                      <th>商品說明</th>
                      <th colspan="2"></th>
                      
                    </tr>
                  </thead>
                  <tbody>
                  <form action="addProductData.php">
                    <tr> 
                      <td>
      
                      </td>
                      <td>
                        <input type="text" name="product_name" id="">
                      </td>
                      <td>
                        <input type="file" name="product_img" id="">
                      </td>
                      <td>
                        <input type="text" name="product_price" id="">
                      </td>
                      <td>
                        <input type="text" name="product_status" id="">
                      </td>
                      <td>
                        <input type="text" name="product_description" id="">
                      </td>
                      <td colspan="2">
                        <input class="btn btn-block btn-outline-primary addbtn" type="submit" value="新增">
                      </td>
                    </tr>
                  </form>
                  
<?php
if( $errMsg != ""){ //例外
        echo "<div><center>$errMsg</center></div>";
    }elseif($products->rowCount()==0){
        echo "<div><center>無留言紀錄資料</center></div>";
    }else{
?>
<?php

  
    foreach( $productRows as $i => $productRow){
    
?>
                  <form action="updateProductData.php">
                    <tr>
                      <td><?php echo $productRow['product_no'];?><input name="product_no" type="hidden" value="<?= $productRow['product_no']?>"></td>
                      <td><input type="text" name="product_name" value="<?= $productRow['product_name']?>" readonly="true"></td>
                      <td><input type="text" name="product_img" value="<?= $productRow['product_img']?>" readonly="true"></td>
                      <td><input type="text" name="product_price" value="<?= $productRow['product_price']?>" readonly="true"></td>
                      <td><input type="text" name="product_status" value="<?= $productRow['product_status']?>" readonly="true"></td>
                      <td><input type="text" name="product_description" value="<?= $productRow['product_description']?>" readonly="true"></td>
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
        e.target.parentNode.parentNode.children[1].firstChild.removeAttribute("readonly");   
        e.target.parentNode.parentNode.children[2].firstChild.removeAttribute("readonly");   
        e.target.parentNode.parentNode.children[3].firstChild.removeAttribute("readonly");   
        e.target.parentNode.parentNode.children[4].firstChild.removeAttribute("readonly");   
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
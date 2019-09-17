<?php
  $errMsg = "";
  try{
    require_once("connectg3.php");

    $sql = "select * from game_question";
    $gameQuestions  = $pdo->query($sql);
    $gameQuestionRows = $gameQuestions -> fetchAll(PDO::FETCH_ASSOC);

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
        <li class="breadcrumb-item">題庫管理</li>

      </ol>
      <div class="container-fluid">
        <!-- 中間內容 -->
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">題庫管理</div>
      
              <div class="card-body">
                <table class="table table-responsive-sm table-bordered">
                  <thead>
                    <tr>
                      <th>題目編號</th>
                      <th>題目名稱</th>
                      <th>選項1</th>
                      <th>選項2</th>
                      <th>選項3</th>
                      <th>選項4</th>
                      <th>答案</th>
                      <th>狀態(0:下架; 1:上架)</th>
                      <th>答案說明</th>
                      <th></th>
                      <th></th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                  <form action="addGameQuestionData.php" method="get">
                      <!-- 標題列 -->
                    <tr> 
                      <td></td>
                      <td>
                        <input type="text" name="question_name" id="">
                      </td>
                      <td>
                        <input type="text" name="question_option1" id="">
                      </td>
                      <td>
                        <input type="text" name="question_option2" id="">
                      </td>
                      <td>
                        <input type="text" name="question_option3" id="">
                      </td>
                      <td>
                        <input type="text" name="question_option4" id="">
                      </td>
                      <td>
                        <input type="text" name="question_ans" id="" size="4">
                      </td>
                      <td>
                        <input type="text" name="question_status" id="" size="4">
                      </td>
                      <td>
                        <input type="text" name="ans_description" id="">
                      </td>
                      <td colspan="3">
                        <input class="btn btn-block btn-outline-primary addbtn" type="submit" value="新增">
                      </td>
                    </tr>
                  </form>
                  <?php
                    if( $errMsg != ""){ //例外
                            echo "<div><center>$errMsg</center></div>";
                        }elseif($gameQuestions->rowCount()==0){
                            echo "<div><center>無題庫資料</center></div>";
                        }else{
                  ?>
                 <?php
                
                    foreach( $gameQuestionRows as $i => $gameQuestionRow){
                    
                 ?>
                  
                  <!-- 內容列 -->
                  <form action="updateGameQuestionData.php">
                    <tr>
                      <td><?php echo $gameQuestionRow['question_no'];?><input name="question_no" type="hidden" value="<?= $gameQuestionRow['question_no']?>"></td>
                      <td><input type="text" name="question_name" value="<?= $gameQuestionRow['question_name']?>" readonly="true"></td>
                      <td><input type="text" name="question_option1" value="<?= $gameQuestionRow['question_option1']?>" readonly="true"></td>
                      <td><input type="text" name="question_option2" value="<?= $gameQuestionRow['question_option2']?>" readonly="true"></td>
                      <td><input type="text" name="question_option3" value="<?= $gameQuestionRow['question_option3']?>" readonly="true"></td>
                      <td><input type="text" name="question_option4" value="<?= $gameQuestionRow['question_option4']?>" readonly="true"></td>
                      <td><input type="text" name="question_ans" size="4" value="<?= $gameQuestionRow['question_ans']?>" readonly="true"></td>
                      <td><input type="text" name="question_status" size="4" value="<?= $gameQuestionRow['question_status']?>" readonly="true"></td>
                      <td><input type="text" name="ans_description" value="<?= $gameQuestionRow['ans_description']?>" readonly="true"></td>
                      <td>
                        <input class="btn btn-block btn-outline-primary btn1" type="button" value="編輯">
                      </td>
                      <td>
                        <input class="btn btn-block btn-outline-primary" type="submit"  value="修改完成">
                      </td>
                      </form>
                      <td>
                        <form action="deleteGameQuestionData.php">
                            <input name="question_no" type="hidden" value="<?= $gameQuestionRow['question_no']?>">
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
        e.target.parentNode.parentNode.children[3].firstChild.removeAttribute("readonly");
        e.target.parentNode.parentNode.children[4].firstChild.removeAttribute("readonly");
        e.target.parentNode.parentNode.children[5].firstChild.removeAttribute("readonly");
        e.target.parentNode.parentNode.children[6].firstChild.removeAttribute("readonly");
        e.target.parentNode.parentNode.children[7].firstChild.removeAttribute("readonly");
        e.target.parentNode.parentNode.children[8].firstChild.removeAttribute("readonly");
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
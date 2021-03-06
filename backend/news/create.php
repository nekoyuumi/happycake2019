<?php 
require_once('../is_login.php');
require('../../function/connection.php');
if (!file_exists('../../uploads/news')) {
  mkdir('../../uploads/news', 0755, true);
}

if(isset($_FILES['picture']['name'])){
  $filename = $_FILES['picture']['name'];
  $file_path = "../../uploads/news/".$_FILES['picture']['name'];
  move_uploaded_file($_FILES['picture']['tmp_name'], $file_path);
}else{
  $filename = "cake1.jpg";
}
?>
<?php if(isset($_POST['AddForm']) && $_POST['AddForm'] == "INSERT"){
  $sql= "INSERT INTO news  (published_at, picture, title, content, created_at) VALUES ( :published_at, :picture, :title, :content, :created_at)";
  $sth = $db ->prepare($sql);
  $sth ->bindParam(":published_at", $_POST['published_at'], PDO::PARAM_STR);
  $sth ->bindParam(":picture", $filename, PDO::PARAM_STR);
  $sth ->bindParam(":title", $_POST['title'], PDO::PARAM_STR);
  $sth ->bindParam(":content", $_POST['content'], PDO::PARAM_STR);
  $sth ->bindParam(":created_at", $_POST['created_at'], PDO::PARAM_STR);
  $sth ->execute();

  header('Location: list.php');
}
?>
<!DOCTYPE html>
<html>

<head>
  <?php include_once('../layouts/head.php'); ?>
  <link rel="stylesheet" href="../../js/jquery-ui/jquery-ui.min.css">
  <link rel="stylesheet" href="../../js/summernote/summernote-bs4.css">
  
</head>

<body>
<?php include_once('../layouts/nav.php'); ?>
  <div class="py-5">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1 class="mb-4">最新消息管理</h1>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"> <a href="#"><i class="fa fa-home"></i> 主控台</a> </li>
            <li class="breadcrumb-item active">最新消息管理</li>
            <li class="breadcrumb-item active">新增一筆</li>
          </ul>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 text-right">
          <form id="c_form-h" class="" method="post" action="create.php" enctype="multipart/form-data">
            <div class="form-group row"> <label for="picture" class="col-2 col-form-label">圖片</label>
              <div class="col-10">
                <input type="file" class="form-control-file" id="picture" name="picture"> </div>
            </div>
            <div class="form-group row"> <label for="published_at" class="col-2 col-form-label">發佈日期</label>
              <div class="col-10">
                <input type="text" class="form-control" id="published_at" name="published_at"> </div>
            </div>
            <div class="form-group row">
              <label for="title" class="col-2 col-form-label">標題</label>
              <div class="col-10">
                <input type="text" class="form-control" id="title" name="title"> </div>
            </div>
            <div class="form-group row">
              <label for="content" class="col-2 col-form-label">內容</label>
              <div class="col-10">
                <textarea class="form-control" id="content" name="content"></textarea> </div>
            </div>
            <a class="btn btn-info" href="list.php">回上一頁</a>
            <button type="submit" class="btn btn-success">確認</button>
            <input type="hidden" name="created_at" value="<?php echo date('Y-m-d H:i:s'); ?>">
            <input type="hidden" name="AddForm" value="INSERT">
          </form>
        </div>
      </div>
    </div>
  </div>
  <?php include_once('../layouts/footer.php'); ?>
  <script>
   $(function(){
    $( "#published_at" ).datepicker({
         dateFormat: 'yy-mm-dd'
    });
    $('#content').summernote();
   });
  </script>
</body>

</html>
<?php 
require_once('../is_login.php');
require('../../function/connection.php');
?>
<?php if(isset($_POST['AddForm']) && $_POST['AddForm'] == "INSERT"){
  $sql= "INSERT INTO members  (account, password, name, phone, email, birthday, address, created_at) VALUES ( :account, :password, :name, :phone, :email, :birthday, :address, :created_at)";
  $sth = $db ->prepare($sql);
  $sth ->bindParam(":account", $_POST['account'], PDO::PARAM_STR);
  $sth ->bindParam(":password", $_POST['password'], PDO::PARAM_STR);
  $sth ->bindParam(":name", $_POST['name'], PDO::PARAM_STR);
  $sth ->bindParam(":phone", $_POST['phone'], PDO::PARAM_STR);
  $sth ->bindParam(":email", $_POST['email'], PDO::PARAM_STR);
  $sth ->bindParam(":birthday", $_POST['birthday'], PDO::PARAM_STR);
  $sth ->bindParam(":address", $_POST['address'], PDO::PARAM_STR);
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
          <form id="c_form-h" class="" method="post" action="create.php">
            <div class="form-group row"> <label for="account" class="col-2 col-form-label">帳號</label>
              <div class="col-10">
                <input type="text" class="form-control" id="account" name="account"> </div>
            </div>
            <div class="form-group row">
              <label for="password" class="col-2 col-form-label">密碼</label>
              <div class="col-10">
                <input type="text" class="form-control" id="password" name="password"> </div>
            </div>
            <div class="form-group row">
              <label for="name" class="col-2 col-form-label">姓名</label>
              <div class="col-10">
                <input type="text" class="form-control" id="name" name="name"> </div>
            </div>
            <div class="form-group row">
              <label for="phone" class="col-2 col-form-label">phone</label>
              <div class="col-10">
                <input type="text" class="form-control" id="phone" name="phone"> </div>
            </div>
            <div class="form-group row">
              <label for="email" class="col-2 col-form-label">email</label>
              <div class="col-10">
                <input type="text" class="form-control" id="email" name="email"> </div>
            </div>
            <div class="form-group row"> <label for="birthday" class="col-2 col-form-label">生日</label>
              <div class="col-10">
                <input type="text" class="form-control" id="birthday" name="birthday"> </div>
            </div>
            <div class="form-group row">
              <label for="address" class="col-2 col-form-label">地址</label>
              <div class="col-10">
                <textarea class="form-control" id="address" name="address"></textarea> </div>
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
    $( "#birthday" ).datepicker({
         dateFormat: 'yy-mm-dd'
    });
   });
  </script>
</body>

</html>
<?php 
require_once('../is_login.php');
require_once('../../function/connection.php');
$query = $db->query("SELECT * FROM members");
$members = $query->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html>

<head>
<?php include_once('../layouts/head.php'); ?>
</head>

<body>
<?php include_once('../layouts/nav.php'); ?>
  <div class="py-5">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1 class="mb-4">會員管理</h1>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"> <a href="#"><i class="fa fa-home"></i> Home</a> </li>
            <li class="breadcrumb-item active">Link</li>
            <li class="breadcrumb-item active">Link</li>
          </ul>
        </div>
        <div class="col-md-12 utility" style="margin-bottom: 20px;">
          <a class="btn btn-info" href="create.php">新增一筆</a>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <table class="table">
            <thead>
              <tr>
                <th scope="col">帳號</th>
                <th scope="col">姓名</th>
                <th scope="col">電話</th>
                <th scope="col">E-mail</th>
                <th scope="col">生日</th>
                <th scope="col">手機</th>
                <th scope="col">地址</th>
                <th scope="col">操作</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($members as $data){ ?>
              <tr>
                <td><?php echo $data['account']; ?></td>
                <td><?php echo $data['name']; ?></td>
                <td><?php echo $data['phone']; ?></td>
                <td><?php echo $data['email']; ?></td>
                <td><?php echo $data['birthday']; ?></td>
                <td><?php echo $data['mobile']; ?></td>
                <td><?php echo $data['address']; ?></td>
                <td>
                  <a class="btn btn-info" href="update.php?memberID=<?php echo $data['memberID'] ?>">編輯</a>
                  <a class="btn btn-info" href="delete.php?memberID=<?php echo $data['memberID'] ?>" onclick="if(!confirm('是否確定刪除此筆資料?刪除後無法回復')){return false;};">刪除</a>
                </td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <?php include_once('../layouts/footer.php'); ?>
</body>

</html>
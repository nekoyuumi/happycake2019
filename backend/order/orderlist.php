<?php 
require_once('../is_login.php');
require_once('../../function/connection.php');
$query = $db->query("SELECT * FROM order_details WHERE customer_orderID=".$_GET['id']);
$order = $query->fetchAll(PDO::FETCH_ASSOC);
$query2 = $db->query("SELECT * FROM customer_orders WHERE customer_orderID=".$_GET['id']);
$orders = $query2->fetch(PDO::FETCH_ASSOC);
if($order['status'] == 0){
  $status = "新訂單";
}else if($order['status'] == 1){
  $status = "待備貨";
}else if($order['status'] == 2){
  $status = "待出貨";
}else if($order['status'] == 3){
  $status = "已出貨";
}else if($order['status'] == 4){
  $status = "訂單完成";
}else if($order['status'] == 99){
  $status = "已取消訂單";
}

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
          <h1 class="mb-4">訂單管理</h1>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"> <a href="#"><i class="fa fa-home"></i> Home</a> </li>
            <li class="breadcrumb-item active">訂單管理</li>
            <li class="breadcrumb-item active">明細管理</li>
          </ul>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <table class="table">
            <thead>
              <tr>
                <th scope="col">訂單編號</th>
                <th scope="col">訂單日期</th>
                <th scope="col">訂單狀態</th>
                <th scope="col">總金額</th>
                <th scope="col">收件姓名</th>
                <th scope="col">電話</th>
                <th scope="col">地址</th>
                <th scope="col">操作</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($orders as $order){ ?>
              <tr>
                <td><?php echo $order['order_no']; ?></td>
                <td><?php echo $order['order_date']; ?></td>
                <td><?php echo $status; ?></td>
                <td><?php echo $order['total']; ?></td>
                <td><?php echo $order['name']; ?></td>
                <td><?php echo $order['phone']; ?></td>
                <td><?php echo $order['address']; ?></td>
                <td>
                  <a class="btn btn-info" href="update.php?orderID=<?php echo $order['customer_orderID'] ?>">編輯</a>
                  
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
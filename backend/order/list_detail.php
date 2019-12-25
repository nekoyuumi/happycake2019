<?php 
require_once('../is_login.php');
require_once('../../function/connection.php');
$query = $db->query("SELECT * FROM order_details WHERE customer_orderID=".$_GET['orderID']);
$order = $query->fetchAll(PDO::FETCH_ASSOC);
$query2 = $db->query("SELECT * FROM customer_orders WHERE customer_orderID=".$_GET['orderID']);
$orders = $query2->fetch(PDO::FETCH_ASSOC);

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
          </ul>
        </div>
        <div class="col-md-12 utility" style="margin-bottom: 20px;">
          <a class="btn btn-info" href="orderlistupdate.php?id=<?php echo $_GET['orderID'] ?>">編輯訂單</a>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <table class="table">
            <tbody>
              <tr>
                <td>訂單編號</td>
                <td><?php echo $orders['order_no']; ?></td>
                <td><b>訂單日期</b></td>
                <td><?php echo $orders['order_date']; ?></td>
              </tr> 
              <tr>
                <td><b>訂單狀態</b></td>
                <td><?php if($orders['status'] == "0"){ ?>
                    <spans>新訂單</span>
                    <?php }else if($orders['status'] == "1"){ ?>
                    <span>待備貨</span>
                    <?php }else if($orders['status'] == "2"){ ?>
                    <span>待出貨</span>
                    <?php }else if($orders['status'] == "3"){ ?>
                    <span>已出貨</span>
                    <?php }else if($orders['status'] == "4"){ ?>
                    <span>完成訂單</span>
                    <?php }else if($orders['status'] == "99"){ ?>
                    <span>已取消訂單</span>
                    <?php } ?></td>
                <td><b>總金額</b></td>
                <td><?php echo $orders['total']; ?></td>
              </tr>
              <tr>
                <td>產品圖片</td>
                <td>產品名稱</td>
                <td>數量</td>
                <td>小計</td>
              </tr>
            <?php foreach($order as $od){?>
              <tr>
                <td><img width="150" src="../../uploads/products/<?php echo $od['picture']; ?>" alt="<?php echo $od['name']; ?>"></td>
                <td><?php echo $od['name']; ?></td>
                <td><?php echo $od['quantity']; ?></td>
                <td><?php echo $od['quantity']*$od['price']; ?></td>
              </tr>
            <?php } ?>
              <tr>
              <td colspan="4">收件資料</td>  
              </tr>
              <tr>
                <td>收件姓名</td>
                <td colspan="3"><?php echo $orders['name']; ?></td>
              </tr>
              <tr>
                <td>電話</td>
                <td colspan="3"><?php echo $orders['phone']; ?></td>
              </tr>
              <tr>
                <td>地址</td>
                <td colspan="3"><?php echo $orders['address']; ?></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <?php include_once('../layouts/footer.php'); ?>
</body>

</html>
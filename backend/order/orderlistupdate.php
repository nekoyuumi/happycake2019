<?php 
require_once('../is_login.php');
require_once('../../function/connection.php');
if (isset($_POST['EditForm']) && $_POST['EditForm'] == "UPDATE"){
  $sql= "UPDATE customer_orders SET name=:name, phone=:phone, status=:status, total=:total, address=:address, updated_at=:updated_at WHERE customer_orderID=".$_POST['customer_orderID'];
  $sth = $db ->prepare($sql);
  $sth ->bindParam(":name", $_POST['name'], PDO::PARAM_STR);
  $sth ->bindParam(":phone", $_POST['phone'], PDO::PARAM_STR);
  $sth ->bindParam(":status", $_POST['status'], PDO::PARAM_INT);
  $sth ->bindParam(":total", $_POST['total'], PDO::PARAM_STR);
  $sth ->bindParam(":address", $_POST['address'], PDO::PARAM_STR);
  $sth ->bindParam(":updated_at", $_POST['updated_at'], PDO::PARAM_STR);
  $sth ->execute();

  header('Location: list_detail.php?orderID='.$_POST['customer_orderID']);
}else{
  $query = $db->query("SELECT * FROM order_details WHERE customer_orderID=".$_GET['id']);
  $order = $query->fetchAll(PDO::FETCH_ASSOC);
  $query2 = $db->query("SELECT * FROM customer_orders WHERE customer_orderID=".$_GET['id']);
  $orders = $query2->fetch(PDO::FETCH_ASSOC);
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
          <h1 class="mb-4">訂單管理</h1>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"> <a href="#"><i class="fa fa-home"></i> 主控台</a> </li>
            <li class="breadcrumb-item active">訂單管理</li>
            <li class="breadcrumb-item active">編輯更新</li>
          </ul>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 text-left">
          <form id="c_form-h" class="" method="post" action="orderlistupdate.php">
            <div class="form-group row">
              <label for="order_no" class="col-2 col-form-label">訂單編號</label>
              <div class="col-10">
                <?php echo $orders['order_no']?> </div>
            </div>
            <div class="form-group row">
              <label for="order_date" class="col-2 col-form-label">訂單日期</label>
              <div class="col-10">
                <?php echo $orders['order_date']?> </div>
            </div>
            <div class="form-group row">
              <label for="status" class="col-2 col-form-label">訂單狀態</label>
              <div style="border:none;">
                <label class="radio-inline"><input type="radio" name="status" value="0" <?php if($orders['status']=="0") echo "checked";?>>新訂單</label>
                <label class="radio-inline"><input type="radio" name="status" value="1" <?php if($orders['status']=="1") echo "checked";?>>待備貨</label>
                <label class="radio-inline"><input type="radio" name="status" value="2" <?php if($orders['status']=="2") echo "checked";?>>待出貨</label>
                <label class="radio-inline"><input type="radio" name="status" value="3" <?php if($orders['status']=="3") echo "checked";?>>已出貨</label>
                <label class="radio-inline"><input type="radio" name="status" value="4" <?php if($orders['status']=="4") echo "checked";?>>訂單完成</label>
                <label class="radio-inline"><input type="radio" name="status" value="99" <?php if($orders['status']=="99") echo "checked";?>>已取消訂單</label>
                </div>
            </div>
            <div class="form-group row">
              <label for="total" class="col-2 col-form-label">總金額</label>
              <div class="col-10">
                <input type="text" class="form-control" id="total" name="total" value="<?php echo $orders['total']?>"> </div>
            </div>

            <div class="form-group row">
              <label for="name" class="col-2 col-form-label">收件姓名</label>
              <div class="col-10">
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $orders['name']?>"> </div>
            </div>
            <div class="form-group row">
              <label for="phone" class="col-2 col-form-label">電話</label>
              <div class="col-10">
                <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $orders['phone']?>"> </div>
            </div>
            <div class="form-group row">
              <label for="address" class="col-2 col-form-label">地址</label>
              <div class="col-10">
                <textarea class="form-control" id="address" name="address"><?php echo $orders['address']?></textarea> </div>
            </div>
            <a class="btn btn-info" href="list.php">回上一頁</a>
            <button type="submit" class="btn btn-success">確認</button>
            <input type="hidden" name="updated_at" value="<?php echo date('Y-m-d H:i:s'); ?>">
            <input type="hidden" name="EditForm" value="UPDATE">
            <input type="hidden" name="customer_orderID" value="<?php echo $_GET['id']?>">
          </form>
        </div>
      </div>
    </div>
  </div>
  <?php include_once('../layouts/footer.php'); ?>
</body>

</html>
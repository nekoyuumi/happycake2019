<?php 
require_once('../is_login.php');
require_once('../../function/connection.php');
if (isset($_POST['EditForm']) && $_POST['EditForm'] == "UPDATE"){
  $sql= "UPDATE customer_orders SET order_no=:order_no, name=:name, phone=:phone, status=:status, order_date=:order_date, total=:total, address=:address, updated_at=:updated_at WHERE customer_orderID=:customer_orderID";
  $sth = $db ->prepare($sql);
  $sth ->bindParam(":name", $_POST['name'], PDO::PARAM_STR);
  $sth ->bindParam(":phone", $_POST['phone'], PDO::PARAM_STR);
  $sth ->bindParam(":status", $_POST['status'], PDO::PARAM_INT);
  $sth ->bindParam(":total", $_POST['total'], PDO::PARAM_STR);
  $sth ->bindParam(":address", $_POST['address'], PDO::PARAM_STR);
  $sth ->bindParam(":updated_at", $_POST['updated_at'], PDO::PARAM_STR);
  $sth ->execute();
  $sql2= "UPDATE order_details SET order_no=:order_no, name=:name, phone=:phone, status=:status, order_date=:order_date, total=:total, address=:address, updated_at=:updated_at WHERE customer_orderID=:customer_orderID";
  $sth2 = $db ->prepare($sql2);
  $sth2 ->bindParam(":name", $_POST['name'], PDO::PARAM_STR);
  $sth2 ->bindParam(":phone", $_POST['phone'], PDO::PARAM_STR);
  $sth2 ->bindParam(":status", $_POST['status'], PDO::PARAM_INT);
  $sth2 ->bindParam(":total", $_POST['total'], PDO::PARAM_STR);
  $sth2 ->bindParam(":address", $_POST['address'], PDO::PARAM_STR);
  $sth2 ->bindParam(":updated_at", $_POST['updated_at'], PDO::PARAM_STR);
  $sth2 ->execute();

  header('Location: list.php');
}else{
  $query = $db->query("SELECT * FROM customer_orders WHERE customer_orderID=".$_GET['orderID']);
  $one_order = $query->fetch(PDO::FETCH_ASSOC);
  $query2 = $db->query("SELECT * FROM order_details WHERE customer_orderID=".$_GET['orderID']);
  $one_orders = $query2->fetch(PDO::FETCH_ASSOC);
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
          <form id="c_form-h" class="" method="post" action="update.php">
            <div class="form-group row">
              <label for="account" class="col-2 col-form-label">訂單編號</label>
              <div class="col-10">
                <?php echo $one_order['order_no']?> </div>
            </div>
            <div class="form-group row">
              <label for="name" class="col-2 col-form-label">訂單日期</label>
              <div class="col-10">
                <?php echo $one_order['order_date']?> </div>
            </div>
            <div class="form-group row">
              <label for="phone" class="col-2 col-form-label">訂單狀態</label>
              <div style="border:none;">
                <label class="radio-inline"><input type="radio" name="status" value="0" <?php if($one_order['status']=="0") echo "checked";?>>待付款</label>
                <label class="radio-inline"><input type="radio" name="status" value="1" <?php if($one_order['status']=="1") echo "checked";?>>處理中</label>
                <label class="radio-inline"><input type="radio" name="status" value="2" <?php if($one_order['status']=="2") echo "checked";?>>出貨中</label>
                <label class="radio-inline"><input type="radio" name="status" value="3" <?php if($one_order['status']=="3") echo "checked";?>>運送中</label>
                <label class="radio-inline"><input type="radio" name="status" value="4" <?php if($one_order['status']=="4") echo "checked";?>>貨物已送達</label>
                <label class="radio-inline"><input type="radio" name="status" value="99" <?php if($one_order['status']=="99") echo "checked";?>>訂單取消</label>
                </div>
            </div>
            <div class="form-group row">
            <table class="table">
              <thead>
                  <tr>
                      <th>產品圖片</th>
                      <th>產品名稱</th>
                      <th>數量</th>
                      <th>單價</th>   
                      <th colspan="2">金額</th>
                  </tr>
              </thead>
              <tbody>
              
              <?php foreach($i = 0 ; $i < count($one['customer_orderID']); $i++){ ?>
                  <tr>
                      <td>
                          <img src="../uploads/products/<?php echo $one['customer_orderID'][$i]['picture']?>" alt="<?php echo $one['customer_orderID'][$i]['name']?>">
                      </td>
                      <td><a href="#"><?php echo $one['customer_orderID'][$i]['name']?></a>
                      </td>
                      <td>
                          <input type="number" value="<?php echo $one['customer_orderID'][$i]['quantity']?>" name="quantity[]" class="form-control">
                      </td>
                      <td>$NT <?php echo $one['customer_orderID'][$i]['price']?></td>
                      <td>$NT <?php $sub_total = $one['customer_orderID'][$i]['quantity']* $one['customer_orderID'][$i]['price']; echo $sub_total; ?></td>
                      <td><a href="cart/test_delete.php?index=<?php echo $i ?>"><i class="fa fa-2x fa-trash-o"></i></a>
                      </td>
                  </tr>
              <?php
              } ?>
                  
              </tbody>
            </div>
            <div class="form-group row">
              <label for="email" class="col-2 col-form-label">總金額</label>
              <div class="col-10">
                <input type="text" class="form-control" id="email" name="email" value="<?php echo $one_order['total']?>"> </div>
            </div>
            <div class="form-group row">
              <label for="birthday" class="col-2 col-form-label">收件姓名</label>
              <div class="col-10">
                <input type="text" class="form-control" id="birthday" name="birthday" value="<?php echo $one_order['name']?>"> </div>
            </div>
            <div class="form-group row">
              <label for="mobile" class="col-2 col-form-label">電話</label>
              <div class="col-10">
                <input type="text" class="form-control" id="mobile" name="mobile" value="<?php echo $one_order['phone']?>"> </div>
            </div>
            <div class="form-group row">
              <label for="address" class="col-2 col-form-label">地址</label>
              <div class="col-10">
                <textarea class="form-control" id="address" name="address"><?php echo $one_order['address']?></textarea> </div>
            </div>
            <a class="btn btn-info" href="list.php">回上一頁</a>
            <button type="submit" class="btn btn-success">確認</button>
            <input type="hidden" name="updated_at" value="<?php echo date('Y-m-d H:i:s'); ?>">
            <input type="hidden" name="EditForm" value="UPDATE">
            <input type="hidden" name="customer_orderID" value="<?php echo $one_order['customer_orderID']?>">
          </form>
        </div>
      </div>
    </div>
  </div>
  <?php include_once('../layouts/footer.php'); ?>
</body>

</html>
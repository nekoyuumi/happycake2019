<?php 
require_once('../is_login.php');
require_once('../../function/connection.php');
$query = $db->query("SELECT * FROM customer_orders WHERE status=".$_GET['status']." ORDER BY order_date DESC");
$orders = $query->fetchAll(PDO::FETCH_ASSOC);
$total_rows = count($orders);
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
          <h1 class="mb-4">訂單管理<?php switch($_GET['status']){
                      case 0:
                        echo "-新訂單";
                        break;
                      case 1:
                        echo "-待備貨";
                        break;
                      case 2:
                        echo "-待出貨";
                        break;
                      case 3:
                        echo "-已出貨";
                        break;
                      case 3:
                        echo "-訂單完成";
                        break;
                      case 99:
                        echo "-已取消訂單";
                        break;
                  }
            ?></h1>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"> <a href="#"><i class="fa fa-home"></i> Home</a> </li>
            <li class="breadcrumb-item active">訂單管理</li>
          </ul>
        </div>
      </div>
      <div class="row">
        <div class="col-md-4 my-2">
          <select class="form-control" id="status" name="status">
            <option value="0" <?php if($_GET['status'] == 0) echo "selected"; ?>>新訂單</option>
            <option value="1" <?php if($_GET['status'] == 1) echo "selected"; ?>>待備貨</option>
            <option value="2" <?php if($_GET['status'] == 2) echo "selected"; ?>>待出貨</option>
            <option value="3" <?php if($_GET['status'] == 3) echo "selected"; ?>>已出貨</option>
            <option value="4" <?php if($_GET['status'] == 4) echo "selected"; ?>>訂單完成</option>
            <option value="99" <?php if($_GET['status'] == 99) echo "selected"; ?>>已取消訂單</option>
          </select>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <table class="table">
            <thead>
              <tr>
                <th scope="col">訂單編號</th>
                <th scope="col">訂單日期</th>
                <th scope="col">總金額</th>
                <th scope="col">訂單狀態</th>  
                <th scope="col">訂單明細</th>
              </tr>
            </thead>
            <tbody>
            <?php if($total_rows > 0){ ?>
              <?php foreach($orders as $order){ ?>
              <tr>
                <td><?php echo $order['order_no']; ?></td>
                <td><?php echo $order['order_date']; ?></td>
                <td><?php echo $order['total']; ?></td>
                <td><?php if($order['status'] == "0"){ ?>
                    <spans>新訂單</span>
                    <?php }else if($order['status'] == "1"){ ?>
                    <span>待備貨</span>
                    <?php }else if($order['status'] == "2"){ ?>
                    <span>待出貨</span>
                    <?php }else if($order['status'] == "3"){ ?>
                    <span>已出貨</span>
                    <?php }else if($order['status'] == "4"){ ?>
                    <span>訂單完成</span>
                    <?php }else if($order['status'] == "99"){ ?>
                    <span>已取消訂單</span>
                    <?php } ?></td>
                <td>
                  <a class="btn btn-info" href="list_detail.php?orderID=<?php echo $order['customer_orderID'] ?>">檢視明細</a>
                </td>
              </tr>
                <?php } ?>
              <?php }else{ ?>
              <tr><td colspan="5">目前無訂單</td></tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <ul class="pagination">
            <li class="page-item">
              <a class="page-link" href="#">
                <span>«</span>
                <span class="sr-only">Previous</span>
              </a>
            </li>
            <li class="page-item">
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
              <a class="page-link" href="#">
                <span>»</span>
                <span class="sr-only">Next</span>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <?php include_once('../layouts/footer.php'); ?>
  <script>
$(function(){
    $('select[name="status"]').change(function(){
      console.log($('select[name="status"]').val());
        window.location = 'list.php?status='+ $('select[name="status"]').val();
    });
});
</script>
</body>

</html>
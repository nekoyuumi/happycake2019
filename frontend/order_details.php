
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="robots" content="all,follow">
    <meta name="googlebot" content="index,follow,snippet,archive">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Cake House 帶給你最天然健康的幸福滋味">
    <meta name="author" content="Ondrej Svestka | ondrejsvestka.cz">
    <meta name="keywords" content="">

    <title>
        Cake House : 帶給你最天然健康的幸福滋味
    </title>

    <meta name="keywords" content="">

    <?php require_once('template/head_files.php'); ?>



</head>

<body>
<?php require_once('template/navbar.php'); ?>
<?php
$query = $db->query("SELECT * FROM customer_orders WHERE customer_orderID=".$_GET['orderID']);
$member_order = $query->fetch(PDO::FETCH_ASSOC);
$query2 = $db->query("SELECT * FROM order_details WHERE customer_orderID=".$_GET['orderID']." Order By created_at DESC");
$one_order = $query2->fetchALL(PDO::FETCH_ASSOC); ?>

    <!-- *** NAVBAR END *** -->

    <div id="all">

        <div id="content">
            <div class="container">

                <div class="col-md-12">

                    <ul class="breadcrumb">
                        <li><a href="../index.php">首頁</a>
                        </li>
                        <li><a href="customer_orders.php">我的訂單</a>
                        </li>
                        <li>訂單 # <?php echo $member_order['order_no']; ?></li>
                    </ul>

                </div>

                <div class="col-md-3">
                    <!-- *** CUSTOMER MENU ***
 _________________________________________________________ -->
                    <div class="panel panel-default sidebar-menu">

                        <div class="panel-heading">
                            <h3 class="panel-title">會員專區</h3>
                        </div>

                        <div class="panel-body">

                            <ul class="nav nav-pills nav-stacked">
                                <li>
                                    <a href="customer-account.php"><i class="fa fa-user"></i> 我的資料</a>
                                </li>
                                <li>
                                    <a href="basket.php"><i class="fa fa-shopping-cart"></i> 我的購物車</a>
                                </li>
                                <li class="active">
                                    <a href="customer-orders.php"><i class="fa fa-list"></i> 我的訂單</a>
                                </li>                               
                                <li>
                                    <a href="../index.php"><i class="fa fa-sign-out"></i> 登出</a>
                                </li>
                            </ul>
                        </div>

                    </div>
                    <!-- /.col-md-3 -->

                    <!-- *** CUSTOMER MENU END *** -->
                </div>

                <div class="col-md-9" id="customer-order">
                    <div class="box">
                        <h1>訂單 <?php echo $member_order['order_no']; ?></h1>

                        <p class="lead">訂單日期: <strong><?php echo $member_order['order_date']; ?></strong> 成立，目前狀態為
                        
                        <strong><?php if($member_order['status'] == "0"){ ?>
                                        <span class="label label-info">待付款</span>
                                        <?php }else if($member_order['status'] == "1"){ ?>
                                        <span class="label label-warning">處理中</span>
                                        <?php }else if($member_order['status'] == "2"){ ?>
                                        <span class="label label-warning">出貨中</span>
                                        <?php }else if($member_order['status'] == "3"){ ?>
                                        <span class="label label-warning">運送中</span>
                                        <?php }else if($member_order['status'] == "4"){ ?>
                                        <span class="label label-success">貨物已送達</span>
                                        <?php }else if($member_order['status'] == "99"){ ?>
                                        <span class="label label-danger">取消訂單</span>
                                        <?php } ?></strong>.</p>
                        <p class="text-muted">有任何問題請 <a href="contact.php">聯絡我們</a>, 我們將盡快回覆您.</p>

                        <hr>

                        <div class="table-responsive">
                        
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>產品圖片</th>
                                        <th>產品名稱</th>
                                        <th>數量</th>
                                        <th>單價</th>
                                        <th>小計</th>
                                    </tr>
                                </thead>
                               
                                
                                <tbody>  
                                <?php foreach($one_order as $one){ ?>                   
                                    <tr>
                                        <td>
                                            <img src="../uploads/products/<?php echo $one['picture']; ?>" alt="<?php echo $one['name']; ?>">
                                        </td>
                                        <td><?php echo $one['name']; ?>
                                        </td>
                                        <td><?php echo $one['quantity']; ?></td>
                                        <td>$NT <?php echo $one['price']; ?></td>
                                        <td>$NT <?php $subtotal = $one['price']*$one['quantity']; echo $subtotal; ?></td>
                                    </tr>
                                <?php } ?>  
                                </tbody>
                                
                                <tfoot>
                                    <tr>
                                        <th colspan="4" class="text-right">訂單總計</th>
                                        <th>$NT <?php echo $member_order['total'] - $member_order['shipping'] ; ?></th>
                                    </tr>
                                    <tr>
                                        <th colspan="4" class="text-right">運費</th>
                                        <th>$NT <?php echo $member_order['shipping']; ?></th>
                                    </tr>
                                   
                                    <tr>
                                        <th colspan="4" class="text-right">合計</th>
                                        <th>$NT <?php echo $member_order['total']; ?></th>
                                    </tr>
                                </tfoot>
                            </table>
                        
                        </div>
                        <!-- /.table-responsive -->

                        <div class="row">
                            <div class="col-md-12">
                                <h2>收件者資訊</h2>
                                <p>姓名：<?php echo $member_order['name']; ?></p>
                                <p>行動電話：<?php echo $member_order['phone']; ?></p>
                                <p>地址：<?php echo $member_order['address']; ?></p>
                                <p>E-mail：<?php echo $_SESSION['member']['account']; ?></p>
                            </div>
                            
                        </div>

                    </div>
                </div>

            </div>
            <!-- /.container -->
        </div>
        <!-- /#content -->


       <?php require_once('template/footer.php'); ?>



</body>

</html>

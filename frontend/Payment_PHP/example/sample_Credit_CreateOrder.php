<?php
/**
*
*/
require_once('../../../function/connection.php');
$query2 = $db->query("SELECT * FROM order_details WHERE customer_orderID=".$_POST['customer_orderID']);
$one_order = $query2->fetchALL(PDO::FETCH_ASSOC);
    //載入SDK(路徑可依系統規劃自行調整)
    include('Opay.Payment.Integration.php');
    try {

    	$obj = new OpayAllInOne();

        //服務參數
        $obj->ServiceURL  = "https://payment-stage.opay.tw/Cashier/AioCheckOut/V5";         //服務位置
        $obj->HashKey     = '5294y06JbISpM5x9' ;                                            //測試用Hashkey，請自行帶入OPay提供的HashKey
        $obj->HashIV      = 'v77hoKGq4kWxNNIS' ;                                            //測試用HashIV，請自行帶入OPay提供的HashIV
        $obj->MerchantID  = '2000132';                                                      //測試用MerchantID，請自行帶入OPay提供的MerchantID
        $obj->EncryptType = OpayEncryptType::ENC_SHA256;                                    //CheckMacValue加密類型，請固定填入1，使用SHA256加密

        //基本參數(請依系統規劃自行調整)
        $obj->Send['ReturnURL']         = 'http://localhost/simple_ServerReplyPaymentStatus.php'; //付款完成通知回傳的網址
        $obj->Send['MerchantTradeNo']   = $_POST['MerchantTradeNo'] ;                                         //訂單編號
        $obj->Send['MerchantTradeDate'] = date('Y/m/d H:i:s');                                    //交易時間
        $obj->Send['TotalAmount']       = $_POST['TotalAmount'];                                                   //交易金額
        $obj->Send['TradeDesc']         = $_POST['TradeDesc']; ;                                       //交易描述
        $obj->Send['ChoosePayment']     = OpayPaymentMethod::Credit ;                             //付款方式:Credit

        //訂單的商品資料
        foreach($one_order as $one){
        array_push($obj->Send['Items'], array('Name' => $one['name'], 'Price' => (int)$one['price'],
                   'Currency' => "元", 'Quantity' => (int) $one['quantity'], 'URL' => "dedwed"));

        //Credit信用卡分期付款延伸參數(可依系統需求選擇是否代入)
        //以下參數不可以跟信用卡定期定額參數一起設定
        $obj->SendExtend['OrderResultURL'] = 'http://localhost/happy_cake/frontend/payment_success.php' ; 
        $obj->SendExtend['CreditInstallment'] = '' ;   //分期期數，預設0(不分期)，信用卡分期可用參數為:3,6,12,18,24
        $obj->SendExtend['Redeem'] = false ;           //是否使用紅利折抵，預設false
        $obj->SendExtend['UnionPay'] = false;          //是否為聯營卡，預設false;

        //Credit信用卡定期定額付款延伸參數(可依系統需求選擇是否代入)
        //以下參數不可以跟信用卡分期付款參數一起設定
        // $obj->SendExtend['PeriodAmount'] = '2000' ; //每次授權金額，預設空字串
        // $obj->SendExtend['PeriodType']   = 'M' ;    //週期種類，預設空字串
        // $obj->SendExtend['Frequency']    = '1' ;    //執行頻率，預設空字串
        // $obj->SendExtend['ExecTimes']    = '2' ;    //執行次數，預設空字串

        //產生訂單(auto submit至OPay)
        $obj->CheckOut();

    } catch (Exception $e) {
    	echo $e->getMessage();
    }

?>
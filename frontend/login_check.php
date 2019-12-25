<?php 
session_start();
require_once('../function/connection.php');
$query = $db->query("SELECT * FROM members WHERE account='".$_POST['account']."' AND password='".$_POST['password']."'");
$member = $query->fetch(PDO::FETCH_ASSOC);
if(isset($member) && $member['account'] != null){
    $_SESSION['member'] = $member;
    
    header('Location: ../index.php');
}else{
    header('Location: register.php?MSG=error');
}
?>
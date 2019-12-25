<?php
session_start();
if($_SESSION['member'] !==null){
    header('Location: checkout1.php');
}else{
    header('Location: register.php');
}
?>
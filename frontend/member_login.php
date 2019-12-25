<?php
session_start();
if(!isset($_SESSION['member']) && $_SESSION['member']['account'] ==null){
    header('Location: register.php');
}
?>
<?php
session_start();
if(!isset($_SESSION['user']) && $_SESSION['user']['account'] ==null){
    header('Location: ../login.php?MSG=plz_login');
}
?>
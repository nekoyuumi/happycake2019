<?php 
require_once('../is_login.php');
require_once('../../function/connection.php');
$query = $db->query("DELETE FROM members WHERE memberID=".$_GET['memberID']);
header('Location: list.php');
?>
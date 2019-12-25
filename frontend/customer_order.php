<?php
session_start();
if(isset($_POST['AddForm']) && $_POST['AddForm'] == "INSERT"){
    $sql= "INSERT INTO customer_orders (published_at, picture, title, content, created_at) VALUES ( :published_at, :picture, :title, :content, :created_at)";
    $sth = $db ->prepare($sql);
    $sth ->bindParam(":published_at", $_POST['published_at'], PDO::PARAM_STR);
    $sth ->bindParam(":picture", $filename, PDO::PARAM_STR);
    $sth ->bindParam(":title", $_POST['title'], PDO::PARAM_STR);
    $sth ->bindParam(":content", $_POST['content'], PDO::PARAM_STR);
    $sth ->bindParam(":created_at", $_POST['created_at'], PDO::PARAM_STR);
    $sth ->execute();
  
    header('Location: list.php');
?>
<?php 
session_start();
require_once('../function/connection.php');
if (isset($_POST['EditPassword']) && $_POST['EditPassword'] == "CHANGE"){
    if(isset($_POST['password_old']) && $_POST['password_old'] == $_SESSION['member']['password']){   
        if(isset($_POST['password_new']) && $_POST['password_new'] == $_POST['password_check']){
          $sql= "UPDATE members SET password=:password WHERE memberID=:memberID";
          $sth = $db ->prepare($sql);
          $sth ->bindParam(":password", $_POST['password_new'], PDO::PARAM_STR);
          $sth ->bindParam(":memberID", $_SESSION['member']['memberID'], PDO::PARAM_INT);
          $sth ->execute();

          $_SESSION['member']['password'] = $_POST['password_new'];

          header('Location: customer-account.php?msg=success');
        }else{
        header('Location: customer-account.php?msg=failed');
        };    
    }else{
    header('Location: customer-account.php?msg=failed');
    };
};
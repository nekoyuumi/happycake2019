<?php

define('DB_SERVER', "sql305.byethost.com");
define('DB_USER', "b8_24636162");
define('DB_PASSWORD', "5bttest1234");
define('DB_DATABASE', "b8_24636162_happycake");
define('DB_DRIVER', "mysql");

$db = new PDO(DB_DRIVER . ":dbname=" . DB_DATABASE . ";host=" . DB_SERVER, DB_USER, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

date_default_timezone_set("Asia/Taipei");

 ?>

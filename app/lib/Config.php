<?php


$address ="localhost";
$username="root";
$passwd="123456";
$dbname="data";


$GLOBALS['PDO'] = new PDO("mysql:host=$address;dbname=data",$username,$passwd,
    array(PDO::ATTR_PERSISTENT => true,
         PDO::MYSQL_ATTR_INIT_COMMAND => "set names utf8"
    ));
//$GLOBALS['PDO'] = new PDO("mysql:host=localhost;dbname=data","root","123456",array(PDO::ATTR_PERSISTENT => true));



?>
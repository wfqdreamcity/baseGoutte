<?php
require_once('./lib/auto_load.php');

$PDO =$GLOBALS['PDO'];

error_reporting(E_ALL^E_NOTICE^E_WARNING);
set_time_limit(0);
ignore_user_abort(true);


read($PDO);





function read($PDO){
    $sql ="select count(id) as total from url";
    $result = $PDO->query($sql);
    foreach ($result as $row) {
        $total = $row['total'];
    }
    $sql ="select count(id) as total from url where status =1";
    $result = $PDO->query($sql);
    foreach ($result as $row) {
        $finish = $row['total'];
    }
    $unfinish =$total -$finish;
    $sql ="select count(id) as total from news_url";
    $result = $PDO->query($sql);
    foreach ($result as $row) {
        $total2 = $row['total'];
    }
    $sql ="select count(id) as total from news_url where status=1";
    $result = $PDO->query($sql);
    foreach ($result as $row) {
        $finish2 = $row['total'];
    }
    $unfinish2 =$total2 -$finish2;

    $sql ="select count(id) as total from news";
    $result = $PDO->query($sql);
    foreach ($result as $row) {
        $news = $row['total'];
    }
    echo "总计抓取新闻 :".$news."条 <br><br>";
    echo "Url总计 :".$total."条 ,已经抓取 :".$finish."条 ，剩余 :".$unfinish."<br><br>";
    echo "新闻url总计 :".$total2."条 ,已经抓取 :".$finish2."条 ，剩余 :".$unfinish2."<br><br>";
}

?>
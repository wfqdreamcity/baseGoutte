<?php
//引入文件
require_once('lib/auto_load.php');

use App\lib\DB;
use App\lib\DataHandle;
use App\lib\UrlHandle;

error_reporting(E_ALL^E_NOTICE^E_WARNING);
set_time_limit(0);
ignore_user_abort(true);


while(1){

    $URL  =new UrlHandle();
    $uri =$URL->getUriToCrawler();
	$time =date('Y-m-d H:i:s',time());
	if($uri){
        //获取到uri 抓取数据
        $Data = new App\lib\DataHandle();
        $Data->tenXunData($uri);
    }else{
        //uri库中找不到地址暂停30秒
        echo "Waiting for get more uri.....";
		file_put_contents('news_log.txt',$time."=>get news pause\r\n",FILE_APPEND);
   
        flush();
        sleep(600);
    }

}



?>
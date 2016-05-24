<?php
//引入文件
require_once('lib/auto_load.php');

use App\lib\Request;
use App\lib\UrlHandle;
use App\lib\DB;

error_reporting(E_ALL^E_NOTICE^E_WARNING);
set_time_limit(0);
ignore_user_abort(false);

$initUrl ="http://news.qq.com/";

reptile($initUrl);


function reptile($initUrl){

    $url =$initUrl;

    $request = new Request();

    $UrlHandle =new UrlHandle();

    $num =0;
    while(1) {
        //获取数据
        $data = $request->getWebInfo($url);

        //处理数据
        $UrlHandle->handle($data);

        $url = $UrlHandle->getUriAndChangeTheStatus();

        $num++;
		$time =date('Y-m-d H:i:s',time());
        //file_put_contents('log.txt',$time."=>".$num.":".$url."\r\n",FILE_APPEND);
		
		if(!$url){
            //uri库中找不到地址暂停30秒
            echo "Waiting for get more uri.....";
			file_put_contents('log.txt',$time."=>".$num.":".$url."\r\n",FILE_APPEND);
            flush();
            sleep(35);
        }
    }
}

?>

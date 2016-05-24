<?php
//引入文件
require_once('auto_load.php');

use App\request;
use App\handle;
use App\connect;

error_reporting(E_ALL^E_NOTICE^E_WARNING);
set_time_limit(0);
ignore_user_abort(true);

$initUrl ="http://news.baidu.com";

reptile($initUrl);


function reptile($initUrl){

    $url =$initUrl;

    $request = new App\request();

    $handle =new App\handle();

    $pdo =$GLOBALS['PDO'];
    $num =0;
    while(1) {
        //获取数据
        $data = $request->getWebInfo($url);

        //处理数据
        $handle->handle($data);

        $sql = "UPDATE url SET status=1 WHERE url='" . $url . "' LIMIT 1";
        $pdo->query($sql);

        $sql = 'SELECT url FROM url WHERE status=0 LIMIT 1';
        $result = $pdo->query($sql);
        foreach ($result as $row) {
            $url = $row['url'];
        }
		$num++;
		$time =date('Y-m-d H:i:s',time());
        file_put_contents('log.txt',$time."=>".$num.":".$url."\r\n",FILE_APPEND);
    }
}

?>

<?php
/*
 * 数据处理类
 *
 *
 */
namespace App;

use App\connect as Connect;

class handle{


    //获取页面中的可用字段
    public function handle($str){

        //匹配url
        $url =array();
        $pdo =$GLOBALS['PDO'];
        //保存url
        preg_match_all('/http:\/\/[0-9a-z\.\/\-]+\/[0-9a-z\.\/\-]+\.([0-9a-z\.\/\-]+)/',$str,$result);
        foreach ($result['0'] as $key =>$url){
            $extend =$result['1'][$key];
			//$time =date('Y-m-d H:i:s',time());
            //file_put_contents('sql_url.txt',$time."=>".$url."\r\n",FILE_APPEND);
            $this->getUrls($url,$extend,$pdo);
        }

        //保存文章内容

    }


    //保存页面中的url
    public function getUrls($url,$extend,$pdo){

        $sq ="select count(id) as num from url where url='".$url."'";
        $count = $pdo->query($sq);
        foreach ($count as $row) {
            $num = $row['num'];
        }
		if($num==0){
            $extend_array =array('shtml','html','htm');
            //剔除图片，js 文件
            if(in_array($extend,$extend_array)){
                $time =date('Y-m-d H:i:s',time());
                $sql="insert into url (url,type,time,status) VALUES ('".$url."','".$extend."','".$time."',0)";
                $pdo->query($sql);
            }
        }
    }

    //保存页面中的内容
    public function getContent(){

    }





}


?>

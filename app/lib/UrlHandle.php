<?php
/*
 * 数据处理类
 *
 *
 */
namespace App\lib;

use App\lib\DB;

class UrlHandle{


    //获取页面中的可用字段
    public function handle($str){

        //匹配url
        $url =array();
        $pdo =$GLOBALS['PDO'];
        //保存url
        //preg_match_all('/http:\/\/[0-9a-z\.\/\-]+\/[0-9a-z\.\/\-]+\.([0-9a-z\.\/\-]+)/',$str,$result);
        preg_match_all('/http:\/\/[a-z]+\.qq\.com[0-9a-z\.\/\-]+\/[0-9a-z\.\/\-]+\.([0-9a-z\.\/\-]+)/',$str,$result);
        foreach ($result['0'] as $key =>$url){
            $extend =$result['1'][$key];

            //处理拓展信息
            $this->getExtend($extend);

            //处理url
            $this->getUrls($url,$extend,$pdo);
        }

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
                $data =array(
                    'url' =>$url,
                    'type' =>$extend,
                    'time' =>$time,
                    'status' =>0
                );
                DB::create('url',$data);

                //匹配改地址是否为文章详情页
                if(preg_match('/http:\/\/[a-z]+\.qq\.com\/a\/[0-9a-z\.\/\-]+\/[0-9a-z\.\/\-]+\.([0-9a-z\.\/\-]+)/',$url)){
                    $data =array(
                        'uri' =>$url,
                        'status' =>0
                    );
                    DB::create('news_url',$data);
                }
            }
        }
    }

    //获取一条uri信息 抓取该页面的所有uri
    public function getUriAndChangeTheStatus(){
        $PDO =$GLOBALS['PDO'];
        $url="";
        $sql = 'SELECT url FROM url WHERE status=0 LIMIT 1';
        $result = $PDO->query($sql);
        foreach ($result as $row) {
            $url = $row['url'];
        }
        if($url){
            $sql = "UPDATE url SET status=1 WHERE url='".$url."' LIMIT 1";
            $PDO->query($sql);

            return $url;
        }else{
            return false;
        }
    }

    //获取一条uri信息 抓取该页面数据
    public function getUriToCrawler(){
        $PDO =$GLOBALS['PDO'];
        $uri="";
        $sql = 'SELECT uri FROM news_url WHERE status=0 LIMIT 1';
        $result = $PDO->query($sql);
        foreach ($result as $row) {
            $uri = $row['uri'];
        }
		$sql = "UPDATE news_url SET status=1 WHERE uri='".$uri."'";
        $PDO->query($sql);
        if($uri){
            return $uri;
        }else{
            return false;
        }
    }

    //统计拓展信息
    public function getExtend($extend){
        $PDO =$GLOBALS['PDO'];
        $num=0;
        $sql = "SELECT count(id) as num FROM extend WHERE extend='".$extend."'";
        $result = $PDO->query($sql);
        foreach ($result as $row) {
            $num = $row['num'];
        }
        if($num>0){
            //拓展加1
            $sql = "UPDATE extend SET count=count+1 WHERE extend='".$extend."' LIMIT 1";
            $PDO->query($sql);
        }else{
            //新建记录
            $data =array(
                'extend' =>$extend,
                'count' =>1
            );
            DB::create('extend',$data);
        }

    }





}


?>

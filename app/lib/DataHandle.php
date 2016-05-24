<?php
namespace App\lib;

use Goutte\Client;
use App\lib\DB;

class DataHandle{

    /*
     *get tenxun news' detail page
     **/
    public function tenXunData($Url){

        //实例化goutte
        $client = new Client();

        //获取数据
        $data =array();
        // Go to the symfony.com website
        $crawler = $client->request('GET', $Url);

        //获取新闻标题
        $title =$crawler->filter('#C-Main-Article-QQ > .hd >h1');
        foreach ($title as $domElement){
            $html =$domElement->textContent;
            $data['title'] =$html;
        }

        //获取新闻分类
        $category =$crawler->filter('#C-Main-Article-QQ > .hd > .tit-bar > .ll > .color-a-0 > a');
        foreach ($category as $domElement){
            $html =$domElement->textContent;
            $data['category'] =$html;
        }

        //获取新闻分类(link)
        /*
        $href =$crawler->filter('#C-Main-Article-QQ > .hd > .tit-bar > .ll > .color-a-0 > a')->extract("href");
        foreach ($href as $domElement){
            $html =$domElement;
            $data['category_url'] =$html;
        }
        */

        //获取新闻来源
        $category =$crawler->filter('#C-Main-Article-QQ > .hd > .tit-bar > .ll > .color-a-1 > a');
        foreach ($category as $domElement){
            $html =$domElement->textContent;
            $data['source'] =$html;
        }

        //获取新闻来源(link)
        $href =$crawler->filter('#C-Main-Article-QQ > .hd > .tit-bar > .ll > .color-a-1 > a')->extract("href");
        if($href){
            foreach ($href as $domElement){
                $html =$domElement;
                $data['new_url'] =$html;
            }
        }else{
            $data['new_url'] =$Url;
        }

        //获取新闻时间
        $time =$crawler->filter('#C-Main-Article-QQ > .hd > .tit-bar > .ll > .article-time');
        foreach ($time as $domElement){
            $html =$domElement->textContent;
            $data['time'] =$html;
        }

        //获取新闻内容
        $content = $crawler->filter('#C-Main-Article-QQ > .bd');
        foreach ($content as $domElement){
            $html =$domElement->ownerDocument->saveHTML($domElement);
            //$html =$domElement->textContent;
            $data['content'] =$html;
        }
		
		if(empty($data['title'])){
			return;
		}
		
        $result = DB::create('news',$data);
        return $result;

    }


}















?>
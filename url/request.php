<?php
namespace App;
/*
 *
 * 数据抓取类
 *
 */
class request{

    //获取页面信息
    public function getWebInfo($url){

        // 初始化一个 cURL 对象
        $curl = curl_init();

        // 设置你需要抓取的URL
        curl_setopt($curl, CURLOPT_URL, $url);

        // 设置header
        curl_setopt($curl, CURLOPT_HEADER, 1);

        // 设置cURL 参数，要求结果保存到字符串中还是输出到屏幕上。
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        // 运行cURL，请求网页
        $data = curl_exec($curl);

        // 关闭URL请求
        curl_close($curl);

        return $data;

    }


}










?>
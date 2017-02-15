<?php
# Name: PHP版乐视云计算获取直连
# Author: 烟雨江南<cscms@qq.com> [QQ:2811358863]
# Homepage:http://ydisk.chshcms.com/
//错误提示
error_reporting(0);
//默认时区
date_default_timezone_set("Asia/Shanghai");
//文件名称
define('SELF', pathinfo(__FILE__, PATHINFO_BASENAME));
// 网站根目录
define('FCPATH', str_replace("\\", "/", str_replace(SELF, '', __FILE__)));
//强制编码
header('Content-Type:text/html;Charset=utf-8');
//API地址，不能修改
define('API_URL', 'http://letvpan.duapp.com/letv/api.php'); 
//防盗链域名，多个用|隔开，如：123.com|abc.com  关闭请留空
define('REFERER_URL', ''); 
//用户授权UID，在 ydisk.chshcms.com 平台可以查看到
define('USER_ID', '2768876328');

//判断防盗链
if(!is_referer()){
	 header('HTTP/1.1 403 Forbidden');
     exit('403');
}

//视频VID
$vid=$_GET['vid'];
//如果视频VID为直连地址则转换
if(substr($vid,0,7)=='http://'){
    $arr = explode("/".USER_ID."/", $vid);
    $type=trim(substr(strrchr($vid, '.'), 1));
    $vid=str_replace(".".$type, "",$arr[1]);
}

//判断缓存是否存在
$cache=0;
$filemd5=FCPATH.'cache/'.md5($vid.'-'.$type).'.txt';
if(file_exists($filemd5)){
    $purl=file_get_contents($filemd5);
	if(stristr($purl,'&ntm=')){
	    $times=str_substr('&ntm=', '&', $purl);
	}else{
	    $times=str_substr('&tm=', '&', $purl);
	}
	if($times+1800 > time()){
	    $cache++;
	}
}
if($cache==0){
    $apiurl=API_URL."?uid=".USER_ID."&type=".$type."&vid=".$vid;
    $purl=geturl($apiurl);
}
if(strpos($purl,'http://') !== FALSE){
	if($cache==0){
        file_put_contents($filemd5,$purl);
	}
	if(stristr($purl,'#EXTM3U')){
		//判断苹果
		if(preg_match("/(iPhone|iPad|iPod)/i", strtoupper($_SERVER['HTTP_USER_AGENT']))){
			header('Content-type: application/x-mpegURL');
            header('Content-disposition: attachment; filename=video.m3u8');
		}
        exit($purl);
	}else{
        header("Location:".$purl);exit;
	}
}else{
    exit('获取失败~!');
}

//获取远程内容
function geturl($url) {
    // 判断是否支持CURL
    if (!function_exists('curl_init') || !function_exists('curl_exec')) {
        exit('您的主机不支持Curl，请开启~');
	}
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_USERAGENT, 'cscms_ydisk_letv');
    curl_setopt($curl, CURLOPT_REFERER, "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
    curl_setopt($curl, CURLOPT_AUTOREFERER, 1);
    curl_setopt($curl, CURLOPT_TIMEOUT, 10);
    curl_setopt($curl, CURLOPT_HEADER, 0);
	curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); 
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false); 
    $data = curl_exec($curl);
    curl_close($curl);
    return $data;
}

// 字符串截取函数
function str_substr($start, $end, $str){      
    $temp = explode($start, $str, 2);      
    $content = explode($end, $temp[1], 2);      
    return $content[0];      
}

//判断防盗链域名
function is_referer(){
	//没有设置防盗链
    if(REFERER_URL=='') return true; 
	//部分手机浏览器没有来路
	if(empty($_SERVER['HTTP_REFERER'])){
		if(preg_match("/(iPhone|iPad|iPod|Android|Linux)/i", strtoupper($_SERVER['HTTP_USER_AGENT']))){
            return true;
		}
	}else{
	    //开始验证
        $ext = explode("|",REFERER_URL);
        for($i=0;$i<count($ext);$i++){
		    if(strpos(strtolower($_SERVER['HTTP_REFERER']),strtolower($ext[$i])) !== FALSE ){
               return true; 
            }
		}
	}
    return false;
}
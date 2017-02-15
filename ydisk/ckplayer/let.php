<?php
$vid=$_GET['vid'];
//$vid=44898837;
get_letv($vid);
function get_letv($vid){
	$url="http://dynamic.meizi.app.m.letv.com/android/dynamic.php?mod=minfo&ctl=videofile&act=index&mmsid=".$vid."&playid=0&tss=no&pcode=010610000&version=1.9";
	$c=get_c($url);
	$json=json_decode($c);
	for($i=1;$i<=5;$i++){
		if($json->body->videofile->infos->mp4_1000->filesize>300){
			break;
			}
	
	}
$url=$json->body->videofile->infos->mp4_350->mainUrl;
$url=str_replace('tss=no','tss=ios',$url);
$url=str_replace('vtype=13','vtype=22',$url);
/*if(empty($url)){
	$url=$json->body->videofile->infos->mp4_350->mainUrl;
}*/
$c=get_c($url);
	$json=json_decode($c);
	//print_r($json);
	$file=$json->nodelist[2]->location;
	//echo $file;
header('Location:'.$file);
	}
function get_c($url){
	$ip=$_SERVER['REMOTE_ADDR'];
       $ch=curl_init();
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch,CURLOPT_REFERER,$url);
curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,30);
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (iPhone; CPU iPhone OS 9_1 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Version/9.0 Mobile/13B143 Safari/601.1'.$url);
 curl_setopt($ch, CURLOPT_HTTPHEADER, array('X-FORWARDED-FOR:'.$ip, 'CLIENT-IP:'.$ip)); 
@$file=curl_exec($ch);
curl_close($ch);
return $file;
}

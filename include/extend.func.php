<?php
function litimgurls($imgid=0)
{
    global $lit_imglist,$dsql;
    //获取附加表
    $row = $dsql->GetOne("SELECT c.addtable FROM #@__archives AS a LEFT JOIN #@__channeltype AS c 
                                                            ON a.channel=c.id where a.id='$imgid'");
    $addtable = trim($row['addtable']);
    
    //获取图片附加表imgurls字段内容进行处理
    $row = $dsql->GetOne("Select imgurls From `$addtable` where aid='$imgid'");
    
    //调用inc_channel_unit.php中ChannelUnit类
    $ChannelUnit = new ChannelUnit(2,$imgid);
    
    //调用ChannelUnit类中GetlitImgLinks方法处理缩略图
    $lit_imglist = $ChannelUnit->GetlitImgLinks($row['imgurls']);
    
    //返回结果
    return $lit_imglist;
}

//格式化列表
function GetMurlss($dbstr){
	$restr = '';
	$patchArr = explode("\r\n", $dbstr);
	if(count($patchArr)>1){
		foreach($patchArr as $key => $val){
			if(!empty($val)){
				$nowval = explode('$$$$', $val);
				if(count($nowval)>1) $restr .= "<A href=\"/plus/viewbo.php?bo={$nowval[1]}\" target=\"_self\">{$nowval[0]}</a>\r\n"; 
			}
		}
	}else{
		$nowval = explode('$$$$', $dbstr);
		if(count($nowval)>1) $restr = "{$nowval[0]}\r\n"; 
	}
	
	if(empty($restr)){
		return "<li>更新中暂无下载地址</li>";
	}else{
		return $restr;
	}
	
}

function Search_addfields($id,$result){  
 
global $dsql;  
 
$oicqzone = $dsql->GetOne("SELECT * FROM `dede_product` where aid='$id'");  
 
 $name=$oicqzone[$result];  
 
 return $name;  
 
 } 
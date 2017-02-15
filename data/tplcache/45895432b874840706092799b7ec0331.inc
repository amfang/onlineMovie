
-----------------------------------------------

<m:top item='1_' name='常用操作' display='block'>
  <m:item name='网站栏目管理' link='catalog_main.php' ischannel='1' addalt='创建栏目' linkadd='catalog_add.php?listtype=all' rank='t_List,t_AccList' target='main' />
  <m:item name='所有档案列表' link='content_list.php' rank='a_List,a_AccList' target='main' />
  <m:item name='内容回收站' link='recycling.php' ischannel='1' addalt='清空回收站' addico='images/gtk-del.png' linkadd='archives_do.php?dopost=clear&aid=no&recycle=1' rank='a_List,a_AccList,a_MyList' target='main' />
  
  
   <m:item name='LOGO管理' link='ppt_edit.php?aid=1&dopost=edit' target='main' />
    <m:item name='播放页面二维码图片' link='ad_edit.php?aid=24&dopost=edit' target='main' />
	 <m:item name='跳转页二维码' link='file_manage_main.php?activepath=%2Fimages%2Fweixin' target='main' />
	  <m:item name='播放器上方广告' link='ad_edit.php?aid=21&dopost=edit' target='main' />
	   <m:item name='播放器下方广告' link='ad_edit.php?aid=22&dopost=edit' target='main' />
	    <m:item name='底部悬浮广告' link='ad_edit.php?aid=23&dopost=edit' target='main' />
</m:top>

<m:top item='1_' name='内容管理' display='block'>
    <m:item name='普通文章' ischannel='1' link='content_list.php?channelid=1' linkadd='article_add.php?channelid=1' channelid='1' rank='' target='main' />
  <m:item name='电影' ischannel='1' link='content_list.php?channelid=17' linkadd='archives_add.php?channelid=17' channelid='17' rank='' target='main' />
  <m:item name='电视' ischannel='1' link='content_list.php?channelid=18' linkadd='archives_add.php?channelid=18' channelid='18' rank='' target='main' />

</m:top>










<m:top item='5_' name='自动任务' notshowall='1'  display='block' rank='sys_MakeHtml'>
  <m:item name='一键更新网站' link='makehtml_all.php' rank='sys_MakeHtml' target='main' />
  <m:item name='更新系统缓存' link='sys_cache_up.php' rank='sys_ArcBatch' target='main' />
  
</m:top>

<m:top item='5_' name='HTML更新' notshowall='1' display='none' rank='sys_MakeHtml'>
  <m:item name='更新主页HTML' link='makehtml_homepage.php' rank='sys_MakeHtml' target='main' />
  <m:item name='更新栏目HTML' link='makehtml_list.php' rank='sys_MakeHtml' target='main' />
  <m:item name='更新文档HTML' link='makehtml_archives.php' rank='sys_MakeHtml' target='main' />
</m:top>


<m:top item='7_' name='模板管理' display='none' rank='temp_One,temp_Other,temp_MyTag,temp_test,temp_All'>
  <m:item name='默认模板管理' link='templets_main.php' rank='temp_All' target='main'/>
</m:top>

<m:top item='10_' name='系统设置' display='none' rank='sys_User,sys_Group,sys_Edit,sys_Log,sys_Data'>
  <m:item name='系统基本参数' link='sys_info.php' rank='sys_Edit' target='main' />
  <m:item name='系统用户管理' link='sys_admin_user.php' rank='sys_User' target='main' />
  <m:item name='数据库备份/还原' link='sys_data.php' rank='sys_Data' target='main' />
</m:top>

    


-----------------------------------------------

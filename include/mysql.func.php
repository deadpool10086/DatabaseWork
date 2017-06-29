<?php

/*
	链接mysql数据库;
*/

	 	function _connect(){
 		global $_conn;
 		 $serverName = "127.0.0.1";
 		 $connectionInfo = array("UID"=>"sa","PWD"=>"zsd123456","Database"=>"work");
 		if(!$_conn = @sqlsrv_connect( $serverName, $connectionInfo))
 		{
 			exit('数据库链接失败！');
 		}
 	}
/*
	选则一款数据库;
*/

 	function _select_db(){
 		if(!mysql_select_db(DB_NAME))
 		{
 			exit('找不到指定数据库！');
 		}
 	}
//选择字符集
 	function _set_names(){
 		if(!mysql_query('SET NAMES UTF8'))
 		{
 			exit("字符集错误！");
 		}
 	}

function _query($_sql)
{
	global $_conn;
	if (!$result = sqlsrv_query( $_conn,$_sql))
	{
		exit('SQL 执行失败');
	}
	return $result;
}

function _insert_id()
{
	return mysql_insert_id();
}

//返回单个数据集
function _fetch_array($_sql){
	global $_conn;
	return sqlsrv_fetch_array(sqlsrv_query($_conn,$_sql),SQLSRV_FETCH_NUMERIC);
}
//返回多条数据
function _fetch_array_list($_result){
	return sqlsrv_fetch_array($_result,SQLSRV_FETCH_NUMERIC);
}

function _num_rows($_result)
{
	return mysql_num_rows($_result);
}

/*
返回影响的记录数
*/
function _affected_rows()
{
	return mysql_affected_rows();
}

function _free_result($_result)
{
	mysql_free_result($_result);
}

function _is_reqeat($_sql,$_info)
{
	if(_fetch_array($_sql))
	{
		_alert_back($_info);
	}
}
function _close(){
	if(!mysql_close())
	{
		exit('关闭异常');
	}
}
?>
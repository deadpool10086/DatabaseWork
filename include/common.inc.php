<?php
	define('ROOT_PATH',substr(dirname(__FILE__),0,-8));
	require ROOT_PATH.'/include/mysql.func.php';
	_connect();
	function _alert_back($_info) {
	echo "<script type='text/javascript'>alert('".$_info."');history.back(); </script> ";
	exit();
	}
?>
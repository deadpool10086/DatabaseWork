<?php
require dirname(__FILE__).'/include/common.inc.php';
$stmt = _query($sql);
if(isset($_GET['action'])&&$_GET['action'] == 'login')
{
	if ($_POST['username'] == $_POST['password'] ) {
		$sql = "SELECT * FROM Worker WHERE WID = '".$_POST['username']."'";
		if($_res = _fetch_array($sql))
		{
			setcookie("username",$_res[0],time()+3600*24);	
			header("Location: http://118.89.18.165/a/"); 
		}
		_alert_back("用户名或密码错误！");
	}
}
?>
<!DOCTYPE HTML>
<html>
<head>
<title>Home</title>
<!-- Custom Theme files -->
<link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
<!-- Custom Theme files -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<meta name="keywords" content="Login form web template, Sign up Web Templates, Flat Web Templates, Login signup Responsive web template, Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
<script type="text/javascript" src="js/login.js"></script>
</head>
<body>
<div class="login">
	<h2>Acced Form</h2>
	<div class="login-top">
		<h1>LOGIN FORM</h1>
		<form method="post" name="login" action="?action=login">
			<input type="text" name="username" value="User Id" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'User Id';}">
			<input type="password" name="password" value="password" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'password';}">
	    
	    <div class="wcwcwc">
	    	<p id="errNo">用户名和密码不得小于6位</p>
	    	<p id="errUse">用户名或密码错误</p>
	    </div>
	    <div class="forgot">
	    	<a href="#">forgot Password</a>
	    	<input type="submit" value="Login" >
	    </div>
	    </form>
	</div>
	<div class="login-bottom">
		<h3>New User &nbsp;<a href="#">Register</a>&nbsp Here</h3>
	</div>
</div>	

</body>
</html>
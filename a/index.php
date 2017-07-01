<?php

	require dirname(__FILE__).'/include/common.inc.php';
	if(isset($_COOKIE['username']))
	{
		$sql = "SELECT * FROM Worker WHERE WID = '".$_COOKIE['username']."'";
		if($_res = _fetch_array($sql))
		{
			$_cxmz  = $_COOKIE['username'];
			if(isset($_GET['action'])&&$_COOKIE['username']=='00000001' )
			{
				if($_GET['action'] == 'cxmz')
				{
					if (_fetch_array("SELECT * FROM Worker WHERE WID = '".iconv('UTF-8','GBK',$_POST['WID'])."'"))
						$_cxmz  = iconv('UTF-8','GBK',$_POST['WID']);
					else
						_alert_back("该用户不存在");
				}
				else
				{
				if($_GET['action'] == 'fire' && _fetch_array("SELECT * FROM Worker WHERE WID = '".$_POST['WID']."'"))
				{
					$sql = "DELETE FROM worker WHERE WID = '".$_POST['WID']."'";
				}
				elseif ($_GET['action'] == 'worker' && _fetch_array("SELECT * FROM Worker WHERE WID = '".$_POST['WID']."'")) {
					$sql = "UPDATE worker SET ";
					foreach ($_POST as $key => $value) {
						$sql = $sql.$key."='".$value."',";
					}
					$sql[strlen($sql)-1] = ' ';
					$sql = $sql."WHERE WID = '".$_POST['WID']."'";
				}
				elseif ($_GET['action'] == 'Wsta' && _fetch_array("SELECT * FROM Wsta WHERE TID = '".$_POST['TID']."' AND DID = '".$_POST['DID']."'")) {
					$sql = "UPDATE Wsta SET ";
					foreach ($_POST as $key => $value) {
						$sql = $sql.$key."='".$value."',";
					}
					$sql[strlen($sql)-1] = ' ';
					$sql = $sql."WHERE TID = '".$_POST['TID']."' AND DID = '".$_POST['DID']."'";
				}
				elseif ($_GET['action'] == 'Depart' && _fetch_array("SELECT * FROM Depart WHERE DID = '".$_POST['DID']."'")) {
					$sql = "UPDATE Depart SET ";
					foreach ($_POST as $key => $value) {
						$sql = $sql.$key."='".$value."',";
					}
					$sql[strlen($sql)-1] = ' ';
					$sql = $sql."WHERE DID = '".$_POST['DID']."'";
				}
				elseif ($_GET['action'] == 'Wtype' && _fetch_array("SELECT * FROM Wtype WHERE TID = '".$_POST['TID']."'")) {
					$sql = "UPDATE Wtype SET ";
					foreach ($_POST as $key => $value) {
						$sql = $sql.$key."='".$value."',";
					}
					$sql[strlen($sql)-1] = ' ';
					$sql = $sql."WHERE TID = '".$_POST['TID']."'";
				}
				else
				{
					$sql = "INSERT ".$_GET['action']." values (";
					foreach ($_POST as $key => $value) {
						$sql = $sql."'".$value."',";
					}
					$sql[strlen($sql)-1] = ')';
				}
				$sql = iconv('UTF-8','GBK',$sql);
				if(_query($sql))
				{
					_alert_back("数据变动成功！");
				}
				else
				{
					_alert_back("数据变动失败请检查数据是否符合规范！");
				}
				}
			}
		}
		else
		{
			_alert_back("非法登陆！");
		}
	}
	else
		_alert_back("非法登陆！");

?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>地球宇宙员工薪资管理系统</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Free HTML5 Template by FreeHTML5.CO" />
	<meta name="keywords" content="free html5, free template, free bootstrap, html5, css3, mobile first, responsive" />
	

  

  	<!-- Facebook and Twitter integration -->
	<meta property="og:title" content=""/>
	<meta property="og:image" content=""/>
	<meta property="og:url" content=""/>
	<meta property="og:site_name" content=""/>
	<meta property="og:description" content=""/>
	<meta name="twitter:title" content="" />
	<meta name="twitter:image" content="" />
	<meta name="twitter:url" content="" />
	<meta name="twitter:card" content="" />

	<!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
	<link rel="shortcut icon" href="favicon.ico">

	
	<!-- Animate.css -->
	<link rel="stylesheet" href="css/animate.css">
	<link rel="stylesheet" href="css/my.css">
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="css/icomoon.css">
	<!-- Simple Line Icons -->
	<link rel="stylesheet" href="css/simple-line-icons.css">
	<!-- Bootstrap  -->
	<link rel="stylesheet" href="css/bootstrap.css">
	<!-- Owl Carousel  -->
	<link rel="stylesheet" href="css/owl.carousel.min.css">
	<link rel="stylesheet" href="css/owl.theme.default.min.css">
	<!-- Style -->
	<link rel="stylesheet" href="css/style.css">


	<!-- Modernizr JS -->
	<script src="js/modernizr-2.6.2.min.js"></script>
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="js/respond.min.js"></script>
	<![endif]-->

	</head>
	<body>
	<header role="banner" id="fh5co-header">
		
		<nav class="navbar navbar-default">
			<div class="container">
				<div class="navbar-header">
					<!-- Mobile Toggle Menu Button -->
					<a href="#" class="js-fh5co-nav-toggle fh5co-nav-toggle" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar"><i></i></a>
					<a class="navbar-brand" href="index.html"><span>Z</span>工资管理系统</a> 
				</div>
				<div id="navbar" class="navbar-collapse collapse">
					<ul class="nav navbar-nav navbar-right">
						<li class="active"><a href="#" data-nav-section="home"><span>工资</span></a></li>
						<li><a href="#" data-nav-section="about"><span>各部门</span></a></li>
						<li><a href="#" data-nav-section="practice-areas"><span>公司情况</span></a></li>
						<li><a href="#" data-nav-section="testimony"><span>个人</span></a></li>
						<li><a href="#" data-nav-section="services"><span>管理</span></a></li>
						<li><a href="#" data-nav-section="team"><span>优秀职工</span></a></li>
						<li><a href="#" data-nav-section="contact"><span>联系我们</span></a></li>
					</ul>
				</div>
			</div>
		</nav>
 
	</header>

	<section id="fh5co-home" data-section="home" style="background-image: url(images/full_image_3.jpg);" data-stellar-background-ratio="0.5">
		<div class="overlay"></div>
		<div class="container">
			<div class="text-wrap">
				<div class="text-inner">
					<div class="row">
						<div class="col-md-10 col-md-offset-1 to-animate">
							<table border="1" class="biaoge1">
								<tr class="biaoti">
									<td class="mtb1">ID</td>
									<td class="mtb1">日期</td>
									<td class="mtb1">姓名</td>
									<td class="mtb1">基本工资</td>
									<td class="mtb1">公司福利</td>
									<td class="mtb1">业绩奖金</td>
									<td class="mtb1">保险</td>
									<td class="mtb1">购房基金</td>
									<td class="mtb1">总计</td>
								</tr>
								<?php
									$_result = _query("SELECT * FROM gongzi WHERE WID = '".$_cxmz."'"); 
									while (!!$_rows = _fetch_array_list($_result)) {?>
								<tr>
									<td><?php echo $_rows[0]; ?></td>
									<td><?php echo $_rows[1]->format('Y-m-d'); ?></td>
									<td><?php echo iconv('GBK','UTF-8',$_rows[2]); ?></td>
									<td><?php echo $_rows[3] ?></td>
									<td><?php echo $_rows[4] ?></td>
									<td><?php echo $_rows[5] ?></td>
									<td><?php echo $_rows[6] ?></td>
									<td><?php echo $_rows[7] ?></td>
									<td><?php echo $_rows[8] ?></td>
								</tr>
								<?php  } ?>
								<td colSpan=9><form method="post" name="login" action="index.php?action=cxmz" id="mamai">
								<input type="text" name="WID">
								<input type="submit" value="查询员工">
								</form></td>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section id="fh5co-about" data-section="about">
		<div class="container">

			<div class="row">
				<div class="col-md-7 col-md-pull-1">
					<table border="1" class="biaoge2">
					<tr class="biaoti2">
					<td>部门</td>
					<td>工作</td>
					<td>福利</td>
					<td>津贴</td>
					<td>保险</td>
					<td>基金</td>
					</tr>
					<?php
						$_result = _query("SELECT * FROM bumen"); 
						while (!!$_rows = _fetch_array_list($_result)) {?>
					<tr>
						<td class="liebiao1"><?php echo iconv('GBK','UTF-8',$_rows[0]); ?></td>
						<td class="liebiao2"><?php echo iconv('GBK','UTF-8',$_rows[1]); ?></td>
						<td><?php echo $_rows[2] ?></td>
						<td><?php echo $_rows[3] ?></td>
						<td><?php echo $_rows[4] ?></td>
						<td><?php echo $_rows[5] ?></td>
					</tr>
					<?php  } ?>
					</table>
				</div>
			</div>

		</div>
	</section>


	<section id="fh5co-explore" data-section="practice-areas">
		<div class="container">
			<div class="row">
				<div class="col-md-12 section-heading text-center">
					<h2 class="to-animate">工司情况</h2>
					<div class="row">
						<div class="col-md-8 col-md-offset-2 subtext to-animate">
							<h3>xzit服务有限公司，成立于2008年，我公司为各行各业提供专业的it技术服务，经过3年多的努力与发展，已具一定的规模及实力，现拥有一支技术精湛的it服务团队，以卓越的服务品质、专业安全的技术服务实力，为不同群体的用户提供更高更优质的it服务。</h3>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="fh5co-explore">
			<div class="container">
				<div class="row">
					<div class="col-md-8 col-md-push-5 to-animate-2">
						<img class="img-shadow img-responsive" src="images/img_2.jpg" alt="Free HTML5 Bootstrap Template">
					</div>
					<div class="col-md-4 col-md-pull-8 to-animate-2">
						<div class="mt">
							<h3>公司工作列表</h3>
							<p>以下为详细公司工作列表，包括工作名称和工作ID号。</p>
							<ul class="list-nav">
							<?php
							$_result = _query("SELECT * FROM Wtype"); 
							while (!!$_rows = _fetch_array_list($_result)) {?>
								<li><i class="icon-check2"></i><?php echo iconv('GBK','UTF-8',$_rows[1]).":".iconv('GBK','UTF-8',$_rows[0]) ?>该部门共有:<?php echo _fetch_array("SELECT COUNT(*) FROM worker WHERE TID = '".$_rows[0]."'")[0]; ?>人</li>
								<?php  } ?>
							</ul>
						</div>
					</div>
					
				</div>
			</div>
		</div>

		<div class="fh5co-explore">
			<div class="container">
				<div class="row">
					<div class="col-md-8 col-md-pull-1 to-animate-3">
						<img class="img-responsive" src="images/img_3.jpg" alt="Free HTML5 Bootstrap Template">
					</div>
					<div class="col-md-4 to-animate-3">
						<div class="mt">
						<?php
							$_result = _query("SELECT * FROM Depart"); 
							while (!!$_rows = _fetch_array_list($_result)) {?>
							<div>
								<h4><i class="icon-shield"></i><?php echo iconv('GBK','UTF-8',$_rows[1]);?></h4>
								<p>部门编号:<?php echo iconv('GBK','UTF-8',$_rows[0]);?> 该部门共有:<?php echo _fetch_array("SELECT COUNT(*) FROM worker WHERE DID = '".$_rows[0]."'")[0]; ?>人</p>
							</div>
						<?php  } ?>
						</div>
					</div>
				</div>
			</div>
		</div>

	</section>
    <div class="copyrights">Collect from <a href="http://www.cssmoban.com/"  title="网站模板">网站模板</a></div>
	
	<?php $user = _fetch_array("SELECT * FROM worker jOIN Depart
		ON worker.DID = Depart.DID
		INNER JOIN Wtype
		ON worker.TID = Wtype.TID WHERE WID = '".$_COOKIE['username']."'");?>
	<section id="fh5co-testimony" data-section="testimony">
		<div class="container">
			<div class="row">
				<div class="col-md-12 to-animate">
					<div class="wrap-testimony">
						<div class="owl-carousel-fullwidth">
							<div class="item">
								<div class="testimony-slide active text-center">
									<figure>
										<img src="images/person2.jpg" alt="user">
									</figure>
									<blockquote>
										<p>"我是一个认真工作，认真钻研，勇于创新的人。能熟练运用电脑，掌握一定的office办公软件，与老师与同学保持着紧密的关系，乐于帮助同学解决学习与生活上的麻烦，善于总结归纳，善于沟通，有良好的敬业作风和团队合作精神。已熟悉与掌握本专业的相关知识，在大学4年间学会刻苦耐劳，努力钻研，学以致用，这就是我们所追寻的宝藏。"</p>
									</blockquote>
								</div>
							</div>

							<div class="item">
								<div class="testimony-slide active text-center">
									<figure>
										<img src="images/person2.jpg" alt="user">
									</figure>
										<p class="geren"><?php echo "用户ID:".$user[0] ?></p>
										<p class="geren"><?php echo "部门:".iconv('GBK','UTF-8',$user[10]) ?></p>
										<p class="geren"><?php echo "工作:".iconv('GBK','UTF-8',$user[12]) ?></p>
										<p class="geren"><?php echo "姓名:".iconv('GBK','UTF-8',$user[3]) ?></p>
										<p class="geren"><?php echo "性别:".iconv('GBK','UTF-8',$user[4]) ?></p>
										<p class="geren"><?php echo "生日:".$user[5]->format('Y-m-d'); ?></p>
										<p class="geren"><?php echo "工龄:".$user[8] ?></p>
										<p class="geren"><?php echo "基本工资:".$user[7] ?></p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	
	<section id="fh5co-services" data-section="services">
		<div class="fh5co-services">
			<div class="container">
				<div class="row">
					<div class="col-md-12 section-heading text-center">
						<h2 class="to-animate">管理</h2>
						<div class="row">
							<div class="col-md-8 col-md-offset-2 subtext">
								<h3 class="to-animate">直接输入信息后提交，输入已存在的相关ID号是修改该条的信息，输入不存在的相关ID号是新增信息</h3>
							</div>
						</div>
					</div>
				</div>
					<dl class="tijiao">
						<dd><form method="post" name="login" action="index.php?action=worker" class="biaoge7">
						职工号：<input type="text" name="WID" class="text"/>部门号：<input type="text" name="DID" class="text"/>工作类别：<input type="text" name="TID" class="text"/>姓名：<input type="text" name="Wname" class="text"/>性别：<input type="text" name="Wsex" class="text"/>生日：<input type="text" name="Wbirth" class="text"/>入职日期：<input type="text" name="InTime" class="text"/>基本工资：<input type="text" name="basW" class="text"/><input type="submit" value="更改员工">
						</form></dd>
						<p></p>
						<dd><form method="post" name="login2" action="index.php?action=Wsta" class="biaoge7">
						部门号：<input type="text" name="DID" class="text"/>工作类别：<input type="text" name="TID" class="text"/>福利：<input type="text" name="welW" class="text"/>津贴：<input type="text" name="rewW" class="text"/>保险：<input type="text" name="InsW" class="text"/>基金：<input type="text" name="funW" class="text"/><input type="submit" value="更改福利"></form></dd>
						<p></p>
						<dd><form method="post" name="login3" action="index.php?action=Depart" class="biaoge7">
						部门号：<input type="text" name="DID" class="text"/>部门名字：<input type="text" name="Dname" class="text"/><input type="submit" value="更改部门名字">
						</form></dd>
						<p></p>
						<dd><form method="post" name="login4" action="index.php?action=Wtype" class="biaoge7">
						工作号：<input type="text" name="TID" class="text"/>工作类别：<input type="text" name="Tname" class="text"/><input type="submit" value="更改职业名字">
						</form></dd>
						<p></p>
						<dd><form method="post" name="login5" action="index.php?action=fire" class="biaoge7">
						工作号：<input type="text" name="WID" class="text"/><input type="submit" value="开除某人">
						</form></dd>
					</dl>
			</div>
		</div>
	</section>	

	<section id="fh5co-team" data-section="team">
		<div class="fh5co-team">
			<div class="container">
				<div class="row">
					<div class="col-md-12 section-heading text-center">
						<h2 class="to-animate">优秀职工</h2>
						<div class="row">
							<div class="col-md-8 col-md-offset-2 subtext">
								<h3 class="to-animate">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove. </h3>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4">
						<div class="team-box text-center to-animate-2">
							<div class="user"><img class="img-reponsive" src="images/person4.jpg" alt="Roger Garfield"></div>
							<h3>Roger Garfield</h3>
							<span class="position">Lawyer</span>
							<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
							<ul class="social-media">
								<li><a href="#" class="facebook"><i class="icon-facebook"></i></a></li>
								<li><a href="#" class="twitter"><i class="icon-twitter"></i></a></li>
								<li><a href="#" class="dribbble"><i class="icon-dribbble"></i></a></li>
								<li><a href="#" class="codepen"><i class="icon-codepen"></i></a></li>
								<li><a href="#" class="github"><i class="icon-github-alt"></i></a></li>
							</ul>
						</div>
					</div>

					<div class="col-md-4">
						<div class="team-box text-center to-animate-2">
							<div class="user"><img class="img-reponsive" src="images/person2.jpg" alt="Roger Garfield"></div>
							<h3>Kevin Steve</h3>
							<span class="position">Lawyer</span>
							<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
							<ul class="social-media">
								<li><a href="#" class="facebook"><i class="icon-facebook"></i></a></li>
								<li><a href="#" class="twitter"><i class="icon-twitter"></i></a></li>
								<li><a href="#" class="dribbble"><i class="icon-dribbble"></i></a></li>
								<li><a href="#" class="codepen"><i class="icon-codepen"></i></a></li>
								<li><a href="#" class="github"><i class="icon-github-alt"></i></a></li>
							</ul>
						</div>
					</div>

					<div class="col-md-4">
						<div class="team-box text-center to-animate-2">
							<div class="user"><img class="img-reponsive" src="images/person3.jpg" alt="Roger Garfield"></div>
							<h3>Ross Standford</h3>
							<span class="position">Lawyer</span>
							<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
							<ul class="social-media">
								<li><a href="#" class="facebook"><i class="icon-facebook"></i></a></li>
								<li><a href="#" class="twitter"><i class="icon-twitter"></i></a></li>
								<li><a href="#" class="dribbble"><i class="icon-dribbble"></i></a></li>
								<li><a href="#" class="codepen"><i class="icon-codepen"></i></a></li>
								<li><a href="#" class="github"><i class="icon-github-alt"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	
	

	<section id="fh5co-footer" data-section="contact" role="contentinfo">
		<div class="container">
			<div class="row">
				<div class="col-md-4 to-animate">
					<h3 class="section-title">About Us</h3>
					<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics.</p>
				</div>

				<div class="col-md-4 to-animate">
					<h3 class="section-title">Our Address</h3>
					<ul class="contact-info">
						<li><i class="icon-map-marker"></i>198 West 21th Street, Suite 721 New York NY 10016</li>
						<li><i class="icon-phone"></i>+ 1235 2355 98</li>
						<li><i class="icon-envelope"></i><a href="#">info@yoursite.com</a></li>
						<li><i class="icon-globe2"></i><a href="#">www.yoursite.com</a></li>
					</ul>
					<h3 class="section-title">Connect with Us</h3>
					<ul class="social-media">
						<li><a href="#" class="facebook"><i class="icon-facebook"></i></a></li>
						<li><a href="#" class="twitter"><i class="icon-twitter"></i></a></li>
						<li><a href="#" class="dribbble"><i class="icon-dribbble"></i></a></li>
						<li><a href="#" class="github"><i class="icon-github-alt"></i></a></li>
					</ul>
				</div>
				<div class="col-md-4 to-animate">
					<h3 class="section-title">Drop us a line</h3>
					<form class="contact-form">
						<div class="form-group">
							<label for="name" class="sr-only">Name</label>
							<input type="name" class="form-control" id="name" placeholder="Name">
						</div>
						<div class="form-group">
							<label for="email" class="sr-only">Email</label>
							<input type="email" class="form-control" id="email" placeholder="Email">
						</div>
						<div class="form-group">
							<label for="message" class="sr-only">Message</label>
							<textarea class="form-control" id="message" rows="7" placeholder="Message"></textarea>
						</div>
						<div class="form-group">
							<input type="submit" id="btn-submit" class="btn btn-send-message btn-md" value="Send Message">
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
	
	<div id="map" class="fh5co-map"></div>

	
	<!-- jQuery -->
	<script src="js/jquery.min.js"></script>
	<!-- jQuery Easing -->
	<script src="js/jquery.easing.1.3.js"></script>
	<!-- Bootstrap -->
	<script src="js/bootstrap.min.js"></script>
	<!-- Waypoints -->
	<script src="js/jquery.waypoints.min.js"></script>
	<!-- Stellar Parallax -->
	<script src="js/jquery.stellar.min.js"></script>
	<!-- Owl Carousel -->
	<script src="js/owl.carousel.min.js"></script>
	<!-- Main JS (Do not remove) -->
	<script src="js/main.js"></script>

	</body>
</html>


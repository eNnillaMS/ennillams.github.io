<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
	<head>
		<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
        <link href='_pgdat/favicon.ico' type='' rel='shortcut icon' />
		<title>RedNet Home Portal</title>
        <script src="_pgdat/mobile-detect.js" type="text/javascript"></script>
		<style type="text/css">
			<!--
				html {
					background-image: url("_pgdat/bg.jpg");
					background-position: center center;
					background-color: #000;
					background-repeat: no-repeat;
					background-attachment: fixed;
					height: 100%;
					width: 100%;
					top: 0px; bottom: 0px; left: 0px; right: 0px;
					overflow: hidden !important;
				}
				.banner {
					width: 75%;
					height: auto;
					margin-left: 12.5%;
					margin-right: 12.5%;
				}
				.wrap {
					height: auto;
					width: 100%;
				}
				a {
					display: inline-block;
					vertical-align: middle;
				}
				.lpic {
					width: 100%;
					height: auto;
				}
			-->
		</style>
	</head>
	<body>
		<script type="text/javascript">
			window.onload=function(){
				var md = new MobileDetect(window.navigator.userAgent);
				if (md.mobile() == null){
					var elems = document.getElementsByClassName("link");
					for (var i=0; i <elems.length;i+=1){
						elems[i].style.width="12%";
						elems[i].style.height="auto";
						elems[i].style.marginLeft="4%";
						elems[i].style.marginTop="50px";
					}
				} else {
					var elems = document.getElementsByClassName("link");
					for (var i=0; i <elems.length;i+=1){
						elems[i].style.width="41%";
						elems[i].style.height="auto";
						elems[i].style.marginLeft="6%";
						elems[i].style.marginTop="50px"
					}
				}
			}
		</script>
        <img class="banner" src="_pgdat/banner.png" />
        <br />
        <div class="wrap">
        	<a class="link" href="/red/index.php"><img class="lpic" src="_pgdat/ehp.png" alt="eHomePage" /></a>
        	<a class="link" href="http://dev.bukkit.org/bukkit-plugins/MineJobs"><img class="lpic" src="_pgdat/MineJobs.png" alt="Project MineJobs" /></a>
        	<a class="link" href="/sb/index.php"><img class="lpic" src="_pgdat/sbtemp.png" alt="SpaceCP" /></a>
        	<a class="link" href="/owncloud/index.php"><img class="lpic" src="_pgdat/owncloud.png" alt="OwnCloud" /></a>
        	<a class="link" href="/phpma"><img class="lpic" src="_pgdat/phpma.png" alt="PHPMyAdmin" /></a>
        	<a class="link" href="/red/codes.php"><img class="lpic" src="_pgdat/lock.png" alt="Server Access Codes" /></a>
		</div>
    </body>
</html>
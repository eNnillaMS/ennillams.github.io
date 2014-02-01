<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="../pgdat/favicon.ico" type="" rel="shortcut icon" />
        <link rel="stylesheet" href="pgdat/scrollNav.css" type="text/css" />
        <?php
			date_default_timezone_set('America/Vancouver');
			if (date('G') >= 21 || date('G') < 3){
				echo '<link rel="stylesheet" href="pgdat/Night/Night.css" type="text/css" />';
			} else if (date('G') >= 3 && date('G') < 9){
				echo '<link rel="stylesheet" href="pgdat/Morning/Morning.css" type="text/css" />';
			} else if (date('G') >= 9 && date('G') < 15){
				echo '<link rel="stylesheet" href="pgdat/Day/Day.css" type="text/css" />';
			} else if (date('G') >= 15 && date('G') < 21){
				echo '<link rel="stylesheet" href="pgdat/Dusk/Dusk.css" type="text/css" />';
			}
		?>
        <title>THISISTHEPAGETITLE</title>
        <script src="pgdat/mobile-detect.js" type="text/javascript"></script>
        <script src="Scripts/swfobject_modified.js" type="text/javascript"></script>
        <script type="text/javascript">
			function posY(elm) {
				var test = elm, top = 0;
				while(!!test && test.tagName.toLowerCase() !== "body") {
					top += test.offsetTop;
					test = test.offsetParent;
				}
				return top;
			}
			function viewPortHeight() {
				var de = document.documentElement;
				if(!!window.innerWidth)
				{ return window.innerHeight; }
				else if( de && !isNaN(de.clientHeight) )
				{ return de.clientHeight; }
				return 0;
			}
			function scrollY() {
				if( window.pageYOffset ) { return window.pageYOffset; }
				return Math.max(document.documentElement.scrollTop, document.body.scrollTop);
			}
			function checkvisible( elm ) {
				var vpH = viewPortHeight(), // Viewport Height
					st = scrollY(), // Scroll Top
					y = posY(elm),
					h = elm.offsetHeight;
				return ((st < y && y < st+vpH) || (st < y+h && y+h < st+vpH));
			}
			window.onscroll = function(){
                if (!checkvisible(document.getElementById("Header"))){
                    document.getElementById("ScrollNav").innerHTML = "<?php require "scrollNav.php"; ?>";
                } else {
                    document.getElementById("ScrollNav").innerHTML = "";
                }
            };
        </script>
    </head>
	<body>
		<div id="Header">
        	<div class="o1"></div>
        	<div class="o2">
        		<div class="i1"></div>
        		<div class="i2">
                	<a href="index.php">
                         <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="100%" height="100%" id="FlashID" title="Header">
                            <param name="movie" value="pgdat/Header.swf" />
                            <param name="quality" value="high" />
                            <param name="wmode" value="opaque" />
                            <param name="swfversion" value="9.0.115.0" />
                            <param name="scale" value="exactfit" />
                            <!-- This param tag prompts users with Flash Player 6.0 r65 and higher to download the latest version of Flash Player. Delete it if you don’t want users to see the prompt. -->
                            <param name="expressinstall" value="Scripts/expressInstall.swf" />
                            <!-- Next object tag is for non-IE browsers. So hide it from IE using IECC. -->
                            <!--[if !IE]>-->
                            <object type="application/x-shockwave-flash" data="pgdat/Header.swf" width="100%" height="100%">
                            <!--<![endif]-->
                                <param name="quality" value="high" />
                                <param name="wmode" value="opaque" />
                                <param name="swfversion" value="9.0.115.0" />
                                <param name="scale" value="exactfit" />
                                <param name="expressinstall" value="Scripts/expressInstall.swf" />
                                <!-- The browser displays the following alternative content for users with Flash Player 6.0 and older. -->
                                <div>
                                    <img src="pgdat/Header.gif" alt="HeaderGif" height="100%" width="100%" />
                                </div>
                            <!--[if !IE]>-->
                            </object>
                            <!--<![endif]-->
                        </object>
                    </a>
                </div>
        		<div class="i3"></div>
            	<div class="directory">
            		<a href="index.php">Home</a>
            		<a href="journal.php">Journal</a>
            		<a href="projects.php">Projects</a>
            		<a href="http://www.youtube.com/user/eNnillaGotBored" style="float:right"><img src="pgdat/youtube.png" /></a>
            		<a href="https://twitter.com/King_eNnilla" style="float:right"><img src="pgdat/twitter.png" /></a>
            		<a href="https://www.facebook.com/AnonyD3RP612" style="float:right"><img src="pgdat/facebook.png" /></a>
            		<a href="http://dev.bukkit.org/profiles/eNnillaMS/bukkit-plugins/" style="float:right">BukkitDev</a>
            		<a href="../index.php" style="float:right">Main Portal</a>
            	</div>
            </div>
        	<div class="o3"></div>
		</div>
    	<div id="ScrollNav"></div>
        <script type="text/javascript">
			swfobject.registerObject("FlashID");
		</script>
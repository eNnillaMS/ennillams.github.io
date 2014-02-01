<?php
	session_start();
	$link = mysqli_connect("localhost", "root", "Hz88329857", "Web_Main", "3306");
	
	if (isset($_POST['submit'])){
		if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == 1){
			unset($_SESSION['loggedIn']);
			unset($_SESSION['username']);
			unset($_SESSION['userPrivs']);
			session_destroy();
			if (isset($_GET['return'])){
				header("location:" . $_GET['return'] . ".php");
			} else {
				header("location:index.php");
			}
		} else $FAIL = "yeahno";
	}
	
	ob_start();
	require "_pgdat/header.php";
	$header = ob_get_clean();
	echo preg_replace("{THISISTHEPAGETITLE}", "Logout - eHP", $header);
	
	echo '  <div id="Column">';
	//Column parts in here -=-=-=     require "col_PART.php";
	require "_pgdat/col_login.php";
	echo '  </div>';
    
	if(isset($_POST['submit'])){
		if (isset($FAIL)){
			echo '	<div id="Body">
						<div class="article">
							<div class="artTop"><br /></div>
							<div class="art">
								Error
								<div class="bTop"><br /></div>
								<div class="bMain">
									You aren\'t even logged in!
								</div>
								<div class="bBot"><br /></div>
								<div class="artFoot">
								</div>
							</div>
							<div class="artBot"><br /></div>
						</div>
					</div>';
		}
	} else {
		echo '	<div id="Body">
					<div class="article">
						<div class="artTop"><br /></div>
						<div class="art">
							Logout?
							<div class="bTop"><br /></div>
							<div class="bMain">
								Do you really want to logout?
								<form action="logout.php" method="POST">
									<input type="submit" name="submit" value="Yeah, I do." />
								</form>
							</div>
							<div class="bBot"><br /></div>
							<div class="artFoot">
							</div>
						</div>
						<div class="artBot"><br /></div>
					</div>
				</div>';
	}
	
	require "_pgdat/footer.php";
    mysqli_close($link);
?>
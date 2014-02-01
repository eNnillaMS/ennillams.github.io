<?php
	session_start();
	$link = mysqli_connect("localhost", "root", "", "Web_Main", "3306");
	
	if (isset($_POST['submit'])){
		$FAIL = "";
		$success = false;
		if (!empty($_POST['username']) && !empty($_POST['password'])){
			require_once "pgdat/parser.php";
			$parser = new parser;
			$username = mysqli_real_escape_string($link, $parser->p($_POST['username'], 1));
			$query = mysqli_query($link, "SELECT * FROM usersList WHERE username='$username'");
			if (mysqli_num_rows($query) > 0){
				while ($row = mysqli_fetch_assoc($query)){
					$password = md5($_POST['password']);
					if ($password == $row['password']){
						$_SESSION['loggedIn'] = 1;
						$_SESSION['username'] = $row['username'];
						$_SESSION['userPrivs'] = $row['perms'];
						$success = true;
					} else $FAIL .= "Incorrect Password!!<br />";
				}
			} else $FAIL .= "User not found in database!<br />";
		}
	}
	
	ob_start();
	require "pgdat/header.php";
	$header = ob_get_clean();
	echo preg_replace("{THISISTHEPAGETITLE}", "Login - eHP", $header);
	
	echo '  <div id="Column">';
	//Column parts in here -=-=-=     require "col_PART.php";
	require "pgdat/col_login.php";
	echo '  </div>';
    
	if ($success == true){
		/*if (isset($_GET['return'])){
			header("location:" . $_GET['return'] . ".php");
		} else {
			header("location:index.php");
		}*/
	} else {
		echo '	<div id="Body">
			<div class="article">
				<div class="artTop"><br /></div>
				<div class="art">
					Login
					<div class="bTop"><br /></div>
					<div class="bMain">
						' . $FAIL . '
						<form action="login.php" method="POST">
							<input type="text" name="username" placeholder="UserName" style="width:100%;text-align:center;" />
							<input type="password" name="password" placeholder="Password" style="width:100%;text-align:center;" />
							<input type="submit" name="submit" value="Submit" style="width:100%;" />
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
		
	require "pgdat/footer.php";
    mysqli_close($link);
?>
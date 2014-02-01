<?php
	session_start();
	$link = mysqli_connect("localhost", "root", "Hz88329857", "Web_Main", "3306");
	
	$name = "";
	$username = "";
	$email = "";
	$email1 = "";
	$FAIL = "";
	$success = false;
	if (isset($_POST['submit'])){
		if (!isset($_SESSION['loggedIn'])){
			require_once "pgdat/parser.php";
			$parser = new parser;
			$username = mysqli_real_escape_string($link, $parser->p($_POST['username'], 1));
			if (!empty($username)){
				if (strlen($username) <= 512){
					$pass = $_POST['password'];
					$pass1 = $_POST['password1'];
					if (!empty($pass) && !empty($pass1)){
						if ($pass == $pass1) {
							$password = md5($pass);
							$email = mysqli_real_escape_string($link, $parser->p($_POST['email'], 1));
							$email1 = mysqli_real_escape_string($link, $parser->p($_POST['email1'], 1));
							if (!empty($email) && !empty($email1)){
								if ($email == $email1) {
									$name = mysqli_real_escape_string($link, $parser->p($_POST['name'], 1));
									$query = mysqli_query($link, "SELECT * FROM usersList WHERE username='$username'");
									if (mysqli_num_rows($query) <= 0){
										if ($query = mysqli_query($link, "INSERT INTO usersList VALUES ('', '$username', '$password', '$email', '$name', '1')")){
											$success = true;
										} else $FAIL .= "User info upload failed! Please try again! " . mysqli_error($link) . "<br />";
									} else $FAIL .= "Username has already been registered! Please choose another!<br />";
								} else $FAIL .= "Emails do not match.<br />";
							} else $FAIL .= "You must fill out <strong>both</strong> email fields!<br />";
						} else $FAIL .= "Passwords do not match.<br />";
					} else $FAIL .= "You must fill out <strong>both</strong> password fields!<br />";
				} else $FAIL .= "UserName must be less than 512 characters!<br />";
			} else $FAIL .= "You must have a UserName!<br />";
		} else $FAIL .= "You're already logged in! You don't need a new account!<br />";
	}
	
	ob_start();
	require "pgdat/header.php";
	$header = ob_get_clean();
	echo preg_replace("{THISISTHEPAGETITLE}", "Register - eHP", $header);
	
	echo '  <div id="Column">';
	//Column parts in here -=-=-=     require "col_PART.php";
	require "pgdat/col_login.php";
	echo '  </div>';
    
	if ($success == true){
		echo '	<div id="Body">
					<div class="article">
						<div class="artTop"><br /></div>
						<div class="art">
							Welcome!
							<div class="bTop"><br /></div>
							<div class="bMain">
								<form action="register.php" method="POST">
									Your registration was successful!
									//REDIRECT
								</form>
							</div>
							<div class="bBot"><br /></div>
							<div class="artFoot">
							</div>
						</div>
						<div class="artBot"><br /></div>
					</div>
				</div>';
	} else {
		echo '	<div id="Body">
					<div class="article">
						<div class="artTop"><br /></div>
						<div class="art">
							Register
							<div class="bTop"><br /></div>
							<div class="bMain">
								<form action="register.php" method="POST">
									' . $FAIL . '
									<input type="text" name="name" placeholder="Full Name" value="'.$name.'" style="width:100%;text-align:center;font-size:18px;" />
									<input type="text" name="username" placeholder="UserName" value="'.$username.'" style="width:100%;text-align:center;font-size:18px;" />
									<input type="password" name="password" placeholder="Password" style="width:100%;text-align:center;font-size:18px;" />
									<input type="password" name="password1" placeholder="Password again" style="width:100%;text-align:center;font-size:18px;" />
									<input type="email" name="email" placeholder="eMail" value="'.$email.'" style="width:100%;text-align:center;font-size:18px;" />
									<input type="email" name="email1" placeholder="eMail again" value="'.$email1.'" style="width:100%;text-align:center;font-size:18px;" />
									<br /><br />
									<input type="submit" name="submit" value="Submit" style="width:100%;height:30px;text-align:center;font-size:18px;" />
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
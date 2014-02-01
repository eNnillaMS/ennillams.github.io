<?php
$pgnm = preg_replace("{.php}", "", basename($_SERVER['PHP_SELF']));
if (!isset($_SESSION['loggedIn'])){
	echo '
		<div class="object">
			<div class="objTop"><br /></div>
			<div class="obj">
				Login
				<div class="inTop"><br /></div>
				<div class="inMain">
					<form action="login.php?return='.$pgnm.'" method="POST">
						<input type="text" name="username" placeholder="UserName" style="width:100%;text-align:center;" />
						<input type="password" name="password" placeholder="Password" style="width:100%;text-align:center;" />
						<input type="submit" name="submit" value="Login" style="width:100%;" />
					</form>
					<form action="register.php">
						<input type="submit" value="Register" style="width:100%;" />
					</form>
				</div>
				<div class="inBot"><br /></div>
				<div class="objFoot">
				</div>
			</div>
			<div class="objBot"><br /></div>
		</div>
	';
} else {
	echo '
		<div class="object">
			<div class="objTop"><br /></div>
			<div class="obj">
				Welcome!
				<div class="inTop"><br /></div>
				<div class="inMain">
					To make a new news article, <a href="newNews.php">Click Here.</a><br />
					To make a new journal entry, <a href="newJournal.php">Click Here.</a>
					<form action="logout.php?return='.$pgnm.'" method="POST">
						<input type="submit" name="submit" value="Logout" style="width:100%;" />
					</form>
				</div>
				<div class="inBot"><br /></div>
				<div class="objFoot">
				</div>
			</div>
			<div class="objBot"><br /></div>
		</div>
	';
}

?>
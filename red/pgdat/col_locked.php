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
					<form action="codes.php" method="POST">
						<input type="password" name="pass1" placeholder="Passcode 1 (older)" style="width:100%;text-align:center;" />
						<input type="password" name="pass2" placeholder="Passcode 2 (failed)" style="width:100%;text-align:center;" />
						<input type="password" name="pass3" placeholder="Passcode 3 (latest)" style="width:100%;text-align:center;" />
						<input type="password" name="pass4" placeholder="Passcode 4 (eventname)" style="width:100%;text-align:center;" />
						<input type="password" name="pass5" placeholder="Passcode 5 (ourname)" style="width:100%;text-align:center;" />
						<input type="submit" name="submit" value="Unlock" style="width:100%;" />
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
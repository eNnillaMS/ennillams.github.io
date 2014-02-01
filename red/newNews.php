<?php
	session_start();
	$link = mysqli_connect("localhost", "root", "Hz88329857", "Web_Main", "3306");
	
	$postErr = "";
	$parsedTitle = "";
	$parsedContent = "";
	$success = false;
	if (isset($_POST['submit'])){
		if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == 1 && $_SESSION['userPrivs'] >= 2){
			require_once "_pgdat/parser.php";
			$parser = new parser;
			date_default_timezone_set('America/Vancouver');
			$title = $_POST['title'];
			$content = $_POST['content'];
			$parsedTitle = mysqli_real_escape_string($link, $parser->p($title, 1));
			$parsedContent = mysqli_real_escape_string($link, $parser->p($content, 0));
			$date = date('F d, Y');
			$time = date('h:i:s a');
			$creator = $_SESSION['username'];
			if (strlen($parsedContent) <= 1000000){
				if (strlen($parsedTitle) <= 512){
					if ($query = mysqli_query($link, "INSERT INTO newsFeed VALUES ('', '$parsedTitle', '$parsedContent', '$creator', '$date', '$time')")){
						$success = true;
					} else $postErr .= "Pushing the article to the server failed! Please try again! " + mysqli_error($link) + "<br />";
				} else $postErr .= "Your title is too long!";
			} else $postErr .= "There's too much content!<br />";
		} else $postErr .= "You don't have permission to create a new news article!<br />";
	}

	ob_start();
	require "_pgdat/header.php";
	$header = ob_get_clean();
	echo preg_replace("{THISISTHEPAGETITLE}", "New News Article - eHP", $header);
	
	echo '  <div id="Column">';
	//Column parts in here -=-=-=     require "col_PART.php";
	require "_pgdat/col_login.php";
	echo '  </div>';
	
	echo '	<div id="Body">';
	if ($postErr != ""){
		echo '	<div class="article">
					<div class="artTop"><br /></div>
					<div class="art">
						Error!
						<div class="bTop"><br /></div>
						<div class="bMain">
							' . $postErr . '
						</div>
						<div class="bBot"><br /></div>
						<div class="artFoot">
						</div>
					</div>
					<div class="artBot"><br /></div>
				</div>';
	} elseif ($success == true){
		echo '	<div class="article">
					<div class="artTop"><br /></div>
					<div class="art">
						Success!
						<div class="bTop"><br /></div>
						<div class="bMain">
							Your article has been successfully posted!<br />
							<a href="index.php">Click here to see it on the homepage!</a><br />
							<a href="viewNews.php">Click here to see it on its own page!</a><br />
						</div>
						<div class="bBot"><br /></div>
						<div class="artFoot">
						</div>
					</div>
					<div class="artBot"><br /></div>
				</div>';
	} elseif (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] != 1 || $_SESSION['userPrivs'] < 2){
		echo '	<div class="article">
					<div class="artTop"><br /></div>
					<div class="art">
						Error!
						<div class="bTop"><br /></div>
						<div class="bMain">
							You don\'t have permission to see this page!
						</div>
						<div class="bBot"><br /></div>
						<div class="artFoot">
						</div>
					</div>
					<div class="artBot"><br /></div>
				</div>';
	} else {
		echo '	<div class="article"><form method="POST" action="newNews.php">
					<div class="artTop"><br /></div>
					<div class="art">
						<input type="text" name="title" placeholder="Article Title" value="' . $parsedTitle . '" style="width:85%;text-align:center;" />
						<div class="bTop"><br /></div>
						<div class="bMain">
							<textarea name="content" placeholder="Article content should go in here." wrap="soft" rows="30">' . $parsedContent . '</textarea>
							<input type="submit" name="submit" value="Submit" />
						</div>
						<div class="bBot"><br /></div>
						<div class="artFoot">
						</div>
					</div>
					<div class="artBot"><br /></div>
				</form></div>';
	}
	echo '  </div>';
	
	require "_pgdat/footer.php";
    mysqli_close($link);
?>
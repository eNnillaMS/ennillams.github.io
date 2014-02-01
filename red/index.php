<?php
	session_start();
	$link = mysqli_connect("localhost", "root", "", "Web_Main", "3306");
	
	ob_start();
	require "pgdat/header.php";
	$header = ob_get_clean();
	echo preg_replace("{THISISTHEPAGETITLE}", "eNnilla's Homepage", $header);
	
	echo '  <div id="Column">';
	//Column parts in here -=-=-=     require "col_PART.php";
	require "pgdat/col_login.php";
	echo '  </div>';
    
	echo '	<div id="Body">';
	$query = mysqli_query($link, "SELECT * FROM newsFeed ORDER BY id DESC");
	require_once "pgdat/parser.php";
	$parser = new parser;
	while ($row = mysqli_fetch_assoc($query)){
		echo '
				<div class="article">
					<div class="artTop"><br /></div>
					<div class="art">
						' . $row['title'] . '
						<div class="bTop"><br /></div>
						<div class="bMain">
							' . $parser->p($row['content'], 2) . '
						</div>
						<div class="bBot"><br /></div>
						<div class="artFoot">
							Created by ' . $row['creator'] . ' at ' . $row['time'] . ' on ' . $row['date'] . '.
						</div>
					</div>
					<div class="artBot"><br /></div>
				</div>
		';
	}
				
	echo '  </div>';
	
	require "pgdat/footer.php";
	mysqli_close($link);
	/* To-Do and Notes:
		- Test news posting system AFTER making the parser and the login / register / logout system
		- Add success pages with nav timers on login / logout / register pages.
		- Add " die(); " after all the Header Redirects.
	*/
	
?>
<?php
	session_start();
	$link = mysqli_connect("localhost", "root", "Hz88329857", "Web_Main", "3306");
	
	ob_start();
	require "_pgdat/header.php";
	$header = ob_get_clean();
	echo preg_replace("{THISISTHEPAGETITLE}", "Heath's Journals - eHP", $header);
	
	echo '  <div id="Column">';
	//Column parts in here -=-=-=     require "_pgdat/col_PART.php";
	require "_pgdat/col_login.php";
	echo '  </div>';
    
	echo '	<div id="Body">';
	$query = mysqli_query($link, "SELECT * FROM journals ORDER BY id DESC");
	require_once "_pgdat/parser.php";
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
							Created by eNnillaMS at ' . $row['time'] . ' on ' . $row['date'] . '.
						</div>
					</div>
					<div class="artBot"><br /></div>
				</div>
		';
	}
				
	echo '  </div>';
	
	require "_pgdat/footer.php";
	mysqli_close($link);
?>
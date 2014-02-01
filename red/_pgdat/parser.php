<?php
	class parser {
		function __construct() {}
		private $bbc = array(
			1	=> '====',
			2	=> '====',
			3	=> '===',
			4	=> '===',
			5	=> '==',
			6	=> '==',
			7	=> '**',
			8	=> '**',
			9	=> '//',
			10	=> '//',
			11	=> '__',
			12	=> '__',
			13	=> '--',
			14	=> '--',
			15	=> '[b]',
			16	=> '[/b]',
			17	=> '[i]',
			18	=> '[/i]',
			19	=> '[u]',
			20	=> '[/u]',
			21	=> '[s]',
			22	=> '[/s]',
			23	=> '[list]',
			24	=> '[/list]',
			25	=> '[olist]',
			26	=> '[/olist]',
			27	=> '[*]',
			28	=> '[/*]'
			);
		private $rep = array(
			1	=> '<h3>',
			2	=> '</h3>',
			3	=> '<h2>',
			4	=> '</h2>',
			5	=> '<h1>',
			6	=> '</h1>',
			7	=> '<strong>',
			8	=> '</strong>',
			9	=> '<em>',
			10	=> '</em>',
			11	=> '<u>',
			12	=> '</u>',
			13	=> '<del>',
			14	=> '</del>',
			15	=> '<strong>',
			16	=> '</strong>',
			17	=> '<em>',
			18	=> '</em>',
			19	=> '<u>',
			20	=> '</u>',
			21	=> '<del>',
			22	=> '</del>',
			23	=> '<ul>',
			24	=> '</ul>',
			25	=> '<ol>',
			26	=> '</ol>',
			27	=> '<li>',
			28	=> '</li>'
			);
		private $spec = array(
			'\[\[(.*)\|"(.*)"\]\]' 						=> '<a href="$1">$2</a>',
			'\[\[(.*)\]\]' 								=> '<a href="$1">$1</a>',
			'\-\-\-\-' 									=> '<hr />',
			'\{\{(.*)\|"(.*)"\|"(.*)"\|"(.*)"\}\}' 		=> '<img src="$1" width="$2" height="$3" alt="$4" />',
			'\{\{(.*)\|"(.*)"\|"(.*)"\}\}' 				=> '<img src="$1" height="$2" alt="$3" />',
			'\{\{(.*)\|"(.*)"\}\}' 						=> '<img src="$1" alt="$2" />',
			'\{\{(.*)\}\}' 								=> '<img src="$1" />',
			'\{\{\{(.*)\}\}\}'							=> '<pre>$1</pre>'
			);
			/*
			{{http://www.w3schools.com/images/tryitimg.gif}}<br />
			{{http://www.w3schools.com/images/tryitimg.gif|&quot;testing1&quot;}}<br />
			{{http://www.w3schools.com/images/tryitimg.gif|&quot;128px&quot;|&quot;testing2&quot;}}<br />
			{{http://www.w3schools.com/images/tryitimg.gif|&quot;256px&quot;|&quot;128px&quot;|&quot;testing3&quot;}}
			*/
		private $safe = array(
			'&lt;a href\="(.*)"&gt;(.*)&lt;\/a&gt;'												=> '<a href="$1">$2</a>',
			'&lt;abbr title\="(.*)"&gt;(.*)&lt;\/abbr&gt;'										=> '<abbr title="$1">$2</abbr>',
			'&lt;b&gt;(.*)&lt;\/b&gt;'															=> '<b>$1</b>',
			'&lt;big&gt;(.*)&lt;\/big&gt;'														=> '<big>$1</big>',
			'&lt;blockquote( cite\=".*"|)&gt;(.*)&lt;\/blockquote&gt;'							=> '<blockquote$1>$2</blockquote>',
			'&lt;caption&gt;(.*)&lt;\/caption&gt;'												=> '<caption>$1</caption>',
			'&lt;code&gt;(.*)&lt;\/code&gt;'													=> '<code>$1</code>',
			'&lt;dd&gt;(.*)&lt;\/dd&gt;'														=> '<dd>$1</dd>',
			'&lt;del&gt;(.*)&lt;\/del&gt;'														=> '<del>$1</del>',
			'&lt;dl&gt;(.*)&lt;\/dl&gt;'														=> '<dl>$1</dl>',
			'&lt;dt&gt;(.*)&lt;\/dt&gt;'														=> '<dt>$1</dt>',
			'&lt;em&gt;(.*)&lt;\/em&gt;'														=> '<em>$1</em>',
			'&lt;h1&gt;(.*)&lt;\/h1&gt;'														=> '<h1>$1</h1>',
			'&lt;h2&gt;(.*)&lt;\/h2&gt;'														=> '<h2>$1</h2>',
			'&lt;h3&gt;(.*)&lt;\/h3&gt;'														=> '<h3>$1</h3>',
			'&lt;hr( \/|\/|)&gt;'																=> '<hr$1>',
			'&lt;i&gt;(.*)&lt;\/i&gt;'															=> '<i>$1</i>',
			'&lt;img( src\=".*"|)( alt\=".*"|)( title\=".*"|)( \/|)&gt;'						=> '<img$1$2$3$4>',
			'&lt;li&gt;(.*)&lt;\/li&gt;'														=> '<li>$1</li>',
			'&lt;ol&gt;(.*)&lt;\/ol&gt;'														=> '<ol>$1</ol>',
			'&lt;p&gt;(.*)&lt;\/p&gt;'															=> '<p>$1</p>',
			'&lt;pre&gt;(.*)&lt;\/pre&gt;'														=> '<pre>$1</pre>',
			'&lt;s&gt;(.*)&lt;\/s&gt;'															=> '<s>$1</s>',
			'&lt;small&gt;(.*)&lt;\/small&gt;'													=> '<small>$1</small>',
			'&lt;strike&gt;(.*)&lt;\/strike&gt;'												=> '<strike>$1</strike>',
			'&lt;strong&gt;(.*)&lt;\/strong&gt;'												=> '<strong>$1</strong>',
			'&lt;sub&gt;(.*)&lt;\/sub&gt;'														=> '<sub>$1</sub>',
			'&lt;sup&gt;(.*)&lt;\/sup&gt;'														=> '<sup>$1</sup>',
			'&lt;table&gt;(.*)&lt;\/table&gt;'													=> '<table>$1</table>',
			'&lt;tbody&gt;(.*)&lt;\/tbody&gt;'													=> '<tbody>$1</tbody>',
			'&lt;td( colspan\=".*|)( rowspan\=".*|)&gt;(.*)&lt;\/td&gt;'						=> '<td$1$2>$3</td>',
			'&lt;tfoot&gt;(.*)&lt;\/tfoot&gt;'													=> '<tfoot>$1</tfoot>',
			'&lt;th( colspan\=".*|)( rowspan\=".*|)&gt;(.*)&lt;\/th&gt;'						=> '<th$1$2>$3</th>',
			'&lt;thead&gt;(.*)&lt;\/thead&gt;'													=> '<thead>$1</thead>',
			'&lt;tr&gt;(.*)&lt;\/tr&gt;'														=> '<tr>$1</tr>',
			'&lt;ul&gt;(.*)&lt;\/ul&gt;'														=> '<ul>$1</ul>',
			);
		public function p ($string, $IO){
			if ($IO == 0){
				//Compact into single string.
				$s = (string) $string;
				
				//Cleanup quotes and tags.
				$s = htmlentities($s, ENT_QUOTES, 'UTF-8');
				
				//Replace linebreaks
				$s = preg_replace('#&lt;br( \/|\/|)&gt;#Ui', NULL, $s);
				$s = nl2br($s);
				$s = str_replace('\\\\', '<br />', $s);
				$lineBreaks = array(
				0 => array('<code style="white-space: pre;">', '</code>'),
				1 => array('<ul style="list-style-type: square;">', '</ul>'),
				2 => array('<ol style="list-style-type: decimal;">', '</ol>'));
				foreach ($lineBreaks as $lbArray) {
					$lb1 = $lbArray[0];
					$lb2 = $lbArray[1];
					$lb1Quoted = preg_quote($lb1, '#');
					$lb2Quoted = preg_quote($lb2, '#');
					$lbNeedle = "#" . $lb1Quoted . "(.+?)" . $lb2Quoted . "#sie";
					$s = preg_replace($lbNeedle, "'" . $lb1 . "'.str_replace('<br />', '', str_replace('\\\"', '\"', '$1')).'".$lb2."'", $s);
					$s = preg_replace("#\<br \/\>(\r\n)" . $lb1Quoted . "#i", "\n" . $lb1, $s);
					$s = preg_replace("#" . $lb2Quoted . "\<br \/\>#i", $lb2, $s);
					$s = preg_replace("#" . $lb2Quoted . "(\r\n)\<br \/\>#i", $lb2, $s);
				}
				$s = str_replace('</blockquote><br />', '</blockquote>' . "\n", $s);
				$s = str_replace('<br />' . "\r\n" . '<blockquote>', "\n" . '<blockquote>', $s);
				$s = preg_replace('#\/\.\/\<br \/\>#', '', $s);
				$s = preg_replace('#\<br \/\>\/\.\/#', '', $s);
				$s = preg_replace('#\/\.\/#', '', $s);
				
				return $s;
			} elseif ($IO == 1){
				$s = (string) $string;
				$s = htmlentities($s, ENT_QUOTES, 'UTF-8');
				return $s;
			} elseif ($IO == 2){
				$bbc = $this->bbc;
				$rep = $this->rep;
				$spec = $this->spec;
				$safe = $this->safe;
				$s = (string) $string;
				$s = str_replace("&quot;", "\"", $s);
				
				//Handle the Single Tags from spec
				foreach ($spec as $Sneedle => $Srep){
					$s = preg_replace("#" . $Sneedle . "#Uis", $Srep, $s);
				}
				
				//Handle the Doubled Tags from bbc and rep
				for ($i = 1; $i <= count($bbc); $i++) {
					$s = preg_replace("#" . preg_quote($bbc[$i], '#') . "(.*)" . preg_quote($bbc[$i+1], '#') . "#Uis", 
					$rep[$i] . "$1" . $rep[$i+1], $s);
					$i += 1;
				}
				
				//Handle the Safe Tags from safe
				foreach ($safe as $sNeed => $sRep){
					$s = preg_replace("#" . $sNeed . "#Uis", $sRep, $s);
				}
				
				//Fix HTTP signs because they keep changing into italics.
				$s = preg_replace("{http\:(\<em\>|\<\/em\>)}", "http://", $s);
				
				return $s;
			}
		}
	}
?>
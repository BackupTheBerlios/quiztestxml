<?php

/**
 * style/zwei/seite.php  -- lädt Seitenrand mit zwei flash
 *
 * Copyright (c) 2003 Team krausi,sepp,stefan  
 *
 * Licensed under the GNU GPL. For full terms see the file COPYING. 
 *
 * Date: Don Jun 26 14:46:25 CEST 2003
 *
 */
?>

<html>
<head>
<meta name="author" content="Team krausi,sepp,stefan">
</head>
<body bgcolor="<?PHP echo $colors[bg1]; ?>">

<div valign="middle" align="center">
	<table cellspacing="5" height="100%">
<?php
	for( $x=0;$x<2;++$x){
		echo "<tr><td align=\"center\">";
		echo <<<EOT
<OBJECT CLASSID="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
 CODEBASE="http://active.macromedia.com/flash2/cabs/swflash.cab#version=4,0,0,0"
 ID="Fragezeichen" WIDTH="60" HEIGHT="60">
 <PARAM NAME=movie VALUE="Fragezeichen.swf">
 <PARAM NAME=quality VALUE=high>
 <PARAM NAME=bgcolor VALUE="$colors[bg1]">
<EMBED SRC="style/$style/flash/fragezeichen.swf" QUALITY=high BGCOLOR="$colors[bg1]" WIDTH="60" HEIGHT="60" TYPE="application/x-shockwave-flash" PLUGINSPAGE="http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash"> </EMBED>
</OBJECT>		
EOT;
		echo "</td></tr>";
	}
?>
	</table>
</div>

</body>
</html>
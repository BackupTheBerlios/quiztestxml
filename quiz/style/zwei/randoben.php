<?php

echo <<<EOT
<html>
<head>
<meta name="author" content="krausi">
</head>
<body bgcolor="$colors[bg1]">
<div align="center">
<OBJECT CLASSID="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
 CODEBASE="http://active.macromedia.com/flash2/cabs/swflash.cab#version=4,0,0,0"
 ID="headani" WIDTH="550" HEIGHT="60">
 <PARAM NAME="movie" VALUE="headani.swf">
 <PARAM NAME="quality" VALUE="high">
 <PARAM NAME=bgcolor VALUE="$colors[bg1]">
<EMBED SRC="style/$style/flash/headani.swf" QUALITY="high" BGCOLOR="$colors[bg1]" WIDTH="550" HEIGHT="60" TYPE="application/x-shockwave-flash" PLUGINSPAGE="http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash"> </EMBED>
</OBJECT>
</div>

</body>
</html>

EOT;

?>
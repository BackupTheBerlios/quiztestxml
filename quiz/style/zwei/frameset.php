<?php

/**
 * /style/default/frameset.php  -- unsere Startseite
 *
 * Copyright (c) 2003 Team krausi,sepp,stefan  
 *
 * Licensed under the GNU GPL. For full terms see the file COPYING. 
 *
 */

$noframe = GetMsg("NOFRAME");
$here    = GetMsg("here");

echo <<<EOT
<html>
<head>
<meta name="author" content="krausi">
<title>QUIZ</title>
</head>
<frameset rows="*,357,*" border="0">
 <frame src="randoben.php?style=$style" scrolling="no">
        <frameset cols="*,30,660,30,*" border="0">
                  <frame src="seite.php?style=$style" scrolling="no">
                  <frame src="randl.php?style=$style" scrolling="no">
                         <frameset rows="30,*,30" border="0">
                                   <frame src="rando.php?style=$style" scrolling="no">
                                   <frame src="start.php?style=$style" name="mainframe" border="1">
                                   <frame src="randu.php?style=$style" scrolling="no">
                         </frameset>
                  <frame src="randr.php?style=$style" scrolling="no">
                  <frame src="seite.php?style=$style" scrolling="no">
        </frameset>
 <frame src="rand.php?style=$style" scrolling="no">
</frameset>

<noframe>
</noframe>
<body text="#000000" bgcolor="#FFFFFF">
$noframe
<a href="start.php?style=$style">$here</a>
</body>
</html>

EOT;

?>
<?php

/**
 * style/default/start.php  -- lädt unsere Startseite
 *
 * Copyright (c) 2003 Team krausi,sepp,stefan  
 *
 * Licensed under the GNU GPL. For full terms see the file COPYING. 
 *
 * Date: Don Jun 26 14:40:52 CEST 2003
 */
 
/* 
	
	Sie ist über 2 Parameter beinflussbar.

	$withstylemenu -- wenn wahr, dann Styleauswahl anzeigen
	
	$startaction -- der Name der nächsten Seite (bei Enter)
						 default ist quizmenu.php
					
*/ 

require_once( "./include/optional.php" );

remove_broken_sessions();

$welcome = GetMsg("WELCOME");
$enter   = GetMsg("ENTER");
$stylechose = GetMsg("STYLECHOSE");

if( $withstylemenu ){
	$stylemenu = stylemenu();
}

$start="";
if( $startaction ){
	$start = $startaction;
}
else{
	$start = "quizmenu.php";
}

echo <<<EOT
<html>
<head>
<meta name="author" content="krausi,basti,stefan">
<meta name="GENERATOR" content="ccls">
<title></title>
<style type="text/css">
$css[cssmain]
</style>
</head>
<body background ="style/$style/hggif/hgmain.gif" text="#000000" bgcolor="$colors[bg1]" marginwidth="24" marginheight="24" topmargin="24" leftmargin="24">
<center>
<br>
<table border="0" cellpadding="0" cellspacing="0">
     <colgroup>
        <col width="10">
        <col width="*">
        <col width="10">
     </colgroup>
    <tr>
      <td height="10" background="style/$style/hggif/trol.gif"></td>
      <td height="10" background="style/$style/hggif/tro.gif"></td>
      <td height="10" background="style/$style/hggif/tror.gif"></td>
    </tr>
    <tr>
      <td background="style/$style/hggif/trlr.gif"></td>
      <td>
                   <table cellpadding="0">
                          <tr height="27" >
                           <td height="27" width="137"><center>$welcome
                           <br /><br />
                           $stylechose
                           <br /><br />
                           </center>                          
                           </td>
                          </tr>
                          
                          $stylemenu
                          <tr height="27" >
                           <td height="27" width="137" background="style/$style/hggif/hgti.gif">
                               <div align="center">
                                   <a href="$start?style=$style">$enter</a>
                               </div></td>
                          </tr>
                   </table>

      </td>
      <td background="style/$style/hggif/trrr.gif"></td>
    </tr>
    <tr>
      <td height="10" background="style/$style/hggif/trul.gif"></td>
      <td height="10" background="style/$style/hggif/tru.gif"></td>
      <td height="10" background="style/$style/hggif/trur.gif"></td>
    </tr>
</table>
</body>
</html>
EOT;

?>
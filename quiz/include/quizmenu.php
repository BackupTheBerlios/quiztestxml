<?php

/* 
	quizmenu.php -- Hier wird eine Auswahl der möglichen Quiz dargestellt.
	
  Copyright (c) 2003 Team krausi,sepp,stefan  
 
  Licensed under the GNU GPL. For full terms see the file COPYING. 
  
  Date: Don Jun 26 14:57:04 CEST 2003
 
	Sie ist über 5 Parameter beinflussbar.

	1. $quizfiles -- ein Array mit den zu ladenden XML-Quizdateien.
						  dieser Parameter ist wie die anderen optional
	
	2. $withabstract -- mit Kurzbeschreibung anzeigen
	3. $witheditor -- Editor wird mit angezeigt
	4. $withdate -- Das Erstellungsdatum wird mit angezeigt
	5. $withlanguage -- Sprache wird angezeigt
						 
*/

require_once( "./include/class.quizinfo.php" );
require_once( "./include/optional.php" );

$welcome = GetMsg("WELCOME");
$enter   = GetMsg("ENTER");

	$qf = new quizfile();
	$qf->only_info();
	
	foreach( $quizfiles as $fname ){
		if( $qf->read_quizfile( $fname ) != "ok" ){
			echo "Warnung: Kann $fname nicht korrekt laden.";
		}
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
<div align="center">
                   <table cellpadding="0" cellspacing="0">
                          <tr height="27" >
                           <td height="27" width="137">$welcome</td>
                          </tr>
                  </table>
           </div>
     </td>
     <td background="style/$style/hggif/trrr.gif"></td>
   </tr>
   <tr><td background="style/$style/hggif/trlr.gif"></td>
      <td>
EOT;

	foreach( $qf->get_qsets() as $quiz ){
	
		 $SID   = $quiz->get_ID();
		 $title = $quiz->get_title();
		 $file  = $quiz->get_file();
		 
       // formattabelle
       echo '<div>';
       echo '<table><tr><td>';
       
       echo '<div align="center"><table cellpadding="0" cellspacing="0"><tr height="27" >';
       
       echo "<td height=\"27\" width=\"137\" background=\"style/$style/hggif/hgti.gif\">\n";
       
       echo "<div align=\"center\">";
       echo "<a href=\"quiz.php?style=$style&sid=$SID&file=$file\">$title</a>\n";
                               
       echo "</div></td></tr></table></div></td>";
       echo "</td></tr>";
       
       // now the optional damage
       
       if( $withabstract && $quiz->get_abstract() ){
       		$abstract = wordwrap( $quiz->get_abstract(), 40 , "<br />\n" );
       		echo "<tr><td>$abstract</td><tr>";
       }
       
       if( $withdate && $quiz->get_cdate() ){
       		$cdate = GetMsg( "CREATED", $quiz->get_cdate() );
       		echo "<tr><td>$cdate</td></tr>";
       }
       
       if( $witheditor && count($quiz->get_editors()) ){
       		echo "<tr><td><table>";
       			echo "<tr><td colspan=\"2\">",GetMsg( "EDITORS" ),"</td></tr>\n";
       			foreach( $quiz->get_editors() as $editor ){
       					echo "<tr>";
       					echo "<td>",$editor->get_name(),"</td>";
       					echo "<td>",$editor->get_email(),"</td>";
       					echo "<tr>";
       			}
       		echo "</table></td></tr>";
       }
       
       if( $withlanguage && $quiz->get_language() ){
       		$cdate = GetMsg( "LANGUAGE", GetLanguage($quiz->get_language()) );
       		echo "<tr><td>$cdate</td></tr>";
       }
       // end formattabelle
   	 echo "</table></div>";
   }
   	
   /*
       echo "<tr><td><pre>";
       print_r( $qf );
       echo "</pre></td></tr>";
   */                       
echo <<<EOT

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
<?php

/**
 * style/default/question.php  -- zeigt Frage an
 *
 * Copyright (c) 2003 Team krausi,sepp,stefan  
 *
 * Licensed under the GNU GPL. For full terms see the file COPYING. 
 *
 * Date:Fre Jun 27 13:09:18 CEST 2003
 *
 */       
 
 $END=GetMsg( "ENDSITE" );
 
echo <<<EOT
	  <br />
	  <div align="center">
	  <table cellpadding="0" cellspacing="0">
	  <tr>
	  <td width="137" height="27" class="kasten" style="background-image:url(style/$style/hggif/hgtit.gif); background-repeat:no-repeat">
			<div class="imkasten">
			<a href="end.php?style=$style">$END</a>
			</div>
      </td>  
     </tr></table>
     </div>
     
EOT;

?>


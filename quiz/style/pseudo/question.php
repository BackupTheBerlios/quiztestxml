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
 
$FRAGE = GetMsg( "QUESTION",$fi+1 );
echo <<<EOT
     <table cellpadding="0" cellspacing"0">
        <tr>
           
                      <td width="137" height="27" class="kasten" style="background-image:url(style/$style/hggif/hgti.gif); background-repeat:no-repeat">
								        <div class="imkasten">$FRAGE</div>
            			    </td>             
                   
           
           <td width="27">&nbsp;</td> 
           <td rowspan="2">$QUESTION</td>
        </tr>
        
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        
        <tr>
           <td height="17" colspan="3">&nbsp;</td>
        </tr>
EOT;

?>


<?php

/**
 * style/default/endquestion.php  -- schliesst Frage ab
 *
 * Copyright (c) 2003 Team krausi,sepp,stefan  
 *
 * Licensed under the GNU GPL. For full terms see the file COPYING. 
 *
 * Date:Fre Jun 27 13:09:18 CEST 2003
 *
 */ 
 
$SELECT = "<select name=\"$NAME\" size=\"1\">\n";   
    
for( $zi = 0; $zi < $ACOUNTER; ++$zi ){
		$val = $SINDEX * 100 + $zi;
		$SELECT .= "<option value=\"$val\"> ".($zi+1)." </option>\n";
}
$SELECT.="</select>";
 
echo <<<EOT

                          <tr>
                           <td height="27">
                            <center>
                            $SELECT
                            </center>
                           </td>
                           <td height="27">&nbsp;</td>
                           <td height="27">
                            $TEXT
                           </td>                                                      
                          </tr>

EOT;

?>


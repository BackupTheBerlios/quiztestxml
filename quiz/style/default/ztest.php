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
 
echo <<<EOT

                          <tr>
                           <td height="27">
                            <center>
                            <input type="radio" name="$NAME" value="$INDEX">
                            </center>
                           </td>
                           <td height="27">&nbsp;</td>
                           <td height="27">
                            $TEXT
                           </td>                                                      
                          </tr>

EOT;

?>


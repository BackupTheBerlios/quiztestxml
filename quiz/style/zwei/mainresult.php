<?php

// $richtige $falsche $anzahl

$QCOUNT = GetMsg( "QCOUNT" );
$RCOUNT = GetMsg( "RCOUNT" );
$FCOUNT = GetMsg( "FCOUNT" );

$pr = number_format( $richtige * 100 / $anzahl , 2 );
$pf = number_format( $falsche * 100 / $anzahl , 2 );
$rmsg = GetMsg( "RMRESULT" , $pr );
$fmsg = GetMsg( "FMRESULT" , $pf );
 
echo <<<EOT
						<br />
						<table cellpadding="0" cellspacing="0">
                    <tr>                            

                      <td width="137" height="27" class="kasten" style="background-image:url(style/$style/hggif/hgti.gif); background-repeat:no-repeat">
								        <div class="imkasten">$QCOUNT</div>
            			    </td>                                                                              
                            
                           <td width="27" height="27">&nbsp;</td>
                            <td height="*">
                              <div style="text-align:center; font-weight:bold;">
                              $anzahl
                              </div>
                           </td>
                    </tr>
                    
                    <tr><td colspan="3">&nbsp;</td></tr>
						
                    <tr>                            

                      <td width="137" height="27" class="kasten" style="background-image:url(style/$style/hggif/hgti.gif); background-repeat:no-repeat">
								        <div class="imkasten">$RCOUNT</div>
            			    </td>                                                                              
                            
                           <td width="27" height="27">&nbsp;</td>
                            <td height="*">
                            <div style="text-align:center; font-weight:bold;">
                              $richtige
                              </div>
                              $rmsg
                           </td>
                    </tr>

                    <tr><td colspan="3">&nbsp;</td></tr>
                                        
                    <tr>                            

                      <td width="137" height="27" class="kasten" style="background-image:url(style/$style/hggif/hgti.gif); background-repeat:no-repeat">
								        <div class="imkasten">$FCOUNT</div>
            			    </td>                                                                              
                            
                           <td width="27" height="27">&nbsp;</td>
                            <td height="*">
                             <div style="text-align:center; font-weight:bold;">
                              $falsche
                             </div>
                              $fmsg
                           </td>
                    </tr>
                   </table>
EOT;

?>
<?php


// $MTEXT 


$CORRECT = $MTEXT->correct();

$MCTEXT = $MTEXT->get_input();

$YOURANSWER = GetMsg("YOURANSWER");
$CORRECTANSWER = GetMsg( "CORRECTANSWER");

$OR = GetMsg("OR");
$RIGHTANSWER = implode( $MTEXT->get_answer(), $OR."<br />\n" );
$FULLANSWER = $MTEXT->get_fullanswer();
$FRAGE = GetMsg( "QUESTION" , $NUMMER );
$MFRAGE = $MTEXT->get_question();

echo <<<EOT

							<table cellpadding="0" cellspacing="0">
                          <tr>                            

                      <td width="137" height="27" class="kasten" style="background-image:url(style/$style/hggif/hgti.gif); background-repeat:no-repeat">
								        <div class="imkasten">$FRAGE</div>
            			    </td>                                                                              
                            
                           <td width="27" height="27">&nbsp;</td>
                            <td height="*" rowspan="2">
                              $MFRAGE
                           </td>
                          </tr>
                          
                          <tr>
                           <td>&nbsp;</td><td>&nbsp;</td>
                          </tr>                                                    
                          
                          </tr>
                            <td height="7" colspan="3">&nbsp;</td>
                          </tr>                          

                      <td width="137" height="27" class="kasten" style="background-image:url(style/$style/hggif/hgtit.gif); background-repeat:no-repeat">
								        <div class="imkasten">$YOURANSWER</div>
            			    </td>                           
                            
                           <td width="27" height="27">&nbsp;</td>
                            <td height="*" rowspan="2">
                              $MCTEXT
                           </td>
                          </tr>
                          
                          <tr>
                           <td>&nbsp;</td><td>&nbsp;</td>
                          </tr>                                                    
                          
                          </tr>
                            <td height="7" colspan="3">&nbsp;</td>
                          </tr>                              
                          
                      <td width="137" height="27" class="kasten" style="background-image:url(style/$style/hggif/hgtit.gif); background-repeat:no-repeat">
								        <div class="imkasten">$ISCORRECT</div>
            			    </td>
                      <td width="27">&nbsp;</td>
                      <td>   
                                                

EOT;

if( $CORRECT ){
	EchoMsg( "CORRECT" );
	echo "</td></tr><tr><td width=\"27\" height=\"27\">&nbsp;</td></tr></table>";
}
else{

	EchoMsg( "FALSE" );
	echo <<<EOT
	</td></tr>
                            <tr>
                            <td height="7" colspan="3">&nbsp;</td>
                            </tr>
                            
                            
                            <tr>                            
                      <td width="137" height="27" class="kasten" style="background-image:url(style/$style/hggif/hgtit.gif); background-repeat:no-repeat">
								        <div class="imkasten">$CORRECTANSWER</div>
            			    </td>    
                            
                            <td width="27" height="27">&nbsp;</td>
                            <td height="*" rowspan="2">
                             $RIGHTANSWER 
                           </td>
                          </tr>
                          <tr>
                           <td>&nbsp;</td><td>&nbsp;</td>
                          </tr>
                          <tr>
                            <td height="27" colspan="3">&nbsp;</td>
                          </tr>                           
                                        
EOT;

if( strlen( $FULLANSWER ) ){
	echo "<tr><td colspan=\"3\">";
	echo $FULLANSWER;
	echo "</td></tr>";
} 

	echo "</table>\n";


} 

?>
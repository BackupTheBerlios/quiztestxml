<?php


// $MSORT 

$mso=$MSORT->get_sort();
$kinputs = $MSORT->get_input();

// echo "<pre>";print_r( $MCHOICE );echo "</pre>";

	$correctanswers = array();

	for( $vin=0; $vin < count( $mso ) ; ++$vin ){
		$correctanswers[$mso[$vin]->position()-1] = $mso[$vin]->get_text();
	}
	ksort( $correctanswers );
	$RIGHTANSWER = implode( $correctanswers, "<br />" ); 


$art = array();
for( $vin = 0; $vin < count( $mso ) ; ++$vin ){
	$art[$kinputs[$vin]-1] = $correctanswers[$kinputs[$vin]-1];
} 

ksort( $art );

$CORRECT = $MSORT->correct();
$RIGHTANSWER;

	
$MCTEXT = implode(  $art, "<br />\n" );

$YOURANSWER = GetMsg("YOURANSWER");
$CORRECTANSWER = GetMsg( "CORRECTANSWER");
$ISCORRECT = GetMsg( "ISCORRECT" );
$FRAGE = GetMsg( "QUESTION" , $NUMMER );
$MFRAGE = $MSORT->get_question();

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
                           <td height="*">&nbsp;</td><td height="2">&nbsp;</td>
                          </tr>                                                    
                          
                          </tr>
                            <td height="7" colspan="3">&nbsp;</td>
                          </tr>           
           
           
            <tr>          
           
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
                          
                          <tr>
                            <td height="7" colspan="3">&nbsp;</td>
                          </tr>                          

                          <tr>
                            <td height="27" width="137" class="kasten" background="style/$style/hggif/hgtit.gif">
                              <div class="imkasten">
                              $ISCORRECT
                              </div>
                            </td>
                            <td width="27" height="27">&nbsp;</td>
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
                             <div style="text-align:top; padding=0px; margin:0px; max-height:10px;">
                             $RIGHTANSWER
                             </div> 
                           </td>
                          </tr>
                          <tr>
                           <td>&nbsp;</td><td>&nbsp;</td>
                          </tr>
                          <tr>
                            <td height="27" colspan="3">&nbsp;</td>
                          </tr>                           
  
</table>                                                    
EOT;

} 

?>
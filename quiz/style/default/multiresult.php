<?php


// $MCHOICE 

$mcs=$MCHOICE->get_choice();
// echo "<pre>";print_r( $MCHOICE );echo "</pre>";

$art=array();
$kinputs = $MCHOICE->get_input();

// echo "<pre>";print_r( $kinputs );echo "</pre>";

for( $v = 0; $v < count($kinputs); ++$v ){
	$art[]=$mcs[$kinputs[$v]]->get_text();
}
$CORRECT = $MCHOICE->correct();
$YOURANSWER = GetMsg("YOURANSWER");
$CORRECTANSWER = GetMsg( "CORRECTANSWER");
$ISCORRECT = GetMsg( "ISCORRECT" );
$FRAGE = GetMsg( "QUESTION" , $NUMMER );
$MFRAGE = $MCHOICE->get_question();

if( ! $CORRECT ){
	$correctanswers = array();
	for( $v = 0; $v < count($mcs); ++$v ){
		if( $mcs[$v]->correct() ){
			$correctanswers[] = $mcs[$v]->get_text();
		}
	}
	$RIGHTANSWER = implode( $correctanswers, "<br />" ); 
}
	
$MCTEXT = implode(  $art, "<br />\n" );
if(strlen($MCTEXT)==0){
	$MCTEXT = GetMsg("NOANSWER");
}

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
  
</table>                                                    
EOT;

} 

?>
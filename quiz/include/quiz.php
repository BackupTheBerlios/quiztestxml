<?php

/**
 * include/quiz.php  -- zeigt das Quiz an
 *
 * Copyright (c) 2003 Team krausi,sepp,stefan  
 *
 * Licensed under the GNU GPL. For full terms see the file COPYING. 
 *
 * Date: Fre Jun 27 10:58:39 CEST 2003
 *
 */
 
 require_once( "./include/class.quizinfo.php" );
 require_once( "./include/class.quizsession.php" );
 
 require_once( "./include/class.randomName.php" );
 require_once( "./include/phpshelf.php" );
 
 // Prameter 1 :  $questionspersite
 if( ! ( is_integer($questionspersite) && $questionspersite > 0 ) ){
 	$questionspersite = 1; // defaultvalue
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
      <td>&nbsp;
     </td>
     <td background="style/$style/hggif/trrr.gif"></td>
   </tr>
   <tr><td background="style/$style/hggif/trlr.gif"></td>
      <td>
EOT;

 $sessionid = $_POST['ses'] ? $_POST['ses'] 
                       : ( $_GET['ses'] ? $_GET['ses'] : "" );
                       
 $qindex = $_POST['findex'] ? $_POST['findex']
 							  : ( $_GET['findex'] ? $_GET['findex'] : 0 );
 
 $shelf; // Shelfobjekt
 $sesobj = new quizsession();
 $status = "undef";
 
 // Session fortsetzen
 if( strlen( $sessionid ) ){
 		$shelf =  new Shelve($sessionid,$sessiondir);
 		$sesobj = $shelf->get("session");
 		if( $sesobj ){
			$status = "continue";
		}
		else{
			$status = "fehler";
			EchoMsg( "ERROR2" , $sessionid );
		}
 }
 else{ // Neue Session anlegen
 	$randomname = new randomName();
 	
 	$sessionid = $randomname->get_name(); 

	$shelf = new Shelve( $sessionid , $sessiondir );
 } 
 
 if( ! isset( $xmlfile ) ){
 	$xmlfile = $_POST[file] ? $_POST[file] 
       	                  : ( $_GET[file] ? $_GET[file] 
   	                     : ( $sesobj ? $sesobj->get_file() : "" ) );
}
 if( ! isset( $ID ) ){
 	$ID = $_POST[sid] ? $_POST[sid] 
                     : ( $_GET[sid]  ? $_GET[sid] 
                     : ( $sesobj ? $sesobj->get_ID() : "" ) );                     
}
 
 // Neue Session
 if( $status == "undef" ){

	if( strlen( $xmlfile ) && strlen( $ID ) ){
    
	   $quizfile = new quizfile($xmlfile);
		if( $quizfile->read_quizfile() != "ok" ){
			EchoMsg( "ERROR1", $xmlfile );
			$status="fehler";
		}
		else{
			$questionset = $quizfile->get_questionset($ID);
			if( ! empty( $questionset )){
				$sesobj->set_questionset( $questionset );
				$sesobj->set_file( $xmlfile );
			}
			else{
				EchoMsg( "ERROR3" , $ID );
				$status = "fehler"; 
			}
		}
	}
	else{
		EchoMsg( "ERROR0" );
		$status = "fehler";
	} 			 			
 }

 // Ergebnisse auswerten
 if( $status == "continue" ){
 	$qentries = & $sesobj->get_qentries();
 	if( $qindex >= count( $qentries ) ){
 		$status = "auswertung";
 	}
 	$qindexA = $qindex - $questionspersite;
 	for( $i = 0; $i < $questionspersite; ++$i ){
 		$li = $qindexA + $i;
		
		if( isset( $qentries[$li] )){
			if( $qentries[$li]->get_typ() == "multi" ){
				$qentries[$li]->evaluate_mc( $_POST["_{$li}"] );
			}
			elseif( $qentries[$li]->get_typ() == "test" ){
				$qentries[$li]->evaluate_test( $_POST["_{$li}"] );
			}
			elseif( $qentries[$li]->get_typ() == "text" ){
				$qentries[$li]->evaluate_text( $_POST["_{$li}"] );			
			}
			elseif( $qentries[$li]->get_typ() == "sort" ){
				$qentries[$li]->evaluate_sort( $_POST["_{$li}"] );
			}
		} 				
 	}		
 }
 
 // echo "<pre>";print_r( $_POST ); echo "</pre>";
 
 // Beginn Ausgabe Fragen 
 if( $status != "fehler" && $status != "auswertung" ){
	$qindexF = $qindex + $questionspersite;
echo <<<EOT
	<form name="quizform" method="post" action="$PHP_SELF">
		<input type="hidden" name="ses" value="{$sessionid}">
		<input type="hidden" name="findex" value="{$qindexF}">
		<input type="hidden" name="style" value="{$style}">
EOT;

	
//	echo "<h1>$qindex</h1>";
	$qentries = & $sesobj->get_qentries();
		
	for( $i = 0; $i < $questionspersite ; ++$i ){
		$fi = $qindex + $i;
		$qentry = $qentries[$fi];
		if( isset( $qentry ) ){
			$QUESTION = $qentry->get_question();
			include( "./style/$style/question.php" );
			
			// Bilder anzeigen
			
			if( count( $qentry->get_images() ) ){
				include( "./style/$style/images.php" );
			}
			 
			if( $qentry->get_typ() == "multi" ){
				$choices = $qentry->get_choice();
				$z = 0;
				$NAME = "_{$fi}[]";
			   foreach( $choices as $co ){
			   	$TEXT = $co->get_text();
			   	$INDEX = $z; 
			   	include( "./style/$style/zmulti.php" );
			   	++$z;
			   }
			}
			elseif( $qentry->get_typ() == "test" ){
				$test = $qentry->get_test();
				$z = 0;
			   foreach( $test as $ts ){
			   	$TEXT = $ts->get_text();
			   	$NAME = "_{$fi}";
			   	$INDEX = $z; 
			   	include( "./style/$style/ztest.php" );
			   	++$z;
			   }	
			}
			elseif( $qentry->get_typ() == "text" ){
					$NAME = "_{$fi}";
					include( "./style/$style/ztext.php" );
			}
			elseif( $qentry->get_typ() == "sort" ){
					$NAME = "_{$fi}[]";
					$sitems = $qentry->get_sort();
					$ACOUNTER = count( $sitems );
					for( $SINDEX = 0; $SINDEX<$ACOUNTER; ++$SINDEX ){
						$TEXT = $sitems[$SINDEX]->get_text();
						include( "./style/$style/zsort.php" );		
					}			
			}
			include( "./style/$style/endquestion.php" );
		}
	}
	
	include( "./style/$style/zsubmit.php" );
 
 // Ende Ausgabe der Fragen
 echo "</form>\n";
 
 	// Session sichern
 	$shelf->put("session", $sesobj );

	$shelf->close();
 }

 // Beginn der Anzeige Auswertung
 if( $status == "auswertung" ){
 	$punktsumme = 0;
 	$testfragen = 0;
 	$richtige =0;
 	$falsche  =0;
	for( $z = 0; $z < count( $qentries ); ++$z  ){
		if( isset($qentries[$z]) ){
			if( $qentries[$z]->get_typ() == "multi" ){
				$MCHOICE = $qentries[$z];
				$NUMMER =$z+1;
				include( "./style/$style/multiresult.php" );
			}
			elseif( $qentries[$z]->get_typ() == "test" ){
				//echo "<h1>Resultat$z: ",$qentries[$z]->get_input(),"</h1>";
				$testfragen = 1;
				$punktsumme += $qentries[$z]->get_input();	
			}
			elseif( $qentries[$z]->get_typ() == "text" ){
				$NUMMER = $z+1;
				$MTEXT = $qentries[$z];
				include( "./style/$style/textresult.php" );
			}
			elseif( $qentries[$z]->get_typ() == "sort" ){
				$NUMMER = $z +1;
				$MSORT = $qentries[$z];
				include( "./style/$style/sortresult.php" );	
			}
			if( $qentries[$z]->get_typ() != "test" ){
				if( $qentries[$z]->correct() ){
					++$richtige;
				}
				else{
					++$falsche;
				}
			}				
		}
	}
	if( $testfragen == 1 ){
		$results = $sesobj->get_results();
		$TEXT="";
		$TESTRESULT = GetMsg( "TESTRESULT",$punktsumme,$sesobj->get_pointsum());	
		
		for( $z = 0; $z < count( $results ); ++$z ){

			if( $punktsumme >= $results[$z]->get_min() &&
				 $punktsumme <= $results[$z]->get_max() ){
				$TEXT = $results[$z]->get_text();
				break;
			}
		}
		include( "./style/$style/testresult.php" );  
	}
	if( $sesobj->countentries() ){
		$anzahl = $sesobj->countentries();
		include( "./style/$style/mainresult.php" );
	}
	include( "./style/$style/endsubmit.php" );
	$shelf->destroy(); 
 }
//echo $status;
//viewglobals();
//echo "<pre>";print_r($sesobj);echo "</pre>";

 // Ende Anzeige Auswertung                       
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
 
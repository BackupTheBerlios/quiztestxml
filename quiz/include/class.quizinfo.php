<?php

/**
 * include/class.quizinfo.php -- some classes, which provides the interface to quiztextXML
 *
 * Copyright (c) 2003 Team krausi,sepp,stefan  
 *
 * Licensed under the GNU GPL. For full terms see the file COPYING.
 *
 * Date: Fre Jun 27 13:49:08 CEST 2003
 *
 */
 	
 	class quizfile{

 		var $file;
		var $qsets = array(); // array for questionsets
		var $tags = array();
		var $info;
		var $tempid;
		
		function quizfile( $file="" ){
			$this->tags = $this->get_quizfile_tags();
			if( strlen($file) ){
				$this->file = $file;
			}
			$this->info=0;		
		}
		
		function only_info(){ $this->info = 1; }
		function complete(){ $this->info = 0; } 
		
		function get_qsets(){ return $this->qsets; }
		function get_questionset( $key ){ return $this->qsets[$key]; }
		
		function read_quizfile($filename=""){
			if( strlen($filename) ){
				$this->file = $filename;
			}
			else{
				if( isset( $this->file ) ){
					$filename = $this->file;
				}
				else{
					return "No file specified!";
				}
			}

		   $data = @implode("",@file($filename));
			if( ! strlen( $data ) ){
				return "Can't read file $filename.";
			}
 	   	$parser = xml_parser_create();
  		  	xml_parser_set_option($parser,XML_OPTION_CASE_FOLDING,0);
  		  	xml_parser_set_option($parser,XML_OPTION_SKIP_WHITE,1);
  		  	xml_set_external_entity_ref_handler($parser,"");
 	   	xml_parse_into_struct($parser,$data,$values,$tags);
	    	
	    	if( xml_get_error_code ( $parser ) != XML_ERROR_NONE ){
	    		return  xml_error_string(  xml_get_error_code ( $parser ) );
	    	}

	    	xml_parser_free($parser);
	    	
	    	// loop through the structures 
			$num = 0;
  	   	foreach ($tags as $tag=>$indizes) {
    			if( $this->tags[ $tag ] ){								// wenn questionset
    			
    				for( $x = 0; $x < count( $indizes ); $x+=2 ){
    				
    					// ID und Sprache setzen
    					$this->init_quizfile_data( $values[$indizes[$x]] );
    			
    					// Titel, Abstrakt und Editor setzen
    					$in = array( $indizes[$x], $indizes[$x+1] );
    					$this->get_quizfile_data( $in , $values );
    				}
    			}
    		}
      	return "ok";
   	}
		
		
		function get_quizfile_tags(){
			return array(
				'questionset' 	   => 1
			);
		}
		
		/*
				Parameter ist der questionset-tag als array
				
				Die Funktion muss als erste aufgerufen werden.
				Die Atrribute des questionsets werden im Objekt angelegt.
				
		*/
		function init_quizfile_data( $tag ){
			$qs = new question_set();
			// Set filename
			$qs->set_file( $this->file ); 
			
			// Set the ID
			if( $tag[attributes][SID] ){
				$qs->set_ID( $tag[attributes][SID] );
			}
			else{
				// if more then one xml-file is read and the id is not specified
				// only the last questionset is used
				$id = count( $this->qsets );
				$qs->set_ID( $id );	
				error_log( "Warning: No ID defined for questionset in file "
    				  		  . $this->file . ".\n" , 0 );
			}
			// Set language if available
			if( $tag[attributes][language] ){
				$qs->set_language( $tag[attributes][language] );
			}
			
			$this->qsets[$qs->get_ID()] = $qs;
			$this->tempid = $qs->get_ID();
		}
		
		function get_quizfile_data( $indizes , $values ){
			
			// Loop over all questionset values 
			
			$qs = & $this->qsets[$this->tempid];
			
			$begin = $indizes[0]+1;
			$end = $indizes[1];
			
			for( $z = $begin; $z<$end ; ++$z ){
			
				$tag = $values[$z][tag];
				$type = $values[$z]["type"];
				
				if ($tag == "editor" && $type == "open" ) {
					$editor = new quiz_editor();
					do{
						++$z;
						$tag  = $values[$z][tag];
						$type = $values[$z]["type"];
						
						if( $tag == "name" ){
							$editor->set_name( $values[$z][value] );		
						}
						
						if( $tag == "email" ){
							$editor->set_email( $values[$z][value] );
						}
										
					}while( !($tag == "editor" && $type == "close") && $z < $end ); 
					
					$qs->add_editor( $editor );
					continue;
				}
				
				if( $tag == "title" ){
					$qs->set_title( $values[$z][value] );
					continue;
				}	
				
				if( $tag == "abstract" ){
					$qs->set_abstract( $values[$z][value] );
					continue;
				}
				
				if( $tag == "creation_date" ){
					$qs->set_cdate( $values[$z][value] );
					continue;
				}
				
				if( $this->info == 1 ){ continue; }
				
				if( $tag == "quizentry" && $type == "open" ){
					$qe = new quiz_entry();
					do{
						++$z;
						$tag  = $values[$z][tag];
						$type = $values[$z]["type"];
						
						// question
						if( $tag == "question" ){
							$qe->set_question( $values[$z][value] );
							continue;	
						}
						
						// hint
						if( $tag == "hint" ){
							$qe->add_hint( $values[$z][value] );
							continue;
						}
						
						// image
						if( $tag == "image" ){
							$image = new quiz_image();
							$image->set_ref( $values[$z][attributes][ref] );
							$image->set_text( $values[$z][value] );
							$qe->add_image( $image );
							continue;
						}
						
						// text
						if( $tag == "answer" ){
							$qe->add_answer( $values[$z][value] );
							$qe->set_typ( "text" );
							continue;
						}
						if( $tag == "fullanswer" ){
							$qe->set_fullanswer( $values[$z][value] );
							continue;
						}
						
						// multi
						if( $tag == "choice" ){
							$choice = new quiz_choice();
							$choice->set_text( $values[$z][value] );
							if( $values[$z][attributes][correct] == "true" ){
								$choice->set_correct( 1 ); 
							}
							else{
								$choice->set_correct( 0 );
							}
							$qe->add_choice( $choice );
							$qe->set_typ( "multi" );
							continue;
						}
						
						// test
						if( $tag == "test" ){
							$test = new quiz_test();
							$test->set_text( $values[$z][value] );
							$test->set_value( $values[$z][attributes][value] );
							$qe->set_maxpoints( $test->value() );
							$qe->add_test( $test );
							$qe->set_typ( "test" );
							continue;
						}
						
						//sort
						if( $tag == "sortitem" ){
							$sort = new quiz_sort();
							$sort->set_text( $values[$z][value] );
							$sort->set_position( $values[$z][attributes][position] );
							$qe->add_sort( $sort );
							$qe->set_typ( "sort" );
							continue;
						}
					}while( !($tag == "quizentry" && $type == "close") && $z < $end );

					$qs->add_qentry( $qe );
					continue;	

				}
				if( $tag == "result" ){
					$res = new quiz_result();
					$res->set_text( $values[$z][value] );
					$res->set_min( $values[$z][attributes][minimum] );
					$res->set_max( $values[$z][attributes][maximum] );
					$qs->add_result( $res);
				}
			}	
		} 				
 	}
 	
 	class question_set {
 		var $sid;
 		var $file;
 		var $language;
 		var $editors = array();
		var $title;
		var $abstract;
		var $cdate;
		var $tags = array();
		var $qentries = array();
		var $results = array();
		
		/*
			Konstruktor
		*/
		function question_set(){
			// default constructor
		}
		function countentries(){
			$anz=0;
			foreach( $this->qentries as $qe ){
				if( $qe->typ != "test" ){
					++$anz;
				} 
			}
			return $anz;
		}
		function set_file( $f ){
			$this->file = $f;
		}
		function get_file(){ return $this->file; }
		
		function set_ID($id){
			$this->sid = $id;
		}	
		function set_language($lang){
			$this->language = $lang;
		}
		function set_title( $t ){
			$this->title = $t;	
		}		
		function add_editor( $ed ){
			array_push( $this->editors, $ed );
		}
		function set_abstract( $desc ){
			$this->abstract = $desc ;
		}
		function set_cdate( $date ){
			$this->cdate = $date;
		}
		function get_title(){ return $this->title; }
		function get_ID(){ return $this->sid; }
		function get_language(){ return $this->language; }
		function get_editors(){ return $this->editors; }
		function get_cdate(){ return $this->cdate; }
		function get_abstract(){ return $this->abstract; }
		
		function add_qentry( $qe ){ array_push( $this->qentries, $qe ); }
		function & get_qentries(){ return $this->qentries; }
		
		function get_results(){ return $this->results; }
		function add_result( $r ){ array_push( $this->results, $r ); }
		
		function get_pointsum(){
			$sum = 0;
			foreach( $this->qentries as $qe ){
				if( $qe->get_typ() == "test" ){
					$sum += $qe->get_maxpoints();	
				}	
			}
			return $sum;
		} 
}

class quiz_editor {
	
	var $name;
	var $email;
	
	function set_name( $_name ){
		$this->name = $_name;
	}
	
	function get_name(){ return $this->name; }
	
	function set_email( $_email ){
		$this->email = $_email;
	}
	
	function get_email(){ return $this->email; }
	
}

class quiz_choice{
	var $text;
	var $correct;
	
	function set_text( $t ){ $this->text = $t; }
	function get_text(){ return $this->text; }
	
	function set_correct( $b ){ $this->correct = $b; }
	function correct(){ return $this->correct; }
}

class quiz_test{
	var $text;
	var $value;
	
	function set_text( $t ){ $this->text = $t; }
	function get_text(){ return $this->text; }
	
	function set_value( $v ){ $this->value = $v; }
	function value(){ return $this->value; }
}

class quiz_sort{
	var $text;
	var $position;
	
	function set_text( $t ){ $this->text = $t; }
	function get_text(){ return $this->text; }
	
	function set_position( $p ){ $this->position = $p; }
	function position(){ return $this->position; }
}

class quiz_image {
	var $ref;
	var $text;
	
	function set_ref( $r ){
		$this->ref = $r;
	}
	function get_ref(){ return $this->ref; }
	function set_text( $t ){
		$this->text = $t ;
	}
	function get_text(){ return $this->text; }
}

class quiz_result {
	var $text;
	var $min;
	var $max;
	
	function set_text( $t ){ $this->text = $t ; }
	function get_text(){ return $this->text; }
	function set_min( $m ){ $this->min = $m ; }
	function set_max( $m ){ $this->max = $m ; }
	function get_min(){ return $this->min; }
	function get_max(){ return $this->max; }	
}

class quiz_entry{
	var $typ;	// test | text | multi | sort
	var $question;
	var $hints=array();
	var $images=array();
	
	// text
	var $answer=array();
	var $fullanswer;
	
	// test
	var $test = array();
	
	// multi
	var $choice = array();
	
	// sort
	var $sort = array();
	
	//
	var $correct;
	var $maxpoints;
	var $inp;
	
	function set_maxpoints( $p ){ 
		if( $this->maxpoints < $p ){
			$this->maxpoints = $p;
		}
	}
	function get_maxpoints(){ return $this->maxpoints; }
	
	function quiz_entry(){ $this->correct = 0; $this->maxpoints = 0; }
	function is_correct(){ $this->correct = 1; }
	function correct(){ return $this->correct; }
	
	function set_input( $i ){ $this->inp = array(); $this->inp = $i; }
	function get_input(){ return $this->inp; }
	
	function set_typ( $t ){ $this->typ = $t; }
	function get_typ(){ return $this->typ; }
	
	function add_answer( $a ){ array_push( $this->answer , $a ); }
	function get_answer(){ return $this->answer; }
	
	function set_fullanswer( $f ){ $this->fullanswer = $f; }
	function get_fullanswer(){ return $this->fullanswer; }
	
	function add_choice( $c ){ array_push( $this->choice, $c ); }
	function get_choice(){ return $this->choice; }
	
	function add_test( $c ){ array_push( $this->test, $c ); }
	function get_test(){ return $this->test; }
	
	function add_sort( $s ){ array_push( $this->sort, $s ); }
	function get_sort(){ return $this->sort; } 
	
	function set_question( $p ){ $this->question = $p; }
	function add_hint( $h ){ array_push( $this->hints, $h ); }
	function add_image( $i ){ array_push( $this->images, $i ); }
	// function 
	function get_question(){ return $this->question; }
	function	get_hints(){ return $this->hints; }
	function	get_images(){ return $this->images; }
	// function 
	
   // Auswertungsfunktionen
	function evaluate_mc( $an ){
		$choice = $this->get_choice();
		$i=0;
		$stat;
		$z = 0;
		//echo $this->get_question();		
		foreach( $choice as $cobold ){
			if( $cobold->correct() ){
				if( $an[$i] == $z ){
					$stat=1;
				}
				else{
					$stat=0;
					break;
				}
				++$i;
			}
			++$z;
		}
		if( $stat && $i == count( $an ) ){
			$this->is_correct();
		}
		$this->set_input( $an );
	}
	
	function evaluate_test( $an ){
		$tests = $this->get_test();
		$res = 0;
		if(isset($tests[$an])){
			$res = $tests[$an]->value();
		}
		// echo "<h1>Antwort:$an Resultat:$res</h1>";
		$this->set_input( $res );
	}
	
	function evaluate_text( $an ){
		$answers = $this->get_answer();
		/*
		echo "<pre>";
		print_r( $an );
		print_r( $answers );
		echo "</pre>";
		*/
		$this->set_input( $an );
		for( $z = 0; $z < count( $answers ); ++$z ){
			
			$string = preg_replace( "/^\s*/","",$answers[$z] );
			$string = preg_replace( "/\s*$/","", $string );

			$string = preg_quote( $string , "/" );
			if( preg_match ( "/^{$string}$/i", $an ) ){
				$this->is_correct();
				break;
			}
		}
	}
	
	function evaluate_sort( $an ){
		$sort = $this->get_sort();
		$stat = 1;
		$input = array();
		// echo "<h2>Anzahl", count($sort) , "</h2>";
		// echo "<pre>";print_r( $an );print_r( $sort ); echo "</pre>";
		
		for( $i = 0; $i < count($sort); ++$i ){
			$val = $an[$i] + 1 - 100 * $i;
		// echo "<h1>$an[$i] $val</h1>";
			array_push( $input , $val );		
			if( !( $sort[$i]->position() == $val )){
				$stat = 0;
			} 
		}
		if( $stat ){
			$this->is_correct();
		}	
		$this->set_input( $input );		
	}
}

?>


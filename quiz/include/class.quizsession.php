<?php

/**
 * include/class.quizsession.php  -- Klasse zur Verwaltung der Sessiondaten
 *
 * Copyright (c) 2003 Team krausi,sepp,stefan  
 *
 * Licensed under the GNU GPL. For full terms see the file COPYING. 
 *
 * Date: Don Jun 26 15:50:36 CEST 2003
 *
 */

class quizsession {
	var $qs; // questionset
	var $file;
	
	function quizsession(){ $this->index = 0; }
	function set_questionset( $q ){ $this->qs = $q; }
	function get_ID(){ return $this->qs->get_ID(); }
	function get_file(){ return $this->file; }
	function set_file( $f ){ $this->file = $f; }
	function get_results(){ return $this->qs->get_results(); }
	function & get_qentries(){ return $this->qs->get_qentries(); }
	
	// ermittelt die maximal erreichbare Punktzahl bei einem Test
	function get_pointsum(){ return $this->qs->get_pointsum(); }
	
	// ermittelt die Anzahl der Fragen die keine Testfragen sind
	function countentries(){ return $this->qs->countentries(); }
}

?>
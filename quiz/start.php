<?php

/**
 * start.php  -- lädt unsere Startseite
 *
 * Copyright (c) 2003 Team krausi,sepp,stefan  
 *
 * Licensed under the GNU GPL. For full terms see the file COPYING. 
 *
 */
 
/* 
	
	Sie ist über 2 Parameter beinflussbar.

	$withstylemenu -- wenn wahr, dann Styleauswahl anzeigen
	
	$startaction -- der Name der nächsten Seite (bei Enter)
						 default ist quizmenu.php
					
*/

require_once( "./include/global.php" );

$style = $_POST[style] ? $_POST[style] 
                       : ( $_GET[style] ? $_GET[style] : "default" ) ;

include( "./style/$style/colors.php");
include( "./style/$style/css.php");


$withstylemenu=1; // Styleauswahl anzeigen
// $startaction = "meinstart.php"; 
// --> verwendet quizmenu.php
include( "./style/$style/start.php" );

?>
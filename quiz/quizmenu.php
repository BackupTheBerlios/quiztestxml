<?php

/**
 * quizmenu.php  -- lädt eine Auswahl der verfügbaren Quiz
 *
 * Copyright (c) 2003 Team krausi,sepp,stefan  
 *
 * Licensed under the GNU GPL. For full terms see the file COPYING. 
 *
 * Date: Don Jun 26 14:57:04 CEST 2003
 *
 */


require_once( "./include/global.php" );

$style = $_POST[style] ? $_POST[style] 
                       :( $_GET[style] ? $_GET[style] : "default" );

include( "./style/$style/colors.php");
include( "./style/$style/css.php");

/* 
	quizmenu.php -- Hier wird eine Auswahl der möglichen Quiz dargestellt.
	
	Sie ist über 5 Parameter beinflussbar.

	1. $quizfiles -- ein Array mit den zu ladenden XML-Quizdateien.
						  dieser Parameter ist wie die anderen optional
	
	2. $withabstract -- mit Kurzbeschreibung anzeigen
	3. $witheditor -- Editor wird mit angezeigt
	4. $withdate -- Das Erstellungsdatum wird mit angezeigt
	5. $withlanguage -- Sprache wird angezeigt
						 
*/

$withdate     = 1;
$witheditor   = 1;
$withabstract = 1;
$withlanguage = 1;

$quizfiles = array( "xml/mctest1.xml",
						  "xml/ltestM.xml",
						  "xml/fahrschule.xml",
              "xml/biologiequiz.xml" );

include( "./include/quizmenu.php" );

?>
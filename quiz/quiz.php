<?php

/**
 * quiz.php  -- zeigt das Quiz an
 *
 * Copyright (c) 2003 Team krausi,sepp,stefan  
 *
 * Licensed under the GNU GPL. For full terms see the file COPYING. 
 *
 * Date: Don Jun 26 15:50:36 CEST 2003
 *
 */
 
 
 require_once( "./include/global.php" );

 $style = $_POST[style] ? $_POST[style] 
                       :( $_GET[style] ? $_GET[style] : "default" );

 include( "./style/$style/colors.php");
 include( "./style/$style/css.php");                       
                       
 $questionspersite=4;
 include( "./include/quiz.php" );

 
?>
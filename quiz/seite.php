<?php

/**
 * seite.php  -- lädt Seitenrand
 *
 * Copyright (c) 2003 Team krausi,sepp,stefan  
 *
 * Licensed under the GNU GPL. For full terms see the file COPYING. 
 *
 * Date: Don Jun 26 13:45:54 CEST 2003
 *
 */

require_once( "./include/global.php" );

$style = $_POST[style] ? $_POST[style] 
                       : $_GET[style] ? $_GET[style] : "default" ;

include( "./style/$style/colors.php");
include( "./style/$style/seite.php" );

?>
<?php

require_once( "./include/global.php" );

$style = $_POST[style] ? $_POST[style] 
                       : $_GET[style] ? $_GET[style] : "default" ;

include( "./style/$style/colors.php");
include( "./style/$style/css.php");
include( "./style/$style/randu.php" );

?>
<?php



/**
 * globals.php
 *
 * Copyright (c) 2003 Team SAS 2003 
 
 * Licensed under the GNU GPL. For full terms see the file COPYING.
 *
 * This includes code to update < 4.1.0 globals to the newer format 
 *
 */
 
/** 
 * returns true if current php version is at mimimum a.b.c 
 * 
 * Called: check_php_version(4,1)
 *
 * Code is borrowed from Squirrelmail.
 */
 
 
// configuration
$picturedirectory="images/";	// Verzeichnis für Bilder im Quiz
$sessiondir="data/"; // Verzeichnis für Sessiondaten, muss Schreibberechtigung haben
$brokentime=3600; // Zeit die abgebrochene Sessions erhalten bleiben in Sekunden
						// !!! Vorsicht: Keinen zu kleinen Wert wählen !!!

// end configurateion

function check_php_version ($a = '0', $b = '0', $c = '0')             
{
    global $CUR_PHP_VERSION;
 
    if(!isset($CUR_PHP_VERSION))
        $CUR_PHP_VERSION = substr( str_pad( preg_replace('/\D/','', PHP_VERSION), 3, '0'), 0, 3);

    return $CUR_PHP_VERSION >= ($a.$b.$c);
}


if ( !check_php_version(4,1) ) {
  global $_COOKIE, $_ENV, $_FILES, $_GET, $_POST, $_SERVER, $_SESSION;
  global $HTTP_COOKIE_VARS, $HTTP_ENV_VARS, $HTTP_POST_FILES, $HTTP_GET_VARS,
         $HTTP_POST_VARS, $HTTP_SERVER_VARS, $HTTP_SESSION_VARS, $PHP_SELF;
  $_COOKIE  =& $HTTP_COOKIE_VARS;
  $_ENV     =& $HTTP_ENV_VARS;
  $_FILES   =& $HTTP_POST_FILES;
  $_GET     =& $HTTP_GET_VARS;
  $_POST    =& $HTTP_POST_VARS;
  $_SERVER  =& $HTTP_SERVER_VARS;
  $_SESSION =& $HTTP_SESSION_VARS;
  if (!isset($PHP_SELF) || empty($PHP_SELF)) {
     $PHP_SELF =  $HTTP_SERVER_VARS['PHP_SELF'];
  }
}

require_once( "./texts/de/msg.php" );
require_once( "./texts/de/languages.php" );

function EchoMsg( $key, $var1="" , $var2="" ){
	echo GetMsg( $key, $var1, $var2 );
}

function GetMsg( $key, $var1="" , $var2="" ){
	global $messages;
	if( isset( $messages[$key] ) ){
		if( strlen( $var1 ) ){ 
			$var1 = htmlspecialchars( $var1 ); 
			if( strlen( $var2 ) ){ 
				$var2 = htmlspecialchars( $var2 ); 
			}
			return preg_replace( array( "/%VAR1%/","/%VAR2%/" ),
										array( $var1   , $var2   ),
										$messages[$key] );
		}
		else{
			return $messages[$key];
		}
	}
	else{
		return "Message: $key not defined!";
	}
}

function GetLanguage( $lang ){
	global $languages;
	return $languages[$lang] ? $languages[$lang]
									 : "Language $lang not defined.";
}

function viewglobals(){
	$keys =  array_keys( $GLOBALS );
	$anz = count( $keys );
	echo "<table>";
	for( $z=0; $z<$anz; ++$z ){	
		echo "<tr><td>",$keys[$z],"</td><td>",$GLOBALS[$keys[$z]],"</td></tr>";
	}
	echo "</table>";
}

?>
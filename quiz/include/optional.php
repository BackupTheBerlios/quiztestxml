<?php

/**
 * include/optional.php  -- ein paar seltener verwendete Funktionen
 *
 * Copyright (c) 2003 Team krausi,sepp,stefan  
 *
 * Licensed under the GNU GPL. For full terms see the file COPYING. 
 *
 * Date: Don Jun 26 14:12:51 CEST 2003
 *
 */

function stylemenu(){

	global $style;
$handle = opendir("./style"); 
$return ="";
	while($file = readdir($handle)) {
 
		if(is_dir($file)){
			if($file == "." || $file == ".." ){ continue; }
		}
		$return.=<<<EOT
                        
      <tr height="27" >
         <td height="27" width="137" background="style/$style/hggif/hgti.gif">
             <div align="center">
               <a href="frameset.php?style=$file" target="_top">$file</a>
             </div>
         </td>
      </tr>
EOT;

	} 
	closedir($handle);
	$return.=<<<EOT
      <tr height="27" >
          <td height="27" width="137">&nbsp;</td>
      </tr>
EOT;
 
	return $return;
}

function remove_broken_sessions(){

	global $sessiondir;
	global $brokentime;
	
	$handle = opendir( $sessiondir );
	while($file = readdir($handle)) { 
		if($file == "." || $file == ".." ){ continue; }
		$atime = @fileatime($sessiondir.$file."/session");

		$ctime = time();
		if( $atime && ( $atime + $brokentime ) < $ctime ){
		 	@unlink ($sessiondir.$file."/session");
		 	@unlink ($sessiondir.$file."/shelf.idx");
		 	@rmdir($sessiondir.$file);
		 	echo $file." gelöscht!";
		}
	}
}
?>
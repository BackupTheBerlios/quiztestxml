<?php

/**
 * style/default/endquestion.php  -- schliesst Frage ab
 *
 * Copyright (c) 2003 Team krausi,sepp,stefan  
 *
 * Licensed under the GNU GPL. For full terms see the file COPYING. 
 *
 * Date: Son Jun 29 18:57:30 CEST 2003
 *
 */       

echo "<tr><td colspan=\"3\"><table><tr>\n";

 $imagebase = $picturedirectory.$ID."/";
 $img = $qentry->get_images();
 
for( $imgz=0; $imgz<count($img);++$imgz ){
	$imgref=$img[$imgz]->get_ref();
	$imgtext=$img[$imgz]->get_text();
	echo "<td><div><img src=\"{$imagebase}{$imgref}\"></div>";
	if( isset($imgtext ) ){
		echo "<div>$imgtext</div>";
	}
	echo "</td>\n";	
}

echo "</tr></table></td></tr>\n";

?>


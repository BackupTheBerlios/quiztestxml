<?php

class moreRandom{
	var $makeMoreRandom = TRUE;
	// private:
	function seed()
	{
		if($this->makeMoreRandom){
			usleep(1);
			srand((double)microtime()*1000000);
		}
	}	
	function set( $var , $val )
	{
		$this->$var = $val;
	}
}

class randomName extends moreRandom{
	var $chars = array(
	               "a","b","c","d","e","f","g","h","i","j","k","l","m",
					   "n","o","p","q","r","s","t","u","v","w","x","y","z",
					   "0","1","2","3","4","5","6","7","8","9");
	function randomName( $length = 9 ){
		$this->seed();
		$ret = $this->chars[ rand(0,25) ];
		for( $i=1; $i<$length;$i++){
			$ret.=$this->chars[ rand(0,35) ];	
		}
		$this->name = $ret;
	}
	function get_name(){ return $this->name; }
}

?>
<?
// (C) 2002, Alexander Zhukov <alex@veresk.ru>
class Shelve {

	var $_shlef;
	var $_keys = Array();
	var $_objects = Array();
	var $_deleted = Array();

	function Shelve($shelf,$shelves_path = ".")
	{
		$this->_shelf = $shelves_path."/".$shelf;
		
		if(!is_dir($this->_shelf)
)
		{
			mkdir($this->_shelf,0700);
			$this->_save_index();
		}
		
		$p = new Unpickle(new File($this->_shelf."/shelf.idx"));
		$this->_keys =& $p->load();
	}
	
	function & get($key)
	{
		if(in_array($key,$this->_keys))
		{
			if(!in_array($key,array_keys($this->_objects))) 
			{
			    $unpickle = new Unpickle(new File($this->_shelf."/".$key));
    			    return $unpickle->load();
			}
			return 
	$this->_objects[$key];

		}
		else
		{
			return false;
		}
	}
	
	function add($key,&$obj)
	{
		if(!in_array($key,$this->_keys)
)
		{
			$this->_keys[] = $key;
			$this->_objects[$key] =& $obj;
			return true;
		}
		else
		{
			return false;
		}
	}

	function put($key,&$obj)
	{
		if(in_array($key,$this->_keys)
)
		{
			$this->_objects[$key] =& $obj;
			return true;
		}
		else
		{
			return $this->add($key,$obj);
		}
	}

	
	function _save_object($key,&$obj)
	{
		$p = new Pickle(new File($this->_shelf."/".$key));
		$p->dump($obj);
	}

	function _save_index()
	{
		$p = new Pickle(new File($this->_shelf."/shelf.idx"));
		$p->dump($this->_keys);
	}
	
	function del($key)
	{
		$in=0;
		foreach( $this->_keys as $kval ){
			if( $key = $kval ){
				break;		
			}
			++$in;
		}
		// array_search($key,$this->_keys) noch nicht bekannt
		unset($this->_keys[$in]);
		unset($this->_objects[$key]);
		$this->_deleted[] = $key;
	}

	function keys()
	{
		return $this->_keys;
	}
	
	function destroy()
	{
		unlink($this->_shelf."/shelf.idx");
		foreach($this->_keys as $key)
		{
		    if(is_file($this->_shelf."/".$key)) unlink($this->_shelf."/".$key)
;
		}
		return rmdir($this->_shelf);
	}

	function close()
	{

	    foreach($this->_keys as $key)
	    {
		$this->_save_object($key,$this->_objects[$key]);
	    }
	    $this->_save_index();

	    foreach($this->_deleted as $key)
	    {
		$f = new File($this->_shelf."/".$key);
		$f->delete();
	    }

	}

}
?>
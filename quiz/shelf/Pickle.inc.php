<?
// (C) 2002, Alexander Zhukov <alex@veresk.ru>
class Pickle {
	
	var $_storage;
	
	function Pickle(&$obj)
	{
		$this->_storage = $obj;
	}
	
	function dump(&$obj)
	{
		$this->_storage->write(serialize($obj));
	}
}

class Unpickle {

	var $_storage;

	function Unpickle(&$obj)
	{
		$this->_storage = $obj;
	}

	function & load()
	{
		return unserialize($this->_storage->read());
	}
}
?>
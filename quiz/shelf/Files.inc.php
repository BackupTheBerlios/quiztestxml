<?
// (C) 2002, Alexander Zhukov <alex@veresk.ru>
class File {

	var $_file;

	function File($file)
	{
		$this->_file = $file;
	}

 	function read()
	{
		$fh = @fopen($this->_file,"rb");
		$str = @fread($fh,filesize($this->_file));
		@fclose($fh);
		return $str;
	}
	
	function write($str)
	{
		$fh = @fopen($this->_file,"wb");
		@fwrite($fh,$str);
		@fclose($fh);
	}
	
	function exists()
	{
		return @is_file($this->_file);	
	}
	
	function delete()
	{
		@unlink($this->_file);
	}
	
}
?>
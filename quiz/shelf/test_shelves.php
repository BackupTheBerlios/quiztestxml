<?
/* include the neded classes here
include_once("phpunit/phpunit.php");
include_once("../Files.inc.php");
include_once("../Pickle.inc.php");
include_once("../Shelve.inc.php");
*/

$suite = new TestSuite();


class FileFixture extends TestCase {

	var $_file;
	var $_string;

	function FileFixture($name)
	{
		$this->TestCase($name);
	}
	
	function setUp()
	{
		$this->_file = new File("__testfile");
		$this->_string = "test string";
	}
	
	function testFileWrite()
	{
		$this->_file->write($this->_string);
	}

	function testFileExists()
	{
		$this->assert($this->_file->exists());
	}

	function testFileRead()
	{
		$this->assertEquals($this->_string,$this->_file->read());
	}

	function testFileDelete()
	{
		$this->_file->delete();
		$this->assert(!is_file($this->_file->_file));
	}
}

$suite->addtest(new FileFixture("testFileWrite"));
$suite->addtest(new FileFixture("testFileExists"));
$suite->addtest(new FileFixture("testFileRead"));
$suite->addtest(new FileFixture("testFileDelete"));

class DummyClass
{
	var $test;
	function DummyClass($test)
	{
		$this->test = $test;
	}
}

class PickleFixture extends TestCase
{
	var $_file;
	var $_pickle;
	var $_unpickle;
	var $obj;
	
	function PickleFixture($name)
	{
		$this->TestCase($name);
	}

	function setUp()
	{
		$this->_file = new File("__testfile");
		$this->_pickle = new Pickle($this->_file);
		$this->_unpickle = new Unpickle($this->_file);
		$this->obj = new DummyClass("test string");
	}

	function tearDown()
	{
		$this->_file->delete();
	}

	function testPickler()
	{
		$this->_pickle->dump($this->obj);
		$this->assertEquals($this->obj,$this->_unpickle->load());
	}

}

$suite->addtest(new PickleFixture("testPickler"));



class ShelvesFixture extends TestCase
{
	var $obj;
	var $shelf_name;

	function ShelvesFixture($name)
	{
		$this->TestCase($name);
	}

	function setUp()
	{
		$this->obj = new DummyClass("test string");
		$this->shelf_name = "_test_shlef";
	}

	function testShelfAdd()
	{
		$shelf =& new Shelve($this->shelf_name);
		$shelf->put("test",$this->obj);
		$this->assertEquals($this->obj,$shelf->get("test"));
		$shelf->destroy();
	}

    

	function testShelfSaveLoad()
	{
		$shelf =& new Shelve($this->shelf_name);
		$shelf->put("test",$this->obj);
		$shelf->close();
		unset($shelf);
	
		$shelf2 =& new Shelve($this->shelf_name); 
		$this->assertEquals($this->obj,$shelf2->get("test"));
		$shelf2->destroy();
	}


	function testShelfDeleteKey()
	{
		$shelf =& new Shelve($this->shelf_name);
		$shelf->put("test",$this->obj);
		$shelf->close();
		unset($shelf);
		$shelf = new Shelve($this->shelf_name);
		$shelf->del("test");
		$shelf->close();
		unset($shelf);
		
		$shelf2 =& new Shelve($this->shelf_name); 
		$this->assert($shelf2->get("test") == 0);
		$shelf2->destroy();
	}

	function testShelfIndex()
	{
		$shelf =& new Shelve($this->shelf_name);
		$shelf->put("key1",$this->obj);
		$shelf->put("key2",$this->obj);
		$shelf->close();
		unset($shelf);
		
		$shelf =& new Shelve($this->shelf_name);
		
		$this->assertEquals(2,sizeof($shelf->keys()));
		$shelf->close();
		$shelf->destroy();
	} 

}

$suite->addtest(new ShelvesFixture("testShelfAdd"));
$suite->addtest(new ShelvesFixture("testShelfSaveLoad"));
$suite->addtest(new ShelvesFixture("testShelfDeleteKey"));
$suite->addtest(new ShelvesFixture("testShelfIndex"));


$res = new TextTestResult();
$suite->run(&$res);
$res->report();

?>
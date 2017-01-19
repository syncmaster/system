<?php
/*class hello {
	var $hello = "Plamen";
	function world() {
		echo "hi $name"	;
	}
}
$object1 = new hello;

$object1->name = "Plamen";
$object1->world();
*/

/*
class area {
	function calculate($lenght, $breadth) {
		return $lenght*$breadth;
	}
}
$result = area :: calculate(225, 100);
echo "The are is : $result";

*/
/*
class Name {
	var $name = "Plamen";

	function show_name() {
		echo "Hi $this->name.";
	}
}
$obj1 = new Name;
$obj1->show_name();
*/

/*
class Name {
	var $name = "Plamen";
	var $somename = "";
	function show_name() {
		echo "Hi $this->name";
	}
	function change_name($somename) {
		$this->name = $somename;
	}
}
$obj1 = new Name;
$obj1->show_name();
$obj1->change_name("Bogomil");
$obj1->show_name();
*/
/*
class Name {
	var $name;

	function PrintName() {
		$this->name = "Angelika";
		echo "HI $this->name";
	}
	function show_name($somename) {
		echo "Hi $this->name !";
	}
}
$obj1 = new Name;
$obj2 = new Name;
*/

/*
class ParentClass {
	function show_message() {
		echo "Hi! This comes from the parent class.";
	}
}
class ChildClass extends ParentClass {
	function show() {
		echo "Hi This comes from the child class.";
	}
}
$obj1 = new ParentClass;
$obj1->show_message();
$obj2 = new ChildClass;
$obj2->show();
$obj2->show_message();
*/

/*
class A {
	function foo() {
		if (isset($this)) {
			echo '$this e definirana';
			echo get_class($this);
			echo "\n";
		} else {
			echo '$this ne e definirana.' . "\n";
		}
	}
}

class B {
	function bar() {
		A::foo();
	}
}

$a = new A();
$a->foo();
A::foo();
$b = new B();
$b->bar();
B::bar();

*/

/*******************************************
$this preprashta kym tekushtiq obekt
dokato self preprashta kym tekushtiq klas
ne e zadaljitelno da se preprashta kym klass izpolzvasht element self





********************************************/

/*
class SimpleClass {

	public $var3 = 1+2;
	public $var4 = self::myStaticMethod();
	public $var5 = $myVar;

	public $var6 = myConstant;
	public $var7 = self::classConstant;
	public $var8 = array(true, false);
}


$instance = new SimpleClass();

$assigned = $instance;
$reference =& $instance;

$instance->var = '$assigned shte priemete stoinostta tuk';

$instance = null; // tuk se zanulqva promenlivata $instance i taka kato
//promenlivata $refference priema stoinostta na $assigned
//tq se zanulqvaa sashto

var_dump($instance);
var_dump($reference);
var_dump($assigned);
*/

/*
class Classy {
	const STAT = 'S'; //na konstantite ne se slaga dolar za indikaciq
	static $stat = 'Static';
	public $publ = 'Public';
	private $priv = 'Private';
	protected $prot = 'Protected';

	function __construct() {
		public function showMe() {
			print '<br> self::STAT: ' . self::STAT; //preprashta kam konstanta
			print '<br> self::$stat:' . self:$stat; //statichna promenlivata
			print '<br> $this->stat:' . $this->stat;
			print '<br> $this->publ:' . $this->publ; //preprashta kam obekt promenliva
			print '<br>';
		}
	}
}
$me = new Classy();
$me->showMe();

*/
/****************
klasove s constuktori
construktora nqma da bade izvikan avtomatichno v dyshtenrniq class zatova
trqbva da napishem parent::__construct za da se inicializira ot bashtata

*****************
class BaseClass{
	function __construct() {
		print "in BaseClass constuctor</br>";
	}
}

class SubClass extends BaseClass {
	function __construct() {
		parent::__construct();
		print "in SubClass constructor</br>";
	}
}

$obj = new BaseClass();
$obj = new SubClass();

*/
/************************
i pri destructora e sahstoto kato pri konstruktora
trqbva da se izvika s parent::kalsa za da se zadeistva
destruktorite se vikat po wreme na spirane na skripta, pri koeto http zaqwkite za izprateni


**************************

class MyDestructableClass {
	function __construct() {
		print "in Constructor </br>";
		$this->name = "MyDestructableClass";
	}

	function __destruct() {
		print "Destroying" . $this->name . "</br>";
	}
}

$obj = new MyDestructableClass();

**************************************/

/*
*************************
public moje da se polzva navsqkade i v drugi klasove
protected moje da se polzva samo v klassa i v dashternite sahto
private moje da se polzva samo v klasa v koito e sazdaden
nemoje da se polzva nikade drugade dori i v dashternite


***************************
class myClass {
	public $public = 'Public';
	protected $protected = 'Protected';
	private $private = 'Private';

	function printHello() {
		echo $this->public;
		echo $this->protected;
		echo $this->private;
	}
}

$obj = new myClass();
echo $obj->public;
//echo $obj->protected;
//echo $obj->private;
$obj->printHello();

class myClass2 extends myClass {
	protected $protected = "Protected2";

	function printHello() {
		echo $this->public;
		echo $this->protected;
		echo $this->private;
	}
}

$obj2 = new myClass2();
echo $obj2->public;
//echo $obj2->private;
//echo $obj2->protected;
$obj->printHello();

*******************************************/
/*
*******************************************
"SELF" i "PARENT" se izpolvat za dostap do svoistvaa ili methodi vytre
 v definiciqta na klasa



**********************************************/

/*
class MyClass {
	const CONST_VALUE = "Stoinost na konstantata</br>";
}

$classname = new MyClass;
echo $classname::CONST_VALUE;

echo MyClass::CONST_VALUE;

class OtherClass extends MyClass {
	public $my_var = 123;
	public static $my_static = "statichna promenliva</br>"

	public static function doubleColon() {
		echo parent::CONST_VALUE . "</br>";
		echo self::$my_static . "</br>";
	}
}

$classname = new OtherClass;
echo $classname::doubleColon();

OtherClass::doubleColon();

*/
/*
**********************************
* kogato v dashterniq klas se definira povtorno method ot roditelskiq
* php nqma da izvika roditelskiq method
* dali da se izvika rotelskiq method se reshava samo ot dashterniq klas
* sashtoto vaji i za konstruktori i descructori,povtorno definirane i valshebni methodi


class MyClass {
	protected function myFunction() {
		echo "MyClass::myfunction() </br>";
	}
}

class OtherClass extends MyClass {
	public function myFunction() {
		parent::myFunction();
		echo "OtherClass::myFunction() </br>";
	}
}

$class = new OtherClass();
$class->myFunction();

***************************
*/

/*
abstract class AbstractClass {
	//methodi koito trqbva da badat definirani v dashterniq klas
	abstract protected function getValue();
	abstract protected function prefixValue($prefix);

	public function printOut() {
		print $this->getValue() . "</br>";
	}
}

class ConcreteClass1 extends AbstractClass {
	protected function getValue() {
		return "ConcreteClass1";
	}
	public function prefixValue($prefix) {
		return "{$prefix}ConcreteClass1";
	}
}

class ConcreteClass2 extends AbstractClass {
	public function getValue() {
		return "ConcreteClass2";
	}
	public function prefixValue($prefix) {
		return "{$prefix}ConcreteClass2";
	}
}
$class = new ConcreteClass1;
$class->printOut();
echo $class->prefixValue('FOO_') . "</br>";

$class2 = new ConcreteClass2;
$class2 = printOut();
echo $class2->prefixValue('FOO_') . "</br>";

*/


interface MyDogovor {
	public function getName();

	public function fetchRows($result);
};

abstract class MyClass implements MyDogovor {
	public function getName() {
		return "My Class Name";
	}

	abstract public function fetchRows($result);
	abstract protected function fetchRows2();
};


trait MyTrait1 {
	public function getAge() {
		return 24;
	}
};

trait MyTrait2 {
	public function getAddress() {
		return "Varna";
	}
};

class Util extends MyClass {
	use MyTrait1, MyTrait2;

	const PI_Number = 3.14;

	public function getPi() {
		return self::PI_Number + 5;
	}

	public function fetchRows($result) { }
	protected function fetchRows2() { }
}

$a = new Util();
echo $a->getName();
echo $a->getAddress();



<?php
include 'config.php';

class TestClass {
	public $myName;
	private $age;

	public function __construct($name, $age) {
		$this->myName = $name;
		$this->age = $age;
	}

	public function getName() {
		return $this->myName;
	}

	protected function getAge() {
		return $this->age;
	}
};

class MySecondClass extends TestClass {
	public function getMyAge() {
		return $this->age;
	}
};

$Mitko = new MySecondClass("Mitko", 20);
$Pesho = new MySecondClass("Pesho", 23);


echo $Mitko->getName();
echo $Mitko->getMyAge();
echo $Pesho->getName();
echo $Pesho->getMyAge();



$asdasd = "";
function SendMail() {

}

?>
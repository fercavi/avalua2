<?php
require_once('../class/Estimul.php');
require_once('../class/ItemRadioButton.php');
class  testEstimulTest extends PHPUnit_Framework_TestCase{	   
    	public function testConstructor(){    	
    		$items = array();
			$items[] = new ItemRadioButton(1,"<b>Pregunta1</b>",array("Opcio1","Opcio2"),array("Opcio1"));
			$items[] = new ItemRadioButton(1,"<b>Pregunta2</b>",array("Opcio3","Opcio4"),array("Opcio1"));
			$E = new Estimul(1,$items);
			$this->assertEquals(2,count($E->getItems()));
    	}
}
?>
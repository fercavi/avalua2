<?php
require_once('../class/ItemRadioButton.php');

    class ItemRadioButtonTest extends PHPUnit_Framework_TestCase
    {
    	public function testConstructor(){    		 
    		 $I = new ItemRadioButton(1,"Pregunta1",array("Opcio1","Opcio2"),array(1));
    		 $this->assertEquals(count($I->getPreguntes()), 2);
    		 $this->assertEquals(count($I->getRespostes()), 1);
    	}
    	public function testCrearUnaPregunta(){
    		$I = new ItemRadioButton(1,"Pregunta1",array("Opcio1","Opcio2"),array());
    		$expected = "<form id='1'>Pregunta1<div class='radio'><label><input type='radio' name='pregunta' resposta='0'>Opcio1</input></label></div><div class='radio'><label><input type='radio' name='pregunta' resposta='1'>Opcio2</input></label></div></form>";
    		$this->assertEquals($expected,$I->generateHTML());
    	}
    	public function testComprovarCheckedContestada(){
    		$I = new ItemRadioButton(1,"Pregunta1",array("Opcio1","Opcio2"),array(1));
    		$expected = "<form id='1'>Pregunta1<div class='radio'><label><input type='radio' name='pregunta' resposta='0'>Opcio1</input></label></div><div class='radio'><label><input type='radio' name='pregunta' resposta='1' checked>Opcio2</input></label></div></form>";
    		$this->assertEquals($expected,$I->generateHTML());    		
    	}
    	public function testComprovarlaInsercioDeRespostes(){
    		$I = new ItemRadioButton(1,"Pregunta1",array("Opcio1","Opcio2"),array());
    		$expected = "<form id='1'>Pregunta1<div class='radio'><label><input type='radio' name='pregunta' resposta='0'>Opcio1</input></label></div><div class='radio'><label><input type='radio' name='pregunta' resposta='1'>Opcio2</input></label></div></form>";
    		$this->assertEquals($expected,$I->generateHTML());
    		$I->setRespostes(array(1));
    		$expected = "<form id='1'>Pregunta1<div class='radio'><label><input type='radio' name='pregunta' resposta='0'>Opcio1</input></label></div><div class='radio'><label><input type='radio' name='pregunta' resposta='1' checked>Opcio2</input></label></div></form>";
    		$this->assertEquals($expected,$I->generateHTML());    		
    	}
    }


?>
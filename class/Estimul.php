<?php
class Estimul{
	public $Items;
	private $Id;
	function __construct($id,$items){
		$this->Items = $items;
		$this->Id = $id;
	}
	function getItems(){
		return $this->Items;
	}
	function generateHTML(){
		$html = "<div  name='Estimul_".$this->Id."'>";
		for($i=0;$i<count($this->Items);$i++){
			$html.=$this->Items[$i]->generateHTML();
		}
		$html .='</div>';
		return $html;
	}
}
?>
<?php
class Estimul{
	public $Items;
	private $Id;
  private $Titol;
  private $Enunciat;
	function __construct($id,$Titol,$Enunciat,$items){
		$this->Items = $items;
		$this->Id = $id;
    $this->Titol = $Titol;
    $this->Enunciat= $Enunciat;
	}
	function getItems(){
		return $this->Items;
	}
	function generateHTML(){
		$html = "<div  name='Estimul_".$this->Id."'><h3>".$this->Titol."</h3><p>".$this->Enunciat."</p>";
		for($i=0;$i<count($this->Items);$i++){
			$html.=$this->Items[$i]->generateHTML();
		}
		$html .='</div>';
		return $html;
	}
}
?>
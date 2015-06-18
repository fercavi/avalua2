<?php
class Questionari {
	private $Estimuls;
	private $Id;
	private $EstimulsActiu;
	function __construct ($id,$Estimuls){
		$this->Id = $id;
		$this->Estimuls=$Estimuls;
		$this->EstimulActiu=0;
	}
	function getEstimul(){
		return $this->Estimuls;
	}
	function generateHTML(){
		$html = "";		
		$html.=$this->Estimuls[$this->EstimulActiu]->generateHTML();
		$html.="<nav> <ul class='pager'>";
		if ($this->EstimulActiu!=0){
			$html.=" <li><a href='#' onClick='anterior()'>Anterior</a></li>";	
		}
		if ($this->EstimulActiu<count($this->Estimuls)-1){
			$html.="  <li><a href='#' onClick='seguent()'>Seguent</a></li>";
		}  
  		$html.='</ul></nav>';		
		return  $html;
	}
	function seguent(){
		if($this->EstimulActiu<count($this->Estimuls)){
			$this->EstimulActiu++;
		}
	}
	function anterior(){
		if($this->EstimulActiu!=0){
			$this->EstimulActiu--;
		}
	}
	function setRespostesEstimulActiu($respostes){
		for($i=0;$i<count($this->Estimuls[$this->EstimulActiu]->Items);$i++){
			$this->Estimuls[$this->EstimulActiu]->Items[$i]->setRespostes($respostes[$i]);
		}
	}
	
}

?>
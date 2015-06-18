<?php
require_once 'Item.php';

class ItemRadioButton extends Item{
	function generateHTML(){
		$pregunta = "<form id='".$this->Id."'>".$this->Enunciat;
  		for($i=0;$i<count($this->Preguntes);$i++){  			
  			if ($this->RespostaContestada($i)){  				
  				$pregunta.="<div class='radio'><label><input type='radio' name='pregunta' resposta='$i' checked>".$this->Preguntes[$i]."</input></label></div>";
  			}
  			else{
  				$pregunta.="<div class='radio'><label><input type='radio' name='pregunta' resposta='$i'>".$this->Preguntes[$i]."</input></label></div>";
  			}
  		}
  		$pregunta .='</form>';
  		return $pregunta;

  	}  	
}
?>
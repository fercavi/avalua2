<?php
  abstract class Item {
  	protected $Enunciat;
  	protected $Preguntes;
  	protected $Respostes;
  	protected $Id;
  	function __construct($id,$enunciat,$preguntes,$respostes){
  		$this->Enunciat=$enunciat;
  		$this->Preguntes=$preguntes;
  		$this->Respostes = $respostes;
  		$this->Id=$id;
  	}
  	function getRespostes(){
  		return $this->Respostes;
  	}
  	function getPreguntes(){
  		return $this->Preguntes;
  	}
  	function getEnunciat(){
  		return $this->Enunciat;
  	}
  	abstract function generateHTML();
    protected function RespostaContestada($resposta)  {
      $result = false;     
      if (isset($this->Respostes)) {
        if (in_array($resposta,$this->Respostes))
          $result = true;
      }
      return $result;     
    }
    public function setRespostes($respostes){
      $this->Respostes=$respostes;
    }
  }

?>
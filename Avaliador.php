<?php 
	/**
	* 
	*/
	class Avaliador	{

		public $maiorValor = -INF;
		public $menorValor = INF;
		
		public function avalia(Leilao $leilao){

			foreach ($leilao->getLances() as $lance) {
				if($lance->getValor() > $this->maiorValor){
					$this->maiorValor = $lance->getValor();
				}
				if($lance->getValor() < $this->menorValor){
					$this->menorValor = $lance->getValor();
				}
			}

		}

		public function valorMedio(){
			$valorMedio = ($this->maiorValor + $this->menorValor) / 2;
			return $valorMedio;
		}

		public function getMaiorLance()
		{
		    return $this->maiorValor;
		}
		 
		public function getMenorLance()
		{
		    return $this->menorValor;
		}


	}
?>
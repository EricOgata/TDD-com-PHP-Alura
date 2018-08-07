<?php 
	/**
	* 
	*/
	class Avaliador	{

		private $maiorValor = -INF;
		private $menorValor = INF;
		private $valorMedio;
		private $maiores;
		
		public function avalia(Leilao $leilao){

			foreach ($leilao->getLances() as $lance) {
				if($lance->getValor() > $this->maiorValor){
					$this->maiorValor = $lance->getValor();
				}
				if($lance->getValor() < $this->menorValor){
					$this->menorValor = $lance->getValor();
				}
			}

			$this->valorMedio = $this->calculaValorMedio();
			$this->pegaOsMaioresNo($leilao);

		}
		/**
		 * Calcula o valor médio dos lances através do maior lance e menor lance
		 * @return [type] [Valor Médio dos Lances]
		 */
		public function calculaValorMedio(){
			$valorMedio = ($this->maiorValor + $this->menorValor) / 2;
			return $valorMedio;
		}

		/**
		 * Realiza um sort dentro do leilão, organizando-o em ordem decrescente, e 
		 * retorna os 3 maiores valores;
		 * 
		 * @param  Leilao $leilao [leilão a ser organizado]
		 * @return [type]         [description]
		 */
		public function pegaOsMaioresNo(Leilao $leilao){

			$lances = $leilao->getLances();
			usort($lances, function($a, $b){
				if($a->getValor() == $b->getValor()) return 0;
				return ($a->getValor() < $b->getValor()) ? 1 : -1;
			});

			$this->maiores = array_slice($lances, 0, 3);

		}

		// GETS & SETTERS
		public function getMaiorLance()
		{
		    return $this->maiorValor;
		}
		 
		public function getMenorLance()
		{
		    return $this->menorValor;
		}

		public function getValorMedio()
		{
		    return $this->valorMedio;
		}

		public function getMaiores()
		{
		    return $this->maiores;
		}

	}
?>
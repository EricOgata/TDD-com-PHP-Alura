<?php 
	require "Usuario.php";
	require "Lance.php";
	require "Leilao.php";
	require "Avaliador.php";

	class AvaliadorTest extends PHPUnit_Framework_TestCase{
		
		public function test(){
			$leilao = new Leilao("Playstation 4");

			$renan = new Usuario("Renan");
			$caio = new Usuario("Caio");
			$felipe = new Usuario("Felipe");

			$leilao->propoe(new Lance($renan, 400));
			$leilao->propoe(new Lance($caio, 350));
			$leilao->propoe(new Lance($felipe, 250));

			$leiloeiro = new Avaliador();
			$leiloeiro->avalia($leilao);

			$maiorEsperado = 400;
			$menorEsperado = 250;

			$this->assertEquals( $leiloeiro->getMaiorLance(), $maiorEsperado );
			$this->assertEquals( $leiloeiro->getMenorLance(), $menorEsperado );
		}
	}
?>
<?php 
	require "Usuario.php";
	require "Lance.php";
	require "Leilao.php";
	require "Avaliador.php";
	use PHPUnit\Framework\TestCase;

	/*
		Git Bash:
			./vendor/bin/phpunit --color --debug AvaliadorTest
	 */

	class AvaliadorTest extends TestCase{
		
		public function testDeveAceitarLancesEmOrdemDecrescente(){
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

			// Assert Equals (O que você espera, O que você quer comparar)
			$this->assertEquals( $maiorEsperado, $leiloeiro->getMaiorLance(), 0.00001 );
			$this->assertEquals( $menorEsperado, $leiloeiro->getMenorLance(), 0.00001 );
		}

		public function testPegaOsTresMaiores(){
			$joao = new Usuario("Joao");
			$renan = new Usuario("Renan");
			$felipe = new Usuario("Felipe");

			$leilao = new Leilao("Playstation 3");

			$leilao->propoe(new Lance($joao, 250));
			$leilao->propoe(new Lance($renan, 300));
			$leilao->propoe(new Lance($joao, 350));
			$leilao->propoe(new Lance($felipe, 400));
			$leilao->propoe(new Lance($renan, 450));
			$leilao->propoe(new Lance($joao, 500));

			$leiloeiro = new Avaliador();
			$leiloeiro->avalia($leilao);

			$maiores = $leiloeiro->getMaiores();

			$this->assertEquals(count($maiores), 3);
			$this->assertEquals($maiores[0]->getValor(),500);
			$this->assertEquals($maiores[1]->getValor(),450);
			$this->assertEquals($maiores[2]->getValor(),400);
		}

		public function testValidaComUmLance(){
			$joao = new Usuario("Joao");

			$leilao = new Leilao("Playstation 3");

			$leilao->propoe(new Lance($joao, 200));

			$leiloeiro = new Avaliador();
			$leiloeiro->avalia($leilao);

			$valorEsperado = 200;

			$this->assertEquals($valorEsperado, $leiloeiro->getMaiorLance() );
			$this->assertEquals($valorEsperado, $leiloeiro->getMenorLance() );

		}

		public function testValorMedioDosLances(){
			$leilao = new Leilao("Carro");

			$usuario1 = new Usuario("Túlio");
			$usuario2 = new Usuario("Maria");

			$leilao->propoe(new Lance($usuario1,20000));
			$leilao->propoe(new Lance($usuario2,10000));

			// ( 20000 + 10000 )/2 = 15.000
			
			$leiloeiro = new Avaliador();
			$leiloeiro->avalia($leilao);

			$mediaEsperada = 15000;

			$this->assertEquals( $mediaEsperada, $leiloeiro->getValorMedio(), 0.00001 );
		}

		public function testLancesAleatorios(){
			$leilao = new Leilao("Pamonha");

			$usuario1 = new Usuario("Túlio");

			$leilao->propoe(new Lance($usuario1,200));
			$leilao->propoe(new Lance($usuario1,450));
			$leilao->propoe(new Lance($usuario1,120));
			$leilao->propoe(new Lance($usuario1,700));
			$leilao->propoe(new Lance($usuario1,630));
			$leilao->propoe(new Lance($usuario1,230));
			$leilao->propoe(new Lance($usuario1,500));

			$leiloeiro = new Avaliador();
			$leiloeiro->avalia($leilao);

			$maiorLanceEsperado = 700;
			$menorLanceEsperado = 120;

			$this->assertEquals($maiorLanceEsperado, $leiloeiro->getMaiorLance() );
			$this->assertEquals($menorLanceEsperado, $leiloeiro->getMenorLance() );
		}

		public function testLancesDecrescentes(){
			$leilao = new Leilao("Pamonha");

			$usuario1 = new Usuario("Túlio");
			$leilao->propoe(new Lance($usuario1, 400));
			$leilao->propoe(new Lance($usuario1, 300));
			$leilao->propoe(new Lance($usuario1, 200));
			$leilao->propoe(new Lance($usuario1, 100));

			$leiloeiro = new Avaliador();
			$leiloeiro->avalia($leilao);

			// Testar maior e menor lances
			$maiorLanceEsperado = 400;
			$menorLanceEsperado = 100;
			
			$this->assertEquals($maiorLanceEsperado, $leiloeiro->getMaiorLance() );
			$this->assertEquals($menorLanceEsperado, $leiloeiro->getMenorLance() );

			// Testar 3 maiores lances
			$testMaioresLances = array(400,300,200);
			$maiores = $leiloeiro->getMaiores();

			$this->assertEquals(count($maiores), 3);
			$this->assertEquals($maiores[0]->getValor(), $testMaioresLances[0]);
			$this->assertEquals($maiores[1]->getValor(), $testMaioresLances[1]);
			$this->assertEquals($maiores[2]->getValor(), $testMaioresLances[2]);
		}

	}
?>
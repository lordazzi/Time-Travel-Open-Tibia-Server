<?php
# AUTHOR: RICARDO AZZI #
# CREATED: 14/01/13 #

class buyPoints {
	private $acc;
	private $pagserguro;
	private $paypal;
	private $sql;
	
	const pagseguro_email = "email@hotmail.com";
	const pagseguro_token = "TOKEN";
	
	public function __construct($qtdd = 10, $style = "pagseguro") {
		/* CONSIDERANDO A SEGUINTE TABELA DE PREÇOS
			- 10 pontos: R$ 10,00
			- 25 pontos: R$ 25,00
			- 50 pontos: R$ 45,00
			- 100 pontos: R$ 85,00
		*/
		//criando objetos
		$this->acc = new Account(@$_SESSION["account"]);
		$this->sql = new MySql("ttotsite");

		if ($qtdd == 0 OR !$this->acc->isLogin() OR !($this->acc->getIdVip() <> 0) OR $this->acc->getCountry() <> "Brasil") {
			echo("Impossível entrar no pagseguro: faça o seu login!");
			return FALSE;
			exit;
		}

		//quantidade de pontos comprados
		$qtd100 = 0;
		$qtd50 = 0;
		$qtd1 = 0;
		
		//100 pontos
		if ($qtdd >= 100) {
			$qtd100 = floor($qtdd / 100);
			$qtdd = $qtdd % 100;
		}
		
		//50 pontos
		if ($qtdd >= 50) {
			$qtd50 = floor($qtdd / 50);
			$qtdd = $qtdd % 50;
		}
		
		//pontos restantes
		$qtd1 = $qtdd;
		
		//forma de pagamento (paypal, pagseguro)
		if ($style == "paypal") {
			$transation = "PP";
		} else {
			System::using("PagSeguro");
			
			//compra com pagseguro
			$this->pagseguro = new PagSeguroPaymentRequest();
			
			//identificador de produtos comprados
			$uid_qtd1 = 0;
			$uid_qtd50 = 0;
			$uid_qtd100 = 0;
			$transation = "PS";
			
			//compra de 50 pontos para baixo
			if ($qtd1 <> 0) {
				$this->pagseguro->addItem(
					'0001', //Número de identificação do produto
					"1 ponto VIP para Time Travel", //Nome do item
					$qtd1, //Quantidade
					1.00 //Valor 
				);
				
				$uid_qtd1 .= $this->sql->Query("INSERT INTO accounts_pontos (idaccount, idponto, nrqtdd, txtplugin, dtcadastro) VALUES (".$this->acc->getAccountId().", 1, $qtd1, 'pagseguro', NOW())");
				$transation .= "-$uid_qtd1";
			} else {
				$transation .= "-0";
			}
			
			//compra entre 50 e 100 pontos
			if ($qtd50 <> 0) {
				$this->pagseguro->addItem(
					'0002', 
					"50 pontos VIP para Time Travel", 
					$qtd50, 
					45.00 //Valor 
				);
				
				$uid_qtd50 = $this->sql->Query("INSERT INTO accounts_pontos (idaccount, idponto, nrqtdd, txtplugin, dtcadastro) VALUES (".$this->acc->getAccountId().", 2, $qtd50, 'pagseguro', NOW())");
				$transation .= "-$uid_qtd50";
			} else {
				$transation .= "-0";
			}
			
			//compra de 100 pontos
			if ($qtd100 <> 0) {
				$this->pagseguro->addItem(
					'0003', 
					"100 pontos VIP para Time Travel", 
					$qtd100, 
					85.00 //Valor 
				);
				
				$uid_qtd100 = $this->sql->Query("INSERT INTO accounts_pontos (idaccount, idponto, nrqtdd, txtplugin, dtcadastro) VALUES (".$this->acc->getAccountId().", 3, $qtd100, 'pagseguro', NOW())");
				$transation .= "-$uid_qtd100";
			} else {
				$transation .= "-0";
			}
			
			//adicionando variavel de transição
			if ($uid_qtd1 <> 0) { $this->sql->Query("UPDATE accounts_pontos SET txttransacao='$transation' WHERE idcompra='$uid_qtd1'"); }
			if ($uid_qtd50 <> 0) { $this->sql->Query("UPDATE accounts_pontos SET txttransacao='$transation' WHERE idcompra='$uid_qtd50'"); }
			if ($uid_qtd100 <> 0) { $this->sql->Query("UPDATE accounts_pontos SET txttransacao='$transation' WHERE idcompra='$uid_qtd100'"); }
			
			//configurando as coisas do pagseguro
			$this->pagseguro->setSender(
				$this->acc->getUserName(), //Nome do comprador  
				$this->acc->getEmail(), //e-mail do comprador
				$this->acc->getTelPrefixo(), //DDD
				$this->acc->getTelefone() //telefone 
			);
			
			$this->pagseguro->setShippingAddress(  
				$this->acc->getCep(), //CEP   
				$this->acc->getLogr(), //Nome da rua
				$this->acc->getNumero(), //número da casa
				$this->acc->getCompl(), //complemento
				$this->acc->getBairro(), //bairro
				$this->acc->getCidade(), //cidade
				$this->acc->getEstado(), //estado
				'BRA' //país
			);
			
			$this->pagseguro->setCurrency("BRL"); //moeda
			$this->pagseguro->setShippingType(3); //frete indefinido
			$this->pagseguro->setReference($transation);//associação com o meu sistema
			
			// fazendo a requisição a API do PagSeguro pra obter a URL de pagamento  
			$url = $this->pagseguro->register(
				new PagSeguroAccountCredentials(  
					buyPoints::pagseguro_email,
					buyPoints::pagseguro_token				
				)
			);

			header("location: $url");
		}
	}
}

?>
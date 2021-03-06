<?php 
class Produto {
	public $conn;



	function cadastroDeProdutos($Usuario, $nome, $codigo, $validade, $chegada, $lote, $quant,$est){
		global $conn;
		$consulta = $conn->prepare("INSERT INTO produto_pdo(nome,codigo,validade,chegada,lote,fk_user,quantidade,estoque)
			VALUES (?,?,?,?,?,?,?,?)");

		$consulta->execute([$nome,$codigo,$validade,$chegada,$lote,$Usuario,$quant,$est]);
	}
	function returnIdProd($prod,$comp,$quantcomp,$log)
	{
		
		session_start();
		global $conn;
		$ver=$conn->prepare('SELECT * FROM compoe WHERE id_produto =? AND id_componente =? ');
		$ver->execute([$prod,$comp]);
		if ($ver->rowCount()>0) {
	
			header('location: /php/compoe.php');
		}else{
 		

		$compoe = $conn->prepare('INSERT INTO compoe(id_produto,id_componente,quantidade,user_comp) 
			VALUES (?,?,?,?)');
		$compoe->execute([$prod,$comp,$quantcomp,$log]);
	}

		
	}
	function saida($code,$quant,$log){
		global $conn;

		$vender = $conn->prepare("SELECT nome,quantidade FROM produto_pdo  WHERE nome = ? AND fk_user=?");
		$vender->execute([$code,$log]); 
		$adc=$vender->fetch();
		$nome=$adc[0];
		$soma=$adc[1]-$quant;

		$adicionar=$conn->prepare('UPDATE produto_pdo SET quantidade = ? WHERE nome = ?  ');
		$adicionar->execute([$soma,$code]);

		$saidaE= $conn->prepare('INSERT INTO Saida(nome,login,quantidade) VALUES (?,?,?) ');
		$saidaE->execute([$nome,$log,$quant]);
	}
}

?>

<?php
session_start();	
if (isset($_SESSION['login'])) {
	
	include 'POO/Usuario.php';
	$u= new Usuario;
	$u->conectar();
	$nomeUs=$_SESSION['login'];
	require_once ('menu.php');
}else{
	header('location: /php/login/login.php');
}	
$_email=$conn->prepare('SELECT * FROM mail');
$_email->execute();
$_ema=$_email->fetchALL(PDO::FETCH_ASSOC);


?>
<body>
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-6 col-sm-12 col-xs-12" >
				<div class="produto" >
					<h1>Cadastro de Produtos</h2>
					<fieldset>

						<form action="cadprod/addNome.php" method="POST">


								<ul>

								<label>Nome do Produto 
										<input type="text" name="nome" placeholder="Digite o nome do Produto"></label>
										<label>Código do Produto
											<input type="text" name="codigo" placeholder="Digite o codigo do Produto"></label>



											<label>Data da Chegada
												<input type="date" name="chegada" placeholder="dd/mm/aaaa"></label>

												<label>Validade
													<input type="date" name="validade" placeholder="dd/mm/aaaa"></label>


													<label>Lote do Produto
														<input type="text" name="lote" placeholder="Digite o lote"></label>

														<label>Quantidade 
															<input min="1" type="number" name="quant" placeholder="Escolha a quantidade" required></label>

															<label>Estoque de segurança
																<input min="1" type="number" name="estoque" placeholder="Estoque de segurança" required></label>
							<!-- 	Email do fornecedor:
								<select name="mail_forn" >
								<?php foreach($_ema as $email) :?>
									<option value="<?=$email['id_mail']?>" ><?=$email['email']?></option>
								<?php endforeach; ?>
								</select>
							-->
						</div>
						<input class="botao_cadastro" type="submit" value="Cadastrar no Sistema">
					</ul>
				</form>
			</fieldset>
		</div>
	</div>

	<div class="row">
		

		<div class="col-lg-12 col-md-6 col-sm-12 col-xs-12">
			<div class="produto">	
				<h1>Estoque</h2>

				<table border="1" cellpadding="5" cellspacing="0">
					<tr>
						<th>Nome</th>
						<th>Código</th>
						<th>Validade</th>
						<th>Chegada</th>
						<th>Lote</th>
						<th>Quantidade</th>
						<th>Excluir</th>
						<th>Vendas</th>
						<th>Situação do Produto</th>
					</tr>
					<?php 



					$nomes=$conn->prepare('SELECT * FROM produto_pdo WHERE fk_user = :f');
					$nomes->bindValue(":f",$nomeUs);
					$nomes->execute();
		// $res = $nomes->fetch(PDO::FETCH_ASSOC);


					while($res = $nomes->fetch(PDO::FETCH_ASSOC)):	


						?>
					<tr>
						<td><?= $res['nome'] ?></td>
						<td><?=$res['codigo'] ?></td>
						<td><?=$res['validade']?></td>
						<td><?=$res['chegada']?></td>
						<td><?=$res['lote']?></td>
						<td><?=$res['quantidade']?></td>
						<td><a href="/php/cadprod/rmNome.php?id=<?= $res['id'] ?>">
							<img src="../img/excluir.png"></excluir></a></td>
							<!-- <td><a href="/php/exit.php?id=<?= $res['id'] ?>"">oi</a></td> -->
						 <!--<a href="/php/cadprod/altNome.php?id=<?= $res['id'] ?>"> <img src="../img/up.jpg" width="30px" height="30px"></a></td> 
						-->
						<td><a href="/php/exit.php?cod=<?=$res['nome']?>"><img height="30px" width="30px" src="/img/coin.png"></a></td>
						<td><?php 
							//$alert=$conn->prepare('SELECT quantidade FROM produto_pdo WHERE fk_user = :f AND nome="$res[nome]" AND quantidade="0"');
							$alert=$conn->prepare('SELECT quantidade,estoque FROM produto_pdo WHERE fk_user = ? AND quantidade=?'); 
							$alert->bindValue(1,$nomeUs);
							$alert->bindValue(2,$res['quantidade']);
							$alert->execute();
							$a=$alert->fetch();
							$b=$a[0];
							$c=$a[1];

							if($b<=$c){
								echo "<a href='/php/cadmail.php' ><img width='30px' height='30px' src='../img/alert.png'></a>";
							}else{
								echo "<img width='30px' height='30px' src='../img/okay.png'>";
							} ?>

						</td>
					</tr> 
				<?php endwhile; ?>
			</table>	
		</div>
	</div>

</body>


</html>

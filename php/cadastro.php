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
		
?>
<body>
<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-6 col-sm-12 col-xs-12" >
				<div class="produto" >
					<h2>Cadastro de Produtos</h2>
					<fieldset>
<<<<<<< HEAD
					<form action="cadprod/addNome.php" method="POST">
						<ul>
						<p>Cadastre o Produto</p>
						<input type="text" name="nome" placeholder="Digite o nome do Produto">
=======
						<form action="cadprod/addNome.php" method="POST">
							<ul>
<<<<<<< HEAD
								Nome do Produto: 
								<input type="text" name="nome" placeholder="Digite o nome do Produto"></br>
								Código do Produto: 
								<input type="text" name="codigo" placeholder="Digite o codigo do Produto"></br>
=======
								<li>Cadastre o Produto</li>
								<input type="text" name="nome" placeholder="Digite o nome do Produto">
>>>>>>> ab91efa60d2066678f9b2338303837f4d9f2da68
>>>>>>> c61e7ce1737fbd44a324c185183f6516a856a8cf

								Data da Chegada:
								<input type="date" name="chegada" placeholder="dd/mm/aaaa"></br>

								Validade:
								<input type="date" name="validade" placeholder="dd/mm/aaaa"></br>


								lote do Produto:
								<input type="text" name="lote" placeholder="Digite o lote"></br>

								Quantidade: 
								<input type="number" name="quant" placeholder="Escolha a quantidade" required></br>

								Estoque de segurança: 
								<input type="number" name="estoque" placeholder="Estoque de segurança" required></br>

							</div>
							<input class="botao_cadastro" type="submit" value="Cadastrar no Sistema">
						</ul>
					</form>
				</fieldset>
			</div>
		</div>


<<<<<<< HEAD
<div class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Modal body text goes here.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary">Save changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>





	


<div class="row">
		<div class="col-lg-12 col-md-6 col-sm-12 col-xs-12">	
			<h2>Estoque</h2>
=======
		<div class="row">
			<div class="col-lg-12 col-md-6 col-sm-12 col-xs-12">
				<div class="produto">	
				<h2>Estoque</h2>
>>>>>>> ab91efa60d2066678f9b2338303837f4d9f2da68
				<table border="1" cellpadding="5" cellspacing="0">
					<tr>
						<th>Nome</th>
						<th>Código</th>
						<th>Validade</th>
						<th>Chegada</th>
						<th>Lote</th>
						<th>Quantidade</th>
						<th>Excluir</th>
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
						<td><a href="/php/cadprod/rmNome.php?id=<?= $res['id'] ?>"><img src="../img/excluir.png"></excluir></a></td>
						<td><?php 
							//$alert=$conn->prepare('SELECT quantidade FROM produto_pdo WHERE fk_user = :f AND nome="$res[nome]" AND quantidade="0"');
							$alert=$conn->prepare('SELECT quantidade FROM produto_pdo WHERE fk_user = ? AND quantidade=?'); 
							$alert->bindValue(1,$nomeUs);
							$alert->bindValue(2,$res['quantidade']);
							$alert->execute();
							$a=$alert->fetch();
							$b=$a[0];
							

							if($b<=0){
								echo "<img width='30px' height='30px' src='../img/alert.png'>";
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
		
<?php 
session_start();
require_once('menu.php');

$login=$_SESSION['login'];

include 'POO/Usuario.php';
$u = new Usuario();
$u->conectar();
$nameUs=$_SESSION['login'];
$cod=$_GET['cod'] ?? " ";

$_cod=$conn->prepare('SELECT id,nome FROM produto_pdo WHERE fk_user=?');
$_cod->execute([$nameUs]);
$show=$_cod->fetchALL(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
		body {font-family: Arial, Helvetica, sans-serif;color: white;}

input[type=text], input[type=password] {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
}

button {
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
}

button:hover {
    opacity: 0.8;
}

.cancelbtn {
    width: auto;
    padding: 10px 18px;
    background-color: #f44336;
}

.imgcontainer {
    text-align: center;
    margin: 24px 0 12px 0;
}

img.avatar {
    width: 40%;
    border-radius: 50%;
}

.container {
    padding: 16px;
}

span.psw {
    float: right;
    padding-top: 16px;
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
    span.psw {
       display: block;
       float: none;
    }
    .cancelbtn {
       width: 100%;
    }
}
.produto b{
	text-shadow: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black;
}
.ui table, h1{
	text-shadow: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black;
	color: white;
}

	</style>

</head>
<body>
<form method="POST" action="cadprod/exitPdo.php">
	<div class="imgcontainer">
	</div>
	<div class="container">
		<div class="produto">
		<label for="uname"><b>Escolha o Produto</b></label>

		<!--input type="text" placeholder="Inserir codigo ou nome do produto" value="<?=$cod?>" name="code" -->
		 <select name="code" class="form-control" >
		 <option value="0" >---SELECIONE---</option>
		<?php foreach ($show as $see ) :?>
                    <option   value="<?=$see['nome']?>"><?=$see['nome']?></option>
                <?php endforeach ; ?> 
         </select>  
		<input type="number" class="form-control" min="1" placeholder="Inserir quantidade" name="quantities">

		<button type="submit" name="submit">Vender Produtos</button>		
		<label>
		</div>

	</form>

    <div class="imgcontainer" style="margin-right: 30%;
	margin-left: 30%;">
	<table class="ui inverted table" style="text-align:center;">
		<h1>Vendas</h1>
		<tr>
			<th>Nome</th>
			<th>Quantidade</th>
		</tr>
		<?php
	     $saida = $conn->prepare('SELECT * FROM Saida WHERE login =:l');
	     $saida->bindValue(':l',$login);
	     $saida->execute();

		while($res = $saida->fetch(PDO::FETCH_ASSOC)):

			?>
			<tr>
				<td><?=$res['nome']?></td>
				<td><?=$res['quantidade']?></td>
			</tr>
		<?php endwhile; ?>
	</table>

	<a href="/php/pdf/saida.php" ><button>Gerar relatório</button></a>

	</div>
	</div>

	
		

</body>
</html>
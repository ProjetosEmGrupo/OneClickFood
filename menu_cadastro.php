<?PHP
# variáveis para conexão com o banco de dados

error_reporting(0);
$servidor = 'localhost';
$usuario = 'root';
$senha = '';
$banco = 'dblanchonete';
#
# conexão com o SGBD MySQL
$link = mysqli_connect($servidor, $usuario, $senha, $banco);
#
# torna o banco de dados 'dbPHP' utilizável
$select = mysqli_select_db($link, $banco);
#
# sentença SQL para incluir na tabela
$sql = "INSERT INTO tbPedido (data_abertura, data_fechamento) VALUES (?,?)";
#
# "ligação" da conexão com o SGBD com a sentença SQL a ser executada
$stmt = $link->prepare($sql);
#
# preparação/vinculação dos parâmetros de execução da sentença SQL 
$stmt->bind_param("ss", $data_abertura , $data_fechamento); 
#
# variáveis para incluir no banco de dados
date_default_timezone_set('America/Sao_Paulo');
$data_abertura = date("Y-m-d H:i:s");
$data_fechamento = null;
#echo "<script>alert("passei na linha 27"); </script>";
#
#
# executa a operação no banco de dados
#	mysqli_stmt_execute($stmt);

if(mysqli_stmt_execute($stmt)){

}

/*if(mysqli_stmt_execute($stmt))
{
	header("Location: http://www.google.com");
}
else
{
	header("Location: http://www.youtube.com");
}
*/
$sql = "SELECT max(id_pedido) as teste FROM tbpedido";
$result = mysqli_query($link, $sql);
$row = mysqli_fetch_array($result);
$id_pedido = (int)$row["teste"];

echo $row["id_pedido"] ;


$id_produtostr = $_POST['pao'];
$id_produto = (int)$id_produtostr;
$sql = "INSERT INTO  tbItemPedido (id_pedido, id_produto) VALUES (?,?)";
$stmt = $link->prepare($sql);
$stmt->bind_param("ii", $id_pedido, $id_produto); 
mysqli_stmt_execute($stmt);


$id_produtostr = $_POST['recheio'];
$id_produto = (int)$id_produtostr;	
$sql = "INSERT INTO  tbItemPedido (id_pedido, id_produto) VALUES (?,?)";
$stmt = $link->prepare($sql);
$stmt->bind_param("ii", $id_pedido, $id_produto); 
mysqli_stmt_execute($stmt);


$id_produtostr = $_POST['salada'];
$id_produto = (int)$id_produtostr;
$stmt = $link->prepare($sql);
$stmt->bind_param("ii", $id_pedido, $id_produto); 
mysqli_stmt_execute($stmt);

$id_produtostr = $_POST['queijo'];
$id_produto = (int)$id_produtostr;
$stmt = $link->prepare($sql);
$stmt->bind_param("ii", $id_pedido, $id_produto); 
mysqli_stmt_execute($stmt);

$ketchup = $_POST['ketchup'];
$mostarda = $_POST['mostarda'];
$maionese = $_POST['maionese'];

if ($ketchup == true ){
	$id_produto = 31;
	$stmt = $link->prepare($sql);
	$stmt->bind_param("ii", $id_pedido, $id_produto); 
	mysqli_stmt_execute($stmt);
	
}
else {

}
if($mostarda == true) {
	$id_produto = 32;
	$stmt = $link->prepare($sql);
	$stmt->bind_param("ii", $id_pedido, $id_produto); 
	mysqli_stmt_execute($stmt);

}
else {
	
}

if($maionese == true) {
	$id_produto = 33;
	$stmt = $link->prepare($sql);
	$stmt->bind_param("ii", $id_pedido, $id_produto); 
	mysqli_stmt_execute($stmt);

}
else {
}
# fecha a ligação com o SGBD
mysqli_stmt_close($stmt);
?>

<html>
<head>
	<title>Pedido Concluído - OneClickFood</title>

	<link href="css/bootstrap.min.css" rel="stylesheet">
 	<link href="css/titulo.css" rel="stylesheet">
 	<link rel="icon" type="image/png" href="icon.ico"/>

</head>
<body>

     	<!-- Modal Envio -->
     		<div class="modal-dialog" role="document">
     			<div class="modal-content">
     				<div class="modal-header">
     					<a href="indexasdad.html"><button type="button" class="close" data-dismiss="modal" aria-label="Fechar"><span aria-hidden="true">&times;</span></button></a>
     					<h4 class="modal-title" id="modalLabel">Pedido Concluído</h4>
     				</div>
     				<div class="modal-body">Obrigado Por Usar Nosso Sistema !!! <br> Codigo Pedido: <?php echo $id_pedido;?></div>
     				<div class="modal-footer">
     					<a href="indexasdad.html"><button type="button" class="btn btn-default cor-botao" data-dismiss="modal">OK</button></a>
     				</div>
     			</div>
     		</div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="js/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
</body>


</body>
</html>
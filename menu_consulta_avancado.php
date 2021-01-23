<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<title>Pedido Realizado - OneClickFood</title>
	<!-- Bootstrap -->
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/titulo.css" rel="stylesheet">
  <link rel="icon" type="image/png" href="icon.ico"/>
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
    </head>

    <BODY>
     <FORM name="Restaurante" method="POST" action="menu_consulta_avancado.php?acao=finalizar" enctype="multipart/form-data">
      <center>
       <nav class="navbar navbar-default cor-barra">
        <div class="container-fluid">
         <div class="navbar-header">


          <img class="img-responsive" src="logo.png" alt="LOGO" width="170" height="160"></center>

          <a class="navbar-brand" href="index.html"></a>

        </img>

      </div>
    </div>

  </nav>
  <div class="container"> 
   <div class="col-md-12">

    <div class="panel panel-default">
     <div class="panel-body">

      <div class="page-header texto-pedido alim">Pedido</div>
      <br>

      <table class="table table-striped" cellspacing="0" cellpadding="0">

       <thead>

        <tr>
         <th>Codigo Pedido</th>
         <th>Data e Hora Abertura</th>
         <th>Status</th>
         <th>Ingredientes</th>
       </tr>

     </thead>

     <tbody>

      <tr>
       <?php


       error_reporting(0);
       $servidor = 'localhost';
       $usuario = 'root';
       $senha = '';
       $banco = 'dblanchonete';
#
# conexão com o SGBD MySQL
       $link = mysqli_connect($servidor, $usuario, $senha, $banco);
#
# torna o banco de dados  utilizável
       $select = mysqli_select_db($link, $banco);
#
       if (isset($_GET['cod'])){
        $codigo =  $_GET['cod'];
#codigo sql

        $sql ="SELECT tbitempedido.id_pedido, tbproduto.des_produto, tbpedido.data_abertura, tbpedido.data_fechamento from tbitempedido join tbpedido ON tbitempedido.id_pedido = tbpedido.id_pedido JOIN tbproduto on  tbproduto.id_produto = tbitempedido.id_produto WHERE  tbpedido.id_pedido = ". $codigo;

#resultado do codigo sql
        $result = $link->query($sql);
#preparativos para iniciar a repetição para ultilizar o select
#inicio da repetição do select

  #$resultadoidpedido = mysql_fetch_array($sqlidproduto);

        $row = mysqli_fetch_array($result);
        echo "<td>". $row["id_pedido"] ."</td>";
        echo "<td>". $row["data_abertura"] ."</td>";

        $des_produtoadiciona = $row["des_produto"];
        if($row['data_fechamento'] == null){
         Echo"<td>Pedido em Andamento</td>";
       }
       else{
         echo"<td>Pedido Finalizado</td>";
       }
       while ($row = mysqli_fetch_array($result)){
         $des_produto =   $des_produtoadiciona.", ".$des_produto;
         $des_produtoadiciona = $row["des_produto"];
       }
      $des_produto =   $des_produtoadiciona.", ".$des_produto;
       echo"<td>". $des_produto . "</td>";
     }

     echo "</tr>";



     echo" </tbody>";

     echo "</table>";



     echo    "<br>";
     echo "<br>";

     echo"<center>"; 
     echo "<input type='hidden' size=5 value=".$codigo." name=id readonly>";
     ?>

     <input type='submit' class='btn btn-default cor-botao' value='Encerrar' data-toggle="modal" data-target="#botao-encerrar"></input>

     <?php





     if ($_REQUEST["acao"] == "finalizar"){

      if(isset($_POST['id']))
        $codigo =  $_POST['id'];

     /*	$sqlupdate = "UPDATE tbpedido SET data_fechamento = NOW() WHERE id_pedido = ".$codigo ;

		$stmt = $link->prepare($sqlupdate);
		$stmt->bind_param("i", $codigo); 
		mysqli_stmt_execute($stmt);*/
		$sql = "UPDATE tbpedido SET data_fechamento = NOW() WHERE id_pedido = " . $codigo;
		$stmt = $link->prepare($sql);
		$stmt->bind_param("i", $codigo); 
		mysqli_stmt_execute($stmt);
		/*if($testeupdate = $link->mysqli_execute($sqlupdate)){
			echo"teste ok";
		}
		else{
			echo"erro";
		}



     	if(mysqli_query($link, $sqlupdate)) {
     			echo"cadastro";
     		}
     		else {
     			echo"errow";

     		}*/
        ?>

        <script>
          alert('Pedido Terminado Com Sucesso');
          window.location.href = 'consulta_principal.php';
        </script>


        <?php






      }
      ?>
      <div class="modal fade" tabindex="-1" role="dialog" id="botao-encerrar">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Modal title</h4>
            </div>
            <div class="modal-body">
              <p>One fine body&hellip;</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button>
            </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->



      <a href="consulta_principal.php"><button type="button" class="btn btn-default cor-botao" >Voltar</button></a>
      <div class="row">
      </center>








      <!-- Modal Exclusão -->
      <div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel">
       <div class="modal-dialog" role="document">
        <div class="modal-content">
         <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Fechar"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="modalLabel">Encerrar Pedido</h4>
        </div>
        <div class="modal-body">Pedido Encerrado com Sucesso</div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default cor-botao" data-dismiss="modal">OK</button>
        </div>
      </div>
    </div>
  </div>


  <!-- Modal Exclusão -->
  <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Fechar"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="modalLabel">Encerrar Pedido</h4>
        </div>
        <div class="modal-body">Pedido Encerrado com Sucesso</div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default cor-botao" data-dismiss="modal">OK</button>
        </div>
      </div>
    </div>
  </div>









</div>
</div>
</div>
</div>
</center>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="js/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
</FORM>
</body>
</html>
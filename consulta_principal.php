<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Pedidos Realizados - OneClickFood</title>

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

  <body>
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

<div class="col-md-12">


    <div id="top" class="row">
        <div class="col-md-9">
            <div class="texto-pedidos-realizados">Pedidos Realizados</div>
        </div>
    </div>
    <hr>
</div>



<div class="col-md-12">
  <div class="panel panel-default">
    <div class="panel-body">

        <table class="table table-striped" cellspacing="0" cellpadding="0">

         <thead>
           <tr>



               <th>Codigo Pedido</th>
               <th>Data e Hora Abertura</th>
               <th>Status</th>
               <th>Informações</th>






           </tr>
       </thead>

       <tbody>
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

#codigo sql
$sql ="SELECT id_pedido, data_abertura, data_fechamento FROM tbpedido WHERE data_fechamento is null order by id_pedido asc" ;

#resultado do codigo sql
$result = $link->query($sql);
#preparativos para iniciar a repetição para ultilizar o select
#inicio da repetição do select

    #$resultadoidpedido = mysql_fetch_array($sqlidproduto);


while ( $row = mysqli_fetch_array($result)){

    echo "<tr><td>". $row["id_pedido"]."</td>";
    echo "<td>". $row["data_abertura"] . "</td>";
    if($row['data_fechamento'] == null){
      Echo"<td>Pedido em Andamento</td>";
    }
    else{
      echo"<td>Pedido Finalizado</td>";
    }
    echo"<td><a href='menu_consulta_avancado.php?cod=" . $row['id_pedido'] . "'>+Detalhes </a> </td></tr>";

}
    
?>

     </tbody>

 </table>


 <!-- Modal Exclusão -->
 <div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="modalLabel">Excluir Item</h4>
            </div>
            <div class="modal-body">Deseja realmente excluir este item? </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary cor-botao">Sim</button>
                <button type="button" class="btn btn-default cor-botao" data-dismiss="modal">N&atilde;o</button>
            </div>
        </div>
    </div>
</div>



<!-- Modal Concluido -->
<div class="modal fade" id="concluir-modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="modalLabel">Conclusão do Pedido</h4>
            </div>
            <div class="modal-body">Pedido Concluido com Sucesso!!! </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary cor-botao">OK</button>
            </div>
        </div>
    </div>
</div>

</div>
</div>
</div>




<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="js/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
</body>
</html>
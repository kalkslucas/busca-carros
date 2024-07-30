<?php
include 'conexao.php';

?>




<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sistema de Busca</title>
</head>
<body>
  <h1>Lista de Veículos</h1>
  <form action="" method="get">
    <input type="text" name="busca" id="busca" value="<?php if(isset($_GET['busca'])) echo $_GET['busca']?>" placeholder="Digite os termos de pesquisa">
    <button type="submit">Pesquisar</button>
  </form>

  <table border="1" style="margin: 15px; width: 400px;">
    <tr>
      <th>Marca</th>
      <th>Modelo</th>
    </tr>

    <tr>
    <?php
    if(!isset($_GET['busca'])){
      echo "<td colspan='2'>Digite algo para pesquisar</td>";
    } else {
      $pesquisa = filter_var($_GET['busca']);
      $sql = "SELECT marcas.nome as marca, modelos.nome as modelo
      FROM modelos 
      INNER JOIN marcas 
      ON modelos.idmarca = marcas.id 
      WHERE marcas.nome LIKE CONCAT('%', :pesquisa, '%')
      OR modelos.nome LIKE CONCAT('%', :pesquisa, '%')";

      $pesquisar = $conectar->prepare($sql);
      $pesquisar->bindParam(":pesquisa", $pesquisa);
      $pesquisar->execute();
      if($pesquisar->rowCount() > 0){
        while($linha = $pesquisar->fetch(PDO::FETCH_ASSOC)) {
          echo "
          <tr>
            <td>$linha[marca]</td>
            <td>$linha[modelo]</td>
          </tr>  
          ";
        }
      } else if ($pesquisar->rowCount() == 0) {
        echo "<td colspan='2'>Nenhum resultado encontrado</td>";
      }
    }
    ?>

      

    </tr>
  </table>
</body>
</html>
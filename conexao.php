<?php
try {
  //Conecta ao banco de dados
  $conectar = new PDO("mysql:host=localhost;dbname=busca", "root", "");
  $conectar->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
  //Caso ocorra erro de conexão com o banco, exibe essa mensagem
  echo 'Falha ao conectar ao banco de dados: ' . $e->getMessage();
}

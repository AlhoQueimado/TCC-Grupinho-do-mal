<?php
  include 'conexao.php';

  $sql = "INSERT INTO esporte (nome_esporte, numero_jogadores) VALUES ('$_POST[nomeEsporte]', '$_POST[numeroJogadores]')";
  mysqli_query($conexao, $sql);
  

  header('Location:index.php');
?>

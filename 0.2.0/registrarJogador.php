<?php
  include 'conexao.php';

  $sql = "INSERT INTO jogador (nome_jogador) VALUES ('$_POST[nomeJogador]')";
  mysqli_query($conexao, $sql);
  

  header('Location:index.php');
?>

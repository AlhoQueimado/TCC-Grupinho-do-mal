<?php
  include 'conexao.php';

  $sql = "INSERT INTO jogador (nome_jogador, matricula_jogador) VALUES ('$_POST[nomeJogador]', '$_POST[matriculaJogador]')";
  mysqli_query($conexao, $sql);


    header('Location:./?pagina=listaJogadores');
?>

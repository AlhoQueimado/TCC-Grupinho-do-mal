<?php

include 'conexao.php';

$sql = "DELETE FROM jogador WHERE id_jogador = " . $_GET[id];

mysqli_query($conexao, $sql);
$sql = "DELETE FROM pontuacao WHERE id_jogador = " . $_GET[id];
mysqli_query($conexao, $sql);
  header('Location:./?pagina=listaJogadores');
?>

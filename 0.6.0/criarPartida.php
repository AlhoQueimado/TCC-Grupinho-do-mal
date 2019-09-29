<?php

include 'conexao.php';
if (!$_SESSION[admin]) {
  header("location: ./");
  die();
};
  //Gerar link do jogo
function numeroAleatorio()
{
  $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $charactersLength = strlen($characters);
  $randomString = '';
  for ($i = 0; $i < 9; $i++) {
  $randomString .= $characters[rand(0, $charactersLength - 1)];
  }
  return $randomString;
}

    $sql = "INSERT INTO jogo (cod_jogo, id_esporte) VALUES ()";
  while(!mysqli_query($conexao, $sql)){
    $numeroAleatorio = numeroAleatorio();
    $sql = "INSERT INTO jogo (cod_jogo, id_esporte) VALUES ('$numeroAleatorio', '$_GET[id_esporte]')";
    if (mysqli_query($conexao, $sql)) {
      header("location: ./?pagina=iniciojogo&cod_jogo=$numeroAleatorio&id_esporte=$_GET[id_esporte]");
      die();
    };
  }
?>

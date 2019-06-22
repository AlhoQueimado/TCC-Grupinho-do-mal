<?php
  ERROR_REPORTING(E_ALL ^E_NOTICE);
  include 'conexao.php';

  for ($i=0; $i < 6; $i++) {
  $jogadorA[$i] = $_POST['jogadorA'.$i];
  var_dump($_POST['jogadorA'.$i]);
  $jogadorB[$i] = $_POST['jogadorB'.$i];
  $sqlA[$i] = "SELECT id_jogador, elo_jogador FROM jogador WHERE id_jogador = '$jogadorA[$i]'";
  $resultadoA[$i] = mysqli_query($conexao, $sqlA[$i]);
  $resultadoA2[$i] = mysqli_query($conexao, $sqlA[$i]);
  $sqlB[$i] = "SELECT id_jogador, elo_jogador FROM jogador WHERE id_jogador = '$jogadorB[$i]'";
  $resultadoB[$i] = mysqli_query($conexao, $sqlB[$i]);
  $resultadoB2[$i] = mysqli_query($conexao, $sqlB[$i]);
};

for ($i=0; $i < 6; $i++){
  while ($linhaA2[$i] = mysqli_fetch_assoc($resultadoA2[$i])){
    $mediaPontosA += $linhaA2[$i][elo_jogador];
  };
while ($linhaB2[$i] = mysqli_fetch_assoc($resultadoB2[$i])){
    $mediaPontosB += $linhaB2[$i][elo_jogador];
  };
};
if ($_POST[pontuacaoA] > $_POST[pontuacaoB]) {
  $vitoriaA = 1;
  $vitoriaB = 0;
};
if ($_POST[pontuacaoB] > $_POST[pontuacaoA]) {
  $vitoriaB = 1;
  $vitoriaA = 0;
};
$mediaPontosA = $mediaPontosA/6;

$mediaPontosB = $mediaPontosB/6;

$estimativaA = (10 ** ($mediaPontosA/400))/((10 ** ($mediaPontosB/400)) + (10 ** ($mediaPontosA/400)));

$acrescimoPontosA = (($mediaPontosA + 50 *($vitoriaA - $estimativaA)) - $mediaPontosA);

$estimativaB = (10 ** ($mediaPontosB/400))/((10 ** ($mediaPontosA/400)) + (10 ** ($mediaPontosB/400)));
$acrescimoPontosB = (($mediaPontosB + 50 *($vitoriaB - $estimativaB)) - $mediaPontosB);

echo $mediaPontosA;
echo "<br>";
echo $estimativaA;
echo "<br>";
echo $acrescimoPontosA;
echo "<br>";
echo $mediaPontosB;
echo "<br>";
echo $estimativaB;
echo "<br>";
echo $acrescimoPontosB;
echo "<br>";
for ($i=0; $i < 6; $i++){
  while ($linhaA[$i] = mysqli_fetch_assoc($resultadoA[$i])){
    $eloA[$i] = $linhaA[$i][elo_jogador] + $acrescimoPontosA;
    $idA[$i] = $linhaA[$i][id_jogador];
    $updateA = "UPDATE jogador SET elo_jogador='$eloA[$i]' WHERE id_jogador = '$idA[$i]'";
    echo $updateA , "<br>";
    mysqli_query($conexao, $updateA);
  };
  while ($linhaB[$i] = mysqli_fetch_assoc($resultadoB[$i])){
    $eloB[$i] = $linhaB[$i][elo_jogador] + $acrescimoPontosB;
    $idB[$i] = $linhaB[$i][id_jogador];
    $updateB = "UPDATE jogador SET elo_jogador='$eloB[$i]' WHERE id_jogador = '$idB[$i]'";
    echo $updateB , "<br>";
    mysqli_query($conexao, $updateB);
  };
};


header("location: index.php");
?>

<?php
  ERROR_REPORTING(E_ALL ^E_NOTICE);
  include 'conexao.php';
  $sqlEsporte = "SELECT * FROM esporte WHERE id_esporte = '$_GET[id]'";
  $esporte = mysqli_fetch_assoc(mysqli_query($conexao, $sqlEsporte));
  $qtdJogadores = $esporte[numero_jogadores];






  for ($i=0; $i < ($qtdJogadores/2); $i++) {
  $jogadorA[$i] = $_POST['jogadorA'.$i];
  
  $jogadorB[$i] = $_POST['jogadorB'.$i];


  if (!mysqli_fetch_assoc (mysqli_query($conexao, "SELECT id_jogador from pontuacao WHERE id_jogador = '$jogadorA[$i]' AND id_esporte = '$_GET[id]' "))) {
    mysqli_query($conexao, "INSERT INTO pontuacao(id_jogador, id_esporte) VALUES($jogadorA[$i], $esporte[id_esporte])");
  };
  $sqlA[$i] = "SELECT j.id_jogador, p.elo_jogador, p.vitorias_jogador, p.derrotas_jogador FROM jogador j, pontuacao p WHERE j.id_jogador = '$jogadorA[$i]' AND p.id_jogador = '$jogadorA[$i]'";
  $resultadoA[$i] = mysqli_query($conexao, $sqlA[$i]);
  $resultadoA2[$i] = mysqli_query($conexao, $sqlA[$i]);

  if (!mysqli_fetch_assoc (mysqli_query($conexao, "SELECT id_jogador from pontuacao WHERE id_jogador = '$jogadorB[$i]' AND id_esporte = '$_GET[id]' "))) {
    mysqli_query($conexao, "INSERT INTO pontuacao(id_jogador, id_esporte) VALUES($jogadorB[$i], $esporte[id_esporte])");
  };
  $sqlB[$i] = "SELECT j.id_jogador, p.elo_jogador, p.vitorias_jogador, p.derrotas_jogador FROM jogador j, pontuacao p WHERE j.id_jogador = '$jogadorB[$i]' AND p.id_jogador = '$jogadorB[$i]'";
  $resultadoB[$i] = mysqli_query($conexao, $sqlB[$i]);
  $resultadoB2[$i] = mysqli_query($conexao, $sqlB[$i]);

};

for ($i=0; $i < ($qtdJogadores/2); $i++){
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

$mediaPontosA = $mediaPontosA/($qtdJogadores/2);

$mediaPontosB = $mediaPontosB/($qtdJogadores/2);

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
for ($i=0; $i < ($qtdJogadores/2); $i++){
  while ($linhaA[$i] = mysqli_fetch_assoc($resultadoA[$i])){

    $eloA[$i] = $linhaA[$i][elo_jogador] + $acrescimoPontosA;
    $idA[$i] = $linhaA[$i][id_jogador];
    $updateA = "UPDATE pontuacao SET elo_jogador='$eloA[$i]', vitorias_jogador=vitorias_jogador+1  WHERE id_jogador = '$idA[$i]' AND id_esporte = '$esporte[id_esporte]'";

    mysqli_query($conexao, $updateA);
  };
  while ($linhaB[$i] = mysqli_fetch_assoc($resultadoB[$i])){
    $eloB[$i] = $linhaB[$i][elo_jogador] + $acrescimoPontosB;
    $idB[$i] = $linhaB[$i][id_jogador];
    $updateB = "UPDATE pontuacao SET elo_jogador='$eloB[$i]', derrotas_jogador=derrotas_jogador+1  WHERE id_jogador = '$idB[$i]' AND id_esporte = '$esporte[id_esporte]'";

    mysqli_query($conexao, $updateB);
  };
};


header("location: index.php");
?>

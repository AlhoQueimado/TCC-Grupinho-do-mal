<?php
  ERROR_REPORTING(E_ALL ^E_NOTICE);
  include 'conexao.php';
  $sqlEsporte = "SELECT * FROM esporte WHERE id_esporte = '$_GET[id_esporte]'";
  $esporte = mysqli_fetch_assoc(mysqli_query($conexao, $sqlEsporte));
  $qtdJogadores = $esporte[numero_jogadores];






  for ($i=0; $i < ($qtdJogadores/2); $i++) {
  $jogadorA[$i] = $_POST['jogadorA'.$i];

  $jogadorB[$i] = $_POST['jogadorB'.$i];


  if (!mysqli_fetch_assoc (mysqli_query($conexao, "SELECT id_jogador from pontuacao WHERE id_jogador = '$jogadorA[$i]' AND id_esporte = '$_GET[id_esporte]' "))) {
    mysqli_query($conexao, "INSERT INTO pontuacao(id_jogador, id_esporte) VALUES($jogadorA[$i], $esporte[id_esporte])");
  };
  $sqlA[$i] = "SELECT j.id_jogador, p.elo_jogador, p.vitorias_jogador, p.derrotas_jogador FROM jogador j, pontuacao p WHERE j.id_jogador = '$jogadorA[$i]' AND p.id_jogador = '$jogadorA[$i]'";
  $resultadoA[$i] = mysqli_query($conexao, $sqlA[$i]);
  $resultadoA2[$i] = mysqli_query($conexao, $sqlA[$i]);

  if (!mysqli_fetch_assoc (mysqli_query($conexao, "SELECT id_jogador from pontuacao WHERE id_jogador = '$jogadorB[$i]' AND id_esporte = '$_GET[id_esporte]' "))) {
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

//gerar numero aleatorio
function GeraHash($qtd){
//Under the string $Caracteres you write all the characters you want to be used to randomly generate the code.
$Caracteres = 'ABCDEFGHIJKLMOPQRSTUVXWYZ0123456789';
$QuantidadeCaracteres = strlen($Caracteres);
$QuantidadeCaracteres--;

$Hash=NULL;
    for($x=1;$x<=$qtd;$x++){
        $Posicao = rand(0,$QuantidadeCaracteres);
        $Hash .= substr($Caracteres,$Posicao,1);
    }

return $Hash;
}
$d = GeraHash(55);

$pontuacaoA = $_POST[pontuacaoA];
$pontuacaoB = $_POST[pontuacaoB];
$sql = "INSERT INTO jogo(id_esporte, pontos_A, pontos_B, cod_jogo) VALUES ('$esporte[id_esporte]', '$pontuacaoA', '$pontuacaoB', '$d')";
mysqli_query($conexao, $sql);
for ($i=0; $i < ($qtdJogadores/2); $i++){
  while ($linhaA[$i] = mysqli_fetch_assoc($resultadoA[$i])){

    $eloA[$i] = $linhaA[$i][elo_jogador] + $acrescimoPontosA;
    $idA[$i] = $linhaA[$i][id_jogador];
    if ($acrescimoPontosA > 0) {
      $updateA = "UPDATE pontuacao SET elo_jogador='$eloA[$i]', vitorias_jogador=vitorias_jogador+1  WHERE id_jogador = '$idA[$i]' AND id_esporte = '$esporte[id_esporte]'";
    } elseif ($acrescimoPontosA < 0) {
      $updateA = "UPDATE pontuacao SET elo_jogador='$eloA[$i]', derrotas_jogador=derrotas_jogador+1  WHERE id_jogador = '$idA[$i]' AND id_esporte = '$esporte[id_esporte]'";
    };

    mysqli_query($conexao, $updateA);

  };
  $atualizarJogoA = "INSERT INTO jogador_jogo(id_jogador, cod_jogo, elo_jogador, time_jogador) VALUES ('$idA[$i]', '$d', '$eloA[$i]', 'A')";
  mysqli_query($conexao, $atualizarJogoA);
  while ($linhaB[$i] = mysqli_fetch_assoc($resultadoB[$i])){
    $eloB[$i] = $linhaB[$i][elo_jogador] + $acrescimoPontosB;
    $idB[$i] = $linhaB[$i][id_jogador];
    if ($acrescimoPontosB > 0) {
      $updateB = "UPDATE pontuacao SET elo_jogador='$eloB[$i]', vitorias_jogador=vitorias_jogador+1  WHERE id_jogador = '$idB[$i]' AND id_esporte = '$esporte[id_esporte]'";

    } elseif ($acrescimoPontosB < 0) {
      $updateB = "UPDATE pontuacao SET elo_jogador='$eloB[$i]', derrotas_jogador=derrotas_jogador+1  WHERE id_jogador = '$idB[$i]' AND id_esporte = '$esporte[id_esporte]'";
    };

    mysqli_query($conexao, $updateB);
  };
  $atualizarJogoB = "INSERT INTO jogador_jogo(id_jogador, cod_jogo, elo_jogador, time_jogador) VALUES ('$idB[$i]', '$d', '$eloB[$i]', 'B')";
  mysqli_query($conexao, $atualizarJogoB);
};
$sql = "DELETE FROM pontuacao WHERE id_jogador < 0";
mysqli_query($conexao, $sql);
$sql = "DELETE FROM jogador_jogo WHERE id_jogador < 0";
mysqli_query($conexao, $sql);
header("location: index.php");
?>

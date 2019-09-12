<?php
include 'conexao.php';

$sqlJogador = "SELECT * FROM jogador WHERE id_jogador ORDER BY nome_jogador";
$sqlEsporte = "SELECT * FROM esporte WHERE id_esporte = '$_GET[id]' ORDER BY nome_esporte";


$esporte = mysqli_fetch_assoc(mysqli_query($conexao, $sqlEsporte));
$qtdJogadores = $esporte[numero_jogadores];

for ($i=0; $i < ($qtdJogadores/2); $i++){
  $resultadoB[$i] = mysqli_query($conexao, $sqlJogador);
  $resultadoA[$i] = mysqli_query($conexao, $sqlJogador);
};

?>
<div class="jogo">

  <form class="" action="fimjogo.php?id=<?php echo $_GET[id];?>" method="post">
      <div class="timea">
      <?php
        for ($i=0; $i < ($qtdJogadores/2); $i++){
          echo "<select name=\"jogadorA$i\">";

          while ($linha = mysqli_fetch_assoc($resultadoA[$i])) {
            echo "<option value=\"$linha[id_jogador]\">$linha[nome_jogador]</option><br> ";
          };
          echo "</select><br> <br>";
        };
      ?>
      <input type="number" name="pontuacaoA" value="0">
    </div>
    <div class="timeb">
      <?php
        for ($i=0; $i < ($qtdJogadores/2); $i++){
          echo "<select name=\"jogadorB$i\">";

          while ($linha = mysqli_fetch_assoc($resultadoB[$i])) {
            echo "<option value=\"$linha[id_jogador]\">$linha[nome_jogador]</option><br> ";
          };
          echo "</select><br> <br>";
        };
      ?>
      <input type="number" name="pontuacaoB" value="0">
    </div>
    <input type="submit" name="Enviar" value="Enviar">
</div>

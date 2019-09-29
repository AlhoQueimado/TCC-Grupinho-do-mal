<?php
include 'conexao.php';

$sqlEsporte = "SELECT * FROM esporte WHERE id_esporte = '$_GET[id_esporte]' ORDER BY nome_esporte";


$esporte = mysqli_fetch_assoc(mysqli_query($conexao, $sqlEsporte));
$qtdJogadores = $esporte[numero_jogadores];

 $queryA = "id_jogador = ";
 $queryB = "id_jogador = ";

for ($i=0; $i < $qtdJogadores/2; $i++) {
 $jogadorB[$i] = $_POST[jogadorB][$i];
 $jogadorA[$i] = $_POST[jogadorA][$i];

if ($i < $qtdJogadores/2-1) {
  $queryA = $queryA . "$jogadorA[$i] OR id_jogador = ";
} else {
  $queryA = $queryA ."$jogadorA[$i]";
};

if ($i < $qtdJogadores/2-1) {
  $queryB = $queryB . "$jogadorB[$i] OR id_jogador = ";
} else {
  $queryB = $queryB ."$jogadorB[$i]";
};

};


$sqlJogadorA = "SELECT * FROM jogador WHERE $queryA ORDER BY nome_jogador";
$sqlJogadorB = "SELECT * FROM jogador WHERE $queryB ORDER BY nome_jogador";

for ($i=0; $i < ($qtdJogadores/2); $i++){
  $resultadoB = mysqli_query($conexao, $sqlJogadorB);
  $resultadoA = mysqli_query($conexao, $sqlJogadorA);
};

?>
<div class="jogo">

  <form class="" action="fimjogo.php?id_esporte=<?php echo $_GET[id_esporte]?>" method="post">
      <div class="timea">
      <?php
          $i = 0;
          while ($linha = mysqli_fetch_assoc($resultadoA)) {
            $sqlA[$i] = "SELECT j.id_jogador, p.elo_jogador, p.vitorias_jogador, p.derrotas_jogador FROM jogador j, pontuacao p, esporte e WHERE p.id_jogador = '$linha[id_jogador]' AND p.id_esporte = '$_GET[id_esporte]'";

            $resultadoA2[$i] = mysqli_query($conexao, $sqlA[$i]);
            echo "$linha[nome_jogador]<br> ";
            echo "<input type=\"hidden\" name=\"jogadorA$i\" value=\"$linha[id_jogador]\">";

            if (!$linha2[$i] = mysqli_fetch_assoc($resultadoA2[$i])) {
              $linha2[$i][elo_jogador] = 1000;
            }
              echo $linha2[$i][elo_jogador];
            $mediaPontosA += $linha2[$i][elo_jogador];


            echo "<br> <br>";
            $i++;
          };
          echo number_format($mediaPontosA/($qtdJogadores/2), 2);
      ?>
      <input type="number" name="pontuacaoA" value="0">
    </div>
    <div class="timeb">
      <?php
      $i = 0;
      while ($linha = mysqli_fetch_assoc($resultadoB)) {
        $sqlB[$i] = "SELECT j.id_jogador, p.elo_jogador, p.vitorias_jogador, p.derrotas_jogador FROM jogador j, pontuacao p, esporte e WHERE p.id_jogador = '$linha[id_jogador]' AND p.id_esporte = '$_GET[id_esporte]'";

        $resultadoB2[$i] = mysqli_query($conexao, $sqlB[$i]);
        echo "$linha[nome_jogador]<br> ";
        echo "<input type=\"hidden\" name=\"jogadorB$i\" value=\"$linha[id_jogador]\">";

        if (!$linha2[$i] = mysqli_fetch_assoc($resultadoB2[$i])) {
          $linha2[$i][elo_jogador] = 1000;
        }
        echo $linha2[$i][elo_jogador];
        $mediaPontosB += $linha2[$i][elo_jogador];


        echo "<br> <br>";
        $i++;
      };
    echo number_format($mediaPontosB/($qtdJogadores/2), 2);
      ?>
      <input type="number" name="pontuacaoB" value="0">
    </div>
    <input type="submit" name="Enviar" value="Enviar">
    <?php
    $mediaPontosA = $mediaPontosA/($qtdJogadores/2);

    $mediaPontosB = $mediaPontosB/($qtdJogadores/2);

    $estimativaA = (10 ** ($mediaPontosA/400))/((10 ** ($mediaPontosB/400)) + (10 ** ($mediaPontosA/400)));
    echo " <br><br>Time A:". number_format($estimativaA*100, 2)." %<br>";
    $estimativaB = (10 ** ($mediaPontosB/400))/((10 ** ($mediaPontosA/400)) + (10 ** ($mediaPontosB/400)));
    echo "<br>Time B:" .number_format($estimativaB*100, 2)."%<br><br>";?>
</div>

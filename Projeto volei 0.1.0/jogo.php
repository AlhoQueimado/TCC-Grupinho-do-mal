<?php
include 'conexao.php';

$sql = "SELECT * FROM jogador WHERE id_jogador ORDER BY nome_jogador";
for ($i=0; $i < 6; $i++){
  $resultadoB[$i] = mysqli_query($conexao, $sql);
  $resultadoA[$i] = mysqli_query($conexao, $sql);
};

?>
<div class="jogo">
  <form class="" action="fimjogo.php" method="post">
    <div class="timea">
      <?php
        for ($i=0; $i < 6; $i++){
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
        for ($i=0; $i < 6; $i++){
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

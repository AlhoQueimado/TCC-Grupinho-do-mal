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
if (!$jogadorA[$i]) {
  $jogadorA[$i] = $i * -1;
};
if (!$jogadorB[$i]) {
  $jogadorB[$i] = $i * -2;
};
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


$sqlJogadorA = "SELECT jogador.id_jogador, jogador.nome_jogador, usuario.imagem_usuario FROM jogador  LEFT JOIN usuario ON   usuario.matricula_usuario=jogador.matricula_jogador WHERE $queryA";

$sqlJogadorB = "SELECT jogador.id_jogador, jogador.nome_jogador, usuario.imagem_usuario FROM jogador  LEFT JOIN usuario ON   usuario.matricula_usuario=jogador.matricula_jogador WHERE $queryB";

for ($i=0; $i < ($qtdJogadores/2); $i++){
  $resultadoB = mysqli_query($conexao, $sqlJogadorB);
  $resultadoA = mysqli_query($conexao, $sqlJogadorA);
};

?>
<div class="jogo">

  <form class="" action="fimjogo.php?id_esporte=<?php echo $_GET[id_esporte]?>" method="post">
    <div  >
      <div class="timea" style="display: table-cell;">
        <h1>Time A</h1>
        <table>


      <?php
          $i = 0;
          while ($linha = mysqli_fetch_assoc($resultadoA)) {
            $sqlA[$i] = "SELECT j.id_jogador, p.elo_jogador, p.vitorias_jogador, p.derrotas_jogador FROM jogador j, pontuacao p, esporte e WHERE p.id_jogador = '$linha[id_jogador]' AND p.id_esporte = '$_GET[id_esporte]'";

            $resultadoA2[$i] = mysqli_query($conexao, $sqlA[$i]);
            if (!$linha[imagem_usuario]) {
              $linha[imagem_usuario] = "default.png";
            };

            if ($IA == 3) {
              echo "<tr>";
            };
            echo "<td>";
            echo " <br><br><img class='checkboxJogador' id=\"lista$linha[id_jogador]\"src='$linha[imagem_usuario]' width='75' height='75' style='background-color:white; box-shadow: 0px 1px 3px grey;border-radius:  2px;'/> <br>";

            echo "$linha[nome_jogador]<br> ";
            echo "<input type=\"hidden\" name=\"jogadorA$i\" value=\"$linha[id_jogador]\">";

            if (!$linha2[$i] = mysqli_fetch_assoc($resultadoA2[$i])) {
              $linha2[$i][elo_jogador] = 1000;
            }
              echo $linha2[$i][elo_jogador];
            $mediaPontosA += $linha2[$i][elo_jogador];
            echo "</td>";
            //Quebrar linha automatico
            $IA+=1;
            if ($IA == 3) {
              echo "</tr>";
              $IA = 0;
            };
            //Fim quebra linha


            $i++;
          };

      ?>
      <br>

        </table>
      </table>
      <div id="chanceA">

      </div>
        <br><br>
        <input id="pontA" type="hidden" name="pontuacaoA" value="1">
        <div class="controlePontuacaoA">
        <a href="#" onclick="aumentarPontuacaoA()">+</a>

        <div id="pontuacaoA">

        </div>
    <a href="#" onclick="diminuirPontuacaoA()">-</a>
      </div>
        <script type="text/javascript">
        document.getElementById('pontuacaoA').innerHTML = document.getElementById('pontA').value;
        function diminuirPontuacaoA() {
          document.getElementById('pontA').value -= 1;
            document.getElementById('pontuacaoA').innerHTML = document.getElementById('pontA').value;
            event.preventDefault();
        }
        function aumentarPontuacaoA() {
          document.getElementById('pontA').value ++;
            document.getElementById('pontuacaoA').innerHTML = document.getElementById('pontA').value;
            event.preventDefault();
        }

        </script>
    </div>
    <div class="espaçamento" style="display: table-cell;">

    </div>
    <div class="timeb" style="display: table-cell;">
      <h1>Time B</h1>
        <table>
      <?php
      $i = 0;
      while ($linha = mysqli_fetch_assoc($resultadoB)) {

          $sqlB[$i] = "SELECT j.id_jogador, p.elo_jogador, p.vitorias_jogador, p.derrotas_jogador FROM jogador j, pontuacao p, esporte e WHERE p.id_jogador = '$linha[id_jogador]' AND p.id_esporte = '$_GET[id_esporte]'";
        $resultadoB2[$i] = mysqli_query($conexao, $sqlB[$i]);
        if (!$linha[imagem_usuario]) {
          $linha[imagem_usuario] = "default.png";
        };
        if ($IB == 3) {
          echo "<tr>";
        };
        echo "<td>";
        echo " <br><br><img class='checkboxJogador' id=\"lista$linha[id_jogador]\"src='$linha[imagem_usuario]' width='75' height='75' style='background-color:white; box-shadow: 0px 1px 3px grey;border-radius:  2px;'/> <br>";

        echo "$linha[nome_jogador]<br> ";
        echo "<input type=\"hidden\" name=\"jogadorB$i\" value=\"$linha[id_jogador]\">";

        if (!$linha2[$i] = mysqli_fetch_assoc($resultadoB2[$i])) {
          $linha2[$i][elo_jogador] = 1000;
        }
          echo $linha2[$i][elo_jogador];
        $mediaPontosB += $linha2[$i][elo_jogador];
        echo "</td>";
        //Quebrar linha automatico
        $IB+=1;
        if ($IB == 3) {
          echo "</tr>";
          $IB = 0;
        };
        //Fim quebra linha
        $i++;
      };

      ?>
      <br>

      </table>
      <div id="chanceB">

      </div>
      <br><br>

      <input id="pontB" type="hidden" name="pontuacaoB" value="1">
      <div class="controlePontuacaoB">
        <a href="#" onclick="aumentarPontuacaoB()" style="color: #4CAF50">+</a>
        <div id="pontuacaoB">

        </div>
        <a href="#" onclick="diminuirPontuacaoB()" style="color: #4CAF50">-</a>
      </div>

      <script type="text/javascript">
      document.getElementById('pontuacaoB').innerHTML = document.getElementById('pontB').value;
      function diminuirPontuacaoB() {
        document.getElementById('pontB').value -= 1;
          document.getElementById('pontuacaoB').innerHTML = document.getElementById('pontB').value;
          event.preventDefault();
      }
      function aumentarPontuacaoB() {
        document.getElementById('pontB').value ++;
          document.getElementById('pontuacaoB').innerHTML = document.getElementById('pontB').value;
          event.preventDefault();
      }

      </script>
    </div>
    <br><br><br><br>
    <?php
 $mediaPontosA = $mediaPontosA/($qtdJogadores/2);
   echo "<input type=\"submit\" name=\"Enviar\" value=\"Fim do Jogo\" style='padding:4%;padding-top:2%;padding-bottom:2%;'>";
$mediaPontosB = $mediaPontosB/($qtdJogadores/2);

$estimativaA = (10 ** ($mediaPontosA/400))/((10 ** ($mediaPontosB/400)) + (10 ** ($mediaPontosA/400)));

 $estimativaB = (10 ** ($mediaPontosB/400))/((10 ** ($mediaPontosA/400)) + (10 ** ($mediaPontosB/400)));
?>
  <script type="text/javascript">
    document.getElementById('chanceB').innerHTML = "<?php echo "<br>Chance de Vitória: " .number_format($estimativaB*100)."%<br><br>";?>";
    document.getElementById('chanceA').innerHTML = "<?php echo "<br>Chance de Vitória: " .number_format($estimativaA*100)."%<br><br>";?>";
  </script>
</div>
</div>

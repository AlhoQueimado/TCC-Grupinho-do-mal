<?php
  include 'conexao.php';
  $sql = "SELECT p.id_pontuacao, j.id_jogador, j.nome_jogador, e.id_esporte, e.nome_esporte, p.elo_jogador, p.vitorias_jogador, p.derrotas_jogador FROM jogador j, esporte e, pontuacao p WHERE (j.id_jogador = '$_GET[id]' OR j.matricula_jogador = '$_GET[matricula]') AND j.id_jogador = p.id_jogador AND e.id_esporte = p.id_esporte ORDER BY p.vitorias_jogador, p.elo_jogador  desc";
  $resultado = mysqli_query($conexao, $sql);
 ?>
<div class="perfilBox">
  <div class="perfilTopo">
    <?php
  $jogador = "SELECT j.id_jogador, j.nome_jogador, j.matricula_jogador FROM jogador j, usuario u WHERE id_jogador = '$_GET[id]' OR (j.matricula_jogador = '$_GET[matricula]' AND j.matricula_jogador != NULL) OR  (matricula_usuario = '$_GET[matricula]'  AND j.matricula_jogador = matricula_usuario)" ;
  $jogador = mysqli_query($conexao, $jogador);
  $jogador = mysqli_fetch_assoc($jogador);
  $usuario = "SELECT u.imagem_usuario, u.login_usuario, u.matricula_usuario FROM usuario u, jogador j  WHERE u.matricula_usuario = j.matricula_jogador AND (id_jogador = '$_GET[id]' OR  matricula_usuario = '$_GET[matricula]')" ;
  $usuario = mysqli_query($conexao, $usuario);
  $usuario = mysqli_fetch_assoc($usuario);

 ?>
    <h1><?php echo $jogador[nome_jogador]; ?></h1>
    <?php $_GET[id] = $jogador[id_jogador]; ?>
    <h2 style="color: #efcdac; width: 100%;"><?php if ($usuario[login_usuario]) {echo $usuario[login_usuario];}else {echo "Não possui conta :(";} ?></h2>
  </div>
  <div class="perfilImagemBox">
    <div class="perfilImagem">
      <?php if ( $usuario[imagem_usuario]): ?>
        <img src="<?php echo $usuario[imagem_usuario]; ?>"  style="background: white;">
      <?php else: ?>
        <img src="default.png" alt="" style="background: white;">
      <?php endif; ?>
    </div>
    <div class="perfilMenu">
      <ul>

        <li>Mais Jogados</li><br>
        <table>


        <?php	while ($linha = mysqli_fetch_assoc($resultado)) {
            echo "<tr>";
            echo "<th><a href='#' onclick=\"graafico('$linha[nome_esporte]',$linha[vitorias_jogador],$linha[derrotas_jogador])\">$linha[nome_esporte]</th></a>";
            echo "<th>V</th>";
            echo "<th>D</th>";
            echo "<th>%</th>";
            echo "</tr>";
        		echo "<tr>";


        		echo "<td>$linha[elo_jogador]</td>";
            echo "<td>$linha[vitorias_jogador]</td>";
            echo "<td>$linha[derrotas_jogador]</td>";
            echo "<td>";
            echo number_format($linha[vitorias_jogador] * 100 / ($linha[derrotas_jogador]+$linha[vitorias_jogador]));
            echo "%</td>";
            echo "</tr>";
            echo "<tr>";
            echo "<th><br></th>";
            echo "</tr>";
          };

        ?></table>
      </ul><br><br><br><br><br><br><br>

      <ul>
        <li>Companheiros Preferidos</li><br>
          <?php
              $sqlCompanheiros = "SELECT COUNT(cod_jogo) as cod_jogo, jogador_jogo.id_jogador, jogador.nome_jogador FROM jogador_jogo JOIN jogador ON jogador_jogo.id_jogador = jogador.id_jogador  WHERE jogador_jogo.cod_jogo = ANY (SELECT jogador_jogo.cod_jogo FROM jogador_jogo WHERE jogador_jogo.id_jogador = $_GET[id]) AND jogador_jogo.time_jogador = ANY (SELECT jogador_jogo.time_jogador FROM jogador_jogo WHERE jogador_jogo.id_jogador = $_GET[id]) AND jogador_jogo.id_jogador != $_GET[id] GROUP BY jogador_jogo.id_jogador order by COUNT(cod_jogo) desc";
              $resultadoCompanheiros = mysqli_query($conexao, $sqlCompanheiros);
              while ($linhaCompanheiros = mysqli_fetch_assoc($resultadoCompanheiros) AND $index2 < 10) {
                echo "<li> $linhaCompanheiros[nome_jogador]  <p style=\"float: right;\">$linhaCompanheiros[cod_jogo]</p> </li>";
                $index2++;
              }
           ?>
      </ul><br><br><br>
      <div id="jogar" style="text-align: center;">




      </div>
    </div>
  </div>
  <div class="perfilDireitaBox">
    <div class="perfilHistorico">
      <h1>Ultimos Jogos</h1>
      <br><br><br><br><br><br>
      <ul>
        <?php

          $historico = "SELECT  jogo.pontos_A, jogo.pontos_B, jogo.data_jogo, jogo.id_esporte, esporte.nome_esporte, jogador_jogo.time_jogador FROM jogo  JOIN jogador_jogo  ON jogador_jogo.id_jogador = $jogador[id_jogador] AND jogador_jogo.cod_jogo = jogo.cod_jogo JOIN esporte ON jogo.id_esporte = esporte.id_esporte ORDER BY jogo.data_jogo desc";
          $resultadoHistorico  = mysqli_query($conexao, $historico);

          while ($linhaHistorico = mysqli_fetch_assoc($resultadoHistorico) AND $index < 5) {

              // code...

            if ( $linhaHistorico[time_jogador] == "A") {
              if ($linhaHistorico[pontos_A] > $linhaHistorico[pontos_B]) {
                $vitoria = "win";
              } elseif ($linhaHistorico[pontos_A] < $linhaHistorico[pontos_B]) {
                $vitoria = "lose";
              }
            };
            if ( $linhaHistorico[time_jogador] == "B") {
              if ($linhaHistorico[pontos_A] < $linhaHistorico[pontos_B]) {
                $vitoria = "win";
              } elseif ($linhaHistorico[pontos_A] > $linhaHistorico[pontos_B]) {
                $vitoria = "lose";
              }
            }
            echo "<li id=\"$vitoria\">" . $linhaHistorico[nome_esporte] . " <p class=\"placar\"> " . $linhaHistorico[pontos_A] . " x ". $linhaHistorico[pontos_B] . "</p><br><p style =\"font-size: 8px\">$linhaHistorico[data_jogo]</p></li>";
            $index++;
          };

         ?>


      </ul>
    </div>
    <h1 id="nomeEsporte" style="display:none;">Esporte</h1>
    <div class="graficosEsportes" style="display:none;">

      <div class="chart-container">
        <div class="pie-chart-container">
          <canvas id="pie-chartcanvas-1"></canvas>
        </div>
        <div class="line-chart-container">
        <canvas id="line-chart" width="800" height="450"></canvas>
        </div>
      </div>

    </div>
  </div>

</div>

<script type="text/javascript">
//grafico
function graafico(nomeEsporte, numeroVitorias, numeroDerrotas){
  $(".graficosEsportes").show();
  $(".chartjs-hidden-iframe").remove;
  $("#nomeEsporte").show();
  document.getElementById('nomeEsporte').innerHTML = nomeEsporte;
  grafico.data.datasets[0].data[0] = numeroVitorias;
  grafico.data.datasets[0].data[1] = numeroDerrotas;
  grafico.update();

$(".perfilHistorico").hide();
event.preventDefault();


i = 1;};
var grafico = new Chart(document.getElementById("pie-chartcanvas-1"), {
    type: 'doughnut',
    data: {
      labels: ["Vitorias", "Derrotas"],
      datasets: [
        {
          label: "Taxa de Jogo",
          backgroundColor: ["#3e95cd","#E85353"],
          data: [0, 0],
        }
      ]
    },
    options: {
      legend: {
        display: false,
        position: 'top',
      },
      title: {
        display: false,
        text: "esporte",
      },

    rotation:  1* Math.PI,
    circumference: 1  * Math.PI

    }
});
new Chart(document.getElementById("line-chart"), {
  type: 'line',
  data: {
    labels: [1500,1600,1700,1750,1800,1850,1900,1950,1999,2050],
    datasets: [{
        data: [86,114,106,106,107,111,133,221,783,2478],
        label: "Africa",
        borderColor: "#3e95cd",
        fill: false
      }, {
        data: [282,350,411,502,635,809,947,1402,3700,5267],
        label: "Asia",
        borderColor: "#8e5ea2",
        fill: false
      }, {
        data: [168,170,178,190,203,276,408,547,675,734],
        label: "Europe",
        borderColor: "#3cba9f",
        fill: false
      }, {
        data: [40,20,10,16,24,38,74,167,508,784],
        label: "Latin America",
        borderColor: "#e8c3b9",
        fill: false
      }, {
        data: [6,3,2,2,7,26,82,172,312,433],
        label: "North America",
        borderColor: "#c45850",
        fill: false
      }
    ]
  },
  options: {
    title: {
      display: true,
      text: 'World population per region (in millions)'
    }
  }
});
</script>

<?php
  include 'conexao.php';
  $sql = "SELECT p.id_pontuacao, j.id_jogador, j.nome_jogador, e.id_esporte, e.nome_esporte, p.elo_jogador, p.vitorias_jogador, p.derrotas_jogador FROM jogador j, esporte e, pontuacao p WHERE (j.id_jogador = '$_GET[id]' OR j.matricula_jogador = '$_GET[matricula]') AND j.id_jogador = p.id_jogador AND e.id_esporte = p.id_esporte ORDER BY p.vitorias_jogador, p.elo_jogador  desc";
  $resultado = mysqli_query($conexao, $sql);
 ?>
<div class="perfilBox">
  <div class="perfilTopo">
    <?php
  $jogador = "SELECT j.nome_jogador, j.matricula_jogador FROM jogador j, usuario u WHERE id_jogador = '$_GET[id]' OR (j.matricula_jogador = '$_GET[matricula]' AND j.matricula_jogador != NULL) OR  (matricula_usuario = '$_GET[matricula]'  AND j.matricula_jogador = matricula_usuario)" ;
  $jogador = mysqli_query($conexao, $jogador);
  $jogador = mysqli_fetch_assoc($jogador);
  $usuario = "SELECT u.imagem_usuario, u.login_usuario, u.matricula_usuario FROM usuario u, jogador j  WHERE u.matricula_usuario = j.matricula_jogador AND (id_jogador = '$_GET[id]' OR  matricula_usuario = '$_GET[matricula]')" ;
  $usuario = mysqli_query($conexao, $usuario);
  $usuario = mysqli_fetch_assoc($usuario);

 ?>
    <h1><?php echo $jogador[nome_jogador]; ?></h1>
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
        <li>Zé</li>
        <li>Zé II</li>
        <li>Zé III, o muito pika</li>
      </ul><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
      <div id="jogar" style="text-align: center;">


        <?php
          //Gerar link do jogo
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < 9; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }

 ?>
        <a  href="?pagina=criarPartida&id_partida=<?php echo $randomString; ?>">Jogar!</a>
      </div>
    </div>
  </div>
  <div class="perfilDireitaBox">
    <div class="perfilHistorico">
      <h1>Ultimos Jogos</h1>
      <br><br><br><br><br><br>
      <ul>
        <li id="win">Volei  <p class="placar">3 x 1</p></li>
        <li id="win">Futebol  <p class="placar">3 x 1</p></li>
        <li id="lose">Futebol  <p class="placar">1 x 3</p></li>
        <li id="win">Cabeçada  <p class="placar">3 x 1 </p></li>
      </ul>
    </div>
    <h1 id="nomeEsporte" style="display:none;">Esporte</h1>
    <div class="graficosEsportes">

      <div class="chart-container">
        <div class="pie-chart-container">
          <canvas id="pie-chartcanvas-1"></canvas>
        </div>
      </div>

    </div>
  </div>

</div>

<script type="text/javascript">
//grafico
function graafico(nomeEsporte, numeroVitorias, numeroDerrotas){

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

    rotation: Math.PI,
    circumference: Math.PI

    }
})
</script>

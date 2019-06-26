
<?php
  $n = 1;
	include 'conexao.php';

	$sql = "SELECT p.id_pontuacao, j.id_jogador, j.nome_jogador, e.id_esporte, e.nome_esporte, p.elo_jogador, p.vitorias_jogador, p.derrotas_jogador FROM jogador j, esporte e, pontuacao p WHERE j.id_jogador = '$_GET[id]' AND j.id_jogador = p.id_jogador AND e.id_esporte = p.id_esporte ORDER BY p.elo_jogador, p.vitorias_jogador desc";


	$resultado = mysqli_query($conexao, $sql);

?>


<?php
  $usuario = "SELECT nome_jogador FROM jogador WHERE id_jogador = '$_GET[id]'";
  $usuario = mysqli_query($conexao, $usuario);
  $usuario = mysqli_fetch_assoc($usuario);
 ?>
<div class="jogador">
<div class="lista">
<div class="listaJogador">

<br>
<h2><?php echo $usuario[nome_jogador]; ?></h2>
<br>
<br><br>
<br><br>
<table border="1">
	<tr>
    <td></td>
		<td>Esporte</td>
    <td>Elo</td>
    <td>Vitorias</td>
    <td>Derrotas</td>
    <td>%</td>


<?php
	while ($linha = mysqli_fetch_assoc($resultado)) {
		echo "<tr>";
    echo "<td>$n.º</td>";
    echo "<td><a href='?pagina=esporte&id=$linha[id_esporte]'>$linha[nome_esporte]</td></a>";
		echo "<td>$linha[elo_jogador]</td>";
    echo "<td>$linha[vitorias_jogador]</td>";
    echo "<td>$linha[derrotas_jogador]</td>";
    echo "<td>";
    echo number_format($linha[vitorias_jogador] * 100 / ($linha[derrotas_jogador]+$linha[vitorias_jogador]));
    echo "%</td>";

    $jogo[id_jogador][$n] = $linha[id_jogador];
    $jogo[elo_jogador][$n] = $linha[elo_jogador];
    $jogo[nome_esporte][$n] = $linha[nome_esporte];
    $jogo[vitorias_jogador][$n] = $linha[vitorias_jogador];
    $jogo[derrotas_jogador][$n] = $linha[derrotas_jogador];
    $jogo[numero_jogos][$n] = $linha[vitorias_jogador] + $linha[derrotas_jogador];

    if ($n==1) {
      $esporte[id_esporte] = $linha[id_esporte];
      $esporte[nome_esporte] = $linha[nome_esporte];
      $esporte[vitorias_jogador] = $linha[vitorias_jogador];
      $esporte[derrotas_jogador] = $linha[derrotas_jogador];
    };


		echo "</tr>";
    $n +=1;
	}
  for ($i=1; $i < $n; $i++) {



  };
?>
	</tr>
</table>
</div>
</div>
</div>

<div class="grafico">



<div class="chart-container">
  <div class="pie-chart-container">
    <canvas id="pie-chartcanvas-1"></canvas>
  </div>
</div>

<br><br><br><br><br><br>
<div class="chart-container">
  <div class="pie-chart-container-grande">
    <canvas id="pie-chartcanvas-2"></canvas>
  </div>
</div>
<br><br><br><br><br><br>
<div class="chart-container">
  <div class="bar-chart-container-grande">
<canvas id="bar-chart-grouped"></canvas>


</div>
</div>
</div>
<!--<br><br><br>
<div class="chart-container">
  <div class="line-chart-container-grande">
<canvas id="line-chart"></canvas>
</div>
</div> -->

<script src="jquery.js"></script>
<script src="chart.min.js"></script>
<script type="text/javascript">


new Chart(document.getElementById("pie-chartcanvas-1"), {
    type: 'doughnut',
    data: {
      labels: ["Vitorias", "Derrotas"],
      datasets: [
        {
          label: "Taxa de Jogo",
          backgroundColor: ["#3e95cd","#E85353"],
          data: [<?php
          echo "$esporte[vitorias_jogador], $esporte[derrotas_jogador]";
          ?>]
        }
      ]
    },
    options: {
      legend: {
        position: 'bottom',
      },
      title: {
        display: true,
        text: <?php
        echo "\"$esporte[nome_esporte]\"";
        ?>
      },

    }
});
//grafico 2

new Chart(document.getElementById("pie-chartcanvas-2"), {
    type: 'doughnut',
    data: {
      labels: [<?php
      for ($i=1; $i < $n; $i++) {
        echo "\"".$jogo[nome_esporte][$i]."\"".",";
      };
        ?>],
      datasets: [
        {
          label: "Taxa de Jogo",
          backgroundColor: ["#3e95cd","#E85353","#FDE74C", "#A14EBF", "#9BC53D", "#26547C", "#EF476F"],
          data: [<?php
          for ($i=1; $i < $n; $i++) {
            echo $jogo[numero_jogos][$i]. " ,";
          };
          ?>]
        }
      ]
    },
    options: {
      title: {
        display: true,
        text: 'Diversidade de Jogos'
      },
      legend: {
        position: 'bottom',
      },
      rotation: 1 * Math.PI,
    circumference: 1 * Math.PI
    }
});
//grafico 3

new Chart(document.getElementById("bar-chart-grouped"), {
    type: 'bar',
    data: {
      labels: [<?php
      for ($i=1; $i < $n; $i++) {
        echo "\"".$jogo[nome_esporte][$i]."\"".",";
      };
        ?>],
      datasets: [
        {
          label: "Total de Jogos",
          backgroundColor: " #464646",
          data: [<?php
          for ($i=1; $i < $n; $i++) {
            echo $jogo[numero_jogos][$i]. " ,";
          };
          ?>]
        }, {
          label: "Vitorias",
          backgroundColor: "#3e95cd",
          data: [<?php
          for ($i=1; $i < $n; $i++) {
            echo $jogo[vitorias_jogador][$i]. " ,";
          };
          ?>]
        }, {
          label: "Derrotas",
          backgroundColor: "#E85353",
          data: [<?php
          for ($i=1; $i < $n; $i++) {
            echo $jogo[derrotas_jogador][$i]. " ,";
          };
          ?>],

        }
      ]
    },
    options: {
      legend: {
        position: 'bottom',
      },
      minBarLength: 25,
      title: {
        display: true,
        text: 'Taxa de Vitoria'
      }
    }
});

//grafico 4
new Chart(document.getElementById("line-chart"), {
  type: 'line',
  data: {
    labels: ["Pontuação"],
    datasets:[
      <?php
      for ($i=1; $i < $n; $i++) {


        echo "{data:[". $jogo[elo_jogador][$i]. "] ,";
        echo "label:[\"".$jogo[nome_esporte][$i]."\""."] ,";
        echo "borderColor: \"#3e95cd\",";
        echo "fill: false},";
      };
        ?>
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

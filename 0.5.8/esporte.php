
<?php
  $n = 1;
	include 'conexao.php';

	$sql = "SELECT j.id_jogador, j.nome_jogador, e.id_esporte, e.nome_esporte ,p.elo_jogador, p.vitorias_jogador, p.derrotas_jogador FROM jogador j, esporte e, pontuacao p WHERE e.id_esporte = '$_GET[id]' AND e.id_esporte = p.id_esporte AND j.id_jogador = p.id_jogador ORDER BY p.elo_jogador desc, j.nome_jogador asc ";


	$resultado = mysqli_query($conexao, $sql);

?>

<?php
  $usuario = "SELECT nome_esporte FROM esporte WHERE id_esporte = '$_GET[id]'";
  $usuario = mysqli_query($conexao, $usuario);
  $usuario = mysqli_fetch_assoc($usuario);
 ?>
 <div class="jogador">
<div class="lista">
<br>
<h2><?php echo $usuario[nome_esporte]; ?></h2>
<br>
<br>

<table border="1">
	<tr>
    <td></td>
		<td>Esporte</td>
    <td>Elo</td>
    <td>Vitorias</td>
    <td>Derrotas</td>
    <td>%Vitoria</td>

<?php
	while ($linha = mysqli_fetch_assoc($resultado)) {
		echo "<tr>";
    echo "<td>$n.º</td>";
    echo "<td><a href='?pagina=jogador&id=$linha[id_jogador]'>$linha[nome_jogador]</td></a>";
		echo "<td>$linha[elo_jogador]</td>";
    echo "<td>$linha[vitorias_jogador]</td>";
    echo "<td>$linha[derrotas_jogador]</td>";
    echo "<td>";
    echo number_format($linha[vitorias_jogador] * 100 / ($linha[derrotas_jogador]+$linha[vitorias_jogador]));
    echo "%</td>";

    $jogo[nome_jogador][$n] = $linha[nome_jogador];
    $jogo[elo_jogador][$n] = $linha[elo_jogador];



		echo "</tr>";
    $n +=1;
	}
?>
	</tr>
</table>
</div>
</div>
<div class="graficoEsporte">
<div class="chart-container">
  <div class="pie-chart-container-grandao">
    <canvas id="pie-chartcanvas-2" ></canvas>
  </div>
</div>
</div>

<script src="jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
<script type="text/javascript">
new Chart(document.getElementById("pie-chartcanvas-2"), {
    type: 'doughnut',
    data: {
      labels: [<?php
      for ($i=1; $i < $n; $i++) {
        echo "\"".$jogo[nome_jogador][$i]."\"".",";
      };
        ?>],
      datasets: [
        {
          label: "Pontuação",
          backgroundColor: ["#3e95cd","#E85353","#FDE74C", "#A14EBF", "#9BC53D", "#26547C", "#EF476F", "#3e95cd","#E85353","#FDE74C", "#A14EBF", "#9BC53D", "#26547C", "#EF476F", "#3e95cd","#E85353","#FDE74C", "#A14EBF", "#9BC53D", "#26547C", "#EF476F"],
          data: [<?php
          for ($i=1; $i < $n; $i++) {
            echo $jogo[elo_jogador][$i]. " ,";
          };
          ?>]
        }
      ]
    },
    options: {
      title: {
        display: true,
        text: 'Pontuação dos Jogadores'
      },
      legend: {
        position: 'bottom',
        fullWidth: false,
        display: false,
      },
      rotation: 2 * Math.PI,
    circumference: 2 * Math.PI,

    }
});
</script>

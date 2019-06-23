
<?php
  $n = 1;
	include 'conexao.php';

	$sql = "SELECT j.id_jogador, j.nome_jogador, e.id_esporte, e.nome_esporte ,p.elo_jogador, p.vitorias_jogador, p.derrotas_jogador FROM jogador j, esporte e, pontuacao p WHERE e.id_esporte = '$_GET[id]' AND e.id_esporte = p.id_esporte AND j.id_jogador = p.id_jogador ORDER BY p.elo_jogador desc ";


	$resultado = mysqli_query($conexao, $sql);

?>

<a href="?pagina=formJogador">Cadastrar Jogador</a><br>
<a href="?pagina=formEsporte">Cadastrar Esporte</a><br>
<a href="?pagina=listaEsportes">Começar jogo</a>
<?php
  $usuario = "SELECT nome_esporte FROM esporte WHERE id_esporte = '$_GET[id]'";
  $usuario = mysqli_query($conexao, $usuario);
  $usuario = mysqli_fetch_assoc($usuario);
 ?>
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
    <td></td>

<?php
	while ($linha = mysqli_fetch_assoc($resultado)) {
		echo "<tr>";
    echo "<td>$n.º</td>";
    echo "<td>$linha[nome_jogador]</td>";
		echo "<td>$linha[elo_jogador]</td>";
    echo "<td>$linha[vitorias_jogador]</td>";
    echo "<td>$linha[derrotas_jogador]</td>";
    echo "<td>";
    echo $linha[vitorias_jogador] * 100 / ($linha[derrotas_jogador]+$linha[vitorias_jogador]);
    echo "</td>";

		echo "<td>";

		echo "<a href='excluirJogador.php?id=$linha[id_jogador]' class='botao'><img src=\"lixo.png\" width=\"20px\"></a>";
		echo "</td>";
		echo "</tr>";
    $n +=1;
	}

?>
	</tr>
</table>
</div>

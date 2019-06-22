
<?php
  $n = 1;
	include 'conexao.php';

	$sql = "SELECT id_jogador, nome_jogador, elo_jogador FROM jogador ORDER BY elo_jogador desc, nome_jogador asc ";
	$resultado = mysqli_query($conexao, $sql);

?>

<a href="?pagina=formJogador">Cadastrar Jogador</a><br>
<a href="?pagina=jogo">Começar jogo</a>

<div class="lista">
<br>
<h2>Lista de Jogadores</h2>
<br>
<br>

<table border="1">
	<tr>
    <td></td>
		<td>Código</td>
		<td>Nome</td>
		<td>Elo</td>
    <td></td>

<?php
	while ($linha = mysqli_fetch_assoc($resultado)) {
		echo "<tr>";
    echo "<td>$n.º</td>";
		echo "<td>$linha[id_jogador]</td>";
		echo "<td>$linha[nome_jogador]</td>";
		echo "<td>$linha[elo_jogador]</td>";

		echo "<td>";

		echo "<a href='excluirJogador.php?id=$linha[id_jogador]' class='botao'><img src=\"lixo.png\" width=\"20px\"></a>";
		echo "</td>";
		echo "</tr>";
    $n += 1;
	}
?>
	</tr>
</table>
</div>

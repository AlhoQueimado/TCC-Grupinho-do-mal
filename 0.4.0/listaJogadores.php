
<?php
  $n = 1;
	include 'conexao.php';

	$sql = "SELECT id_jogador, nome_jogador FROM jogador ORDER BY nome_jogador asc ";
	$resultado = mysqli_query($conexao, $sql);

?>



<div class="lista">
<br>
<h2>Lista de Jogadores</h2>
<a href="?pagina=formJogador">Adicionar um novo jogador</a>
<br>
<br>

<table border="1">
	<tr>

		<td>Código</td>
		<td>Nome</td>
    <td></td>

<?php
	while ($linha = mysqli_fetch_assoc($resultado)) {
		echo "<tr>";
		echo "<td>$linha[id_jogador]</td>";
		echo "<td><a href='?pagina=jogador&id=$linha[id_jogador]'>$linha[nome_jogador]</td></a>";
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

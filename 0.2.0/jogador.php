
<?php
  $n = 1;
	include 'conexao.php';

	$sql = "SELECT p.id_pontuacao, j.id_jogador, j.nome_jogador, e.id_esporte, e.nome_esporte, p.elo_jogador, p.vitorias_jogador, p.derrotas_jogador FROM jogador j, esporte e, pontuacao p WHERE j.id_jogador = '$_GET[id]' AND j.id_jogador = p.id_jogador AND e.id_esporte = p.id_esporte";


	$resultado = mysqli_query($conexao, $sql);

?>

<a href="?pagina=formJogador">Cadastrar Jogador</a><br>
<a href="?pagina=formEsporte">Cadastrar Esporte</a><br>
<a href="?pagina=listaEsportes">Começar jogo</a>

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
    echo "<td>$linha[nome_esporte]</td>";
		echo "<td>$linha[elo_jogador]</td>";

		echo "<td>";

		echo "<a href='excluirJogador.php?id=$linha[id_jogador]' class='botao'><img src=\"lixo.png\" width=\"20px\"></a>";
		echo "</td>";
		echo "</tr>";
	}

?>
	</tr>
</table>
</div>

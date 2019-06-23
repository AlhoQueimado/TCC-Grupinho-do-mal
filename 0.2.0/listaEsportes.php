
<?php

	include 'conexao.php';

	$sql = "SELECT * FROM esporte ORDER BY nome_esporte asc ";
	$resultado = mysqli_query($conexao, $sql);

?>

<a href="?pagina=formJogador">Cadastrar Jogador</a><br>
<a href="?pagina=formEsporte">Cadastrar Esporte</a><br>
<a href="?pagina=inicio">Inicio</a>

<div class="lista">
<br>
<h2>Lista de Esportes</h2>
<br>
<br>

<table border="1">
	<tr>

		<td>Código</td>
		<td>Nome</td>
		<td>Qtd Jogadores</td>
    <td></td>

<?php
	while ($linha = mysqli_fetch_assoc($resultado)) {
		echo "<tr>";
		echo "<td>$linha[id_esporte]</td>";
		echo "<td><a href='?pagina=jogo&id=$linha[id_esporte]'>$linha[nome_esporte]</td></a>";
		echo "<td>$linha[numero_jogadores]</td>";

		echo "<td>";

		echo "<a href='excluirEsporte.php?id=$linha[id_esporte]' class='botao'><img src=\"lixo.png\" width=\"20px\"></a>";
		echo "</td>";
		echo "</tr>";

	}
?>
	</tr>
</table>
</div>

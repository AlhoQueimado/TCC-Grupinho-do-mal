
<?php

	include 'conexao.php';

	$sql = "SELECT * FROM esporte ORDER BY nome_esporte asc ";
	$resultado = mysqli_query($conexao, $sql);

?>



<div class="lista">
<br>
<h2>Lista de Esportes</h2>
<a href="?pagina=formEsporte">Adicionar um novo esporte</a>
<br>
<br>

<table border="1">
	<tr>

		<td>Código</td>
		<td>Nome</td>
		<td>Qtd Jogadores</td>
		<td>Imagem</td>
    <td></td>
		  <td></td>

<?php
	while ($linha = mysqli_fetch_assoc($resultado)) {
		echo "<tr>";
		echo "<td>$linha[id_esporte]</td>";
		echo "<td><a href='?pagina=esporte&id=$linha[id_esporte]'>$linha[nome_esporte]</td></a>";

		echo "<td>$linha[numero_jogadores]</td>";
		echo "<td> <img class='imagem' src='$linha[imagem_esporte]' width='50' /> </td>";
		echo "<td><a href='?pagina=jogo&id=$linha[id_esporte]'><img class='imagem' src='bola.ico' width='20px' /></td></a>";
		echo "<td>";

		echo "<a href='excluirEsporte.php?id=$linha[id_esporte]' class='botao'><img src=\"lixo.png\" width=\"20px\"></a>";
		echo "</td>";
		echo "</tr>";

	}
?>
	</tr>
</table>
</div>

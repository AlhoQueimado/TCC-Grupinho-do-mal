
<?php

	include 'conexao.php';

	$sql = "SELECT * FROM esporte ORDER BY nome_esporte asc ";
	$resultado = mysqli_query($conexao, $sql);

?>



<div class="lista">
<br>
<h2>Lista de Esportes</h2>

<br>
<br>

<table border="1">

<?php
	while ($linha = mysqli_fetch_assoc($resultado)) {
	if ($i == 3) {
		echo "<tr>";
	};
		echo "<td >";
		echo "<a href='?pagina=esporte&id=$linha[id_esporte]'>$linha[nome_esporte]<br><br>";
		echo " <img class='imagem' src='$linha[imagem_esporte]' width='200' height='200'/> </a>";
		echo "</td>";
		$i+=1;
		if ($i == 3) {
			echo "</tr>";
			$i = 0;
		};

	}

?>

</table>
</div>

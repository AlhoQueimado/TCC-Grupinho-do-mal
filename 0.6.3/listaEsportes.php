
<?php

	include 'conexao.php';

	$sql = "SELECT * FROM esporte ORDER BY nome_esporte asc ";
	$resultado = mysqli_query($conexao, $sql);

?>



<div class="lista">
<br>
<h2>Esportes</h2>

<br>
<br>

<table border="1">

<?php
	while ($linha = mysqli_fetch_assoc($resultado)) {
	if ($i == 3) {
		echo "<tr>";
	};
		echo "<td >";

		echo " <a href='?pagina=esporte&id=$linha[id_esporte]'><img class='imagem' id='listaEsportes' src='$linha[imagem_esporte]'/><br><br>";
		echo "$linha[nome_esporte]<br><br></a>";
		if ($_SESSION[admin]) {
			echo "<a id='botaoJogar' href='?pagina=inicioJogo&id_esporte=$linha[id_esporte]' >";
			echo "<div id='botaoJogar' style=\"display:flex;justify-content:center;align-items:center;\">";
			echo "<h1>Jogar</h1>";
			echo "</div></a>	";
		};

		echo "";
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

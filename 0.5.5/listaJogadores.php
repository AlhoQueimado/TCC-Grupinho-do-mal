
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


<?php
	while ($linha = mysqli_fetch_assoc($resultado)) {
    if ($i == 6) {
  		echo "<tr>";
  	};
  		echo "<td >";
  		echo "<a href='?pagina=jogador&id=$linha[id_jogador]'>$linha[nome_jogador]<br><br>";
  		echo " <img class='imagem' src='$linha[imagem_jogador]' width='75' height='75'/> </a>";
  		echo "</td>";
  		$i+=1;
  		if ($i == 6) {
  			echo "</tr>";
  			$i = 0;
  		};

  	}


?>
	</tr>
</table>
</div>

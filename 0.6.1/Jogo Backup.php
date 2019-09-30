
<?php
  $n = 1;
	include 'conexao.php';

	$sql = "SELECT jogador.id_jogador, jogador.nome_jogador, usuario.imagem_usuario FROM jogador LEFT JOIN usuario ON usuario.matricula_usuario=jogador.matricula_jogador ORDER BY nome_jogador  asc";
	$resultado = mysqli_query($conexao, $sql);

  $sqlEsporte = "SELECT * FROM esporte WHERE id_esporte = '$_GET[id_esporte]' ORDER BY nome_esporte";

  $esporte = mysqli_fetch_assoc(mysqli_query($conexao, $sqlEsporte));
  $qtdJogadores = $esporte[numero_jogadores];
?>



<div class="lista">
<br>
<h2>Lista de Jogadores</h2>

<br>
<br>

<table border="1">


<?php
  if (!$_POST) {
    while ($linha = mysqli_fetch_assoc($resultado)) {
      if ($i == 6) {
        echo "<tr>";
      };
        if (!$linha[imagem_usuario]) {
          $linha[imagem_usuario] = "default.png";
        };
        echo "<td >";
        echo "<a href='#'  onclick=\"escolherJogador($linha[id_jogador])\">$linha[nome_jogador]<br><br>";
        echo " <img class='imagem' id=\"lista$linha[id_jogador]\"src='$linha[imagem_usuario]' width='75' height='75'/> </a>";
        echo "</td>";
        $i+=1;
        if ($i == 6) {
          echo "</tr>";
          $i = 0;
        };

      };


  ?>
  <form class="" action="?pagina=jogo&id=<?php echo $_GET[id_esporte];?>&cod_jogo=<?php echo $_GET[cod_jogo];?>" method="post">

      <?php
        for ($i=0; $i < ($qtdJogadores/2); $i++){
        echo "<input id=\"JogadorA$i\" type=\"hidden\" name=\"JogadorA$i\" value=\" \">";
        echo "<input id=\"JogadorB$i\" type=\"hidden\" name=\"JogadorB$i\" value=\" \">";
        };
      ?>
      <input type="submit" name="" value="Começar">

  <script >
    var i = 0
    var j = 0
    function escolherJogador(id_jogador) {

      event.preventDefault();

        if (i < <?php echo $qtdJogadores;?>) {
          if (i < <?php echo $qtdJogadores/2;?>) {
            document.getElementById('lista'+id_jogador).style.border = "3px solid red";
            document.getElementById('JogadorA'+i).value = id_jogador;
          } else {
            document.getElementById('lista'+id_jogador).style.border = "3px solid blue";
            document.getElementById('JogadorB'+j).value = id_jogador;
            j++;
          };
          i++;

        };
  };
  </script>

<?php  }; ?>
</table>
</div>

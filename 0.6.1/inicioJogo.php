
<?php
  $n = 1;
	include 'conexao.php';

	$sql = "SELECT jogador.id_jogador, jogador.nome_jogador, usuario.imagem_usuario FROM jogador LEFT JOIN usuario ON usuario.matricula_usuario=jogador.matricula_jogador ORDER BY nome_jogador  asc";
	$resultado = mysqli_query($conexao, $sql);

  $sqlEsporte = "SELECT * FROM esporte WHERE id_esporte = '$_GET[id_esporte]' ORDER BY nome_esporte";

  $esporte = mysqli_fetch_assoc(mysqli_query($conexao, $sqlEsporte));
  $qtdJogadores = $esporte[numero_jogadores];
?>
<link rel="stylesheet" href="hack.css">


<div class="lista">
<br>
<h2>Selecionar Jogadores</h2>
<?php if (!$_POST): ?>
<h3>Time A</h3>
<?php else: ?>
<h3>Time B</h3>
<?php endif; ?>

<br>
<br>

<table border="1">

<?php if ($_POST): ?>
  <form class="formularioJogadores" action=" <?php echo "?pagina=jogo&id_esporte=$_GET[id_esporte]&cod_jogo=$_GET[cod_jogo]" ?> " method="post">
<?php endif; ?>
<?php if (!$_POST): ?>
  <form class="formularioJogadores" action="#" method="post">
<?php endif; ?>

<?php

  if ($_POST) {
    $time = "B";
    $cor = "#4CAF50";
  }else {
    $time = "A";
    $cor = "#F99B43";
  };
    while ($linha = mysqli_fetch_assoc($resultado)) {
      if ($i == 6) {
        echo "<tr>";
      };
        if (!$linha[imagem_usuario]) {
          $linha[imagem_usuario] = "default.png";
        };
        echo "<td >";
        echo "<label for=\"teste$linha[id_jogador]\">";
        echo " $linha[nome_jogador]<br><br>";
        echo " <img class='checkboxJogador' id=\"lista$linha[id_jogador]\"src='$linha[imagem_usuario]' width='75' height='75' style='border-bottom:5px solid gray'/> ";
        echo "</label>";
        echo "<input class=\"checkboxJogador\" id=\"teste$linha[id_jogador]\" type=\"checkbox\" name=\"jogador$time"."[]\" value=\"$linha[id_jogador]\" style=\"display:none;\">";
        echo "</td>";

        //Quebrar linha automatico
        $i+=1;
        if ($i == 6) {
          echo "</tr>";
          $i = 0;
        };
        //Fim quebra linha

      };

      if ($_POST) {
        for ($i=0; $i < $qtdJogadores/2; $i++) {
          $JogadorA[$i] = $_POST["jogadorA"][$i];
          echo "<input type=\"hidden\" name=\"jogadorA[$i]\" value=\"$JogadorA[$i]\">";
        };
      };
  ?>

<script type="text/javascript">

  $('.checkboxJogador').on('change', function() {

    var i = this.value;

    if($('.checkboxJogador:checked').length > <?php echo $qtdJogadores/2 ?>) {
       this.checked = false;
    };
    if(this.checked) {
        document.getElementById('lista'+i).style.borderBottom = "5px solid <?php echo $cor ?>";
    }else if (!this.checked) {
        document.getElementById('lista'+i).style.borderBottom = "5px solid gray";
    }
  });
</script>
<?php if (!$_POST): ?>
<input id="botaoJogar" type="submit" name="" value="Continuar">
<?php else: ?>
<input id="botaoJogar2" type="submit" name="" value="Começar Partida" >
<?php endif; ?>
<br><br>
</table>
</div>
</form>

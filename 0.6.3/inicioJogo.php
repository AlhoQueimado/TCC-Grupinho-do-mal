
<?php
  $n = 1;
	include 'conexao.php';

  $n = 1;
	include 'conexao.php';

	$sql = "SELECT jogador.id_jogador, jogador.nome_jogador, usuario.imagem_usuario FROM jogador LEFT JOIN usuario ON usuario.matricula_usuario=jogador.matricula_jogador  WHERE jogador.id_jogador > 0 ORDER BY nome_jogador  asc";
	$resultado = mysqli_query($conexao, $sql);

  $sqlEsporte = "SELECT * FROM esporte WHERE id_esporte = '$_GET[id_esporte]' ORDER BY nome_esporte";

  $esporte = mysqli_fetch_assoc(mysqli_query($conexao, $sqlEsporte));
  $qtdJogadores = $esporte[numero_jogadores];

?>




<div class="lista">
<br>
<h2 >Selecionar Jogadores</h2>


</div>
<?php if ($_POST): ?>
  <form class="formularioJogadores" action=" <?php echo "?pagina=jogo&id_esporte=$_GET[id_esporte]&cod_jogo=$_GET[cod_jogo]" ?> " method="post">
<?php endif; ?>
<?php if (!$_POST): ?>
  <form class="formularioJogadores" action="#" method="post">
<?php endif; ?>
<div class="headerListaJogadores">
  <?php $sqlHeaderJogadores = "SELECT * FROM turma";
      $resultado = mysqli_query($conexao, $sqlHeaderJogadores);
        while ($linha = mysqli_fetch_assoc($resultado)) {

          echo "<div><input type=\"checkbox\" class=\"selectTurma\" id=\"$linha[id_turma]\" name=\"$linha[id_turma]\" value=\"$linha[id_turma]\" style=\"display:none;\">";
          echo "<label class=\"selectTurma\" id=\"$linha[id_turma]teste\" for=\"$linha[id_turma]\"  > ";
          echo "$linha[nome_turma] ";
          echo "</label>";
          echo "</div>";
          $n++;
        }
  ?>

</div>
<div class="containerListaJogadores">

  <?php
  if ($_POST) {
    $time = "B";
    $cor = "#4CAF50";
  }else {
    $time = "A";
    $cor = "#F99B43";
  };
    $sqlListaJogadores = "SELECT jogador.id_jogador, jogador.nome_jogador, usuario.imagem_usuario, jogador.turma_jogador FROM jogador LEFT JOIN usuario ON usuario.matricula_usuario=jogador.matricula_jogador WHERE jogador.id_jogador != 0 ORDER BY turma_jogador,nome_jogador  asc ";
    $resultado = mysqli_query($conexao, $sqlListaJogadores);

    while ($linha = mysqli_fetch_assoc($resultado)) {
      if (!$linha[imagem_usuario]) {
        $linha[imagem_usuario] = "default.png";
      };
      if ($linha[turma_jogador] != 1) {
        $style = 'style =\"display:none"';
      }
  		echo " <label  class=\"$linha[turma_jogador]turma checkboxJogador\" style=\"display:none;\" $style><div class=\"containerJogador\" id=\"lista$linha[id_jogador]\" style=\"border-bottom: 6px solid white\">";
      echo "<input type=\"checkbox\" class=\"checkboxJogador\" id=\"$linha[id_jogador]teste\" name=\"jogador$time"."[]\" value=\"$linha[id_jogador]\" style=\"display:none\">";
  		echo "<img class='imagem' src='$linha[imagem_usuario]' /> <br><br> $linha[nome_jogador]";
  		echo " </div> </label>";

      if ($_POST) {
        for ($i=0; $i < $qtdJogadores/2; $i++) {
          $JogadorA[$i] = $_POST["jogadorA"][$i];
          echo "<input type=\"hidden\" name=\"jogadorA[$i]\" value=\"$JogadorA[$i]\">";
        };
      };
    }
   ?>

</div>


<script type="text/javascript">

  document.getElementById("1").checked = true;
  document.getElementById("1teste").style.borderBottom = "2px solid red";
  $(".1turma").show();



  $('.selectTurma').on('change', function() {

    var i = this.value;

    if(this.checked) {
        document.getElementById(i+'teste').style.borderBottom = "2px solid red";
        $("." + i + "turma").show();
    }else if (!this.checked) {
        document.getElementById(i+'teste').style.borderBottom = "0px solid gray";
        $("." + i + "turma").hide();
    }
  });
  $('.checkboxJogador').on('change', function() {

      var j = this.value;

      if($('.checkboxJogador:checked').length > <?php echo $qtdJogadores/2 ?>) {
         this.checked = false;
      };
      if(this.checked) {
          document.getElementById('lista'+j).style.borderBottom = "6px solid <?php echo $cor ?>";
      }else if (!this.checked) {
          document.getElementById('lista'+j).style.borderBottom = "6px solid white";
      }
    });
</script>
<?php if (!$_POST): ?>
<input id="botaoJogar" type="submit" name="" value="Continuar">
<?php else: ?>
<input id="botaoJogar2" type="submit" name="" value="Começar Partida" >
<?php endif; ?>
</div>
</div>

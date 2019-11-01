
<?php
  $n = 1;
	include 'conexao.php';



?>



<div class="lista">
<br>
<h2 >Jogadores</h2>
<br>
<br>
<br>
</div>
<div class="headerListaJogadores">
  <?php $sqlHeaderJogadores = "SELECT * FROM turma";
      $resultado = mysqli_query($conexao, $sqlHeaderJogadores);
        while ($linha = mysqli_fetch_assoc($resultado)) {

          echo "<div><input type=\"checkbox\" class=\"selectTurma\" id=\"$linha[id_turma]\" name=\"$linha[id_turma]\" value=\"$linha[id_turma]\" style=\"display:none;\">";
          echo "<label class=\"selectTurma\" id=\"$linha[id_turma]teste\" for=\"$linha[id_turma]\"  style=\"	transition: 0.1s\"> ";
          echo "$linha[nome_turma] ";
          echo "</label>";
          echo "</div>";
          $n++;
        }
  ?>

</div>
<div class="containerListaJogadores">

  <?php
    $sqlListaJogadores = "SELECT jogador.id_jogador, jogador.nome_jogador, usuario.imagem_usuario, jogador.turma_jogador FROM jogador LEFT JOIN usuario ON usuario.matricula_usuario=jogador.matricula_jogador WHERE jogador.id_jogador > 0 ORDER BY turma_jogador,nome_jogador  asc ";
    $resultado = mysqli_query($conexao, $sqlListaJogadores);

    while ($linha = mysqli_fetch_assoc($resultado)) {
      if (!$linha[imagem_usuario]) {
        $linha[imagem_usuario] = "default.png";
      };
      if ($linha[turma_jogador] != 1) {
        $style = 'style =\"display:none"';
      }
  		echo " <a class=\"$linha[turma_jogador]turma\" style=\"display:none;\" href='?pagina=jogador&id=$linha[id_jogador]' $style><div class=\"containerJogador\" 	transition: 0.1s>";
  		echo "<img class='imagem' src='$linha[imagem_usuario]' /> <br><br> $linha[nome_jogador]";
  		echo " </div> </a>";
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
        $("." + i + "turma").show(0);
    }else if (!this.checked) {
        document.getElementById(i+'teste').style.borderBottom = "0px solid gray";
        $("." + i + "turma").hide(0);
    }
  });
</script>
</div>
</div>

</div>
<div class="hometopo">
<br>
<h1>Alcance o Topo  </h1><br>
<p>Com Moxie™</p><br><br>
<p>Compare seu desempenho com diversos alunos no Brasil</p><br><br><br><br><br>
<?php if ($_SESSION[login]): ?>
  <?php echo " <a id=\"botaoInicio\" href=\"?pagina=jogador&matricula=$_SESSION[matricula]\" >Saiba Mais </a><br>"; 	 ?>
<?php else: ?>
  <a href="#" id="botaoInicio" onclick="document.getElementById('id01').style.display='block'">Saiba Mais</a><br>
<?php endif; ?>
</div>







</div>
</div>

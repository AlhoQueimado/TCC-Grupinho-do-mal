<?php
	session_start();
  ERROR_REPORTING(E_ALL ^E_NOTICE);
    $pagina = $_GET[pagina];

    if (!$pagina){
      $pagina = "inicio";

    };
?>
<!DOCTYPE html>
<html lang="pt" dir="ltr">
  <head>
	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
		<link rel="stylesheet" href="Fontes.css">
		<link rel="stylesheet" href="css.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>


		</script>

    <meta charset="utf-8">
    <title>Moxie</title>


  </head>
  <body>
		<a href='./' ><img  <?php if ($pagina != inicio): ?>
			style="display:block;"
		<?php endif; ?> class='imagem' id="botaoHome" src='bola.ico' width='25' /></a>
			<div class="menuInicio" <?php if ($pagina != inicio) {
				echo "Style=\"background:#25272D\"";
			} ?>>


			<a href="?pagina=listaEsportes">Esportes</a>
			<a href="?pagina=listaJogadores">Jogadores</a>
			<?php if ($_SESSION[login]): ?>
				<?php echo "<a href=\"?pagina=jogador&matricula=$_SESSION[matricula]\" style=\"color: #EF9946;\">$_SESSION[login] </a>"; 	 ?>
			<?php else: ?>
			<a href="#" style="color: #EF9946;" onclick="document.getElementById('id01').style.display='block'">Login</a>
		<?php endif; ?>
		</div>











		<?php if ($pagina != inicio): ?>
			<div class="corpo">

		<?php endif; ?>
      <?php

      if ($pagina != excluirEsporte AND   $pagina != excluirJogador AND   $pagina != excluirUsuario AND   $pagina != formEsporte AND   $pagina !=  formJogador AND   $pagina != jogo AND   $pagina != listaUsuarios AND   $pagina != registrarEsporte AND   $pagina != registrarJogador) {
			include "$pagina.php";

		} else{
      	if (1){

          include "$pagina.php";
        } else {
          echo "Você não possui permissão para acessar essa pagina";
				}};

       ?>
    </div>

    <div class="rodape">
      © Copyright 2019 | Nome Provisório | Todos direitos reservados | Feito orgulhosamente em Scratch
    </div>
		<!-- The Modal -->
<?php if ($pagina != jogo): ?>


		<div class="formulario">


		<div id="id01" class="formularioLogin">
			<!-- Button to open the modal -->

		  <!-- Modal Content -->
		  <form class="modal-content animate" action="?pagina=login" method="post">
		    <div class="imgcontainer">


		    </div>

		    <div class="container">
					<h2 style="color:#686767">Moxie™</h2>
					<br><br><br><br>
					<p>Comece a sua escalada agora</p><br><br>
					<img src="esporte.png" alt="" width="200px"><br><br><br><br>
					<button type="button" name="button" onclick="document.getElementById('id02').style.display='block'; document.getElementById('id01').style.display='none';  event.preventDefault();">Inscrever-se</button><br>
					<br>
					<button type="button" name="button" onclick="document.getElementById('id03').style.display='block'; document.getElementById('id01').style.display='none';  event.preventDefault();" style="background: #9175B4; color: white;" >Já Possuí Conta?</button>
				 </div>
		  </form>
		</div>
		</div>
		<div class="formulario">


		<div id="id02" class="formularioLogin">
			<!-- Button to open the modal -->

		  <!-- Modal Content -->
		  <form class="modal-content animate" action="registrarUsuario.php" method="post">
				<center>
		    <div class="imgcontainer">

		    </div><br>
				<p style="text-align:left;">Registrar</p>  <br>

		    <div class="container" style="	margin: 0 auto;"><br><br>

					<input type="text" name="loginUsuario" placeholder="Nome de Usuário" required><br><br>
					<input type="email" name="emailUsuario" placeholder="Email" required><br><br>
						<input type="password" name="senhaUsuario" placeholder="Senha" required><br><br>
						<input type="text" name="matriculaUsuario" placeholder="Matrícula" required><br><br><br><br><br>
						<label for="Inscrever-se"><button  type="submit" name="button" >Inscrever-se</button><br></label>

		    </div>
			</center>
		  </form>

		</div>
		</div>
		<div class="formulario">


		<div id="id03" class="formularioLogin">
			<!-- Button to open the modal -->

		  <!-- Modal Content -->
		  <form class="modal-content animate" action="?pagina=login" method="post">
				<center>
		    <div class="imgcontainer">

		    </div><br>
				<p style="text-align:left;">Entrar</p>  <br>

		    <div class="container" style="	margin: 0 auto;"><br><br>

					<input type="text" name="login" placeholder="Nome de Usuário" required><br><br>

						<input type="password" name="senha" placeholder="Senha" required><br><br>
						<br><br><br><br><br>	<br><br><br><br>	<br><br>
						<label for="Inscrever-se"><button  type="submit" name="button" >Entrar</button><br></label>

		    </div>
			</center>
		  </form>

		</div>
		</div>
<?php endif; ?>
  </body>

</html>
<script>
// Get the modal
var modal = document.getElementById('id01');
var modal2 = document.getElementById('id02');
var modal3 = document.getElementById('id03');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
		 event.preventDefault();
  }
	if (event.target == modal2) {
		modal2.style.display = "none";
		 event.preventDefault();
	}
	if (event.target == modal3) {
		modal3.style.display = "none";
		 event.preventDefault();
	}
}
</script>

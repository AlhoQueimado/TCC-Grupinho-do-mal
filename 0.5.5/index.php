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


    <meta charset="utf-8">
    <title>Moxie</title>


  </head>
  <body>
		<a href='./' ><img  <?php if ($pagina != inicio): ?>
			style="display:block;"
		<?php endif; ?> class='imagem' id="botaoHome" src='bola.ico' width='25' /></a>
		<div class="menuInicio" <?php if ($pagina != inicio): ?> style="display:block;" 	<?php endif; ?>>
			<a href="?pagina=listaEsportes">Esportes</a>
			<a href="?pagina=listaJogadores">Jogadores</a>
		</div>

				<?php if ($pagina == inicio): ?>
			<a href="#" id="botaoMenu"  onclick="botaoMenu()" ><img src="menuW.png" alt="" width="25" ></a>
				<?php else: ?>
				<a href="#" id="botaoMenu"  onclick="botaoMenu()" ><img src="menuB.png" alt="" width="25" ></a>
			<?php endif; ?>

			<a href="#" id="botaoMenu" class="botaoMenuToggle" onclick="botaoMenu()" ><img src="menuW.png" alt="" width="25" style=""></a>


			<script>
			function botaoMenu() {
			  $(".menuInicio").slideToggle(300);
				$(".botaoMenuToggle").fadeToggle(300);
				$("#botaoHome").slideToggle(300);

				 event.preventDefault();
			};
			</script>




		<?php if ($pagina != inicio): ?>
			<div class="corpo">

		<?php endif; ?>
      <?php

      if ($pagina != excluirEsporte AND   $pagina != excluirJogador AND   $pagina != excluirUsuario AND   $pagina != formEsporte AND   $pagina !=  formJogador AND   $pagina != jogo AND   $pagina != listaUsuarios AND   $pagina != registrarEsporte AND   $pagina != registrarJogador) {
			include "$pagina.php";

		} else{
      	if (@in_array($pagina, $_SESSION[permissoes])){

          include "$pagina.php";
        } else {
          echo "Você não possui permissão para acessar essa pagina";
				}};

       ?>
    </div>

    <div class="rodape">
      © Copyright 2019 | Nome Provisório | Todos direitos reservados | Feito orgulhosamente em Scratch
    </div>
  </body>
</html>

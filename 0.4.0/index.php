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
    <script src="jquery.js"></script>
    <meta charset="utf-8">
    <title>ELO Volei 301</title>
    <link rel="stylesheet" href="css.css">
  </head>
  <body>
    <div class="menu">
      <?php if($_SESSION[login]){echo "<div class=\"bemvindo\">Seja bem vindo $_SESSION[login]</div>";}?>
      <a href="?pagina=listaEsportes">Esportes</a>
      <a href="?pagina=listaJogadores">Jogadores</a>
      <a href="?pagina=listaUsuarios">Usuarios</a>
      <?php if($_SESSION[login]){echo "<a href=\"?pagina=logout\">LogOut</a>";} else {
        echo "<a href=\"?pagina=login\">Login</a>";
      }
      ?>
    </div>
    <div class="corpo">
      <?php
			//GRANDE falha de segurança: um usuario sem permissões pode usar o editar usuarios
      if ($pagina != excluirEsporte AND   $pagina != excluirJogador AND   $pagina != excluirUsuario AND   $pagina != formEsporte AND   $pagina !=  formJogador AND   $pagina != jogo AND   $pagina != listaUsuarios AND   $pagina != registrarEsporte AND   $pagina != registrarJogador ) {
			include "$pagina.php";
		} else{
      	if (@in_array($pagina, $_SESSION[permissoes])){
        //if (1){
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

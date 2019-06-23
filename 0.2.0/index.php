<?php
  ERROR_REPORTING(E_ALL ^E_NOTICE);
    $pagina = $_GET['pagina'];
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
    <div class="corpo">
      <?php
    //  if (!$_SESSION[login]) {
    //    include "login.php"
    //  } else {
        include "$pagina.php";
    //  };

       ?>
    </div>
  </body>
</html>

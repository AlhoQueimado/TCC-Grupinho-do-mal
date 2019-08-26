<?php

include 'conexao.php';

$sql = "DELETE FROM usuario WHERE id_usuario = " . $_GET[id];

mysqli_query($conexao, $sql);

  header('Location:./?pagina=listaUsuarios');
?>

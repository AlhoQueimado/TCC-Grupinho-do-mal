<?php

include 'conexao.php';

$sql = "DELETE FROM esporte WHERE id_esporte = " . $_GET[id];

mysqli_query($conexao, $sql);

header("location: index.php");
?>

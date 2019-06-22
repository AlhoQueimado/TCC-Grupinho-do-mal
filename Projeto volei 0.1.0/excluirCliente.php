<?php
  $idCliente = $_GET['id'];
	include 'conexao.php';

	$sql="DELETE FROM paciente WHERE id_paciente =\"$idCliente\"";
var_dump( $sql);
	mysqli_query($conexao, $sql);


		if (!mysqli_query($conexao, $sql)) {
		echo "Erro no banco: ". mysqli_error($conexao);
	}
	 header("location:index.php?pagina=listaClientes");

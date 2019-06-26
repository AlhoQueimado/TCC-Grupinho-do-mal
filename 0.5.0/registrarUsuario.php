<?php

include 'conexao.php';

$senha = md5($_POST[senhaUsuario]);
if ($_FILES['imagemUsuario']['size'] != 0) {
	$name = $_FILES['imagemUsuario']['name'];
	$target_dir = "upload/";
	$target_file = $target_dir . basename($_FILES["imagemUsuario"]["name"]);

	// seleciona o tipo de arquivo
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

	// valida o tipo de arquivo
	$extensions_arr = array("jpg","jpeg","png","gif");

	// valida os tipos
	if( in_array($imageFileType, $extensions_arr) ){

		// converte para base64
		$image_base64 = base64_encode(file_get_contents($_FILES['imagemUsuario']['tmp_name']) );

		// define o formato no  padrão base64 para ser exibido no html
		$imagem = 'data:image/'.$imageFileType.';base64,'.$image_base64;
	}

};
if ($_POST['id']){
	$sql = "UPDATE usuario set email_usuario='$_POST[emailUsuario]', login_usuario='$_POST[loginUsuario]', senha_usuario='$senha', matricula_usuario='$_POST[matriculaUsuario]', imagem_usuario ='$imagem' WHERE id_usuario = '$_POST[id]' ";
	mysqli_query($conexao, $sql);
}else{
	$sql = "INSERT INTO usuario (email_usuario, login_usuario, senha_usuario, matricula_usuario, imagem_usuario) VALUES ('$_POST[emailUsuario]', '$_POST[loginUsuario]','$senha','$_POST[matriculaUsuario]', '$imagem') ";
	mysqli_query($conexao, $sql);
};

//var_dump($sql);
header("location:./?pagina=login");

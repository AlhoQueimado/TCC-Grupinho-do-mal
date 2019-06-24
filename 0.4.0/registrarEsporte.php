<?php
  include 'conexao.php';
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
  $sql = "INSERT INTO esporte (nome_esporte, numero_jogadores, imagem_esporte) VALUES ('$_POST[nomeEsporte]', '$_POST[numeroJogadores]', '$imagem')";
  mysqli_query($conexao, $sql);


  header('Location:./?pagina=listaEsportes');
?>

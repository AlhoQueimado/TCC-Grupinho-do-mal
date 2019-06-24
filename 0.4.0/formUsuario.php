<?php
  include 'conexao.php';
  if ($_GET['id']){
    echo "Modo de Edição <br>";
    $sql = "SELECT id_usuario, login_usuario, senha_usuario, matricula_usuario, email_usuario FROM usuario WHERE id_usuario =\"$_GET[id]\"";
		if (!$resultado = mysqli_query($conexao, $sql) ) {
			echo "Erro: " . mysqli_error($conexao);
		} else {
			$usuario = mysqli_fetch_assoc($resultado);
		}
	}
?>


<form class="formulario" action="registrarUsuario.php" method="post" enctype="multipart/form-data">

  <?php if ($_GET['id']){ ?>
    <h2>ID: <?php echo $_GET['id'] ?></h2><br>
    <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>">
  <?php } ?>
  <input type="text" name="loginUsuario" value="<?php echo $usuario[login_usuario] ?>" placeholder="Nome de Usuário" required><br><br>
  <input type="email" name="emailUsuario" value="<?php echo $usuario[email_usuario] ?>" placeholder="Email"><br><br>
  <input type="password" name="senhaUsuario"  placeholder="Senha" required><br><br>
  <input type="number" name="matriculaUsuario" value="<?php echo $usuario[matricula_usuario] ?>" placeholder="Matrícula" required><br><br>
  Foto:<br> <input type="file" name="imagemUsuario" ><br ><br >
  <input type="submit" name="" value="Enviar">

</form>

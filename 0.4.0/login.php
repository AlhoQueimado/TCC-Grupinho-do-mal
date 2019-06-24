<?php
	session_start();

	$senha = $_POST['senha'];

	include 'conexao.php';

	if ($_POST) {
		$sql = "SELECT id_usuario,  login_usuario FROM usuario WHERE login_usuario = '$_POST[login]' AND senha_usuario = '$senha' ";


		if (!$resultado = mysqli_query($conexao, $sql)) {
			die("Erro: " . mysqli_error($conexao));
		}

		if (!$usuario = mysqli_fetch_assoc($resultado)) {

		} else {
			$_SESSION[login] = $_POST[login];
      echo $_SESSION[login];
			echo $usuario[id_usuario];

			$sql = "SELECT permissao.nome_permissao FROM permissao join agrupamento_permissao on permissao.id_permissao = agrupamento_permissao.id_permissao join usuario_agrupamento on agrupamento_permissao.id_agrupamento = usuario_agrupamento.id_agrupamento AND usuario_agrupamento.id_usuario = '$usuario[id_usuario]'";
			$resultado = mysqli_query($conexao, $sql);


			while ($linha = mysqli_fetch_assoc($resultado)) {
				echo $linha[nome_permissao];
				echo " ";
				$_SESSION[permissoes][] = $linha[nome_permissao];

			}

			header("location: ./");
		}
	}

?>







<?php

	if ($_POST) {
		echo "<p>*Usuário inexistente</p>";
	}

?>

<form class="formulario" method="post" action="">

	<input   placeholder="Login" type="text" name="login" /><br /><br />

	<input  placeholder="Senha" type="password" name="senha" /><br /><br>

	<input  type="submit" value="Entrar" id="button"><br>
	<a href="?pagina=formUsuario">Não possui conta? Crie agora</a>

</form>

<?php
	session_start();
	ERROR_REPORTING(E_ALL ^E_NOTICE);

	$senha = md5($_POST['senha']);

	include 'conexao.php';

	if ($_POST) {
		$sql = "SELECT id_usuario,imagem_usuario,  login_usuario FROM usuario WHERE login_usuario = '$_POST[login]' AND senha_usuario = '$senha' ";


		if (!$resultado = mysqli_query($conexao, $sql)) {
			die("Erro: " . mysqli_error($conexao));
		}

		if (!$usuario = mysqli_fetch_assoc($resultado)) {

		} else {
			$_SESSION[login] = $_POST[login];

			$_SESSION[foto] = $usuario[imagem_usuario];

			$sql = "SELECT permissao.nome_permissao FROM permissao join agrupamento_permissao on permissao.id_permissao = agrupamento_permissao.id_permissao join usuario_agrupamento on agrupamento_permissao.id_agrupamento = usuario_agrupamento.id_agrupamento AND usuario_agrupamento.id_usuario = '$usuario[id_usuario]'";
			$resultado = mysqli_query($conexao, $sql);


			while ($linha = mysqli_fetch_assoc($resultado)) {
				echo $linha[nome_permissao];
				echo " ";
				$_SESSION[permissoes][] = $linha[nome_permissao];

			}

			header("location:index.php");
		}
	}

?>







<?php

	if ($_POST) {
		echo "<center><p style=\"color: red; padding-top: 5vh;\">Usuario ou senha incorretos</p></center>";
	}

?>
<br><br><br><br>
<center><h2>Entrar</h2></center>
<form class="formulario" method="post" action="">

	<input   placeholder="Login" type="text" name="login" /><br /><br />

	<input  placeholder="Senha" type="password" name="senha" /><br /><br>

	<input  type="submit" value="Entrar" id="button"><br>
	<a href="?pagina=formUsuario">Não possui conta? Crie agora</a>

</form>

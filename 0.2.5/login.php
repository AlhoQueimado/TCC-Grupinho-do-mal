<?php
	session_start();

	$senha = md5($_POST['senha']);

	include 'conexao.php';

	if ($_POST) {
		$sql = "SELECT id_jogador, nome_jogador, login_jogador, numero_jogador FROM jogador WHERE login_jogador = '$_POST[login]' AND senha_jogador = '$senha' ";


		if (!$resultado = mysqli_query($conexao, $sql)) {
			die("Erro: " . mysqli_error($conexao));
		}

		if (!$jogador = mysqli_fetch_assoc($resultado)) {

		} else {
			$_SESSION[login] = $_POST[login];
      echo $_SESSION[login];
			$sql = "SELECT t.nome_permissao FROM permissao t, jogador_permissao ut WHERE t.id_permissao = ut.id_permissao AND ut.id_jogador = '$jogador[id_jogador]'";
			$resultado = mysqli_query($conexao, $sql);

			while ($linha = mysqli_fetch_assoc($resultado)) {
				$_SESSION[permissoes][] = $linha[nome_permissao];
				var_dump($_SESSION);
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
<div class="conteudo">
<form class="formulario" method="post" action="">

	<input  class="nome" placeholder="Login" type="text" name="login" /><br /><br />

	<input class="nome" placeholder="Senha" type="password" name="senha" /><br /><br>

	<input class="nome" type="submit" value="Entrar" id="button">

</form>
</div>

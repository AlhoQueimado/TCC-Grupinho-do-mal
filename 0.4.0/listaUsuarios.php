<?php
  include 'conexao.php';
?>
<div class="conteudo">
  <br>
  <h2>Lista de Usuários</h2>
  <a href="?pagina=formUsuario">Cadastrar um Usuário</a>
  <table class="tabela">
    <tr>
  		<td>ID</td>
  		<td>Nome</td>
  		<td>Login</td>
      <td>Email</td>
      <td>Matricula</td>
      <td>Foto</td>
      <td></td>
      <td></td>
  		<td></td>
  		<td></td>
  	</tr>
    <?php
    $sql = "SELECT u.id_usuario, u.email_usuario, j.nome_jogador, u.login_usuario, u.matricula_usuario, u.imagem_usuario FROM usuario u, jogador j WHERE matricula_usuario = matricula_jogador";


    $resultado = mysqli_query($conexao, $sql);
    while($linha = mysqli_fetch_assoc($resultado)) {
  		echo "<tr>";
  		echo "<td>$linha[id_usuario]</td>";
  		echo "<td>$linha[nome_jogador]</td>";
  		echo "<td>$linha[login_usuario]</td>";
      echo "<td>$linha[email_usuario]</td>";
      echo "<td>$linha[matricula_usuario]</td>";
      echo "<td> <img class='imagem' src='$linha[imagem_usuario]' width='50' /> </td>";
      echo "<td>";
  		echo "<a href='?pagina=formUsuario&id=$linha[id_usuario]'>";
  		echo "<img src='lapis.png' width='20' />";
  		echo "</a>";
  		echo "</td>";
      echo "<td>";
  		echo "<a href='index.php?pagina=permissoesUsuario&id_usuario=$linha[id_usuario]'>";
  		echo "<img src='images.png' width='23' />";
  		echo "</a>";
  		echo "</td>";
  		echo "<td>";
  		echo "<a href='excluirUsuario.php?id=$linha[id_usuario]'>";
  		echo "<img src='delete.png' width='20' />";
  		echo "</a>";
  		echo "</td>";

  		echo "</tr>";
  	}
    ?>
  </table>
</div>

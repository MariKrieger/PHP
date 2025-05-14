<?php 
// include dos arquivox
include_once './include/logado.php';
include_once './include/conexao.php';
include_once './include/header.php';

$usuarios = ['UsuarioID' => '', 'Nome' => '', 'Senha' => '', 'Email' => '', 'Usuario' => ''];
if(!empty($_GET['id'])) {
  $result = mysqli_query($conn, "SELECT * FROM usuarios WHERE UsuarioID = {$_GET['id']}");
  $usuarios = mysqli_fetch_assoc($result) ?: $usuarios;
}

?>


  <main>

    <div id="usuarios" class="tela">
        <form class="crud-form" action="./action/usuarios.php?action=salvar" method="post">

          <h2><?php echo empty($usuarios['UsuarioID']) ? 'Cadastro' : 'Edição' ?> de Usuários</h2>

          <input type="hidden" name="id" value="<?php echo $usuarios['UsuarioID'] ?>">

          <input type="varchar" name="nome" placeholder="Nome do Usuário"
            value="<?php echo $usuarios['Nome'] ?>" required>

          <input type="varchar" name="senha" placeholder="Senha"
            value="<?php echo $usuarios['Senha'] ?>" required>

            <input type="varchar" name="email" placeholder="Email"
            value="<?php echo $usuarios['Email'] ?>" required>

          <input type="varchar" name="usuario" placeholder="Usuário"
            value="<?php echo $usuarios['Usuario'] ?>" required>

          <button type="submit">Salvar</button>
        </form>
      </div>
   
  </main>

  <?php 
  // include dos arquivox
  include_once './include/footer.php';
  ?>
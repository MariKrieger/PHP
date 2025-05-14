<?php 
// include dos arquivox
include_once './include/logado.php';
include_once './include/conexao.php';
include_once './include/header.php';

$sql = "SELECT * FROM usuarios;";
$result = mysqli_query($conn, $sql);

?>
  <main>

    <div class="container">
        <h1>Lista de Usuários</h1>
        <a href="./salvar-usuarios.php" class="btn btn-add">Incluir</a>
        <table>
          <thead>
            <tr>
              <th>ID</th>
              <th>Nome</th>
              <th>Email</th>
              <th>Usuário</th>
              <th>Ações</th>
            </tr>
          </thead>
          <tbody>
            <?php while($row = mysqli_fetch_assoc($result)): ?>
              <tr>
                <td><?php echo $row['UsuarioID'] ?></td>
                <td><?php echo $row['Nome'] ?></td>
                <td><?php echo $row['Email'] ?></td>
                <td><?php echo $row['Usuario'] ?></td>
                <td>
                  <a href="salvar-usuarios.php?id=<?php echo $row['UsuarioID'] ?>" class="btn btn-edit">Editar</a>
                  <a href="./action/usuarios.php?action=delete&id=<?php echo $row['UsuarioID'] ?>" class="btn btn-delete">Excluir</a>
                </td>
              </tr>
            <?php endwhile; ?>
            
          </tbody>
        </table>
      </div>

  </main>

  <?php 
  // include dos arquivos
  include_once './include/footer.php';
  ?>
<?php 
// include dos arquivox
include_once './include/logado.php';
include_once './include/conexao.php';
include_once './include/header.php';

$sql = "SELECT * FROM setor;";
$result = mysqli_query($conn, $sql);

?>
  <main>

    <div class="container">
        <h1>Lista de Setores</h1>
        <a href="./salvar-setores.php" class="btn btn-add">Incluir</a>
        <table>
          <thead>
            <tr>
              <th>ID</th>
              <th>Nome</th>
              <th>Andar</th>
              <th>Cor</th>
              <th>Ações</th>
            </tr>
          </thead>
          <tbody>
            <?php while($row = mysqli_fetch_assoc($result)): ?>
              <tr>
                <td><?php echo $row['SetorID'] ?></td>
                <td><?php echo $row['Nome'] ?></td>
                <td><?php echo $row['Andar'] ?></td>
                <td><?php echo $row['Cor'] ?></td>
                <td>
                  <a href="salvar-setores.php?id=<?php echo $row['SetorID'] ?>" class="btn btn-edit">Editar</a>
                  <a href="./action/setores.php?action=delete&id=<?php echo $row['SetorID'] ?>" class="btn btn-delete">Excluir</a>
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
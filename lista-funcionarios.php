<?php 
// include dos arquivox
include_once './include/logado.php';
include_once './include/conexao.php';
include_once './include/header.php';

// string do comando SQL
$sql = "
  SELECT f.FuncionarioID, f.Nome, c.Nome AS CargoNome, s.Nome AS SetorNome
  FROM funcionarios f
  JOIN cargos c ON f.CargoID = c.CargoID
  JOIN setor s ON f.SetorID = s.SetorID;
";
// executa o comando sql
$result = mysqli_query($conn, $sql);

?>

<main>

  <div class="container">
      <h1>Lista de Funcionários</h1>
      <a href="./salvar-funcionarios.php" class="btn btn-add">Incluir</a> 
      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Cargo</th>
            <th>Setor</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody>
          <?php while($row = mysqli_fetch_assoc($result)): ?>
            <tr>
              <td><?php echo $row['FuncionarioID'] ?></td>
              <td><?php echo $row['Nome'] ?></td>
              <td><?php echo $row['CargoNome'] ?></td>
              <td><?php echo $row['SetorNome'] ?></td>
              <td>
                <a href="salvar-funcionarios.php?id=<?php echo $row['FuncionarioID'] ?>" class="btn btn-edit">Editar</a>
                <a href="./action/funcionarios.php?action=delete&id=<?php echo $row['FuncionarioID'] ?>" class="btn btn-delete">Excluir</a>
              </td> 
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>
</main>

<?php 
  // include dos arquivox
  include_once './include/footer.php';
  ?>
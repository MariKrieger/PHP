<?php 
// include dos arquivox
include_once './include/logado.php';
include_once './include/conexao.php';
include_once './include/header.php';

$sql = "
  SELECT p.ProducaoID, pr.Nome AS ProdutoNome, f.Nome AS FuncionarioNome, c.Nome AS ClienteNome, DataProducao, DataEntrega
  FROM producao p
  JOIN produtos pr ON p.ProdutoID = pr.ProdutoID
  JOIN funcionarios f ON p.FuncionarioID = f.FuncionarioID
  JOIN clientes c ON p.ClienteID = c.ClienteID;
";

$result = mysqli_query($conn, $sql);

?>
  <main>

    <div class="container">
        <h1>Lista de Produções</h1>
        <a href="./salvar-producao.php" class="btn btn-add">Incluir</a> 
        <table>
          <thead>
            <tr>
              <th>ID</th>
              <th>Produto</th>
              <th>Cliente</th>
              <th>Data de Produção</th>
              <th>Data de Entrega</th>
              <th>Ações</th>
            </tr>
          </thead>
          <tbody>
            <?php while($row = mysqli_fetch_assoc($result)): ?>
              <tr>
                <td><?php echo $row['ProducaoID'] ?></td>
                <td><?php echo $row['ProdutoNome'] ?></td>
                <td><?php echo $row['ClienteNome'] ?></td>
                <td><?php echo $row['DataProducao'] ?></td>
                <td><?php echo $row['DataEntrega'] ?><td>
                <td>
                <a href="salvar-producao.php?id=<?php echo $row['ProducaoID'] ?>" class="btn btn-edit">Editar</a>
                <a href="./action/producao.php?action=delete&id=<?php echo $row['ProducaoID'] ?>" class="btn btn-delete">Excluir</a>
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
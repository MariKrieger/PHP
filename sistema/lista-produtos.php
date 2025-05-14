<?php 
// include dos arquivox
include_once './include/logado.php';
include_once './include/conexao.php';
include_once './include/header.php';

$sql = "
  SELECT p.ProdutoID, p.Nome, c.Nome AS CategoriaNome, p.Preco
  FROM produtos p
  JOIN categorias c ON p.CategoriaID = c.CategoriaID;
";

$result = mysqli_query($conn, $sql);

?>

<main>

  <div class="container">
      <h1>Lista de Produtos</h1>
      <a href="./salvar-produtos.php" class="btn btn-add">Incluir</a> 
      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Categoria</th>
            <th>Preço</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody>
          <?php while($row = mysqli_fetch_assoc($result)): ?>
            <tr>
              <td><?php echo $row['ProdutoID'] ?></td>
              <td><?php echo $row['Nome'] ?></td>
              <td><?php echo $row['CategoriaNome'] ?></td>
              <td>R$<?php echo number_format($row['Preco'], 2, ',', '.') ?></td>
              <td>
                <a href="salvar-produtos.php?id=<?php echo $row['ProdutoID'] ?>" class="btn btn-edit">Editar</a>
                <a href="./action/produtos.php?action=delete&id=<?php echo $row['ProdutoID'] ?>" class="btn btn-delete">Excluir</a>
              </td> 
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>

<?php 
  // include dos arquivox
  include_once './include/footer.php';
  ?>
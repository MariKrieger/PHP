<?php 
// include dos arquivox
include_once './include/logado.php';
include_once './include/conexao.php';
include_once './include/header.php';

$producao = [
  'ProducaoID' => '',
  'ProdutoID' => '',
  'FuncionarioID' => '',
  'ClienteID' => '',
  'DataProducao' => '',
  'DataEntrega' => ''
];

$produtos = mysqli_query($conn, "SELECT ProdutoID, Nome FROM produtos");
$funcionarios = mysqli_query($conn, "SELECT FuncionarioID, Nome FROM funcionarios");
$clientes = mysqli_query($conn, "SELECT ClienteID, Nome FROM clientes");

if(!empty($_GET['id'])) {
  $result = mysqli_query($conn, "SELECT * FROM producao WHERE ProducaoID = {$_GET['id']}");
  $producao = mysqli_fetch_assoc($result) ?: $producao;
}
?>
  <main>

    <div id="producao" class="tela">
        <form class="crud-form" method="post" action="./action/producao.php?action=salvar" method="post">
          <h2><?php echo empty($producao['ProducaoID']) ? 'Cadastro' : 'Edição' ?> de Produção de Produtos</h2>

          <select name="produto" required>
            <option value="">Produto</option>
            <?php while($produto = mysqli_fetch_assoc($produtos)): ?>
              <option value="<?php echo $produto['ProdutoID'] ?>" <?php echo ($produto['ProdutoID'] == $producao['ProdutoID']) ? 'selected' : '' ?>>
                <?php echo $produto['Nome'] ?>
              </option>
            <?php endwhile; ?>
          </select>

          <select name="funcionario" required>
            <option value="">Funcionário</option>
            <?php while($funcionario = mysqli_fetch_assoc($funcionarios)): ?>
              <option value="<?php echo $funcionario['FuncionarioID'] ?>" <?php echo ($funcionario['FuncionarioID'] == $producao['FuncionarioID']) ? 'selected' : '' ?>>
                <?php echo $funcionario['Nome'] ?>
              </option>
            <?php endwhile; ?>
          </select>

          <select name="cliente" required>
            <option value="">Cliente</option>
            <?php while($cliente = mysqli_fetch_assoc($clientes)): ?>
              <option value="<?php echo $cliente['ClienteID'] ?>" <?php echo ($cliente['ClienteID'] == $producao['ClienteID']) ? 'selected' : '' ?>>
                <?php echo $cliente['Nome'] ?>
              </option>
            <?php endwhile; ?>
          </select>

          <input type="date" name="dataproducao" placeholder="Data da Produção"
            value="<?php echo $producao['DataProducao'] ?>" required>

          <input type="date" name="data" placeholder="Data da Entrega"
            value="<?php echo $producao['DataEntrega'] ?>">

          <button type="submit">Salvar</button>
        </form>
      </div>
   
  </main>
  <?php 
  // include dos arquivox
  include_once './include/footer.php';
  ?>
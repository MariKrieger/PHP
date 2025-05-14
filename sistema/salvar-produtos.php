<?php 
// include dos arquivox
include_once './include/logado.php';
include_once './include/conexao.php';
include_once './include/header.php';

$produto = [
  'ProdutoID' => '',
  'Nome' => '',
  'Preco' => '',
  'CategoriaID' => '',
  'Referencia' => '',
  'Descricao' => '',
  'Peso' => ''
];

$categorias = mysqli_query($conn, "SELECT CategoriaID, Nome FROM categorias");

if (!empty($_GET['id'])) {
  $result = mysqli_query($conn, "SELECT * FROM produtos WHERE ProdutoID = {$_GET['id']}");
  $produto = mysqli_fetch_assoc($result) ?: $produto;
}

?>
  
  <main>

    <div id="produtos" class="tela">

        <form class="crud-form" action="./action/produtos.php?action=salvar" method="post">
          <h2><?php echo empty($produto['ProdutoID']) ? 'Cadastro' : 'Edição' ?> de Produtos</h2>

          <input type="hidden" name="id" value="<?php echo $produto['ProdutoID'] ?>">

          <input type="text" name="nome" placeholder="Nome do Produto"
            value="<?php echo $produto['Nome'] ?>" required>
          <input type="number" name="preco" placeholder="Preço" step="0.01"
            value="<?php echo $produto['Preco'] ?>" required>
          <input type="number" name="peso" placeholder="Peso (g)"
            value="<?php echo $produto['Peso'] ?>" required>
          <input type="number" name="referencia" placeholder="Referência"
            value="<?php echo $produto['Referencia'] ?>" required>
          <textarea name="descricao" placeholder="Descrição" required>
            <?php echo $produto['Descricao']; ?>
          </textarea>
          <select name="categoria" required>
            <option value="">Categoria</option>
            <?php while ($categoria = mysqli_fetch_assoc($categorias)): ?>
              <option value="<?php echo $categoria['CategoriaID'] ?>" <?php echo $categoria['CategoriaID'] == $produto['CategoriaID'] ? 'selected' : '' ?>>
              <?php echo $categoria['Nome'] ?>
              </option>
              <?php endwhile; ?>
          </select>
          <button type="submit">Salvar</button>
        </form>
      </div>


   
  </main>

  <?php 
  // include dos arquivox
  include_once './include/footer.php';
  ?>
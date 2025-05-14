<?php 

include_once './include/logado.php';
include_once './include/conexao.php';
include_once './include/header.php';

$categoria = [
  'CategoriaID' => '',
  'Nome' => '',
  'Descricao' => ''
];
if (!empty($_GET['id'])) {
  $result = mysqli_query($conn, "SELECT * FROM categorias WHERE CategoriaID = {$_GET['id']}");
  $categoria = mysqli_fetch_assoc($result) ?: $categoria;
}

?>
  <main>

    <div id="categorias" class="tela">
        <form class="crud-form" action="./action/categorias.php?action=salvar" method="post" action="">
          <h2><?php echo empty($categoria['CategoriaID']) ? 'Cadastro' : 'Edição'; ?> de Categorias</h2>

          <input type="hidden" name="id" value="<?php echo $categoria['CategoriaID']; ?>">

          <input type="text" name="nome" placeholder="Nome da Categoria"
            value="<?php echo $categoria['Nome']; ?>" required>

          <textarea name="descricao" placeholder="Descrição" required>
            <?php echo $categoria['Descricao']; ?>
          </textarea>
            
          <button type="submit">Salvar</button>
        </form>
      </div>


   
  </main>

  <?php 

  include_once './include/footer.php';
  ?>
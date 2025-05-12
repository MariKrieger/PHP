<?php 
// include dos arquivox
include_once './include/logado.php';
include_once './include/conexao.php';
include_once './include/header.php';

$setor = ['SetorID' => '', 'Nome' => '', 'Andar' => '', 'Cor' => ''];
if(!empty($_GET['id'])) {
  $result = mysqli_query($conn, "SELECT * FROM setor WHERE SetorID = {$_GET['id']}");
  $setor = mysqli_fetch_assoc($result) ?: $setor;
}

?>


  <main>

    <div id="setores" class="tela">
        <form class="crud-form" action="./action/setores.php?action=salvar" method="post">

          <h2><?php echo empty($setor['SetorID']) ? 'Cadastro' : 'Edição' ?> de Setores</h2>

          <input type="hidden" name="id" value="<?php echo $setor['SetorID'] ?>">

          <input type="text" name="nome" placeholder="Nome do Setor"
            value="<?php echo $setor['Nome'] ?>" required>

          <input type="text" name="andar" placeholder="Andar"
            value="<?php echo $setor['Andar'] ?>" required>

          <input type="text" name="cor" placeholder="Cor"
            value="<?php echo $setor['Cor'] ?>" required>

          <button type="submit">Salvar</button>
        </form>
      </div>
   
  </main>

  <?php 
  // include dos arquivox
  include_once './include/footer.php';
  ?>
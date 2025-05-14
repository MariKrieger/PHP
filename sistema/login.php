<?php
session_start();
include_once './include/conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = mysqli_real_escape_string($conn, $_POST['usuario']);
    $senha = $_POST['senha']; 


    $sql = "SELECT * FROM usuarios WHERE Usuario = '$usuario'";
    $result = mysqli_query($conn, $sql);
    $dados = mysqli_fetch_assoc($result);

 
    if ($dados && password_verify($senha, $dados['Senha'])) {
        $_SESSION['usuario_id'] = $dados['UsuarioID'];
        $_SESSION['usuario_nome'] = $dados['Nome'];

        header("Location: lista-usuarios.php");
        exit;
    } else {
        $erro = "Usuário ou senha inválidos.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sistema Empresarial</title>
  <link rel="stylesheet" href="./assets/style.css">
  <style>
    
  </style>
</head>
<body>
  <header>
    <h1>Sistema de Gestão de Empresa</h1>
  </header>


  <main>

    <div id="login" class="tela active">
      <form class="login-form" onsubmit="return login()">
        <h2>Login</h2>
        <input type="text" id="usuario" placeholder="Usuário" required />
        <input type="password" id="senha" placeholder="Senha" required />
        <button type="submit">Entrar</button>
      </form>
    </div>

   
  </main>

  <script src="./assets/script.js"></script>
</body>
</html>

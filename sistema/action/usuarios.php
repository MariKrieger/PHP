<?php
// include dos arquivos
include_once   '../include/logado.php';
include_once   '../include/conexao.php';

// captura a acao dos dados
$acao = isset($_GET['action']) ? $_GET['action'] : '';

if (empty($acao)) {
    header("Location: ../lista-usuarios.php?error=missing_action");
    exit;
}

// validacao
switch ($acao) {
    case 'delete':
        if (isset($_GET['id'])) {
            $id = mysqli_real_escape_string($conn, $_GET['id']);
            $sql = "DELETE FROM usuarios WHERE UsuarioID = $id";
            
            if(mysqli_query($conn, $sql)) {
                header("Location: ../lista-usuarios.php?success=1");
                exit;
            } else {
                header("Location: ../lista-usuarios.php?error=1");
                exit;
            }
        }
        break;
    case 'salvar':
        $nome = mysqli_real_escape_string($conn, $_POST['nome']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $usuario = mysqli_real_escape_string($conn, $_POST['usuario']);
        $id = $_POST['id'] ?? null;

        if (!empty($id)) {
            $sql = "UPDATE Usuarios SET Nome = '$nome', Email = '$email', Usuario = '$usuario' WHERE UsuarioID = $id";
        } else {
            $sql = "INSERT INTO Usuarios (Nome, Email, Usuario) VALUES ('$nome', '$email', '$usuario')";
        }

        if(mysqli_query($conn, $sql)) {
            header("Location: ../lista-usuarios.php?success=1");
            exit;
        } else {
            header("Location: ../salvar-usuarios.php?error=1");
            exit;
        }
        break;
    
    default:
        header("Location: ../lista-setores.php");
        break;
}
?>
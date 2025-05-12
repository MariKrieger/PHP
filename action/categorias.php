<?php
// include dos arquivos
include_once   '../include/logado.php';
include_once   '../include/conexao.php';


// captura a acao dos dados
$acao = isset($_GET['action']) ? $_GET['action'] : '';

if (empty($acao)) {
    header("Location: ../lista-categorias.php?error=missing_action");
    exit;
}

// validacao
switch ($acao) {
    case 'delete':
        if (isset($_GET['id'])) {
            $id = mysqli_real_escape_string($conn, $_GET['id']);
            $sql = "DELETE FROM categorias WHERE CategoriaID = $id";
            
            if (mysqli_query($conn, $sql)) {
                header("Location: ../lista-categorias.php?success=1");
                exit;
            } else {
                header("Location: ../lista-categorias.php?error=1");
                exit;
            }
        }
        break;
    case 'salvar':
        $nome = mysqli_real_escape_string($conn, $_POST['nome']);
        $descricao = mysqli_real_escape_string($conn, $_POST['descricao']);
        $id = $_POST['id'] ?? null;

        if (!empty($id)) {
            $sql = "UPDATE categorias SET Nome = '$nome', Descricao = '$descricao' WHERE CategoriaID = $id";
        } else {
            $sql = "INSERT INTO categorias (Nome, Descricao) VALUES ('$nome', '$descricao')";
        }

        if (mysqli_query($conn, $sql)) {
            header("Location: ../lista-categorias.php?success=1");
            exit;
        } else {
            header("Location: ../salvar-categorias.php?error=1");
            exit;
        }
        break;
    
    default:
        header("Location: ../lista-cargos.php");
        break;
}
?>
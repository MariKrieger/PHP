<?php
// include dos arquivos
include_once   '../include/logado.php';
include_once   '../include/conexao.php';

// captura a acao dos dados
$acao = isset($_GET['action']) ? $_GET['action'] : '';

if (empty($acao)) {
    header("Location: ../lista-cargos.php?error=missing_action");
    exit;
}

// validacao
switch ($acao) {
    case 'delete':
        if (isset($_GET['id'])) {
            $id = mysqli_real_escape_string($conn, $_GET['id']);
            $sql = "DELETE FROM setor WHERE SetorID = $id";
            
            if(mysqli_query($conn, $sql)) {
                header("Location: ../lista-setores.php?success=1");
                exit;
            } else {
                header("Location: ../lista-setores.php?error=1");
                exit;
            }
        }
        break;
    case 'salvar':
        $nome = mysqli_real_escape_string($conn, $_POST['nome']);
        $andar = mysqli_real_escape_string($conn, $_POST['andar']);
        $cor = mysqli_real_escape_string($conn, $_POST['cor']);
        $id = $_POST['id'] ?? null;

        if (!empty($id)) {
            $sql = "UPDATE setor SET Nome = '$nome', Andar = '$andar', Cor = '$cor' WHERE SetorID = $id";
        } else {
            $sql = "INSERT INTO setor (Nome, Andar, Cor) VALUES ('$nome', '$andar', '$cor')";
        }

        if(mysqli_query($conn, $sql)) {
            header("Location: ../lista-setores.php?success=1");
            exit;
        } else {
            header("Location: ../salvar-setores.php?error=1");
            exit;
        }
        break;
    
    default:
        header("Location: ../lista-setores.php");
        break;
}
?>
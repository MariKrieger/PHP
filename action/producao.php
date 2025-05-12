<?php
// include dos arquivos
include_once   '../include/logado.php';
include_once   '../include/conexao.php';

// captura a acao dos dados
$acao = isset($_GET['action']) ? $GET['action'] : '';

if (empty($acao)) {
    header("Location: ../lista-producao.php?error=missing_action");
    exit;
}

// validacao
switch ($acao) {
    case 'delete':
        if(isset($_GET['id'])) {
            $id = mysqli_real_escape_string($conn, $_GET['id']);
            $sql = "DELETE FROM producao WHERE ProducaoID = $id";
            
            if(mysqli_query($conn, $sql)) {
                header("Location: ../lista-producao.php?success=1");
                exit;
            } else {
                header("Location: ../lista-producao.php?error=1");
                exit;
            }
        }
        break;
    case 'salvar':
        $producao = mysqli_real_escape_string($conn, $_POST['producao']);
        $produto = mysqli_real_escape_string($conn, $_POST['produto']);
        $funcionario = mysqli_real_escape_string($conn, $_POST['funcionario']);
        $cliente = mysqli_real_escape_string($conn, $_POST['cliente']);
        $dataproducao = mysqli_real_escape_string($conn, $_POST['dataproducao']);
        $dataentrega = mysqli_real_escape_string($conn, $_POST['dataentrega']);
        $id = $_POST['id'] ?? null;

            if (!empty($id)) {
                $sql = "UPDATE producao SET
                ProdutoID = '$produto',
                FuncionarioID = '$funcionario',
                ClienteID = '$cliente',
                DataProducao = '$dataproducao',
                DataEntrega = '$dataentrega'
                WHERE ProducaoID = $id";
            } else {
                $sql = "INSERT INTO producao 
                (ProdutoID, FuncionarioID, ClienteID, DataProducao, DataEntrega)
                VALUES ('$produto', '$funcionario', '$cliente', '$dataproducao', '$dataentrega')";
            }
            if(mysqli_query($conn, $sql)) {
                header("Location: ../lista-producao.php?success=1");
                exit;
            } else {
                header("Location: ../lista-producao.php?error=1");
                exit;
            }
        break;
    
    default:
        header("Location: ../lista-producao.php");
        break;
}
?>
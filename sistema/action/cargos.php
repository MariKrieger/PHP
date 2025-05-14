<?php
// include dos arquivos
include_once   '../include/logado.php';
include_once   '../include/conexao.php';

var_dump($_REQUEST);
exit();
// captura a acao dos dados
$acao = isset($_GET['action']) ? $_GET['action'] : '';

if (empty($acao)) {
    header("Location: ../lista-cargos.php?error=missing_action");
    exit;
}

// validacao
switch ($acao) {
    case 'delete':
        if(isset($_GET['id'])) {
            $id = mysqli_real_escape_string($conn, $_GET['id']);
            $sql = "DELETE FROM cargos WHERE CargoID = $id";

            if(mysqli_query($conn, $sql)) {
                header("Location: ../lista-cargos.php?sucess=1");
                exit;
            } else {
                header("Location: ../lista-cargos.php?erros=1");
                exit;
            }
        }
        break;

        case 'salvar':
            $nome = mysqli_real_escape_string($conn, $_POST['nome']);
            $teto = floatval($_POST['teto']);
            $id = $_POST['id'] ?? null;
        
            if (!empty($id)) {
                $sql = "UPDATE cargos SET Nome = '$nome', TetoSalarial = $teto WHERE CargoID = $id";
            } else {
                $sql = "INSERT INTO cargos (Nome, TetoSalarial) VALUES ('$nome', $teto)";
            }
        
            if (mysqli_query($conn, $sql)) {
                header("Location: ../lista-cargos.php?success=1");
                exit;
            } else {
                header("Location: ../salvar-cargos.php?error=1");
                exit;
            }
            break;
        
        default:
            header("Location: ../lista-cargos.php");
            exit;
}        
?>
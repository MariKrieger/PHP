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
        if(isset($_GET['id'])) {
            $id = mysqli_real_escape_string($conn, $_GET['id']);
            $sql = "DELETE FROM funcionarios WHERE FuncionarioID = $id";
            
            if(mysqli_query($conn, $sql)) {
                header("Location: ../lista-funcionarios.php?success=1");
                exit;
            } else {
                header("Location: ../lista-funcionarios.php?error=1");
                exit;
            }
        }
        break;
    case 'salvar':
        $nome = mysqli_real_escape_string($conn, $_POST['nome']);
        $nascimento = mysqli_real_escape_string($conn, $_POST['nascimento']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $ramal = mysqli_real_escape_string($conn, $_POST['ramal']);
        $cargo = mysqli_real_escape_string($conn, $_POST['cargo']);
        $setor = mysqli_real_escape_string($conn, $_POST['setor']);
        $salario = mysqli_real_escape_string($conn, $_POST['salario']);
        $sexo = mysqli_real_escape_string($conn, $_POST['sexo']);
        $altura = mysqli_real_escape_string($conn, $_POST['altura']);
        $cpf = mysqli_real_escape_string($conn, $_POST['cpf']);
        $rg = mysqli_real_escape_string($conn, $_POST['rg']);
        $id = $_POST['id'] ?? null;

            if (!empty($id)) {
                $sql = "UPDATE funcionarios SET
                Nome = '$nome',
                DataNascimento = '$nascimento',
                Email = '$email',
                Ramal = '$ramal',
                CargoID = '$cargo',
                SetorID = '$setor',
                Salario = '$salario',
                Sexo = '$sexo',
                Altura = '$altura',
                CPF = '$cpf',
                RG = '$rg'
                WHERE FuncionarioID = $id";
            } else {
                $sql = "INSERT INTO funcionarios 
                (Nome, DataNascimento, Email, Ramal, CargoID, SetorID, Salario, Sexo, Altura, CPF, RG)
                VALUES ('$nome', '$nascimento', '$email', '$ramal', '$cargo', '$setor', '$salario', '$sexo', '$altura', '$cpf', '$rg')";
            }
        
            if(mysqli_query($conn, $sql)) {
                header("Location: ../lista-funcionarios.php?success=1");
                exit;
            } else {
                header("Location: ../salvar-funcionarios.php?error=1");
                exit;
            }
            break;
    
    default:
    header("Location: ../lista-funcionarios.php");
        break;
}
?>
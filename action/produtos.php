<?php
    // include dos arquivos
    include_once   '../include/logado.php';
    include_once   '../include/conexao.php';

    // captura a acao dos dados
    $acao = isset($_GET['action']) ? $_GET['action'] : '';

    if (empty($acao)) {
        header("Location: ../lista-produtos.php?error=missing_action");
        exit;
    }

    // validacao
    switch ($acao) {
        case 'delete':
            if(isset($_GET['id'])) {
                $id = mysqli_real_escape_string($conn, $_GET['id']);
                $sql = "DELETE FROM produtos WHERE ProdutoID = $id";
                
                if(mysqli_query($conn, $sql)) {
                    header("Location: ../lista-produtos.php?success=1");
                    exit;
                } else {
                    header("Location: ../lista-produtos.php?error=1");
                    exit;
                }
            }
            break;
        case 'salvar':
            $nome = mysqli_real_escape_string($conn, $_POST['nome']);
            $preco = floatval($_POST['preco']);
            $categoria = mysqli_real_escape_string($conn, $_POST['categoria']);
            $referencia = floatval($_POST['referencia']);
            $descricao = mysqli_real_escape_string($conn, $_POST['descricao']);
            $peso = floatval($_POST['peso']);
            $id = $_POST['id'] ?? null;

                if (!empty($id)) {
                    $sql = "UPDATE produtos SET Nome = '$nome', Preco = '$preco', CategoriaID = '$categoria', Referencia = '$referencia', Descricao = '$descricao', Peso = '$peso' WHERE ProdutoID = $id";
                } else {
                    $sql = "INSERT INTO produtos (Nome, Preco, CategoriaID, Referencia, Descricao, Peso) VALUES ('$nome', '$preco', '$categoria', '$referencia', '$descricao', '$peso')";
                }
            
                if(mysqli_query($conn, $sql)) {
                    header("Location: ../lista-produtos.php?success=1");
                    exit;
                } else {
                    header("Location: ../salvar-produtos.php?error=1");
                    exit;
                }
                break;
        default:
            header("Location: ../lista-funcionarios.php");
            break;
    }
    ?>
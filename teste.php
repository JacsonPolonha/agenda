<?php 

require_once "loader.php";

$conexao = null;


try {
    $conexao = Conexao::getConnection();
    echo "Conexão com banco de dados realizada com sucesso";
} catch (\Throwable $th) {
    echo "Erro ao abrir conexão com banco de dados." . $th->getMessage();
}
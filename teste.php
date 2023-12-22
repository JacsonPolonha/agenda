<?php 

require_once "loader.php";

// $conexao = null;


// try {
//     $conexao = Conexao::getConnection();
//     echo "Conexão com banco de dados realizada com sucesso";
// } catch (\Throwable $th) {
//     echo "Erro ao abrir conexão com banco de dados." . $th->getMessage();
// }

echo "<h1>Testes!</h1>";

try {
    $dao = new UsuarioDao;
    $listaUsuario = $dao->listarTodos();
    foreach($listaUsuario as $usuario){
        echo $usuario->getNome();
    }

} catch (\Throwable $e) {
    echo "Erro ao carregar a lista de usuario: " . $e->getMessage();
}
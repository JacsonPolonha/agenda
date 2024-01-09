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

// try {
//     $dao = new UsuarioDao;
//     $listaUsuario = $dao->listarTodos();
//     foreach($listaUsuario as $usuario){
//         echo $usuario->getNome();
//     }

// } catch (\Throwable $e) {
//     echo "Erro ao carregar a lista de usuario: " . $e->getMessage();
// }

// try {
//     $dao = new UsuarioDao;

//     $usuario = new Usuario;
//     $usuario->setNome("Jacson Polonha");
//     $usuario->setEmail("jacsonpolonha@email.com");
//     $usuario->setLogin("polonha");
//     $usuario->setSenha("1234");

//     //$dao->inserir($usuario);
//     echo "Usuário cadastrado com sucesso!!!";


//     echo "<h2>Usuários</h2>";
//     $listaUsuario = $dao->listarTodos();
//     foreach($listaUsuario as $usuario){
//         echo $usuario->getNome(). "<br>";
//     }
// } catch (\Throwable $e) {
//     echo "Erro ao cadastrar usuário: ". $e->getMessage();
// }

$dao = new UsuarioDao;

    $usuario = new Usuario;
    $usuario->setNome("teste usuario");
    $usuario->setEmail("teste@email.com");
    $usuario->setLogin("teste-usuario");
    $usuario->setSenha("1234");
    $dao->inserir($usuario);
    echo "Usuário cadastrado com sucesso!!!";

$daoContato = new ContatoDao;
$contato = new Contato($usuario);
$contato->setNome("Jhuli");
$daoContato->inserir($contato);
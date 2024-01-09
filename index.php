<?php 

session_start();
if (!isset($_SESSION["AGENDA"])) {
  header("Location: login.php");  
}

require_once "loader.php";

$usuario = unserialize($_SESSION["AGENDA"]);

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Document</title>
</head>
<body>
  <div class="container">

    <h1>Agenda de contato</h1>
    <h3>Seja bem-vindo, <?php echo $usuario->getNome(); ?>.</h3>

    <?php 
      $dao = new ContatoDao;
      $contatos = $dao->listar($usuario);
    ?>

    <ul class="list-group">
      <?php 
        foreach ($contatos as $contato) {
          $nome = $contato->getNome();
          echo "<li class='list-group-item d-flex justify-content-between align-items-center'>
                  <span>$nome</span>
                  <div>
                    <a class='btn btn-warning' href='#' role='button'>Editar</a>
                    <a class='btn btn-danger' href='#' role='button'>Excluir</a>
                  </div>
                </li>";
        }
      ?>
      <li></li>
    </ul>
    
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
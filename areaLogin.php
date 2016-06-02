<?php
session_start();

$erro = null;
if (isset($_REQUEST["login"]) && $_REQUEST["login"] == true) {

    if (strlen($_POST["usuario"]) > 1 && strlen($_POST["senha"]) > 1) {

        $strUsuario = $_POST["usuario"];
        $strSenha = $_POST["senha"];

        // Buscando dados no banco de dados

        try {
            $conexao = new PDO("mysql:host=localhost;dbname=rota_sabara", "root", "");
            $conexao->exec("set names utf8");

            $resultadoBusca = $conexao->prepare("select * from usuario_administrativo where usuario='" . $strUsuario . "'" . "and senha='" . $strSenha . "'");

            if ($resultadoBusca->execute()) {

                if ($registro = $resultadoBusca->fetch(PDO::FETCH_OBJ)) {
                    $_SESSION["logado"] = true;
                    $_SESSION["id"] = $registro->id_usuarioAdministrativo;
                    $_SESSION["usuario"] = $registro->usuario;
                    $_SESSION["permissao"] = $registro->permissao;
                    $_SESSION["email"] = $registro->email;
                    header("Location: home.php");
                } else {
                    $erro = "Usuário não encontrado!";
                }
            }
        } catch (PDOException $e) {
            echo "Falha: " . $e->getMessage();
            exit();
        }
    } else {
        $erro = "Preencha os campos!";
    }
}
?>

<!Doctype html>
<html lang="pt-br">
    <head>
        <title>Área Admnistrativa</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    </head>
    <body>

        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-sm-offset-3">
                    <form class="form-horizontal" method="POST" action="?login=true">
                        <legend align="center"><h1>Área Administrativa</h1></legend>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="usuario"> Usuário:</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="usuario" placeholder="Usuário" required></input>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="senha"> Senha:</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="password" name="senha" placeholder="Senha" required></input>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-10 col-sm-offset-2">
                                <button class="btn btn-default btn-block" type="submit" name="acessar">Acessar</button>
                            </div>
                        </div>
                        <?php
                        if (isset($erro)) {
                            echo $erro;
                        }
                        ?>
                    </form>
                </div>
            </div>
        </div>
</html>

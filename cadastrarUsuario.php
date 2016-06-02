<?php
    session_start();
    if($_SESSION["logado"] != true){
        header("Location: areaLogin.php");
        exit;
    }
?>

<?php

    $valido = false;
    // Erros que o usuário cometeu
    $erroUsuario = "";


    if(isset($_REQUEST["validar"]) && $_REQUEST["validar"] == true){

        $valido = true;


        if(strlen(utf8_decode($_POST["nome"])) > 254){
            $erroUsuario .= "Nome muito grande!";
        }else if (strlen(utf8_decode($_POST["nome"])) < 2) {
            $erroUsuario .= "Nome muito pequeno!";
        }else if (substr_count($_POST["email"], "@") != 1) {
            $erroUsuario .= "Email incorreto!";
        }elseif ($_POST["genero"] != "M" && $_POST["genero"] != "F") {
            $erroUsuario .= "Escolha um gênero!";
        }elseif (strlen(utf8_decode($_POST["usuario"])) > 100) {
            $erroUsuario .= "Nome de Usuário muito grande!";
        }else if (strlen(utf8_decode($_POST["usuario"])) < 2) {
            $erroUsuario .= "Nome de Usuário muito pequeno!";
        }elseif (strlen(utf8_decode($_POST["senha"])) > 100) {
            $erroUsuario .= "Senha muito grande!";
        }else if (strlen(utf8_decode($_POST["senha"])) < 6) {
            $erroUsuario .= "Senha muito pequena!";
        }else{
            
            
            // Incluindo neste arquivo a classe de Usuário Administrativo
            include_once 'entidades/UsuarioAdministrativo.php';
            // Incluindo neste arquivo a classe de conexao do Usuário Administrativo
            include_once 'conexao/UsuarioAdministrativoDao.php';

            try{

                $usuario = new UsuarioAdministrativo($_POST["nome"], $_POST["genero"], $_POST["permissao"], $_POST["email"], $_POST["usuario"], $_POST["senha"]);

                $conexao = new UsuarioAdministrativoDao();
                $conexao->inserir($usuario);

            }catch(PDOException $e){
                echo "Falha: " . $e->getMessage();
                exit();
            }
        }

    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Rota Sabará | ADM</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <style type="text/css">
            body {
                background-color: #ddd;
            }

            #nav-principal {
                background-color: #fff;
            }

            .header-principal {
                background-color: #eee;
                margin-bottom: 50px;
            }

            .titulo-principal {
                font-size: 30px;
                color: #888;
            }

        </style>
    </head>
    <body>
        <div class="container-fluid">
            
            
            <?php
                include_once 'layout/header.php';
            ?> 
            
            <div class="col-sm-9 col-sm-offset-3">
                <div class="container-fluid">
                    <!-- CABEÇALHO PRINCIPAL -->
                    <div class="row">
                        <div class="header-principal col-sm-12">
                            <header>
                                <h1 class="titulo-principal">Cadastro De Usuário</h1>
                            </header>
                        </div>
                    </div>
                    <!-- FIM CABEÇALHO PRINCIPAL -->

                    <div class="row">
                        <div class="container-fluid">
                            <div id="formulario">
                                <form class="form-horizontal" role="form" method="POST" action="?validar=true">

                                <?php
                                    if($valido == true){
                                        echo $erroUsuario;
                                    }
                                ?>

                                    <div class="form-group">
                                        <label class="control-label col-sm-2">Nome:</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="text" name="nome" placeholder="Ex: João Alberto" required></input>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-2" for="email">E-mail:</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="email" name="email" placeholder="Ex: joaoAlberto@email.com" required></input>
                                        </div>
                                    </div>
                                    <div class="form-group text-center">
                                        <label class="control-label col-sm-2">Gênero:</label>
                                        <div class="col-sm-2">
                                            <div class="radio">
                                                <label><input type="radio" name="genero" value="M">Masculino</input></label>
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="radio">
                                                <label><input type="radio" name="genero" value="F">Feminino</input></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-2" for="usuario">Usuário:</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="text" name="usuario" placeholder="Ex: joao" required></input>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-2">Permissão:</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" name="permissao"   >
                                                <option>Selecionar...</option>
                                                <option>Administrador</option>
                                                <option>Criar/Editar</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-2" for="senha">Senha:</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="password" name="senha" placeholder="Ex: joao123" required></input>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-2" for="confirmaSenha">Confimar de Senha:</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="password" name="confirmaSenha" placeholder="Ex: joao123" required></input>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-9 col-sm-offset-2">
                                            <button class="btn btn-default btn-block" type="submit" name="salvar">Salvar</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php
                        include_once 'layout/footer.php';
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>

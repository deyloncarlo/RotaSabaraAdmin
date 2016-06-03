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

        include_once 'util/UtilCadastroPontoTuristico.php';

        echo $_POST["ecologica"];
        

        $erroUsuario = UtilCadastroPontoTuristico::isAlgumCampoNulo($erroUsuario, $_POST["nome"], $_POST["dataNascimento"], $_POST["descricao"], $_POST["resumo"], $_POST["latitude"], $_POST["longitude"], array($_POST["ecologica"], $_POST["igreja"], $_POST["museu"], $_POST["culinaria"]));

        if(isset($erroUsuario) == true){
            echo $erroUsuario;
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
                                <h1 class="titulo-principal">Cadastro de Pontos Turísticos</h1>
                            </header>
                        </div>
                    </div>
                    <!-- FIM CABEÇALHO PRINCIPAL -->

                    <div class="row">
                        <div class="container-fluid">
                            <div id="formulario">
                                <form class="form-horizontal" role="form" method="POST" action="?validar=true">
                                    <div class="form-group">
                                        <label class="control-label col-sm-2" for="caminhoImagem">Adicionar Imagem:</label>
                                        <div class="col-sm-9">
                                            <input type="file" name="caminhoImagem"></input>
                                            <p class="help-block">Selecione uma imagem.</p>
                                        </div>
                                    </div>
                                    <div class="form-group">q
                                        <label class="control-label col-sm-2">Nome:</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="text" name="nome" placeholder="Ex: Igreja de Nossa Senhora" ></input>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-2" >Data Nascimento:</label>
                                        <div class="col-sm-3">
                                            <input class="form-control" type="date" name="dataNascimento" ></input>
                                        </div>
                                    </div>
                                    <div class="form-group text-center">
                                        <label class="control-label col-sm-2" for="descricao">Descrição:</label>
                                        <div class="col-sm-9">
                                            <textarea name="descricao" class="form-control" placeholder="Ex: Criado no ano de XXXX, este ponto turístico..." rows="15" ></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group text-center">
                                        <label class="control-label col-sm-2" for="resumo">Resumo:</label>
                                        <div class="col-sm-9">
                                            <textarea name="resumo" class="form-control" placeholder="Ex: Criado no ano de XXXX, este ponto turístico..." rows="5" ></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-2" for="latitude">Latitude:</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="number" name="latitude" ></input>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-2" for="longitude">Longitude:</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="number" name="longitude" ></input>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-2">Classificações:</label>
                                        <div class="col-sm-9">
                                            <div class="checkbox">
                                                
                                                <label class="control-label col-sm-2" for="igreja">
                                                    <input type="checkbox" value="igreja" name="igreja">Igreja</input>
                                                </label>
                                                <label class="control-label col-sm-2" for="ecologica">
                                                    <input type="checkbox" value="ecologica" name="ecologica">Ecológica</input>
                                                </label>
                                                <label class="control-label col-sm-2" for="museu">
                                                    <input type="checkbox" value="museu" name="museu">Museu</input>
                                                </label>
                                                <label class="control-label col-sm-2" for="culinaria">
                                                    <input type="checkbox" value="culinaria" name="culinaria">Culinária</input>
                                                </label>
                                            </div>
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

<?php
    session_start();
    /**
     * Verificando se o usuário está logado, caso contrário ele é enviado para página de login.
     */
    if($_SESSION["logado"] != true){
        header("Location: areaLogin.php");
        exit;
    }
?>

<?php

    $valido = false;

    // Erros que o usuário cometeu
    $erroUsuario = null;
    $erroImagem = null;

    if(isset($_REQUEST["validar"]) && $_REQUEST["validar"] == true){

        $valido = true;

        if(isset($_FILES["imagem"])){

            $erroImagem = $_FILES["imagem"]["error"];        
            $nomeImagem = $_FILES["imagem"]["name"];
            $tipoImagem = $_FILES["imagem"]["type"];
            $tamanhoImagem = $_FILES["imagem"]["size"];
            $nomeTemporarioImagem = $_FILES["imagem"]["tmp_name"];

            if($nomeTemporarioImagem == null && $tamanhoImagem == 0){
                $erroImagem = "Nenhuma imagem selecionada.";
            }else{

                /**
                * Se o valor do $erroImagem for igual a 0, quer dizer que teve sucesso.
                */
                if($erroImagem == 0){

                    if(is_uploaded_file($nomeTemporarioImagem)){
                        if(move_uploaded_file($nomeTemporarioImagem, "uploads/imagem_pontos_turisticos/" . $nomeImagem) == true){
                            echo "Sucesso!" . "<br>";
                        }else{
                            $erroImagem = "Falha ao mover o arquivo.";
                        }
                    }else{
                        $erroImagem = "Erro no envio: arquivo não recebido com sucesso.";
                    }
                }else{
                    $erroImagem = "Erro no envio: " . $erroImagem;
                }
            }

        }else{
            $erroUsuario = "Arquivo enviado não encontrado.";
        }
         
        include_once 'util/UtilCadastroPontoTuristico.php';

        $erroUsuario .= UtilCadastroPontoTuristico::isAlgumCampoNulo($erroUsuario, $_POST["nome"], $_POST["dataNascimento"], $_POST["descricao"], $_POST["resumo"], $_POST["latitude"], $_POST["longitude"], array(isset($_POST["ecologica"]), isset($_POST["igreja"]), isset($_POST["museu"]),isset($_POST["culinaria"])));

        if($erroUsuario == null && $erroImagem == 0){
            try {

                    include_once 'entidades/pontoTuristico.php';
                    include_once 'conexao/PontoTuristicoDao.php';

                    $dataAtual = new date("d/m/y");
                    $caminhoDaFotoDestacada = "uploads/imagem_pontos_turisticos/" . $_FILES["imagem"]["name"];
                    $pontoTuristico = new PontoTuristico($_POST["nome"], $_POST["dataNascimento"], $dataAtual, $_POST["descricao"], $_POST["resumo"], $caminhoDaFotoDestacada, $_POST["latitude"], $_POST["longitude"], $_POST["ecologica"], $_POST["religiosa"], $_POST["gastronomica"], $_POST["patrimonial"], $_POST["trilha"]);

                    $conexao = new PontoTuristicoDAO();
                    $conexao->inserir($pontoTuristico);

               } catch (Exception $e) {
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

        <link rel="stylesheet" type="text/css" href="css/style-principal.css">
    </head>
    <body>
        <div class="container-fluid">
            <!--
            <?php
            include_once 'layout/header.php';
            ?> 
        -->
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
                                <form enctype="multipart/form-data" class="form-horizontal" role="form" method="POST" action="?validar=true">

                                    <?php 
                                    if ($valido == true) {
                                        echo $erroUsuario;
                                        if($erroImagem != 0){
                                            echo $erroImagem;
                                        }
                                    }
                                    ?>

                                    <div class="form-group">
                                        <label class="control-label col-sm-2">Adicionar Imagem:</label>
                                        <div class="col-sm-9">
                                            <input type="file" name="imagem"></input>
                                            <p class="help-block">Selecione uma imagem.</p>
                                        </div>
                                    </div>
                                    <div class="form-group">
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

                                                <label class="control-label col-sm-2" for="religiosa">
                                                    <input type="checkbox" value="1" name="religiosa">Igreja</input>
                                                </label>
                                                <label class="control-label col-sm-2" for="ecologica">
                                                    <input type="checkbox" value="1" name="ecologica">Ecológica</input>
                                                </label>
                                                <label class="control-label col-sm-2" for="patrimonial">
                                                    <input type="checkbox" value="1" name="patrimonial">Patrimonial</input>
                                                </label>
                                                <label class="control-label col-sm-2" for="gastronomica">
                                                    <input type="checkbox" value="1" name="gastronomica">Culinária</input>
                                                </label>
                                                <label class="control-label col-sm-2" for="trilha">
                                                    <input type="checkbox" value="1" name="trilha">Trilha</input>
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
                </div>
            </div>
        </div>
    </body>
</html>

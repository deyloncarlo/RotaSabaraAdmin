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

    include_once 'entidades/pontoTuristico.php';

    $valido = false;

    // Erros que o usuário cometeu
    $erroUsuario = null;

    /* Variável que irá conter os pontos turísticos buscados do banco*/
    $vetorPontosTuristicos = array();

    if(isset($_REQUEST["validar"]) && $_REQUEST["validar"] == true){

        $valido = true;
        /*Vetor que irá armazenar as informações de quais classificações foram selecionadas, selecionado = true não selecionado = false*/
        $vetorDasClassificoes = array( isset($_POST["religiosa"]), isset($_POST["ecologica"]), isset($_POST["patrimonial"]), isset($_POST["gastronomica"]), isset($_POST["trilha"]));

        /*Variável que irá obter a query para buscar os pontos turísticos*/
        $sql = null;

        if(empty($_POST["nome"]) == true && in_array(true, $vetorDasClassificoes) == false){
            $sql = "select * from ponto_turistico";
        }
        else if(empty($_POST["nome"]) == false && in_array(true, $vetorDasClassificoes) == false){
            $sql = "select * from ponto_turistico where nome='" . $_POST["nome"] . "'";
        }
        else if (empty($_POST["nome"]) == false && in_array(true, $vetorDasClassificoes) == true) {
            $sql = "select * from ponto_turistico where nome='" . $_POST["nome"] . "'";

            if (isset($_POST["religiosa"]) == true) {
                $sql .= " and isReligiosa=" . $_POST["religiosa"];
            }
            if (isset($_POST["ecologica"]) == true) {
                $sql .= " and isEcologica=" . $_POST["ecologica"];
            }
            if (isset($_POST["patrimonial"]) == true) {
                $sql .= " and isPatrimonial=" . $_POST["patrimonial"];
            }
            if (isset($_POST["gastronomica"]) == true) {
                $sql .= " and isGastronomica=" . $_POST["gastronomica"];
            }
            if (isset($_POST["trilha"]) == true) {
                $sql .= " and isTrilha=" . $_POST["trilha"];
            }
        }

        include_once 'conexao/PontosTuristicosDao.php';

        $conexao = new PontoTuristicoDAO();

        /* Varável que irá informar se pode ou não exibir os pontos turísticos na tela*/
        $isPodeMostrarPontosTuristicos = null;

        $vetorPontosTuristicos = $conexao->buscar($sql);

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

        <style type="text/css">
            .bloco-pontoTuristico {
                background-color: #ccc;
                padding: 5px;
                box-shadow: 2px 2px 2px gray;
                box-sizing: border-box;
                overflow: hidden;
                margin: 3px;
            }
            .bloco-pontoTuristico img{
                width: 100%;
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
                                <h1 class="titulo-principal">Visualização de Pontos Turísticos</h1>
                            </header>
                        </div>
                    </div>
                    <!-- FIM CABEÇALHO PRINCIPAL -->

                    <div class="row">
                        <div class="container-fluid">
                            <div id="formulario">
                                <form class="form-horizontal" role="form" method="POST" action="?validar=true">

                                    <?php 
                                        if ($valido == true) {
                                            echo $sql;
                                        }
                                    ?>
                                    <div class="form-group">

                                        <div class="form-group">
                                            <label class="control-label col-sm-2">Nome:</label>
                                            <div class="col-sm-9">
                                                <input class="form-control" type="text" name="nome" placeholder="Ex: Igreja de Nossa Senhora" ></input>
                                            </div>
                                        </div>

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
                                                    <input type="checkbox" value="1" name="gastronomica">Gastronômica</input>
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

                            <div id="mostra-resultado">
                                <?php 

                                    if($valido == true){
                                        if($vetorPontosTuristicos != null){
                                            
                                            foreach ($vetorPontosTuristicos as $pontoTuristico) {
                                                echo "<div class='col-sm-5 bloco-pontoTuristico'>";
                                                echo "<img src='" . $pontoTuristico->caminho_imagem_destacada . "'>";
                                                echo "</div>";    
                                            }
                                        }
                                    }
                                 ?>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

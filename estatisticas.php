<?php
    session_start();
    if($_SESSION["logado"] != true){
        header("Location: areaLogin.php");
        exit;
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
                                <h1 class="titulo-principal">Estatísticas</h1>
                            </header>
                        </div>
                    </div>
                    <!-- FIM CABEÇALHO PRINCIPAL -->

                    <div class="row">
                        <div class="container">
                            
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

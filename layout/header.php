
<style type="text/css">
    #nav-principal {
        background-color: #fff;
        display: block;
        position: fixed;
        top: 0px;
        bottom: 0px;
        left: 0px;
        overflow-x: hidden;
        overflow-y: auto;
        z-index: 10; 
    }
    
    .usuario h6{
     
    }
    
</style>

<header>
<nav>
    <div id="nav-principal" class="col-sm-3 sidebar">
        <div class="nav nav-stacked">
            <a class="navbar-brand" href="#">Rota Sabará | ADM</a>
        </div>
        <div class="nav nav-stacked">
            <?php
                echo "<h5>". $_SESSION["usuario"] . "</h5>";
            ?>
        </div>
        <ul class="nav nav-tabs nav-pills nav-stacked nav-tabs-justified">
            <li><a href="home.php">Área de Trabalho</a></li>
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    Pontos Turísticos <span class="caret right"></span>
                </a>
                <ul class="dropdown-menu nav-stacked nav-tabs-justified" >
                    <li><a href="cadastrarPontosTuristicos.php"> Cadastrar</a></li>
                    <li><a href="editarPontosTuristicos.php"> Editar</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    Usuários <span class="caret right"></span>
                </a>
                <ul class="dropdown-menu nav-stacked nav-tabs-justified">
                    <li><a href="cadastrarUsuario.php"> Cadastrar</a></li>
                    <li><a href="editarUsuario.php"> Editar</a></li>
                </ul>
            </li>
            <li>
                <a href="estatisticas.php">Estatíticas</a>
            </li>
            <li>
                <a href="ajuda.php">Ajuda</a>
            </li>
            <li>
                <a href="#">Configurações</a>
            </li>
            <li>
                <a href="logout.php">Sair</a>
            </li>
        </ul>
    </div>
</nav>

</header>

<header>
<nav>
    <div id="nav-principal" class="col-sm-3 sidebar">
        <div class="nav nav-stacked">
            <a class="navbar-brand" href="#">Rota Sabará | ADM</a>
        </div>
        <div class="nav nav-stacked usuario">
            <?php
                echo "Bem vindo, ". $_SESSION["usuario"];
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
                    <li><a href="visualizarPontosTuristicos.php"> Visualizar </a></li>
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
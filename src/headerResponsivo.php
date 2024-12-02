<section class="headerResponsivo pt-3 pb-3">

    <section class="container d-flex">
        <section class="col d-flex align-items-center justify-content-start">
            <a href="/TechWay/index.php">
                <img src="/TechWay/img/icones/logo/logoExtensoBranco.png" class="logo" alt="Icone da Logo TechWay">
            </a>
        </section>
    
        <nav class="navBotao col d-flex navbar justify-content-end">
            <?php
                if(isset($_SESSION["id"])){
                    if($_SESSION["tipo"] == 'Usuario'){
                        $sqlSel = "SELECT * FROM USUARIO WHERE id =". $_SESSION['id'];
                        $resul = mysqli_query($conexao, $sqlSel);
                        $contr = mysqli_fetch_array($resul);
            ?>
                        <a href="/TechWay/src/cadastrado/alterarUsu.php">
            <?php
                            if($contr["foto"] == ''){
            ?>
                                <img src="/TechWay/img/icones/iconesLink/usuarioImg.png" class="iconeUsu" alt="Icone usuário">
            <?php
                            }else{
                                echo('<img src="/TechWay/img/usuario/usu'.$contr["id"].'/'.$contr["foto"].'" class="iconeUsu Usu" alt="Icone usuário">');
                            }
            ?>
                        </a>
            <?php
                    }

                    if($_SESSION["tipo"] == 'Estabelecimento'){
                        $sqlSel = "SELECT * FROM Fotos_Estabelecimento WHERE id_estabelecimento =". $_SESSION['id'];
                        $resul = mysqli_query($conexao, $sqlSel);
                        $contr = mysqli_fetch_array($resul);
            ?>
                        <a href="/TechWay/src/cadastrado/alterarEst.php">
            <?php
                            if($contr["logo"] == ''){
            ?>
                                <img src="/TechWay/img/icones/iconesLink/usuarioImg.png" class="iconeUsu" alt="Icone estabelecimento">
            <?php
                            }else{
                                echo('<img src="/TechWay/img/estabelecimento/est'.$contr["id_estabelecimento"].'/'.$contr["logo"].'" class="iconeUsu Usu" alt="Icone estabelecimento">');
                            }
            ?>
                        </a>
            <?php
                    }

                    if($_SESSION["tipo"] == 'Monitor'){
                        $sqlSel = "SELECT * FROM Fotos_Monitor WHERE id_monitor =". $_SESSION['id'];
                        $resul = mysqli_query($conexao, $sqlSel);
                        $contr = mysqli_fetch_array($resul);
            ?>
                        <a href="/TechWay/src/cadastrado/alterarMon.php">
            <?php
                            if($contr["foto_perfil"] == ''){
            ?>
                                <img src="/TechWay/img/icones/iconesLink/usuarioImg.png" class="iconeUsu" alt="Icone monitor">
            <?php
                            }else{
                                echo('<img src="/TechWay/img/monitor/mon'.$contr["id_monitor"].'/'.$contr["foto_perfil"].'" class="iconeUsu Usu" alt="Icone monitor">');
                            }
            ?>
                        </a>
            <?php
                    }
                }
            ?>
            <button class="botaoHamburguer navbar-toggler" type="button" data-bs-toggle="modal" data-bs-target="#menu">
                <img src="/TechWay/img/icones/iconesLink/menuHamburguerImg.png" class="icones" alt="Icone Menu Hambúrguer">
            </button>
        </nav>
    </section>

    <section class="modalMenu modal fade" id="menu" tabindex="-1" aria-hidden="true">
        <section class="modal-dialog modal-dialog-centered" role="document">
            <section class="modal-content">
                <section class="modal-header d-flex align-items-center">
                    <h5 class="modal-title"> Menu </h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span class="icones" aria-hidden="true"> &times;</span>
                    </button>
                </section>
                <section class="modal-body">
                    <ul class="nav d-flex flex-column list-group list-group-flush">
                        <li class="list-group-item nav-item">
                            <a id="btnExplorar" class="linkHeader nav-link" href="/TechWay/index.php"> Home </a>
                        </li>

                        <li class="list-group-item nav-item">
                            <a id="btnGuias" class="linkHeader nav-link" href="/TechWay/src/guias.php"> Guias e Monitores </a>
                        </li>
                        
                        <li class="list-group-item nav-item">
                            <a id="btnSobreNos" class="linkHeader nav-link" href="/TechWay/src/sobreNos.php"> Sobre Nós </a>
                        </li>

                        <?php
                            if(!isset($_SESSION["id"])){
                        ?>
                                <li class="list-group-item nav-item">
                                    <a id="btnLogin" class="linkHeader nav-link" href="/TechWay/src/login.php"> Fazer Login </a>
                                </li>
                        <?php      
                            }
                        ?>
                    </ul>
                </section>
            </section>
        </section>
    </section>

</section>

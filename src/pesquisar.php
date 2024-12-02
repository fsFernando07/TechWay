<?php
            require_once('header.php');
            require_once('headerResponsivo.php');
            require_once("conexao.php");
        ?>
        <script src="/TechWay/js/header.js"></script>
        <main class="tab-content">

            <section class="container" id="explorar">
                <ul class="nav pt-3 pb-2">
                    <li class="nav-item">
                        <a class="nav-link p-0" href="../index.php"> <i class="fa-solid fa-arrow-left"></i> Voltar à Home </a>
                    </li>
                </ul>
                
                <section class="fundoExplorar">
                    <section class="childFundoExplorar"></section>
                    <section class="container d-flex justify-content-center pb-3">
                        <h1> Conheça Santa Isabel! </h1>
                    </section>
    
                    <nav class="navbar pt-5 container d-flex flex-column justify-content-center">
    
                        <form action="#" method="POST" class="form-inline d-flex flex-row">
                            <input type="text" class="barPesquisa" name="pesquisa" id="pesquisa" placeholder="Buscar por..." autocomplete="off">
                            <button type="submit" id="btnPesquisa" class="btnPesquisa"> 
                                <img src="../img/icones/iconesLink/lupaImg.png" class="iconeBar" alt="Icone de Lupa para Barra de Pesquisa">
                            </button>
                        </form>

                        <section id="lista" class="position-relative list-group"></section>
                    </nav>
                    
                </section>

                <section class="tab-content">

                    <section class="tab-pane active" id="hospedagem">
                        <section class="container mt-5">
                            <h3> Resultados </h3>
                        </section>
        
                        <section class="wrapper est">
                            <i id="left" class="fa-solid fa-angle-left"></i>
                            
                            <section class="carousel">
                            <?php
                                $pesquisa = $_POST["pesquisa"];
                                $sqlSel = 'SELECT * FROM Estabelecimento WHERE nome_estabelecimento LIKE "%'. $pesquisa .'%" && autorizado = "Autorizado";';
                                $resul = mysqli_query($conexao, $sqlSel);
                                $numLinhas = mysqli_num_rows($resul);
                                if($numLinhas > 0){
                                    while($cont = mysqli_fetch_array($resul)){
                                        $sqlSelFt = "SELECT * FROM Fotos_Estabelecimento WHERE id_estabelecimento =". $cont["id"];
                                        $resul1 = mysqli_query($conexao, $sqlSelFt);
                                        $img = mysqli_fetch_array($resul1);
                            ?>
                                            <section class="card">
                                                <section class="id">
                                                <form action="estabSelecionado.php" method="POST">
                            <?php                  
                                                     echo('<input type="number" name="id" id="id" value="'.$cont["id"].'">');
                            ?>
                                                        <input type="submit" value="Enviar" name="enviar" id="enviar">
                                                    </form>
                                                </section>
                            <?php
                                                echo('<img class="card-img-top" src="../img/estabelecimento/est'.$cont["id"].'/'.$img["logo"].'" alt="Imagem estabelecimento '.$cont["nome_estabelecimento"].'" draggable="false">');
                            ?>
                                                <section class="card-body">
                                                    <h5 class="card-title"> <?php echo($cont["nome_estabelecimento"]); ?></h5>
                                                    <p class="card-text"> <?php echo($cont["descricao"]); ?> </p>
                                                </section>
                                                <section class="card-footer">
                                                    <p class="m-0"> <small> <?php echo($cont["horario"]); ?> </small></p>
                                                </section>
                                            </section>
                                            <?php
                                    }
                                }else{
                                    echo('<h5 class="ms-5"> Erro: nenhum estabelecimento encontrado. </h5>');
                                }
                                
                            ?>
                            </section>
                            <i id="right" class="fa-solid fa-angle-right"></i>
                        </section>
    
                    </section>

                </section>

            </section>
            
        </main>

        <?php
            require_once('footer.php');
        ?>
        <script src="/TechWay/js/carousel.js" defer></script>
        <script src="/TechWay/js/cardsEstab.js" defer></script>
        <script src="/TechWay/js/pesquisa.js" defer></script>
    </body>
</html>
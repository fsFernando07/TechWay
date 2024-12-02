        <?php
            require_once('./src/header.php');
            require_once('./src/headerResponsivo.php');
            require_once("./src/conexao.php");
        ?>
        <script src="/TechWay/js/header.js"></script>
        
        <main class="tab-content">
            <section id="splash">
                <section class="container">
                    <h1 class="bebas-neue-regular ms-5"> O turismo é o FUTURO! </h1>
                    <img src="/TechWay/img/icones/logo/logoArredondadaBranco.png" class="logoArredondadaSplash" alt="Icone da Logo TechWay">
                </section>
            </section>

            <section class="container pt-5" id="explorar">
                
                <section class="fundoExplorar">
                    <section class="childFundoExplorar"></section>
                    <section class="container d-flex justify-content-center pb-3">
                        <h1> Conheça Santa Isabel! </h1>
                    </section>
    
                    <section class="container d-flex justify-content-center">
                        <ul class="nav nav-tabs d-flex align-items-center justify-content-center">
                            
                            <li class="nav-item">
                                <a class="nav-link active link-dark link-opacity-75-hover d-flex align-items-center gap-1" data-bs-toggle="tab" href="#tudo">
                                    <img src="./img/icones/iconesLink/tudoImg.png" class="icones" alt="Icone da opção Tudo"> 
                                    <p class="m-0"> Tudo </p> 
                                </a>
                            </li>
    
                            <li class="nav-item">
                                <a class="nav-link link-dark link-opacity-75-hover d-flex align-items-center gap-1" data-bs-toggle="tab" href="#hospedagem">
                                    <img src="./img/icones/iconesLink/hospedagemImg.png" class="icones" alt="Icone da opção Hospedagem">
                                    <p class="m-0"> Hospedagem </p> 
                                </a>
                            </li>
    
                            <li class="nav-item">
                                <a class="nav-link link-dark link-opacity-75-hover d-flex align-items-center gap-1" data-bs-toggle="tab" href="#alimentacao"> 
                                    <img src="./img/icones/iconesLink/alimentacaoImg.png" class="icones" alt="Icone da opção Alimentação">
                                    <p class="m-0"> Alimentação </p>
                                </a>
                            </li>
    
                            <li class="nav-item">
                                <a class="nav-link link-dark link-opacity-75-hover d-flex align-items-center gap-1" data-bs-toggle="tab" href="#compras">
                                    <img src="./img/icones/iconesLink/comprasImg.png" class="icones" alt="Icone da opção Compras"> 
                                    <p class="m-0"> Compras </p>
                                </a>
                            </li>
    
                            <li class="nav-item">
                                <a class="nav-link link-dark link-opacity-75-hover d-flex align-items-center gap-1" data-bs-toggle="tab" href="#locomocao">
                                    <img src="./img/icones/iconesLink/locomocaoImg.png" class="icones" alt="Icone da opção Locomoção"> 
                                    <p class="m-0"> Locomoção </p>
                                </a>
                            </li>
    
                        </ul>  
                    </section>
    
                    <nav class="navbar pt-5 container d-flex flex-column justify-content-center">
    
                        <form action="./src/pesquisar.php" method="POST" class="form-inline d-flex flex-row">
                            <input type="text" class="barPesquisa" name="pesquisa" id="pesquisa" placeholder="Buscar por..." autocomplete="off">
                            <button type="submit" id="btnPesquisa" class="btnPesquisa"> 
                                <img src="./img/icones/iconesLink/lupaImg.png" class="iconeBar" alt="Icone de Lupa para Barra de Pesquisa">
                            </button>
                        </form>

                        <section id="lista" class="position-relative list-group"></section>
                    </nav>
                    
                </section>

                <section class="tab-content">

                    <section class="tab-pane active" id="tudo">
                        <section class="container mt-5">
                            <h3> Em alta </h3>
                        </section>
        
                        <section class="wrapper est">
                            <i id="left" class="fa-solid fa-angle-left"></i>

                            <section class="carousel">
                            <?php
                                $sqlSel = "SELECT * FROM Estabelecimento WHERE autorizado = 'autorizado' LIMIT 10";
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
                                                    <form action="./src/estabSelecionado.php" method="POST">
                            <?php                  
                                                     echo('<input type="number" name="id" id="id" value="'.$cont["id"].'">');
                            ?>
                                                        <input type="submit" value="Enviar" name="enviar" id="enviar">
                                                    </form>
                                                </section>
                            <?php
                                                echo('<img class="card-img-top" src="./img/estabelecimento/est'.$cont["id"].'/'.$img["logo"].'" alt="Imagem estabelecimento '.$cont["nome_estabelecimento"].'" draggable="false">');
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
    
                    <section class="tab-pane fade" id="hospedagem">
                        <section class="container mt-5">
                            <h3> Hospedagem </h3>
                        </section>
        
                        <section class="wrapper est">
                            <i id="left" class="fa-solid fa-angle-left"></i>
                            
                            <section class="carousel">
                            <?php
                                $sqlSel = "SELECT * FROM Estabelecimento WHERE id_categoria = 1 && autorizado = 'autorizado'";
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
                                                <form action="./src/estabSelecionado.php" method="POST">
                            <?php                  
                                                     echo('<input type="number" name="id" id="id" value="'.$cont["id"].'">');
                            ?>
                                                        <input type="submit" value="Enviar" name="enviar" id="enviar">
                                                    </form>
                                                </section>
                            <?php
                                                echo('<img class="card-img-top" src="./img/estabelecimento/est'.$cont["id"].'/'.$img["logo"].'" alt="Imagem estabelecimento '.$cont["nome_estabelecimento"].'" draggable="false">');
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

                    <section class="tab-pane fade" id="alimentacao">
                        <section class="container mt-5">
                            <h3> Alimentação </h3>
                        </section>
        
                        <section class="wrapper est">
                            <i id="left" class="fa-solid fa-angle-left"></i>
                            
                            <section class="carousel">
                            <?php
                                $sqlSel = "SELECT * FROM Estabelecimento WHERE id_categoria = 2 && autorizado = 'autorizado'";
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
                                                <form action="./src/estabSelecionado.php" method="POST">
                            <?php                  
                                                     echo('<input type="number" name="id" id="id" value="'.$cont["id"].'">');
                            ?>
                                                        <input type="submit" value="Enviar" name="enviar" id="enviar">
                                                    </form>
                                                </section>
                            <?php
                                                echo('<img class="card-img-top" src="./img/estabelecimento/est'.$cont["id"].'/'.$img["logo"].'" alt="Imagem estabelecimento '.$cont["nome_estabelecimento"].'" draggable="false">');
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

                    <section class="tab-pane fade" id="compras">
                        <section class="container mt-5">
                            <h3> Compras </h3>
                        </section>
        
                        <section class="wrapper est">
                            <i id="left" class="fa-solid fa-angle-left"></i>
        
                            <section class="carousel">
                            <?php
                                $sqlSel = "SELECT * FROM Estabelecimento WHERE id_categoria = 3 && autorizado = 'autorizado'";
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
                                                <form action="./src/estabSelecionado.php" method="POST">
                            <?php                  
                                                     echo('<input type="number" name="id" id="id" value="'.$cont["id"].'">');
                            ?>
                                                        <input type="submit" value="Enviar" name="enviar" id="enviar">
                                                    </form>
                                                </section>
                            <?php
                                                echo('<img class="card-img-top" src="./img/estabelecimento/est'.$cont["id"].'/'.$img["logo"].'" alt="Imagem estabelecimento '.$cont["nome_estabelecimento"].'" draggable="false">');
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

                    <section class="tab-pane fade" id="locomocao">
                        <section class="container mt-5">
                            <h3> Locomoção </h3>
                        </section>
        
                        <section class="wrapper est">
                            <i id="left" class="fa-solid fa-angle-left"></i>
        
                            <section class="carousel">
                            <?php
                                $sqlSel = "SELECT * FROM Estabelecimento WHERE id_categoria = 4 && autorizado = 'autorizado'";
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
                                                <form action="./src/estabSelecionado.php" method="POST">
                            <?php                  
                                                     echo('<input type="number" name="id" id="id" value="'.$cont["id"].'">');
                            ?>
                                                        <input type="submit" value="Enviar" name="enviar" id="enviar">
                                                    </form>
                                                </section>
                            <?php
                                                echo('<img class="card-img-top" src="./img/estabelecimento/est'.$cont["id"].'/'.$img["logo"].'" alt="Imagem estabelecimento '.$cont["nome_estabelecimento"].'" draggable="false">');
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
                                    echo('<h5 class="ms-5"> Erro: nenhum estabelecimento encontrado. </h2>');
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
            require_once('./src/footer.php');
        ?>
        <script src="/TechWay/js/carousel.js" defer></script>
        <script src="/TechWay/js/cardsEstab.js" defer></script>
        <script src="/TechWay/js/pesquisa.js" defer></script>
    </body>
</html>
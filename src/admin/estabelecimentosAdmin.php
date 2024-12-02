<?php
    require_once('headerAdmin.php');
    require_once('headerResponsivoAdmin.php');
?>
    <main class="container">
        <section class="d-flex flex-column align-items-center pt-3">
            <h2> Estabelecimentos </h2>
            <section class="container">
                <h4> Em análise </h4>
                <section class="wrapper est">
                    <i id="left" class="fa-solid fa-angle-left"></i>

                    <section class="carousel">
                    <?php
                        $sqlSel = "SELECT * FROM Estabelecimento WHERE autorizado = 'Em análise'";
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
                                        <form action="estSelecionadoAdmin.php" method="POST">
                    <?php                  
                                                echo('<input type="number" name="id" id="id" value="'.$cont["id"].'">');
                    ?>
                                                <input type="submit" value="Enviar" name="enviar" id="enviar">
                                            </form>
                                        </section>
                    <?php
                                        echo('<img class="card-img-top" src="/Techway/img/estabelecimento/est'.$cont["id"].'/'.$img["logo"].'" alt="Imagem estabelecimento '.$cont["nome_estabelecimento"].'" draggable="false">');
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
                            echo('<h5 class="ms-5"> Nenhum estabelecimento encontrado. </h2>');
                        }
                        
                    ?>
                    </section>
                    <i id="right" class="fa-solid fa-angle-right"></i>
                </section>
            </section>

            <section class="container pt-5">
                <h4> Não autorizados </h4>
                <section class="wrapper est">
                    <i id="left" class="fa-solid fa-angle-left"></i>

                    <section class="carousel">
                    <?php
                        $sqlSel = "SELECT * FROM Estabelecimento WHERE autorizado = 'Não autorizado'";
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
                                        <form action="estSelecionadoAdmin.php" method="POST">
                    <?php                  
                                                echo('<input type="number" name="id" id="id" value="'.$cont["id"].'">');
                    ?>
                                                <input type="submit" value="Enviar" name="enviar" id="enviar">
                                            </form>
                                        </section>
                    <?php
                                        echo('<img class="card-img-top" src="/TechWay/img/estabelecimento/est'.$cont["id"].'/'.$img["logo"].'" alt="Imagem estabelecimento '.$cont["nome_estabelecimento"].'" draggable="false">');
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
                            echo('<h5 class="ms-5"> Nenhum estabelecimento encontrado. </h2>');
                        }
                        
                    ?>
                    </section>
                    <i id="right" class="fa-solid fa-angle-right"></i>
                </section>
            </section>

            <section class="container pt-5">
                <h4> Autorizados </h4>
                <section class="wrapper est">
                    <i id="left" class="fa-solid fa-angle-left"></i>

                    <section class="carousel">
                    <?php
                        $sqlSel = "SELECT * FROM Estabelecimento WHERE autorizado = 'Autorizado'";
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
                                        <form action="estSelecionadoAdmin.php" method="POST">
                    <?php                  
                                                echo('<input type="number" name="id" id="id" value="'.$cont["id"].'">');
                    ?>
                                                <input type="submit" value="Enviar" name="enviar" id="enviar">
                                            </form>
                                        </section>
                    <?php
                                        echo('<img class="card-img-top" src="/TechWay/img/estabelecimento/est'.$cont["id"].'/'.$img["logo"].'" alt="Imagem estabelecimento '.$cont["nome_estabelecimento"].'" draggable="false">');
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
                            echo('<h5 class="ms-5"> Nenhum estabelecimento encontrado. </h2>');
                        }
                        
                    ?>
                    </section>
                    <i id="right" class="fa-solid fa-angle-right"></i>
                </section>
            </section>
        </section>
    </main>
<?php
    require_once('footerAdmin.php');
?>
        <script src="/TechWay/js/carousel.js" defer></script>
        <script src="/TechWay/js/cardsEstab.js" defer></script>
    </body>
</html>
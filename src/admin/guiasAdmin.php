<?php
    require_once('headerAdmin.php');
    require_once('headerResponsivoAdmin.php');
?>
    <main class="container">
        <section class="d-flex flex-column align-items-center pt-3">
            <h2> Guias e Monitores </h2>

            <section class="container">
                <h4> Em análise </h4>

                <section class="wrapper mon">
                    <i id="left" class="fa-solid fa-angle-left"></i>

                    <section class="carousel">
                    <?php
                        $sqlSel = "SELECT * FROM Monitor WHERE autorizado = 'Em análise'";
                        $resul = mysqli_query($conexao, $sqlSel);
                        $numLinhas = mysqli_num_rows($resul);
                        if($numLinhas > 0){
                            while($cont = mysqli_fetch_array($resul)){
                                $sqlSelFt = "SELECT * FROM Fotos_Monitor WHERE id_monitor =". $cont["id"];
                                $resul1 = mysqli_query($conexao, $sqlSelFt);
                                $img = mysqli_fetch_array($resul1);
                    ?>
                                    <section class="card">
                                        <section class="id">
                                            <form action="guiasSelecionadoAdmin.php" method="POST">
                    <?php                  
                                                echo('<input type="number" name="id" id="id" value="'.$cont["id"].'">');
                    ?>
                                                <input type="submit" value="Enviar" name="enviar" id="enviar">
                                            </form>
                                        </section>
                    <?php
                                        echo('<img class="card-img-top" src="/Techway/img/monitor/mon'.$cont["id"].'/'.$img["foto_perfil"].'" alt="Imagem estabelecimento '.$cont["nome"].'" draggable="false">');
                    ?>
                                        <section class="card-body d-flex justify-content-center align-items-center">
                                            <h2 class="card-title"> <?php echo($cont["nome"]); ?></h2>
                                        </section>
                                        <section class="card-footer d-flex align-items-center justify-content-center gap-2">
                                            <img src="/TechWay/img/icones/iconesLink/telefoneImg.png" class="icones" alt="Icone de telefone"> 
                                            <p class="m-0"> <small> Telefone para contato: <?php echo($cont["telefone"]); ?> </small></p>
                                        </section>
                                    </section>
                                    <?php
                            }
                        }else{
                            echo('<h5 class="ms-5"> Nenhum guia ou monitor encontrado. </h5>');
                        }
                    ?>
                    </section>
                    <i id="right" class="fa-solid fa-angle-right"></i>
                </section>
            </section>

            <section class="container pt-5">
                <h4> Não autorizados </h4>

                <section class="wrapper mon">
                    <i id="left" class="fa-solid fa-angle-left"></i>

                    <section class="carousel">
                    <?php
                        $sqlSel = "SELECT * FROM Monitor WHERE autorizado = 'Não autorizado'";
                        $resul = mysqli_query($conexao, $sqlSel);
                        $numLinhas = mysqli_num_rows($resul);
                        if($numLinhas > 0){
                            while($cont = mysqli_fetch_array($resul)){
                                $sqlSelFt = "SELECT * FROM Fotos_Monitor WHERE id_monitor =". $cont["id"];
                                $resul1 = mysqli_query($conexao, $sqlSelFt);
                                $img = mysqli_fetch_array($resul1);
                    ?>
                                    <section class="card">
                                        <section class="id">
                                            <form action="guiasSelecionadoAdmin.php" method="POST">
                    <?php                  
                                                echo('<input type="number" name="id" id="id" value="'.$cont["id"].'">');
                    ?>
                                                <input type="submit" value="Enviar" name="enviar" id="enviar">
                                            </form>
                                        </section>
                    <?php
                                        echo('<img class="card-img-top" src="/Techway/img/monitor/mon'.$cont["id"].'/'.$img["foto_perfil"].'" alt="Imagem estabelecimento '.$cont["nome"].'" draggable="false">');
                    ?>
                                        <section class="card-body d-flex justify-content-center align-items-center">
                                            <h2 class="card-title"> <?php echo($cont["nome"]); ?></h2>
                                        </section>
                                        <section class="card-footer d-flex align-items-center justify-content-center gap-2">
                                            <img src="/TechWay/img/icones/iconesLink/telefoneImg.png" class="icones" alt="Icone de telefone"> 
                                            <p class="m-0"> <small> Telefone para contato: <?php echo($cont["telefone"]); ?> </small></p>
                                        </section>
                                    </section>
                                    <?php
                            }
                        }else{
                            echo('<h5 class="ms-5"> Nenhum guia ou monitor encontrado. </h5>');
                        }
                    ?>
                    </section>
                    <i id="right" class="fa-solid fa-angle-right"></i>
                </section>
            </section>  

            <section class="container pt-5">
                <h4> Autorizados </h4>

                <section class="wrapper mon">
                    <i id="left" class="fa-solid fa-angle-left"></i>

                    <section class="carousel">
                    <?php
                        $sqlSel = "SELECT * FROM Monitor WHERE autorizado = 'Autorizado'";
                        $resul = mysqli_query($conexao, $sqlSel);
                        $numLinhas = mysqli_num_rows($resul);
                        if($numLinhas > 0){
                            while($cont = mysqli_fetch_array($resul)){
                                $sqlSelFt = "SELECT * FROM Fotos_Monitor WHERE id_monitor =". $cont["id"];
                                $resul1 = mysqli_query($conexao, $sqlSelFt);
                                $img = mysqli_fetch_array($resul1);
                    ?>
                                    <section class="card">
                                        <section class="id">
                                            <form action="guiasSelecionadoAdmin.php" method="POST">
                    <?php                  
                                                echo('<input type="number" name="id" id="id" value="'.$cont["id"].'">');
                    ?>
                                                <input type="submit" value="Enviar" name="enviar" id="enviar">
                                            </form>
                                        </section>
                    <?php
                                        echo('<img class="card-img-top" src="/Techway/img/monitor/mon'.$cont["id"].'/'.$img["foto_perfil"].'" alt="Imagem estabelecimento '.$cont["nome"].'" draggable="false">');
                    ?>
                                        <section class="card-body d-flex justify-content-center align-items-center">
                                            <h2 class="card-title"> <?php echo($cont["nome"]); ?></h2>
                                        </section>
                                        <section class="card-footer d-flex align-items-center justify-content-center gap-2">
                                            <img src="/TechWay/img/icones/iconesLink/telefoneImg.png" class="icones" alt="Icone de telefone"> 
                                            <p class="m-0"> <small> Telefone para contato: <?php echo($cont["telefone"]); ?> </small></p>
                                        </section>
                                    </section>
                                    <?php
                            }
                        }else{
                            echo('<h5 class="ms-5"> Nenhum guia ou monitor encontrado. </h5>');
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
         <script src="/TechWay/js/cardsGuiMon.js" defer></script>
    </body>
</html>
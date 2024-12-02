<?php
            require_once('./header.php');
            require_once('./headerResponsivo.php');
        ?>

        <main>
            <section class="container" id="guiasMonitores">

                <section class="container d-flex justify-content-center pt-4">
                    <h2> Guias </h2>
                </section>

                <section class="wrapper mon">
                    <i id="left" class="fa-solid fa-angle-left"></i>

                    <section class="carousel">
                    <?php
                        $sqlSel = "SELECT * FROM Monitor WHERE id_tipo = 2 && autorizado = 'autorizado'";
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
                                            <form action="./moniSelecionado.php" method="POST">
                    <?php                  
                                                echo('<input type="number" name="id" id="id" value="'.$cont["id"].'">');
                    ?>
                                                <input type="submit" value="Enviar" name="enviar" id="enviar">
                                            </form>
                                        </section>
                    <?php
                                        echo('<img class="card-img-top" src="../img/monitor/mon'.$cont["id"].'/'.$img["foto_perfil"].'" alt="Imagem estabelecimento '.$cont["nome"].'" draggable="false">');
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
                            echo('<h5 class="ms-5"> Erro: nenhum guia encontrado. </h5>');
                        }
                    ?>
                    </section>
                    <i id="right" class="fa-solid fa-angle-right"></i>
                </section>

                <section class="container d-flex justify-content-center pt-4">
                    <h2> Monitores </h2>
                </section>

                <section class="wrapper mon">
                    <i id="left" class="fa-solid fa-angle-left"></i>

                    <section class="carousel">
                    <?php
                        $sqlSel = "SELECT * FROM Monitor WHERE id_tipo = 1 && autorizado = 'autorizado'";
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
                                            <form action="./moniSelecionado.php" method="POST">
                    <?php                  
                                                echo('<input type="number" name="id" id="id" value="'.$cont["id"].'">');
                    ?>
                                                <input type="submit" value="Enviar" name="enviar" id="enviar">
                                            </form>
                                        </section>
                    <?php
                                        echo('<img class="card-img-top" src="../img/monitor/mon'.$cont["id"].'/'.$img["foto_perfil"].'" alt="Imagem estabelecimento '.$cont["nome"].'" draggable="false">');
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
                            echo('<h5 class="ms-5"> Erro: nenhum monitor encontrado. </h5>');
                        }
                    ?>
                    </section>
                    <i id="right" class="fa-solid fa-angle-right"></i>
                </section>

                <section class="container d-flex justify-content-center pt-4">
                    <h2> Guias e Monitores </h2>
                </section>

                <section class="wrapper mon">
                    <i id="left" class="fa-solid fa-angle-left"></i>

                    <section class="carousel">
                    <?php
                        $sqlSel = "SELECT * FROM Monitor WHERE id_tipo = 3 && autorizado = 'autorizado'";
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
                                            <form action="./moniSelecionado.php" method="POST">
                    <?php                  
                                                echo('<input type="number" name="id" id="id" value="'.$cont["id"].'">');
                    ?>
                                                <input type="submit" value="Enviar" name="enviar" id="enviar">
                                            </form>
                                        </section>
                    <?php
                                        echo('<img class="card-img-top" src="../img/monitor/mon'.$cont["id"].'/'.$img["foto_perfil"].'" alt="Imagem estabelecimento '.$cont["nome"].'" draggable="false">');
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
                            echo('<h5 class="ms-5"> Erro: nenhum guia e monitor encontrado. </h5>');
                        }
                    ?>
                    </section>
                    <i id="right" class="fa-solid fa-angle-right"></i>
                </section>

            </section>
        </main>
        <?php
                require_once('./footer.php');
        ?>
        <script src="/TechWay/js/carousel.js" defer></script>
        <script src="/TechWay/js/cardsGuiMon.js" defer></script>
    </body>
</html>
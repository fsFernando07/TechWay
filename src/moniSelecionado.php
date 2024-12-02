<?php
            require_once('./header.php');
            require_once('./headerResponsivo.php');
        ?>
        <main class="container">
            <ul class="nav pt-3">
                <li class="nav-item">
                    <a class="nav-link p-0" href="./guias.php"> <i class="fa-solid fa-arrow-left"></i> Voltar aos perfis </a>
                </li>
            </ul>
          <?php
            if(isset($_POST["enviar"])){
                $id = $_POST["id"];

                $sqlSel = "SELECT * FROM Monitor WHERE id =". $id;
                $resul = mysqli_query($conexao, $sqlSel);
                $numLinhas = mysqli_num_rows($resul);

                if($numLinhas > 0){
                    while($cont = mysqli_fetch_array($resul)){
                        $sqlSelFt = "SELECT * FROM Fotos_Monitor WHERE id_monitor =". $cont["id"];
                        $resul1 = mysqli_query($conexao, $sqlSelFt);
                        $img = mysqli_fetch_array($resul1);
            ?>
                <section class="card border-0">
                    <section class="card-body row d-flex">
                        <section class="col-md-auto">
            <?php
                        echo('<img class="estab" src="../img/monitor/mon'. $cont["id"] .'/'.$img["foto_perfil"].'" alt="Imagem monitor '.$cont["nome"].'" draggable="false">');
           ?>
                        </section>
                        <section class="col d-flex flex-column justify-content-center">
                            <span class="d-none" id="d-none">
                                <?php echo($cont["telefone"]);?>
                            </span>

                            <h2> <?php echo($cont["nome"]);?> </h2>

                            <section class="row">
                                <section class="col-4">
                                    <h5> Area de atuação </h5>
                                    <p> <?php echo($cont["areas_especializacao"]); ?></p>
                                </section>
    
                                <section class="col-5">
                                    <h5> Gênero </h5>
                                    <p> <?php echo($cont["genero"]); ?></p>
                                </section>
    
                                <section class="col-3">
                                    <h5> Idioma secundário </h5>
                                    <p> <?php echo($cont["idiomas"]);?></p>
                                </section>
                            </section>
                            <section class="row pt-2">
                                <section class="col-9">
                                    <h5> Descrição </h5>
                                    <p> <?php echo($cont["descricao"]); ?></p>
                                </section>
                                <?php
                                    if($cont["facebook"] != "" || $cont["instagram"] != "" || $cont["tiktok"] != ""){
                                        echo('<section class="col-md-auto">');
                                        echo("<h5> Redes Sociais </h5>");
                                        echo('<section class="d-flex justify-content-sm-between">');
                                ?>
                                        <a class="linkImg" target="blank" title="Whatsapp" aria-label="Whatsapp" id="whatsapp">
                                            <img src="/TechWay/img/icones/iconesLink/whatsappImg.png" class="iconeRedesSociais" alt="Icone do Whatsapp"> 
                                        </a>
                                <?php
                                        if($cont["facebook"] != ""){
                                ?>
                                            <a href="<?php echo($cont["facebook"]);?>" class="linkImg" target="blank" title="Facebook" aria-label="Facebook">
                                                <img src="/TechWay/img/icones/iconesLink/facebookImg.png" class="iconeRedesSociais" alt="Icone do Facebook"> 
                                            </a>
                                <?php
                                        }

                                        if($cont["instagram"] != ""){
                                ?>
                                            <a href="<?php echo($cont["instagram"]);?>" class="linkImg"target="blank" title="Instagram" aria-label="Instagram">
                                                <img src="/TechWay/img/icones/iconesLink/instagramImg.png" class="iconeRedesSociais" alt="Icone do Instagram"> 
                                            </a>
                                <?php
                                        }

                                        if($cont["tiktok"] != ""){
                                ?>
                                            <a href="<?php echo($cont["tiktok"]);?>" class="linkImg" target="blank" title="Tiktok" aria-label="Tiktok">
                                                <img src="/TechWay/img/icones/iconesLink/tiktokImg.png" class="iconeRedesSociais" alt="Icone do Tiktok"> 
                                            </a>
                                <?php
                                        }
                                        echo("</section>");
                                        echo("</section>");
                                    }
                                ?>
                            </section>

                            <script>
                                var telefone = document.querySelector("#d-none").innerText;
                                var Whatsapp = document.querySelector("#whatsapp");

                                let tel =  telefone.replace(/[^0-9]/g, '');

                                Whatsapp.href = `https://wa.me/55${tel}`;
                            </script> 
                        </section>
                    </section>
                    <section class="wrapper">
                        <i id="left" class="fa-solid fa-angle-left"></i>
                        <section class="carousel cards-img">
                            <?php
                                for($i = 1; $i < 5; $i++){
                                    if($img["foto_".$i] != ""){
                                        echo('<section class="card">');
                                        echo('<img class="img-fluid d-block" src="../img/monitor/mon'. $cont["id"] .'/'.$img["foto_".$i].'" alt="Imagem monitor '.$cont["nome"].'" draggable="false">');
                                        echo('</section>');
                                    }
                                }
                            ?>
                        </section>
                        <i id="right" class="fa-solid fa-angle-right"></i>
                    </section>
                    <?php
                        $sqlSel = "SELECT * FROM Monitor WHERE id_tipo =".$cont['id_tipo']." && id !=".$cont["id"]." && autorizado = true";
                        $resul = mysqli_query($conexao, $sqlSel);
                        $numLinhas = mysqli_num_rows($resul);
                        if($numLinhas > 0){
                    ?>
                    <section class="container mt-5">
                        <h3> Outros </h3>
                    </section>
                    <section id="guiasMonitores">

                        <section class="wrapper mon">
                            <i id="left" class="fa-solid fa-angle-left"></i>
    
                            <section class="carousel">
                            
                    <?php
                            while($cont = mysqli_fetch_array($resul)){
                                $sqlSelFt = "SELECT * FROM Fotos_Monitor WHERE id_monitor =". $cont["id"];
                                $resul1 = mysqli_query($conexao, $sqlSelFt);
                                $img = mysqli_fetch_array($resul1);
                    ?>
                                    <section class="card">
                                        <section class="id">
                                            <form action="#" method="POST">
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
                    ?>
                    
                            </section>
                            <i id="right" class="fa-solid fa-angle-right"></i>
                        </section>
                    </section>
                    <?php
                        }
                    ?>
            <?php
                    }
                }
            }
            ?>
        </main>
        
        <?php
            require_once('./footer.php');
        ?>
        <script src="/TechWay/js/carousel.js" defer></script>
        <script src="/TechWay/js/cardsGuiMon.js" defer></script>
    </body>
</html>
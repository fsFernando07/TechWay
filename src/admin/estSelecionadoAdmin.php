<?php
            require_once('headerAdmin.php');
            require_once('headerResponsivoAdmin.php');

            if(isset($_POST["autorizar"])){
                $id = $_POST["id"];
                $sqlUp = 'UPDATE Estabelecimento SET autorizado = "Autorizado" WHERE id ='.$id;
                $resulUp = mysqli_query($conexao, $sqlUp);
                if($resulUp){
                    echo('<script> window.location.href = "estabelecimentosAdmin.php"; </script>');
                }
            }

            if(isset($_POST["naoAutorizar"])){
                $id = $_POST["id"];
                $sqlUp = 'UPDATE Estabelecimento SET autorizado = "Não autorizado" WHERE id ='.$id;
                $resulUp = mysqli_query($conexao, $sqlUp);
                if($resulUp){
                    echo('<script> window.location.href = "estabelecimentosAdmin.php"; </script>');
                }
            }
        ?>
        <main class="container">
            <ul class="nav pt-3">
                <li class="nav-item">
                    <a class="nav-link p-0" href="estabelecimentosAdmin.php"> <i class="fa-solid fa-arrow-left"></i> Voltar à Home </a>
                </li>
            </ul>
          <?php
            if(isset($_POST["enviar"])){
                $id = $_POST["id"];

                $sqlSel = "SELECT * FROM Estabelecimento WHERE id =". $id;
                $resul = mysqli_query($conexao, $sqlSel);
                $numLinhas = mysqli_num_rows($resul);

                if($numLinhas > 0){
                    while($cont = mysqli_fetch_array($resul)){
                        $sqlSelFt = "SELECT * FROM Fotos_Estabelecimento WHERE id_estabelecimento =". $cont["id"];
                        $resul1 = mysqli_query($conexao, $sqlSelFt);
                        $img = mysqli_fetch_array($resul1);
            ?>
                <section class="card border-0">
                    <section class="card-body row d-flex">
                        <section class="col-md-auto">
            <?php
                        echo('<img class="estab" src="/Techway/img/estabelecimento/est'. $cont["id"] .'/'.$img["logo"].'" alt="Imagem estabelecimento '.$cont["nome_estabelecimento"].'" draggable="false">');
           ?>
                        </section>
                        <section class="col d-flex flex-column justify-content-center">
                            <h2> <?php echo($cont["nome_estabelecimento"]);?> </h2>
                            <section class="row">
                                <section class="col">
                                    <h5> CNPJ </h5>
                                    <p> <?php echo($cont["cnpj"]); ?></p>
                                </section>
    
                                <section class="col">
                                    <h5> Endereço </h5>
                                    <p> <?php echo($cont["bairro"]." ".$cont["tipo_logradouro"]." ".$cont["logradouro"]." nº".$cont["numero"]); ?></p>
                                </section>

                                <section class="col">
                                    <h5> Horário de funcionamento </h5>
                                    <p> <?php echo($cont["horario"]); ?></p>
                                </section>
    
                            </section>
                            <section class="row">
                                <section class="col-8">
                                    <h5> Descrição </h5>
                                    <p> <?php echo($cont["descricao"]); ?></p>
                                </section>
                                <section class="col-md-auto">
                                    <h5> Contato </h5>
                                    <p> <?php echo($cont["emailCom"]); ?></p>
                                </section>
                                <?php
                                    if($cont["facebook"] != "" || $cont["instagram"] != "" || $cont["tiktok"] != ""){
                                        echo('<section class="col-md-auto">');
                                        echo("<h5> Redes Sociais </h5>");
                                        echo('<section class="d-flex justify-content-sm-between">');
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
                            
                        </section>
                    </section>
                    <section class="wrapper">
                        <i id="left" class="fa-solid fa-angle-left"></i>
                        <section class="carousel cards-img">
                            <?php
                                for($i = 1; $i < 10; $i++){
                                    if($img["foto_".$i] != ""){
                                        echo('<section class="card">');
                                        echo('<img class="img-fluid d-block" src="/Techway/img/estabelecimento/est'. $cont["id"] .'/'.$img["foto_".$i].'" alt="Imagem estabelecimento '.$cont["nome_estabelecimento"].'" draggable="false">');
                                        echo('</section>');
                                    }
                                }
                            ?>
                        </section>
                        <i id="right" class="fa-solid fa-angle-right"></i>
                    </section>
                    <section class="footer-login alt d-flex justify-content-center mb-2 gap-2">
                        <form action="#" method="POST">
                            <input type="hidden" name="id" value="<?php echo($id);?>">
                            <?php
                                if($cont["autorizado"] != "Autorizado"){
                            ?>
                                    <button type="submit" class="button" name="autorizar" value="Autorizar">
                                        Autorizar
                                    </button>
                            <?php
                                }

                                if($cont["autorizado"] != "Não autorizado"){
                            ?>
                                    <button type="submit" class="button" name="naoAutorizar" value="Não autorizar">
                                        Não autorizar
                                    </button>

                            <?php
                                }
                            ?>
                            
                        </form>
                    </section>
            <?php
                    }
                }
            }
            ?>
        </main>
        
        <?php
            require_once('footerAdmin.php');
        ?>
        <script src="/TechWay/js/carousel.js" defer></script>
    </body>
</html>
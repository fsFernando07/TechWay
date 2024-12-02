<?php
            require_once('./header.php');
            require_once('./headerResponsivo.php');
        ?>
        <main class="container">
            <ul class="nav pt-3">
                <li class="nav-item">
                    <a class="nav-link p-0" href="../index.php"> <i class="fa-solid fa-arrow-left"></i> Voltar à Home</a>
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
                <section class="card border-0 pt-3">
                    <section class="card-body row d-flex">
                        <section class="col-md-auto">
            <?php
                        echo('<img class="estab" src="../img/estabelecimento/est'. $cont["id"] .'/'.$img["logo"].'" alt="Imagem estabelecimento '.$cont["nome_estabelecimento"].'" draggable="false">');
           ?>
                        </section>
                        <section class="col d-flex flex-column justify-content-center">
                            <span class="d-none" id="d-none">
                                <?php echo($cont["telefone"]);?>
                            </span>

                            <h2> <?php echo($cont["nome_estabelecimento"]);?> </h2>


                            <section class="row">
                                          
                                <section class="col-4">
                                    <h5> Endereço </h5>
                                    <p> <?php echo($cont["bairro"]." ".$cont["tipo_logradouro"]." ".$cont["logradouro"]." nº".$cont["numero"]); ?></p>
                                </section>

                                <section class="col-5">
                                    <h5> Horários de funcionamento </h5>
                                    <p> <?php echo($cont["horario"]); ?></p>
                                </section>
    
                                <section class="col-3">
                                    <h5> Contato </h5>
                                    <section class="d-flex flex-row gap-5 align-items-center">
                                        <p class="m-0"> <?php echo($cont["emailCom"]); ?></p>
                                    </section>
                                </section>
                            </section>

                            <section class="row pt-2">
                                <section class="col-9">
                                    <h5> Descrição </h5>
                                    <p> <?php echo($cont["descricao"]); ?></p>
                                </section>
                                
                                <?php
                                    echo('<section class="col-md-auto">');
                                    echo("<h5> Redes Sociais </h5>");
                                    echo('<section class="d-flex justify-content-sm-between">');
                                ?>
                                    <a class="linkImg" target="blank" title="Whatsapp" aria-label="Whatsapp" id="whatsapp">
                                        <img src="/TechWay/img/icones/iconesLink/whatsappImg.png" class="iconeRedesSociais" alt="Icone do Whatsapp"> 
                                    </a>
                                <?php
                                    if($cont["facebook"] != "" || $cont["instagram"] != "" || $cont["tiktok"] != ""){
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
                                    }
                                    echo("</section>");
                                    echo("</section>");
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
                                for($i = 1; $i < 10; $i++){
                                    if($img["foto_".$i] != ""){
                                        echo('<section class="card">');
                                        echo('<img class="img-fluid d-block" src="../img/estabelecimento/est'. $cont["id"] .'/'.$img["foto_".$i].'" alt="Imagem estabelecimento '.$cont["nome_estabelecimento"].'" draggable="false">');
                                        echo('</section>');
                                    }
                                }
                            ?>
                        </section>
                        <i id="right" class="fa-solid fa-angle-right"></i>
                    </section>

                    
                    <?php
                        $sqlSel = "SELECT * FROM Estabelecimento WHERE id_categoria =". $cont["id_categoria"] ." && id !=". $cont["id"];
                        $resul = mysqli_query($conexao, $sqlSel);
                        $numLinhas = mysqli_num_rows($resul);
                        if($numLinhas > 0){
                    ?>
                    <section class="container mt-5">
                        <h3> Outros </h3>
                    </section>
                    <section id="explorar">
                        <section class="wrapper est">
                            <i id="left" class="fa-solid fa-angle-left"></i>
                            
                            <section class="carousel">
                    <?php
                            while($cont = mysqli_fetch_array($resul)){
                                $sqlSelFt = "SELECT * FROM Fotos_Estabelecimento WHERE id_estabelecimento =". $cont["id"];
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
                                        echo('<img class="card-img-top" src="../img/estabelecimento/est'. $cont["id"] .'/'.$img["logo"].'" alt="Imagem estabelecimento '.$cont["nome_estabelecimento"].'" draggable="false">');
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
        <script src="/TechWay/js/cardsEstab.js" defer></script>
    </body>
</html>
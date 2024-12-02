<?php
            require_once('./header.php');
            if(isset($_SESSION["id"])){
                header('location: ../index.php');
            }
?>
    <script src="/TechWay/js/formSucErr.js"></script>
<?php
    $chave = $_GET["chave"];
    $tabela = $_GET["tabela"];
    $error = array();
    $totalerro = "";

    if($tabela == 'Usuario' || $tabela == 'Estabelecimento' || $tabela == 'Monitor'){
    
        $sql = 'SELECT * FROM '.$tabela.' WHERE recuperar_senha ="'.$chave.'";';
        $resul = mysqli_query($conexao, $sql);
        $contr = mysqli_fetch_array($resul);
        $numLinhas = mysqli_num_rows($resul);
    
        if($numLinhas == 0){
            $error[0] = "Link inválido";
            echo('<script>
                    setTimeout(function(){
                        window.location.href = "login.php";
                    }, 3000);
                </script>');
        }else{
            if(isset($_POST["alterarSenhaSub"])){
                $senhaAlt = $_POST["senhaAlt"];

                if($senhaAlt == ''){
                    $error[1] = "A nova senha não pode ser vazia.";
                }

                if(strlen($senhaAlt) < 6){
                    $error[2] = "A nova senha deve conter no mínimo 6 caracteres.";
                }

                if(count($error) == 0){
                    $senhaCrip = password_hash($senhaAlt,PASSWORD_DEFAULT);

                    $sqlUp = 'UPDATE '.$tabela.' SET senha = "'.$senhaCrip.'", recuperar_senha = "NULL" WHERE id ='.$contr["id"];
                    $resulUp = mysqli_query($conexao, $sqlUp);

                    if($resulUp){
                        $certCon = 1;
                        echo('<script>
                                setTimeout(function(){
                                    window.location.href = "login.php";
                                }, 3000);
                            </script>');
                    }
                }
            }
        }
    
    }else{
        $error[3] = "Link inválido";
        echo('<script>
            setTimeout(function(){
                window.location.href = "login.php";
            }, 3000);
        </script>');
    }

    if (count($error) != 0) {
        $erroCon = 1;
        for($i = 0; $i <= 3; $i++) {
            if (!empty($error[$i])){
                $totalerro .= '<p class="erroLog"> <img src="/TechWay/img/icones/iconesLink/erroImg.png" class="icones me-2" alt="Icone de certo no cadastro">'. $error[$i] .'</p>';
            }
        }
    }
?>
        <script src="https://accounts.google.com/gsi/client" async></script>
        <main class="container d-flex align-items-center">
            <section class="container tab-content d-block">
                
                <section class="tab-pane active" id="alterarSenha">
                
                    <section class="login">
                        <ul class="nav pt-3">
                            <li class="nav-item">
                                <a class="nav-link p-0" href="login.php"> <i class="fa-solid fa-arrow-left"></i> Voltar ao login </a>
                            </li>
                        </ul>

                        <section class="d-flex flex-column align-items-center pt-3 pb-3">
                            <h3> Alterar a senha! </h3>
                        </section>
                        <section class="form-loginEmail alt">
                            
                            <form action="#" method="POST">
                                
                                <section class="page">                                
    
                                    <section class="field">
                                        <label for="senhaAlt"> Nova Senha </label>
                                        <input type="password" name="senhaAlt" id="senhaAlt" placeholder="Digite a sua nova senha">
                                        <span class="erro"> A nova senha não pode ser vazia. </span>
                                        <span class="erro"> A nova senha deve conter no mínimo 6 caracteres. </span>
                                    </section>
    
                                    
                                    <section class="field btns">
                                        <section class="button submit"> Alterar a senha </section>
                                        <input type="submit" name="alterarSenhaSub" id="alterarSenhaSub" value="Alterar" class="d-none">
                                    </section>
                                    
                                </section>
                
                            </form>
                            
                        </section>
                    </section>
                    
                </section>

            </section>

            <section class="modalLogin modal fade" id="envioCerto" tabindex="-1" aria-hidden="true">
                <section class="modal-dialog modal-dialog-centered" role="document">
                    <section class="modal-content">
                        <section class="modal-header d-flex align-items-center">
                            <span></span>
                            <img src="/TechWay/img/icones/iconesLink/certoImg.png" class="iconCerErr" alt="Icone de certo no cadastro">
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span class="icones" aria-hidden="true"> &times;</span>
                            </button>
                        </section>
                        <section class="modal-body">
                           <p> A senha foi alterada com sucesso! </p>
                        </section>
                    </section>
                </section>
            </section>


            <section class="modalLogin modal fade" id="envioErro" tabindex="-1" aria-hidden="true">
                <section class="modal-dialog modal-dialog-centered" role="document">
                    <section class="modal-content">
                        <section class="modal-header d-flex align-items-center">
                            <span></span>
                            <img src="/TechWay/img/icones/iconesLink/erroImg.png" class="iconCerErr" alt="Icone de erro no cadastro">
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span class="icones" aria-hidden="true"> &times;</span>
                            </button>
                        </section>
                        <section class="modal-body">
                           <?php
                                echo($totalerro);
                           ?>
                        </section>
                    </section>
                </section>
            </section>

            
            <button class="botaoHamburguer navbar-toggler d-none" type="button" id="btnCerto" data-bs-toggle="modal" data-bs-target="#envioCerto">
                <p> a </p>
            </button>


            <button class="botaoHamburguer navbar-toggler d-none" type="button" id="btnErro" data-bs-toggle="modal" data-bs-target="#envioErro">
                <p> a</p>
            </button>
            
        </main>
        <?php
                require_once('./footer.php');

                if(isset($erroCon)){
                    echo('<script> erroLogin();</script>');
                }

                if(isset($certCon)){
                    echo('<script> certoLogin(); </script>');
                }

        ?>
        <script src="/TechWay/js/formAtuSenha.js" defer></script>
    </body>
</html>
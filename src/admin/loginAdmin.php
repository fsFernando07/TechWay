<!DOCTYPE html>
<html lang="pt-br" >
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> TechWay </title>
        <link rel="shortcut icon" type="imagex/png" href="/TechWay/img/icones/logo/logoIconeHead.ico">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="/TechWay/css/darkmode.css">
        <link rel="stylesheet" href="/TechWay/css/body.css">
        <link rel="stylesheet" href="/TechWay/css/header.css">
        <link rel="stylesheet" href="/TechWay/css/main.css">
        <link rel="stylesheet" href="/TechWay/css/footer.css">
        <link rel="stylesheet" href="/TechWay/css/responsivo.css">
        <link rel="stylesheet" href="/TechWay/css/form.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/jwt-decode@3.1.2/build/jwt-decode.min.js" async></script>
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
        <script src="https://website-widgets.pages.dev/dist/sienna.min.js" defer></script>
        <script src="/TechWay/js/formSucErr.js"></script>
        <script src="/TechWay/js/darkmode.js" defer></script>
    </head>
    <body class="temaclaro">
        <header id="headerPrincipal" class="headerPrincipal pt-3 pb-3">
            <section class="row d-flex align-items-center">

                <section class="col d-flex justify-content-start">
                    <img src="/TechWay/img/icones/logo/logoExtensoBranco.png" class="logo" alt="Icone da Logo TechWay">
                </section>

                <section class="col d-flex justify-content-end">
                    <input type="checkbox" name="check" id="check" class="checkbox">    
                    <label class="labelCheck" for="check">
                        <img src="/TechWay/img/icones/iconesLink/luaImg.png" id="lua" class="icones" alt="Icone da Lua">
                        <img src="/TechWay/img/icones/iconesLink/solImg.png" class="icones" alt="Icone da Sol">


                        <section class="ball"></section>
                    </label>
                </section>
            </section>
        </header>
        <section class="headerResponsivo pt-3 pb-3">

            <section class="container d-flex">
                <section class="col d-flex align-items-center justify-content-center">
                    <img src="/TechWay/img/icones/logo/logoExtensoBranco.png" class="logo" alt="Icone da Logo TechWay">
                </section>
            </section>
        </section>

        <?php
            session_start();
            require_once("../conexao.php");
            if(!isset($_POST["loginUsu"])){
                $emailUsu = "";
                $senhaUsu = "";
            }

            if(isset($_POST["loginUsu"])){
                $emailUsu = $_POST["emailUsu"];
                $senhaUsu = $_POST["senhaUsu"];

                $sqlSel = 'SELECT * FROM Admin WHERE email ="'. $emailUsu .'";';
                $resul = mysqli_query($conexao, $sqlSel);
                $numLinhas = mysqli_num_rows($resul);

                $error = array();

                if($numLinhas > 0){
                    while($contr = mysqli_fetch_array($resul)){
                        if(password_verify($senhaUsu , $contr['senha'])){
                            $_SESSION['id_admin'] = $contr['id'];
                            $_SESSION['tipo'] = 'Admin';
                            header('location: homeAdmin.php');
                        }
                    }
                    $error[0] = "A senha está incorreta.";
                }else{
                    $error[1] = "Não existe um admin com este email.";
                }

                $totalerro = "";

                if (count($error) != 0) {
                    $erroCon = 1;
                    for($i = 0; $i <= 2; $i++) {
                        if (!empty($error[$i])){
                            $totalerro .= '<p class="erroLog"> <img src="/TechWay/img/icones/iconesLink/erroImg.png" class="icones me-2" alt="Icone de certo no cadastro">'. $error[$i] .'</p>';
                        }
                    }
                }

            }
        ?>
        <main class="container d-flex align-items-center">
            <section class="container tab-content d-block">
                <section class="tab-pane active" id="loginAdmin">
                        
                    <section class="login">
                        <section class="d-flex flex-column align-items-center pt-3 pb-3">
                            <h3> Entre como Admin! </h3>
                        </section>
                        <section class="form-loginEmail login">
                            
                            <form action="#" method="POST">
                                
                                <section class="page">
                                    <section class="title"> 
                                        <h5> Informações de login admin </h5> 
                                    </section>
                                    
                                    <section class="field">
                                        <label for="emailUsu"> E-mail </label>
                                        <input type="email" name="emailUsu" id="emailUsu" placeholder="Digite o e-mail de login" value="<?php echo($emailUsu);?>">
                                        <span class="erro"> O e-mail não pode ser vazio. </span>
                                        <span class="erro"> O e-mail é inválido. </span>
                                    </section>
                                    
                                    <section class="field">
                                        <label for="senhaUsu"> Senha </label>
                                        <input type="password" name="senhaUsu" id="senhaUsu" placeholder="Digite a senha de login">
                                        <span class="erro"> A senha não pode ser vazia. </span>
                                    </section>
                                    
                                    <section class="field btns">
                                        <section class="button submit"> Fazer login </section>
                                        <input type="submit" name="loginUsu" id="loginUsu" value="Login" class="d-none">
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
                           <p> Você foi cadastrado com sucesso! </p>
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
        <footer class="footer">
            <section class="container d-flex justify-content-sm-between align-items-center">

                <img src="/TechWay/img/icones/logo/logoArredondadaBranco.png" class="logoArredondada" alt="Icone da Logo TechWay">

                <section class="d-flex flex-column align-items-center">
                    <p class="mb-0"> &copy; 2024 TechWay - Todos os direitos reservados. </p>
                    
                </section>

                <a href="https://www.instagram.com/techwaytcc/profilecard/?igsh=cmhxcXBnc2RmaHy4" target="blank" title="Instagram" aria-label="Instagram">
                    <img src="/TechWay/img/icones/iconesLink/instagramImg.png" class="iconeRedesSociais fixo" alt="Icone do Instagram"> 
                </a>

            </section>
        </footer>
        <?php

                if(isset($erroCon)){
                    echo('<script> erroLogin(); </script>');
                }

                if(isset($certCon)){
                    echo('<script> certoLogin(); </script>');
                }

        ?>
        <script>
            let emailRegex = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;
        </script>
        <script src="/TechWay/js/formLogUsu.js" defer></script>
    </body>
</html>
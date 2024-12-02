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
        <script src="/TechWay/js/darkmode.js" defer></script>
    </head>
    <body class="temaclaro">
        <header id="headerPrincipal" class="headerPrincipal pt-3 pb-3">
            <section class="row d-flex align-items-center">

                <section class="col d-flex justify-content-start">
                    <a href="/TechWay/index.php">
                        <img src="/TechWay/img/icones/logo/logoExtensoBranco.png" class="logo" alt="Icone da Logo TechWay">
                    </a>
                </section>

                <nav class="col d-flex justify-content-center">

                    <ul class="navHeader nav d-flex gap-2">
                        <li class="nav-item">
                            <a class="linkHeader nav-link active link-opacity-75-hover" href="/TechWay/index.php"> Home </a>
                        </li>

                        <li class="nav-item">
                            <a class="linkHeader nav-link link-opacity-75-hover" href="/TechWay/src/guias.php"> Guias e monitores </a>
                        </li>
                        
                        <li class="nav-item">
                            <a class="linkHeader nav-link link-opacity-75-hover" href="/TechWay/src/sobreNos.php"> Sobre nós </a>
                        </li>
                    </ul>

                </nav>

                <section class="col d-flex justify-content-end align-items-center gap-4">
                <?php
                    session_start();
                    require_once("conexao.php");
                    if(!isset($_SESSION["id"])){
                ?>
                        <a class="botao" href="/TechWay/src/login.php"> Fazer login </a>
                <?php
                    }

                    if(isset($_SESSION["id"])){
                        if($_SESSION["tipo"] == 'Usuario'){
                            $sqlSel = "SELECT * FROM USUARIO WHERE id =". $_SESSION['id'];
                            $resul = mysqli_query($conexao, $sqlSel);
                            $contr = mysqli_fetch_array($resul);
                ?>
                            <a href="/TechWay/src/cadastrado/alterarUsu.php">
                <?php
                                if($contr["foto"] == ''){
                ?>
                                    <img src="/TechWay/img/icones/iconesLink/usuarioImg.png" class="iconeUsu" alt="Icone usuário">
                <?php
                                }else{
                                    echo('<img src="/TechWay/img/usuario/usu'.$contr["id"].'/'.$contr["foto"].'" class="iconeUsu Usu" alt="Icone usuário">');
                                }
                ?>
                            </a>
                <?php
                        }

                        if($_SESSION["tipo"] == 'Estabelecimento'){
                            $sqlSel = "SELECT * FROM Fotos_Estabelecimento WHERE id_estabelecimento =". $_SESSION['id'];
                            $resulSel = mysqli_query($conexao, $sqlSel);
                            $estSel = mysqli_fetch_array($resulSel);
                            
                ?>
                            <a href="/TechWay/src/cadastrado/alterarEst.php">
                <?php
                                if($estSel["id"] == ''){
                ?>
                                    <img src="/TechWay/img/icones/iconesLink/usuarioImg.png" class="iconeUsu" alt="Icone estabelecimento">
                <?php
                                }else{
                                    echo('<img src="/TechWay/img/estabelecimento/est'.$estSel["id_estabelecimento"].'/'.$estSel["logo"].'" class="iconeUsu Usu" alt="Icone estabelecimento">');
                                }
                ?>
                            </a>
                <?php
                        }

                        if($_SESSION["tipo"] == 'Monitor'){
                            $sqlSel = "SELECT * FROM Fotos_Monitor WHERE id_monitor =". $_SESSION['id'];
                            $resul = mysqli_query($conexao, $sqlSel);
                            $contr = mysqli_fetch_array($resul);
                ?>
                            <a href="/TechWay/src/cadastrado/alterarMon.php">
                <?php
                                if($contr["foto_perfil"] == ''){
                ?>
                                    <img src="/TechWay/img/icones/iconesLink/usuarioImg.png" class="iconeUsu" alt="Icone monitor">
                <?php
                                }else{
                                    echo('<img src="/TechWay/img/monitor/mon'.$contr["id_monitor"].'/'.$contr["foto_perfil"].'" class="iconeUsu Usu" alt="Icone monitor">');
                                }
                ?>
                            </a>
                <?php
                        }


                    }

                ?>

                    <input type="checkbox" name="check" id="check" class="checkbox">    
                    <label class="labelCheck" for="check">
                        <img src="/TechWay/img/icones/iconesLink/luaImg.png" id="lua" class="icones" alt="Icone da Lua">
                        <img src="/TechWay/img/icones/iconesLink/solImg.png" class="icones" alt="Icone da Sol">


                        <section class="ball"></section>
                    </label>
                </section>

            </section>
        </header>
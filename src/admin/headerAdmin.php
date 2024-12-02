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

                <section class="col-3 d-flex justify-content-start">
                    <img src="/TechWay/img/icones/logo/logoExtensoBranco.png" class="logo" alt="Icone da Logo TechWay">
                </section>

                <nav class="col d-flex justify-content-center">

                    <ul class="navHeader nav d-flex">
                        <li class="nav-item">
                            <a class="linkHeader nav-link active link-opacity-75-hover" href="/TechWay/src/admin/homeAdmin.php"> Usuários </a>
                        </li>

                        <li class="nav-item">
                            <a class="linkHeader nav-link link-opacity-75-hover" href="/TechWay/src/admin/estabelecimentosAdmin.php"> Estabelecimentos </a>
                        </li>
                        
                        <li class="nav-item">
                            <a class="linkHeader nav-link link-opacity-75-hover" href="/TechWay/src/admin/guiasAdmin.php"> Guias e Monitores </a>
                        </li>
                    </ul>

                </nav>

                <section class="col-3 d-flex justify-content-end align-items-center gap-4">
                    <a class="botao sair" href="/TechWay/src/admin/sair.php"> Sair </a>

                    <input type="checkbox" name="check" id="check" class="checkbox">    
                    <label class="labelCheck" for="check">
                        <img src="/TechWay/img/icones/iconesLink/luaImg.png" id="lua" class="icones" alt="Icone da Lua">
                        <img src="/TechWay/img/icones/iconesLink/solImg.png" class="icones" alt="Icone da Sol">


                        <section class="ball"></section>
                    </label>
                </section>
            </section>
        </header>
        <?php  
            session_start();
            if($_SESSION["tipo"] != 'Admin'){
                header("location: loginAdmin.php");
            }
            require_once('../conexao.php');
        ?>
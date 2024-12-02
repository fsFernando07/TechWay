<section class="headerResponsivo pt-3 pb-3">

    <section class="container d-flex">
        <section class="col d-flex align-items-center justify-content-start">
            <img src="/TechWay/img/icones/logo/logoExtensoBranco.png" class="logo" alt="Icone da Logo TechWay">
        </section>
    
        <nav class="navBotao col d-flex navbar justify-content-end gap-3">
            <a class="botao sair" href="/TechWay/src/admin/sair.php"> Sair </a>
            
            <button class="botaoHamburguer navbar-toggler" type="button" data-bs-toggle="modal" data-bs-target="#menu">
                <img src="/TechWay/img/icones/iconesLink/menuHamburguerImg.png" class="icones" alt="Icone Menu Hambúrguer">
            </button>
        </nav>
    </section>

    <section class="modalMenu modal fade" id="menu" tabindex="-1" aria-hidden="true">
        <section class="modal-dialog modal-dialog-centered" role="document">
            <section class="modal-content">
                <section class="modal-header d-flex align-items-center">
                    <h5 class="modal-title"> Menu </h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span class="icones" aria-hidden="true"> &times;</span>
                    </button>
                </section>
                <section class="modal-body">
                    <ul class="nav d-flex flex-column list-group list-group-flush">
                        <li class="list-group-item nav-item">
                            <a id="btnUsu" class="linkHeader nav-link" href="/TechWay/src/admin/homeAdmin.php"> Usuários </a>
                        </li>

                        <li class="list-group-item nav-item">
                            <a id="btnEst" class="linkHeader nav-link" href="/TechWay/src/admin/estabelecimentosAdmin.php"> Estabelecimentos </a>
                        </li>
                        
                        <li class="list-group-item nav-item">
                            <a id="btnGuias" class="linkHeader nav-link" href="/TechWay/src/admin/guiasAdmin.php"> Guias e Monitores </a>
                        </li>

                    </ul>
                </section>
            </section>
        </section>
    </section>

</section>

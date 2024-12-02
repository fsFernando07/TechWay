<?php
    require_once('../header.php');
    if(!isset($_SESSION["id"])){
        header('location: ../../index.php');
    }

    if(isset($_SESSION["id"])){
        if($_SESSION["tipo"] == 'Estabelecimento'){
            header('location: ../../index.php');
        }

        if($_SESSION["tipo"] == 'Monitor'){
            header('location: ../../index.php');
        }
    }

    require_once('../headerResponsivo.php');
?>
<script src="/TechWay/js/formSucErr.js"></script>
<?php
    $sqlSel = "SELECT * FROM USUARIO WHERE id =". $_SESSION['id'];
    $resul = mysqli_query($conexao, $sqlSel);
    $contr = mysqli_fetch_array($resul);

    if(isset($_POST["atualizarUsu"])){
        $nome = $_POST["nomeUsuAlt"];
        $email = $_POST["emailUsuAlt"];
        $senha = "Teste";
        $foto = $_FILES["fotoPerfil"];

        $error = array();

        $largura = 4000;

        $altura = 4000;

        $tamanho = 1024 * 1024 * 3;

        if(isset($_POST["senhaUsuAlt"])){
            $senha = $_POST["senhaUsuAlt"];
        }

        if($nome == '' || $email == ''){
            $error[0] = 'O nome e/ou e-mail estão vazios.';
        }

        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $error[1] = "O email é inválido.";
        }

        $sqlEmail = 'SELECT * FROM Usuario WHERE email ="'. $email.'" && email !="'.$contr["email"].'";';
        $resulEmail = mysqli_query($conexao, $sqlEmail);
        $numLinhasEmail = mysqli_num_rows($resulEmail);

        if($numLinhasEmail > 0){
            $error[2] = "O email já é usado por outro usuário.";
        }

        if($senha != "Teste" && $senha == ''){
            $error[3] = "A nova senha não pode ser vazia.";
        }
        if($senha != "Teste" && strlen($senha) < 6){
            $error[4] = "A nova senha deve conter no mínimo 6 caracteres.";
        }

        if(!empty($foto["name"])){
            if(!preg_match("/^image\/(jpg|jpeg|png|gif|bmp)$/", $foto["type"])){
                $error[5] = "A foto de logo está em um formato inválido.";
            }
            $dimensoes = getimagesize($foto["tmp_name"]);

            if($dimensoes[0] > $largura) {
                $error[6] = "A largura da logo não deve ultrapassar ".$largura." pixels.";
            }

            if($dimensoes[1] > $altura) {
                $error[7] = "A altura da logo não deve ultrapassar ".$altura." pixels.";
            }
            
            if($foto["size"] > $tamanho) {
                $error[8] = "A logo deve ter no máximo ".$tamanho." bytes.";
            }
        }
        

        $totalerro = "";
        
        if (count($error) != 0) {
            $erroCon = 1;
            for($i = 0; $i <= 4; $i++) {
                if (!empty($error[$i])){
                    $totalerro .= '<p class="erroLog"> <img src="/TechWay/img/icones/iconesLink/erroImg.png" class="icones me-2" alt="Icone de certo no cadastro">'. $error[$i] .'</p>';
                }
            }
        }else{
            if(!empty($foto["name"])){
                if($contr["foto"] != ""){
                    unlink("../../img/usuario/usu".$_SESSION['id']."/".$contr["foto"]);
                }

                preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $foto["name"], $ext);

                $nome_imagem = md5(uniqid(time())) . "." . $ext[1];

                $caminho_imagem = "../../img/usuario/usu". $_SESSION['id'] ."/". $nome_imagem;

                move_uploaded_file($foto["tmp_name"], $caminho_imagem);

            }else{
                $nome_imagem = $contr["foto"];
            }

            if($senha != "Teste"){
                $senhaCrip = password_hash($senha,PASSWORD_DEFAULT);
            }else{
                $senhaCrip = $contr["senha"];
            }

            $sqlUp = 'UPDATE Usuario SET nome ="'.$nome.'", email ="'.$email.'", senha ="'.$senhaCrip.'", foto ="'.$nome_imagem.'" WHERE id ='.$_SESSION["id"];
            $resulUp = mysqli_query($conexao, $sqlUp);

            if ($resulUp){
                $certCon = 1;
            }
        }   
    }

    if(isset($_POST["excluirConta"])){
        if($contr["foto"] != ""){
            unlink("../../img/usuario/usu".$_SESSION['id']."/".$contr["foto"]);
        }
        rmdir('../../img/usuario/usu'.$_SESSION["id"]);
        $sqlEx = 'DELETE FROM Usuario WHERE id ='.$_SESSION["id"];
        $resulEx = mysqli_query($conexao, $sqlEx);
        $excluir = 1;
    }
?>

        <main class="container d-flex align-items-center">
            <section class="container tab-content d-block">
                <section class="tab-pane active" id="cadUsuario">
                    
                    <section class="login">
                        <ul class="nav pt-3">
                            <li class="nav-item">
                                <a class="nav-link p-0" href="../../index.php"> <i class="fa-solid fa-arrow-left"></i> Voltar à Home </a>
                            </li>
                        </ul>

                        <section class="form-loginEmail alt">
                            
                            <form action="#" method="POST" enctype="multipart/form-data">
                                
                                <section class="page pt-2">
                                    <section class="title"> 
                                        <h5> Alterar Informações </h5> 
                                    </section>

                                    <section class="field">
                                        <input type="file" name="fotoPerfil" id="fotoPerfil" onchange="validarArquivo('#fotoPerfil')" accept="image/jpeg, image/gif, image/png">
                                        <label for="fotoPerfil" class="foto">
                                    <?php
                                        if($contr["foto"] == ''){
                                    ?>
                                            <img src="/TechWay/img/icones/iconesLink/usuarioImg.png" class="imgUsu" alt="Icone usuário">
                                            <?php
                                        }else{
                                            echo('<img src="/TechWay/img/usuario/usu'.$contr["id"].'/'.$contr["foto"].'" class="imgUsu" alt="Icone usuário">');
                                        }
                                    ?> 
                                            <section class="selImg"><i class="fa-solid fa-camera"></i></section>
                                        </label>
                                    </section>
                                  
                                    <section class="field">
                                        <label for="nomeUsuAlt"> Nome </label>
                                        <input type="text" name="nomeUsuAlt" id="nomeUsuAlt" placeholder="Digite o seu nome" value="<?php echo($contr['nome']);?>">
                                        <span class="erro"> O nome não pode ser vazio. </span>
                                    </section>
                                    
                                    <section class="field">
                                        <label for="emailUsuAlt"> E-mail </label>
                                        <input type="email" name="emailUsuAlt" id="emailUsuAlt" placeholder="Digite o seu e-mail" value="<?php echo($contr['email']);?>">
                                        <span class="erro"> O e-mail não pode ser vazio. </span>
                                        <span class="erro"> O e-mail é inválido. </span>
                                    </section>

                                    <?php
                                        if($contr["senha"] != ''){
                                    ?>
                                            <section class="field altSenha">
                                                <label for="senhaUsuAlt"> <i class="fa-solid fa-lock"></i> Alterar senha </label>
                                                <section class="senha">
                                                </section>
                                                <span class="erro"> A nova senha não pode ser vazia. </span>
                                                <span class="erro"> A nova senha deve conter no mínimo 6 caracteres. </span>
                                            </section>

                                    <?php
                                        }
                                    ?>
                                    
                                    
                                    <section class="field btns">
                                        <section class="button submit"> Atualizar Informações </section>
                                        <a href="sair.php" class="button"> Sair </a>
                                        <button class="button navbar-toggler" type="button" data-bs-toggle="modal" data-bs-target="#excluirConta">
                                             Excluir Conta 
                                        </button>
                                        <input type="submit" name="atualizarUsu" id="atualizarUsu" value="Alterar" class="d-none">
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
                            <img src="/TechWay/img/icones/iconesLink/certoImg.png" class="iconCerErr" alt="Icone de certo na atualização">
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span class="icones" aria-hidden="true"> &times;</span>
                            </button>
                        </section>
                        <section class="modal-body">
                           <p> Os dados foram atualizados com sucesso! </p>
                        </section>
                    </section>
                </section>
            </section>

            <section class="modalLogin modal fade" id="excluirConta" tabindex="-1" aria-hidden="true">
                <section class="modal-dialog modal-dialog-centered" role="document">
                    <section class="modal-content">
                        <section class="modal-header d-flex align-items-center">
                            <span></span>
                            <img src="/TechWay/img/icones/iconesLink/excluirImg.png" class="iconCerErr" alt="Icone de excluir conta">
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span class="icones" aria-hidden="true"> &times;</span>
                            </button>
                        </section>
                        <section class="modal-body">
                           <p> Tem certeza que deseja excluir sua conta? </p>
                           <form action="#" method="POST">
                                <button type="submit" name="excluirConta" class="buttonEx"> Excluir </button>
                           </form>
                        </section>
                    </section>
                </section>
            </section>

            <section class="modalLogin modal fade" id="envioExcluir" tabindex="-1" aria-hidden="true">
                <section class="modal-dialog modal-dialog-centered" role="document">
                    <section class="modal-content">
                        <section class="modal-header d-flex align-items-center">
                            <span></span>
                            <img src="/TechWay/img/icones/iconesLink/excluirImg.png" class="iconCerErr" alt="Icone de excluir conta">
                            <span></span>
                        </section>
                        <section class="modal-body">
                           <p> Conta excluida com sucesso! </p>
                        </section>
                    </section>
                </section>
            </section>

            <section class="modalLogin modal fade" id="envioErro" tabindex="-1" aria-hidden="true">
                <section class="modal-dialog modal-dialog-centered" role="document">
                    <section class="modal-content">
                        <section class="modal-header d-flex align-items-center">
                            <span></span>
                            <img src="/TechWay/img/icones/iconesLink/erroImg.png" class="iconCerErr" alt="Icone de erro na atualização">
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

            <button class="botaoHamburguer navbar-toggler d-none" type="button" id="btnExcluir" data-bs-toggle="modal" data-bs-target="#envioExcluir">
                <p> a</p>
            </button>
        </main>
        <?php
                require_once('../footer.php');

                if(isset($erroCon)){
                    echo('<script> erroLogin(); </script>');
                }

                if(isset($certCon)){
                    echo('<script> certoLogin(); </script>');
                }

                if(isset($excluir)){
                    echo('<script> excluirConta(); </script>');
                }

        ?>
        <script src="/TechWay/js/formAltUsu.js" defer></script>
    </body>
</html>
<?php
            require_once('../header.php');
            if(!isset($_SESSION["id"])){
                header('location: ../../index.php');
            }

            if(isset($_SESSION["id"])){
                if($_SESSION["tipo"] == 'Usuario'){
                    header('location: ../../index.php');
                }

                if($_SESSION["tipo"] == 'Estabelecimento'){
                    header('location: ../../index.php');
                }
            }
            require_once('../headerResponsivo.php');
?>
<script src="/TechWay/js/formSucErr.js"></script>
<?php
            $sqlSel = "SELECT * FROM Monitor WHERE id=".$_SESSION['id'];
            $resulSel = mysqli_query($conexao, $sqlSel);
            $mon = mysqli_fetch_array($resulSel);
            
            $sqlFotos = "SELECT * FROM Fotos_Monitor WHERE id_monitor=".$_SESSION['id'];
            $resulFotos = mysqli_query($conexao,$sqlFotos);
            $fotoMoni = mysqli_fetch_array($resulFotos);

            if(!isset($_POST["alterarMon"])){
                $nomeMoni = $mon["nome"];
                $tipoMoni = $mon["id_tipo"];
                $descricaoMoni = $mon["descricao"];
                $numMoniCadastur = $mon["numero_cadastur"];
                $generoMoni = $mon["genero"];

                $areaAtuacao = $mon["areas_especializacao"];
                $idiomaSec = $mon["idiomas"];
                $telefoneMoni = $mon["telefone"];
                $facebookMoni = $mon["facebook"];
                $instagramMoni = $mon["instagram"];
                $tiktokMoni = $mon["tiktok"];

                $emailMoni = $mon["email"];
                $senha = "";
            }

            if(isset($_POST["alterarMon"])){
                $nomeMoni = $_POST["nomeMoni"];
                $tipoMoni = $_POST["tipoMoni"];
                $descricaoMoni = $_POST["descricaoMoni"];
                $numMoniCadastur = $_POST["numMoniCadastur"];
                $generoMoni = $_POST["generoMoni"];

                $areaAtuacao = $_POST["areaAtuacao"];
                $idiomaSec = $_POST["idiomaSec"];
                $telefoneMoni = $_POST["telefoneMoni"];
                $facebookMoni = $_POST["facebookMoni"];
                $instagramMoni = $_POST["instagramMoni"];
                $tiktokMoni = $_POST["tiktokMoni"];

                $emailMoni = $_POST["emailMoni"];
                $senha = "Teste";

                $fotoMoni[0] = $_FILES["fotoPerfil"];
                $fotoPerfil = $fotoMoni[0];
                $fotoMoni[1] = $_FILES["fotoPrimMoni"];
                $fotoMoni[2] = $_FILES["fotoSecuMoni"];
                $fotoMoni[3] = $_FILES["fotoTercMoni"];
                $fotoMoni[4] = $_FILES["fotoQuarMoni"];
                $fotoMoni[5] = $_FILES["fotoQuinMoni"];
        
                $numErro = 0;

                $error = array();

                $largura = 4000;

                $altura = 4000;

                $tamanho = 1024 * 1024 * 3;

                if(isset($_POST["senha"])){
                    $senha = $_POST["senha"];
                }

                if($nomeMoni == '' || $tipoMoni == '' || $descricaoMoni == '' || $numMoniCadastur == '' || $generoMoni == ''){
                    $error[0] = "Um ou mais campos da primeira página estão vazios.";
                }else if(strlen($numMoniCadastur) < 18){
                    $error[1] = "O número de cadastro no Cadastur é inválido.";
                }

                if($areaAtuacao == '' || $idiomaSec == '' || $telefoneMoni == ''){
                    $error[2] = "Um ou mais campos da primeira página estão vazios.";
                }

                if(strlen($telefoneMoni) > 0 && strlen($telefoneMoni) < 15){
                    $error[3] = "O telefone é inválido.";
                }

                if(strlen($facebookMoni) > 400 || strlen($instagramMoni) > 400 || strlen($tiktokMoni) > 400){
                    $error[4] = "Um ou mais links de redes sociais ultrapassam 400 caracteres.";
                }

                if($emailMoni == ''){
                    $error[5] = "Um ou mais campos na quarta página estão vazios.";
                }

                if(!filter_var($emailMoni, FILTER_VALIDATE_EMAIL)){
                    $error[6] = "O email de login é inválido.";
                }

                $sql = 'SELECT email FROM Monitor WHERE email ="'. $emailMoni.'" && email != "'.$mon["email"].'";';
                $resul = mysqli_query($conexao, $sql);
                $numLinhas = mysqli_num_rows($resul);

                if($numLinhas > 0){
                    $error[7] = "O email de login já é usado por outro monitor.";
                }

                if($senha != "Teste" && $senha == ''){
                    $error[8] = "A nova senha não pode ser vazia.";
                }
                if($senha != "Teste" && strlen($senha) < 6){
                    $error[9] = "A nova senha deve conter no mínimo 6 caracteres.";
                }

                if (!empty($fotoPerfil["name"])) {
                    if(!preg_match("/^image\/(jpg|jpeg|png|gif|bmp)$/", $fotoPerfil["type"])){
                        $error[10] = "A foto de logo está em um formato inválido..";
                    }
                    $dimensoes = getimagesize($fotoPerfil["tmp_name"]);

                    if($dimensoes[0] > $largura) {
                        $error[11] = "A largura da foto de perfil não deve ultrapassar ".$largura." pixels.";
                    }
    
                    if($dimensoes[1] > $altura) {
                        $error[12] = "A altura da foto de perfil não deve ultrapassar ".$altura." pixels.";
                    }
                    
                    if($fotoPerfil["size"] > $tamanho) {
                        $error[13] = "A foto de perfil deve ter no máximo ".$tamanho." bytes.";
                    }

                }
                
                for($i = 1; $i <= 5; $i++){
                    $fotoFor = $fotoMoni[$i];
                    if(!empty($fotoMoni[1]["name"])){
                        if(!empty($fotoFor["name"])){
                            if(!preg_match("/^image\/(jpg|jpeg|png|gif|bmp)$/", $fotoFor["type"])){
                                $error[14] = "Uma ou mais fotos estão em um formato inválido..";
                                break;
                            }
                            $dimensoes = getimagesize($fotoFor["tmp_name"]);
    
                            if($dimensoes[0] > $largura) {
                                $error[15] = "A largura da ".$i."º foto não deve ultrapassar ".$largura." pixels.";
                                break;
                            }
            
                            if($dimensoes[1] > $altura) {
                                $error[16] = "A altura da ".$i."º foto não deve ultrapassar ".$altura." pixels.";
                                break;
                            }
                            
                            if($fotoFor["size"] > $tamanho) {
                                $error[17] = "A ".$i."º foto deve ter no máximo ".$tamanho." bytes.";
                                break;
                            }
                        }
                    }
                }

                if (count($error) == 0) {
                    for($i = 0; $i <= 5; $i++){
                        if(!empty($fotoMoni[$i]["name"])){
                            if($i == 0){
                                if($fotoMoni["foto_perfil"] != ""){
                                    unlink("../../img/monitor/mon".$_SESSION['id']."/".$fotoMoni["foto_perfil"]);
                                }
                            }else{
                                if($fotoMoni["foto_".$i] != ""){
                                    unlink("../../img/monitor/mon".$_SESSION['id']."/".$fotoMoni["foto_".$i]);
                                }
                            }

                            preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $fotoMoni[$i]["name"], $ext);
        
                            $nome_imagem[$i] = md5(uniqid(time())) . "." . $ext[1];
        
                            $caminho_imagem[$i] = "../../img/monitor/mon". $_SESSION["id"] ."/". $nome_imagem[$i];
        
                            move_uploaded_file($fotoMoni[$i]["tmp_name"], $caminho_imagem[$i]);

                        }else{
                            if($i == 0){
                                $nome_imagem[$i] = $fotoMoni["foto_perfil"];
                            }else{
                                $nome_imagem[$i] = $fotoMoni["foto_".$i];
                            }
                        }
                    }

                    if($senha != "Teste"){
                        $senhaCrip = password_hash($senha,PASSWORD_DEFAULT);
                    }else{
                        $senhaCrip = $mon["senha"];
                    }

                    $sqlInMon = 'UPDATE Monitor SET nome = "'.$nomeMoni.'", descricao = "'. $descricaoMoni.'", numero_cadastur = "'.$numMoniCadastur.'", genero = "'.$generoMoni.'", id_tipo = '.$tipoMoni.',
                            areas_especializacao = "'.$areaAtuacao.'", idiomas = "'.$idiomaSec.'", telefone = "'.$telefoneMoni.'", instagram = "'.$instagramMoni.'",
                            tiktok = "'.$tiktokMoni.'", facebook = "'.$facebookMoni.'", email = "'.$emailMoni.'", senha = "'.$senhaCrip.'", autorizado = "Em análise"  WHERE id ='.$_SESSION["id"];
                    $resul1 = mysqli_query($conexao, $sqlInMon);

                    $sqlin = 'UPDATE Fotos_Monitor SET foto_perfil = "'.$nome_imagem[0].'", foto_1 = "'.$nome_imagem[1].'",
                            foto_2 = "'.$nome_imagem[2].'", foto_3 = "'.$nome_imagem[3].'", foto_4 = "'.$nome_imagem[4].'", foto_5 = "'.$nome_imagem[5].'"
                            WHERE id_monitor = '.$_SESSION["id"]; 
                    $resul = mysqli_query($conexao, $sqlin);
                    
                    if ($resul && $resul1){
                        $certCon = 1;
                    }

                }

                $totalerro = "";
                
                if (count($error) != 0) {
                    $erroCon = 1;
                    for($i = 0; $i <= 17; $i++) {
                        if (!empty($error[$i])){
                            $totalerro .= '<p class="erroLog"> <img src="/TechWay/img/icones/iconesLink/erroImg.png" class="icones me-2" alt="Icone de certo no cadastro">'. $error[$i] .'</p>';
                        }
                    }
                }
            }

            if(isset($_POST["excluirConta"])){
                for($i = 0; $i <= 5; $i++){
                    if($i == 0){
                        if($fotoMoni["foto_perfil"] != ""){
                            unlink("../../img/monitor/mon".$_SESSION['id']."/".$fotoMoni["foto_perfil"]);
                        }
                    }else{
                        if($fotoMoni["foto_".$i] != ""){
                            unlink("../../img/monitor/mon".$_SESSION['id']."/".$fotoMoni["foto_".$i]);
                        }
                    }
                }
                rmdir('../../img/monitor/mon'.$_SESSION["id"]);
                $sqlExFt = 'DELETE FROM Fotos_Monitor WHERE id_monitor ='.$_SESSION["id"];
                $resulExFt = mysqli_query($conexao, $sqlExFt);
                
                $sqlEx = 'DELETE FROM Monitor WHERE id ='.$_SESSION["id"];
                $resulEx = mysqli_query($conexao, $sqlEx);

                $excluir = 1;
            }
?>
        <main class="container">
            <section id="cadMonitor" class="container d-flex flex-column align-items-center">
                    
                <section class="login">
                    <ul class="nav pt-3">
                        <li class="nav-item">
                            <a class="nav-link p-0" href="../../index.php"> <i class="fa-solid fa-arrow-left"></i> Voltar à Home</a>
                        </li>
                    </ul>

                    <p class="pt-2"> Status: 
                        <?php 
                            if($mon["autorizado"] == "Autorizado"){
                                echo('<span style="color: #10b313;">'.$mon["autorizado"].'</span>');
                            }else if($mon["autorizado"] == "Não autorizado"){
                                echo('<span style="color: #ce0000;">'.$mon["autorizado"].'</span>');
                            }else{
                                echo('<span style="color: #cccc07;">'.$mon["autorizado"].'</span>');
                            }
                        ?>
                    </p>

                    <section class="d-flex flex-column align-items-center pt-3 pb-3">
                        <h3> Alterar informações! </h3>
                    </section>

                    <section class="d-flex justify-content-center">
                        <section class="progress-bar">
                            <section class="step">
                                <p> Nome </p>
                                <section class="bullet">
                                    <span> 1 </span>
                                </section>
                                <section class="check fas fa-check"></section>
                            </section>
                            
                            <section class="step">
                                <p> Atuação </p>
                                <section class="bullet">
                                    <span> 2 </span>
                                </section>
                                <section class="check fas fa-check"></section>
                                
                            </section>
    
                            <section class="step">
                                <p> Fotos </p>
                                <section class="bullet">
                                    <span> 3 </span>
                                </section>
                                <section class="check fas fa-check"></section>
                            </section>
    
                            <section class="step">
                                <p> Login </p>
                                <section class="bullet">
                                    <span> 4 </span>
                                </section>
                                <section class="check fas fa-check"></section>
                            </section>
                        </section>
                    </section>

                    <section class="form-loginEmail altMoni">

                        <form action="#" method="POST" enctype="multipart/form-data">

                            <section class="page slidepage">
                                <section class="title"> 
                                    <h4> Informações básicas: </h4> 
                                </section>

                                <section class="field">
                                    <label for="nomeMoni"> Nome </label>
                                    <input type="text" name="nomeMoni" id="nomeMoni" placeholder="Digite o seu nome" value="<?php echo($nomeMoni);?>">
                                    <span class="erro"> O nome não pode ser vazio. </span>
                                </section>

                                <section class="field">
                                    <label for="tipoMoni"> Tipo </label>
                                    <select name="tipoMoni" id="tipoMoni">
                                        <?php
                                            if($tipoMoni == 1){
                                                echo('<option value="1"> Monitor </option>
                                                    <option value="2"> Guia </option>
                                                    <option value="3"> Guia e Monitor </option>');
                                            }else if($tipoMoni == 2){
                                                echo('<option value="2"> Guia </option>
                                                    <option value="1"> Monitor </option>
                                                    <option value="3"> Guia e Monitor </option>');
                                            }else{
                                                echo('<option value="3"> Guia e Monitor </option>
                                                    <option value="1"> Monitor </option>
                                                    <option value="2"> Guia </option>');
                                            }
                                        ?>
                                    </select>
                                </section>

                                <section class="field">
                                    <label for="descricaoMoni"> Descrição </label>
                                    <textarea name="descricaoMoni" id="descricaoMoni"><?php echo($descricaoMoni);?></textarea>
                                    <span class="erro"> A descrição não pode ser vazia. </span>
                                </section>

                                <section class="field">
                                    <label for="numMoniCadastur"> Número de cadastro do Cadastur </label>
                                    <input type="text" name="numMoniCadastur" id="numMoniCadastur" placeholder="Digite o seu número de cadastro do Cadastur" value="<?php echo($numMoniCadastur);?>">
                                    <span class="erro"> O número de cadastro não pode ser vazio. </span>
                                    <span class="erro"> O número de cadastro é inválido. </span>
                                </section>

                                <section class="field">
                                    <label for="generoMoni"> Gênero </label>
                                    <select name="generoMoni" id="generoMoni">
                                    <?php
                                        if($generoMoni == "Masculino"){
                                            echo('<option value="Masculino"> Masculino </option>
                                                <option value="Feminino"> Feminino </option>
                                                <option value="Transgênero"> Transgênero </option>
                                                <option value="Não-binário"> Não-binário </option>');
                                        }else if($generoMoni == "Feminino"){
                                            echo('<option value="Feminino"> Feminino </option>
                                                <option value="Masculino"> Masculino </option>
                                                <option value="Transgênero"> Transgênero </option>
                                                <option value="Não-binário"> Não-binário </option>');
                                        }else if($generoMoni == "Transgênero"){
                                            echo('<option value="Transgênero"> Transgênero </option>
                                                <option value="Masculino"> Masculino </option>
                                                <option value="Feminino"> Feminino </option>
                                                <option value="Não-binário"> Não-binário </option>');
                                        }else{
                                            echo('<option value="Não-binário"> Não-binário </option>
                                                <option value="Masculino"> Masculino </option>
                                                <option value="Feminino"> Feminino </option>
                                                <option value="Transgênero"> Transgênero </option>');
                                        }
                                    ?>
                                    </select>
                                </section>

                                <section class="field btns proxBtn">
                                    <section class="button"> Próximo </section>
                                </section>
                            </section>

                            <section class="page">
                                <section class="title"> 
                                    <h4> Informações de atuação: </h4> 
                                </section>

                                <section class="field">
                                    <label> Escolha sua área de atuação </label>
                                    <select name="areaAtuacao" id="areaAtuacao">
                                    <?php
                                        if($areaAtuacao == "Hospedagem"){
                                            echo('<option value="Hospedagem"> Hospedagem </option>
                                                <option value="Alimentação"> Alimentação </option>
                                                <option value="Compras"> Compras </option>
                                                <option value="Locomoção"> Locomoção </option>');
                                        }else if($areaAtuacao == "Alimentação"){
                                            echo('<option value="Alimentação"> Alimentação </option>
                                            <option value="Hospedagem"> Hospedagem </option>
                                            <option value="Compras"> Compras </option>
                                            <option value="Locomoção"> Locomoção </option>');
                                        }else if($areaAtuacao == "Compras"){
                                            echo('<option value="Compras"> Compras </option>
                                                <option value="Hospedagem"> Hospedagem </option>
                                                <option value="Alimentação"> Alimentação </option>
                                                <option value="Locomoção"> Locomoção </option>');
                                        }else{
                                            echo('<option value="Locomoção"> Locomoção </option>
                                                <option value="Hospedagem"> Hospedagem </option>
                                                <option value="Alimentação"> Alimentação </option>
                                                <option value="Compras"> Compras </option>');
                                        }
                                    ?>
                                    </select>
                                </section>

                                <section class="field">
                                    <label for="idiomaSec"> Idioma secundário </label>
                                    <select name="idiomaSec" id="idiomaSec">
                                    <?php
                                        if($idiomaSec == "Nenhum"){
                                            echo('<option value="Nenhum"> Nenhum </option>
                                                <option value="Alemão"> Alemão </option>
                                                <option value="Espanhol"> Espanhol </option>
                                                <option value="Francês"> Francês </option>
                                                <option value="Inglês"> Inglês </option>
                                                <option value="Italiano"> Italiano </option>
                                                <option value="Russo"> Russo </option>');
                                        }else if($idiomaSec == "Alemão"){
                                            echo('<option value="Alemão"> Alemão </option>
                                                <option value="Nenhum"> Nenhum </option>
                                                <option value="Espanhol"> Espanhol </option>
                                                <option value="Francês"> Francês </option>
                                                <option value="Inglês"> Inglês </option>
                                                <option value="Italiano"> Italiano </option>
                                                <option value="Russo"> Russo </option>');
                                        }else if($idiomaSec == "Espanhol"){
                                            echo('<option value="Espanhol"> Espanhol </option>
                                            <option value="Nenhum"> Nenhum </option>
                                            <option value="Alemão"> Alemão </option>
                                            <option value="Francês"> Francês </option>
                                            <option value="Inglês"> Inglês </option>
                                            <option value="Italiano"> Italiano </option>
                                            <option value="Russo"> Russo </option>');
                                        }else if($idiomaSec == "Francês"){
                                            echo('<option value="Francês"> Francês </option>
                                                <option value="Nenhum"> Nenhum </option>
                                                <option value="Alemão"> Alemão </option>
                                                <option value="Espanhol"> Espanhol </option>
                                                <option value="Inglês"> Inglês </option>
                                                <option value="Italiano"> Italiano </option>
                                                <option value="Russo"> Russo </option>');
                                        }else if($idiomaSec == "Inglês"){
                                            echo('<option value="Inglês"> Inglês </option>
                                                <option value="Nenhum"> Nenhum </option>
                                                <option value="Alemão"> Alemão </option>
                                                <option value="Espanhol"> Espanhol </option>
                                                <option value="Francês"> Francês </option>
                                                <option value="Italiano"> Italiano </option>
                                                <option value="Russo"> Russo </option>');
                                        }else if($idiomaSec == "Italiano"){
                                            echo('<option value="Italiano"> Italiano </option>
                                            <option value="Nenhum"> Nenhum </option>
                                            <option value="Alemão"> Alemão </option>
                                            <option value="Espanhol"> Espanhol </option>
                                            <option value="Francês"> Francês </option>
                                            <option value="Inglês"> Inglês </option>
                                            <option value="Russo"> Russo </option>');
                                        }else{
                                            echo('<option value="Russo"> Russo </option>
                                            <option value="Nenhum"> Nenhum </option>
                                            <option value="Alemão"> Alemão </option>
                                            <option value="Espanhol"> Espanhol </option>
                                            <option value="Francês"> Francês </option>
                                            <option value="Inglês"> Inglês </option>
                                            <option value="Italiano"> Italiano </option>');
                                        }
                                    ?>
                                    </select>
                                </section>

                                <section class="field">
                                    <label for="telefoneMoni"> Telefone </label>
                                    <input type="tel" name="telefoneMoni" id="telefoneMoni" placeholder="Digite o seu telefone" value="<?php echo($telefoneMoni);?>">
                                    <span class="erro"> O telefone não pode ser vazio. </span>
                                    <span class="erro"> O número de telefone não existe. </span>
                                </section>

                                <section class="field">
                                    <label for="facebookMoni"> Facebook </label>
                                    <input type="text" name="facebookMoni" id="facebookMoni" placeholder="Digite o link do Facebook" value="<?php echo($facebookMoni);?>">
                                    <span class="erro"> O link do facebook excede o número de caracteres. </span>
                                </section>

                                <section class="field">
                                    <label for="instagramMoni"> Instagram </label>
                                    <input type="text" name="instagramMoni" id="instagramMoni" placeholder="Digite o link do Instagram" value="<?php echo($instagramMoni);?>">
                                    <span class="erro"> O link do instagram excede o número de caracteres. </span>
                                </section>

                                <section class="field">
                                    <label for="tiktokMoni"> TikTok </label>
                                    <input type="text" name="tiktokMoni" id="tiktokMoni" placeholder="Digite o link do TikTok" value="<?php echo($tiktokMoni);?>">
                                    <span class="erro"> O link do TikTok excede o número de caracteres. </span>
                                </section>

                                <section class="field btns">
                                    <section class="button volt-1 volt"> Voltar </section>
                                    <section class="button prox-1 prox"> Próximo </section>
                                </section>
                            </section>

                            <section class="page">
                                <section class="title"> 
                                    <h5> Fotos monitor/guia </h5> 
                                </section>

                                <section class="field">
                                    <label for="fotoPerfil"> Selecione uma foto de perfil </label>
                                    <input type="file" name="fotoPerfil" id="fotoPerfil" onchange="validarArquivoMon('#fotoPerfil 0')" accept="image/jpeg, image/gif, image/png">
                                    <label for="fotoPerfil" class="file"> <i class="fa-solid fa-upload"></i> Escolher imagem </label>
                                    <span class="certo"> Imagem selecionada com sucesso </span>
                                </section>

                                
                                <section class="field">
                                    <label for="fotoPrimMoni"> Selecione uma ou mais fotos de trabalhos realizados </label>
                                    <input type="file" name="fotoPrimMoni" id="fotoPrimMoni"  onchange="validarArquivoMon('#fotoPrimMoni 1')" accept="image/jpeg, image/gif, image/png">
                                    <label for="fotoPrimMoni" class="file"> <i class="fa-solid fa-upload"></i> Escolher imagem </label>
                                    <span class="certo"> Imagem selecionada com sucesso </span>
                                    <span class="erro"> Selecione pelo menos a foto de perfil e a primeira imagem </span>
                                </section>

                                <section class="addImg">
                                    
                                    <section class="field pt-2">
                                        <input type="file" name="fotoSecuMoni" id="fotoSecuMoni" onchange="validarArquivoMon('#fotoSecuMoni 2')" accept="image/jpeg, image/gif, image/png">
                                        <label for="fotoSecuMoni" class="file"> <i class="fa-solid fa-upload"></i> Escolher imagem </label>
                                        <span class="certo"> Imagem selecionada com sucesso </span>
                                    </section>
                                    
                                    <section class="field pt-2">
                                        <input type="file" name="fotoTercMoni" id="fotoTercMoni" onchange="validarArquivoMon('#fotoTercMoni 3')" accept="image/jpeg, image/gif, image/png">
                                        <label for="fotoTercMoni" class="file"> <i class="fa-solid fa-upload"></i> Escolher imagem </label>
                                        <span class="certo"> Imagem selecionada com sucesso </span>
                                    </section>
                                    
                                    <section class="field pt-2">
                                        <input type="file" name="fotoQuarMoni" id="fotoQuarMoni" onchange="validarArquivoMon('#fotoQuarMoni 4')" accept="image/jpeg, image/gif, image/png">
                                        <label for="fotoQuarMoni" class="file"> <i class="fa-solid fa-upload"></i> Escolher imagem </label>
                                        <span class="certo"> Imagem selecionada com sucesso </span>
                                    </section>
                                    
                                    <section class="field pt-2">
                                        <input type="file" name="fotoQuinMoni" id="fotoQuinMoni" onchange="validarArquivoMon('#fotoQuinMoni 5')" accept="image/jpeg, image/gif, image/png">
                                        <label for="fotoQuinMoni" class="file"> <i class="fa-solid fa-upload"></i> Escolher imagem </label>
                                        <span class="certo"> Imagem selecionada com sucesso </span>
                                    </section>

                                    <span class="erroImg"> Selecione a última imagem primeiro </span>
                                    <p class="addImgBtn d-flex align-items-center gap-1 m-0"> <i class="fa-solid fa-plus"></i> Adicionar imagem </p>
                                </section>
                                
                                <section class="field btns">
                                    <section class="button volt-2 volt"> Voltar </section>
                                    <section class="button prox-2 prox"> Próximo </section>
                                </section>

                            </section>
                            
                            <section class="page">
                                <section class="title"> 
                                    <h5> Informações de login </h5> 
                                </section>

                                <section class="field">
                                    <label for="emailMoni"> E-mail </label>
                                    <input type="email" name="emailMoni" id="emailMoni" placeholder="Digite o e-mail de login" value="<?php echo($emailMoni);?>">
                                    <span class="erro"> O e-mail não pode ser vazio. </span>
                                    <span class="erro"> O e-mail é inválido. </span>
                                    <span class="erro"> O e-mail já é utilizado por um usuário. </span>
                                </section>

                                <section class="field altSenha">
                                    <label for="senha"> <i class="fa-solid fa-lock"></i> Alterar senha </label>
                                    <section class="senha">
                                    </section>
                                    <span class="erro"> A nova senha não pode ser vazia. </span>
                                    <span class="erro"> A nova senha deve conter no mínimo 6 caracteres. </span>
                                </section>


                                <section class="field btns">
                                    <section class="button volt-3 volt"> Voltar </section>
                                    <section class="button submit"> Atualizar </section>
                                    <input type="submit" name="alterarMon" id="alterarMon" value="Cadastrar" class="d-none">
                                </section>
                            </section>

                        </form>

                    </section>
                </section>

                <section class="footer-login alt d-flex align-items-center mb-2 gap-2">
                    <a href="sair.php" class="button"> Sair </a>
                    <button class="button navbar-toggler" type="button" data-bs-toggle="modal" data-bs-target="#excluirConta">
                            Excluir Conta 
                    </button>
                    <input type="submit" name="atualizarUsu" id="atualizarUsu" value="Alterar" class="d-none">
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
        <script src="/TechWay/js/formAltMoni.js" defer></script>
    </body>
</html>
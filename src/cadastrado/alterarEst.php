<?php
            require_once('../header.php');
            if(!isset($_SESSION["id"])){
                header('location: ../../index.php');
            }
            
            if(isset($_SESSION["id"])){
                if($_SESSION["tipo"] == 'Usuario'){
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
            $sqlSel = "SELECT * FROM Estabelecimento WHERE id=".$_SESSION['id'];
            $resulSel = mysqli_query($conexao, $sqlSel);
            $est = mysqli_fetch_array($resulSel);

            $sqlFotos = "SELECT * FROM Fotos_Estabelecimento WHERE id_estabelecimento=".$_SESSION['id'];
            $resulFotos = mysqli_query($conexao,$sqlFotos);
            $fotoEstab = mysqli_fetch_array($resulFotos);

            if(!isset($_POST["atualizarEst"])){

                $nomeEsta = $est["nome_estabelecimento"];
                $categoria = $est["id_categoria"]; 
                $descricao = $est["descricao"]; 
                $cnpj = $est["cnpj"];              
                $horario = $est["horario"];

                $telefone = $est["telefone"]; 
                $emailCom = $est["emailCom"]; 
                $facebook = $est["facebook"]; 
                $instagram = $est["instagram"]; 
                $tiktok = $est["tiktok"];

                $bairro = $est["bairro"];                
                $tipoEnde = $est["tipo_logradouro"]; 
                $endereco = $est["logradouro"]; 
                $numero = $est["numero"];
                
                $email = $est["emailLog"];
                $senha = "";

                $totalerro = "";
            }

            if(isset($_POST["atualizarEst"])){
                $nomeEsta = $_POST["nomeEsta"];
                $categoria = $_POST["categoria"];
                $descricao = $_POST["descricao"];
                $cnpj = $_POST["cnpj"];
                $horario = $_POST["horario"];

                $telefone = $_POST["telefone"];
                $emailCom = $_POST["emailCom"];
                $facebook = $_POST["facebook"];
                $instagram = $_POST["instagram"];
                $tiktok = $_POST["tiktok"];

                $bairro = $_POST["bairro"];
                $tipoEnde = $_POST["tipoEnde"];
                $endereco = $_POST["endereco"];
                $numero = $_POST["numero"];

                $foto[0] = $_FILES["fotoLogo"];
                $fotoLogo = $foto[0];
                $foto[1] = $_FILES["fotoPrim"];
                $foto[2] = $_FILES["fotoSecu"];
                $foto[3] = $_FILES["fotoTerc"];
                $foto[4] = $_FILES["fotoQuart"];
                $foto[5] = $_FILES["fotoQuin"];
                $foto[6] = $_FILES["fotoSext"];
                $foto[7] = $_FILES["fotoSeti"];
                $foto[8] = $_FILES["fotoOito"];
                $foto[9] = $_FILES["fotoNove"];
                $foto[10] = $_FILES["fotoDeci"];

                $email = $_POST["email"];
                $senha = "Teste";

                $numErro = 0;

                $error = array();

                $largura = 4000;

                $altura = 4000;

                $tamanho = 1024 * 1024 * 3;

                if(isset($_POST["senha"])){
                    $senha = $_POST["senha"];
                }

                if($nomeEsta == '' || $categoria == '' || $descricao == '' || $cnpj == '' || $horario == ''){
                    $error[0] = "Um ou mais campos da primeira página estão vazios.";
                }else if(strlen($cnpj) < 18){
                    $error[1] = "O CNPJ é inválido.";
                }

                if($telefone == '' || $emailCom == ''){
                    $error[2] = "Telefone ou email comercial na segunda página estão vazios.";
                }

                if(strlen($telefone) > 0 && strlen($telefone) < 15){
                    $error[3] = "O telefone é inválido.";
                }

                if(!filter_var($emailCom, FILTER_VALIDATE_EMAIL)){
                    $error[4] = "O e-mail comercial é inválido.";
                }

                if(strlen($facebook) > 400 || strlen($instagram) > 400 || strlen($tiktok) > 400){
                    $error[5] = "Um ou mais links de redes sociais ultrapassam 400 caracteres.";
                }

                if($bairro == '' || $tipoEnde == '' || $endereco == '' || $numero == ''){
                    $error[6] = "Um ou mais campos na terceira página estão vázios.";
                }else if($numero < 0){
                    $error[7] = "O número de endereço não pode ser negativo.";
                }

                if($email == ''){
                    $error[8] = "Um ou mais campos na quinta página estão vazios.";
                }

                if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                    $error[9] = "O e-mail de login é inválido.";
                }

                $sql = 'SELECT emailLog FROM Estabelecimento WHERE emailLog ="'. $email.'" && emailLog !="'.$est["emailLog"].'";';
                $resul = mysqli_query($conexao, $sql);
                $numLinhas = mysqli_num_rows($resul);

                
                if($numLinhas > 0){
                    $error[10] = "O e-mail de login já é usado por outro estabelecimento.";
                }

                if($senha != "Teste" && $senha == ''){
                    $error[11] = "A nova senha não pode ser vazia.";
                }
                if($senha != "Teste" && strlen($senha) < 6){
                    $error[12] = "A nova senha deve conter no mínimo 6 caracteres.";
                }

                if (!empty($fotoLogo["name"])) {
                    if(!preg_match("/^image\/(jpg|jpeg|png|gif|bmp)$/", $fotoLogo["type"])){
                        $error[13] = "A foto de logo está em um formato inválido..";
                    }
                    $dimensoes = getimagesize($fotoLogo["tmp_name"]);

                    if($dimensoes[0] > $largura) {
                        $error[14] = "A largura da logo não deve ultrapassar ".$largura." pixels.";
                    }
    
                    if($dimensoes[1] > $altura) {
                        $error[15] = "A altura da logo não deve ultrapassar ".$altura." pixels.";
                    }
                    
                    if($fotoLogo["size"] > $tamanho) {
                        $error[16] = "A logo deve ter no máximo ".$tamanho." bytes.";
                    }

                }
                
                for($i = 1; $i <= 10; $i++){
                    $fotoFor = $foto[$i];
                    if(!empty($fotoFor["name"])){
                        if(!preg_match("/^image\/(jpg|jpeg|png|gif|bmp)$/", $fotoFor["type"])){
                            $error[17] = "Uma ou mais fotos estão em um formato inválido.";
                            break;
                        }
                        $dimensoes = getimagesize($fotoFor["tmp_name"]);

                        if($dimensoes[0] > $largura) {
                            $error[18] = "A largura da ".$i."º foto não deve ultrapassar ".$largura." pixels.";
                            break;
                        }
        
                        if($dimensoes[1] > $altura) {
                            $error[19] = "A altura da ".$i."º foto não deve ultrapassar ".$altura." pixels.";
                            break;
                        }
                        
                        if($fotoFor["size"] > $tamanho) {
                            $error[20] = "A ".$i."º foto deve ter no máximo ".$tamanho." bytes.";
                            break;
                        }
                    }
                }

                if (count($error) == 0) {
                    for($i = 0; $i <= 10; $i++){
                        if(!empty($foto[$i]["name"])){
                            if($i == 0){
                                if($fotoEstab["logo"] != ""){
                                    unlink("../../img/estabelecimento/est".$_SESSION['id']."/".$fotoEstab["logo"]);
                                }
                            }else{
                                if($fotoEstab["foto_".$i] != ""){
                                    unlink("../../img/estabelecimento/est".$_SESSION['id']."/".$fotoEstab["foto_".$i]);
                                }
                            }

                            preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $foto[$i]["name"], $ext);
        
                            $nome_imagem[$i] = md5(uniqid(time())) . "." . $ext[1];
        
                            $caminho_imagem[$i] = "../../img/estabelecimento/est". $_SESSION['id'] ."/". $nome_imagem[$i];
        
                            move_uploaded_file($foto[$i]["tmp_name"], $caminho_imagem[$i]);

                        }else{
                            if($i == 0){
                                $nome_imagem[$i] = $fotoEstab["logo"];
                            }else{
                                $nome_imagem[$i] = $fotoEstab["foto_".$i];
                            }
                        }
                    }

                    if($senha != "Teste"){
                        $senhaCrip = password_hash($senha,PASSWORD_DEFAULT);
                    }else{
                        $senhaCrip = $est["senha"];
                    }

                    $sqlInEst = 'UPDATE Estabelecimento SET nome_estabelecimento = "'.$nomeEsta.'", descricao = "'. $descricao.'", cnpj = "'.$cnpj.'", 
                                bairro = "'.$bairro.'", tipo_logradouro = "'.$tipoEnde.'", logradouro = "'.$endereco.'", numero = '.$numero.', 
                                telefone = "'.$telefone.'", horario = "'.$horario.'", instagram = "'.$instagram.'", tiktok = "'.$tiktok.'", 
                                facebook = "'.$facebook.'", emailCom = "'.$emailCom.'", emailLog = "'.$email.'", senha = "'.$senhaCrip.'", 
                                id_categoria = '.$categoria.', autorizado = "Em análise" WHERE id ='.$_SESSION["id"];
                    $resul1 = mysqli_query($conexao, $sqlInEst);

                    $sqlin = 'UPDATE Fotos_Estabelecimento SET logo = "'.$nome_imagem[0].'", foto_1 =  "'.$nome_imagem[1].'", foto_2 = "'.$nome_imagem[2].'",
                                foto_3 = "'.$nome_imagem[3].'", foto_4 = "'.$nome_imagem[4].'", foto_5 = "'.$nome_imagem[5].'", foto_6 = "'.$nome_imagem[6].'",
                                foto_7 =  "'.$nome_imagem[7].'", foto_8 = "'.$nome_imagem[8].'", foto_9 = "'.$nome_imagem[9].'", foto_10 = "'.$nome_imagem[10].'" 
                                WHERE id_estabelecimento ='.$_SESSION["id"];
                    $resul = mysqli_query($conexao, $sqlin);
                    
                    if ($resul && $resul1){
                        $certCon = 1;
                    }

                }

                $totalerro = "";
                
                if (count($error) != 0) {
                    $erroCon = 1;
                    for($i = 0; $i <= 20; $i++) {
                        if (!empty($error[$i])){
                            $totalerro .= '<p class="erroLog"> <img src="/TechWay/img/icones/iconesLink/erroImg.png" class="icones me-2" alt="Icone de certo no cadastro">'. $error[$i] .'</p>';
                        }
                    }
                }
            }

            if(isset($_POST["excluirConta"])){
                for($i = 0; $i <= 10; $i++){
                    if($i == 0){
                        if($fotoEstab["logo"] != ""){
                            unlink("../../img/estabelecimento/est".$_SESSION['id']."/".$fotoEstab["logo"]);
                        }
                    }else{
                        if($fotoEstab["foto_".$i] != ""){
                            unlink("../../img/estabelecimento/est".$_SESSION['id']."/".$fotoEstab["foto_".$i]);
                        }
                    }
                }
                rmdir('../../img/estabelecimento/est'.$_SESSION["id"]);
                $sqlExFt = 'DELETE FROM Fotos_Estabelecimento WHERE id_estabelecimento ='.$_SESSION["id"];
                $resulExFt = mysqli_query($conexao, $sqlExFt);
                
                $sqlEx = 'DELETE FROM Estabelecimento WHERE id ='.$_SESSION["id"];
                $resulEx = mysqli_query($conexao, $sqlEx);

                $excluir = 1;
            }
?>
        <main class="container">
            <section id="altEstabelecimento" class="container d-flex flex-column align-items-center">
                    
                <section class="login">
                    <ul class="nav pt-3">
                        <li class="nav-item">
                            <a class="nav-link p-0" href="../../index.php"> <i class="fa-solid fa-arrow-left"></i> Voltar à Home</a>
                        </li>
                    </ul>

                    <p class="pt-2"> Status: 
                        <?php 
                            if($est["autorizado"] == "Autorizado"){
                                echo('<span style="color: #10b313;">'.$est["autorizado"].'</span>');
                            }else if($est["autorizado"] == "Não autorizado"){
                                echo('<span style="color: #ce0000;">'.$est["autorizado"].'</span>');
                            }else{
                                echo('<span style="color: #cccc07;">'.$est["autorizado"].'</span>');
                            }
                        ?>
                    </p>

                    <section class="d-flex flex-column align-items-center pt-3 pb-3">
                        <h3> Alterar informações </h3>
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
                                <p> Contato </p>
                                <section class="bullet">
                                    <span> 2 </span>
                                </section>
                                <section class="check fas fa-check"></section>
                                
                            </section>
    
                            <section class="step">
                                <p> Endereço </p>
                                <section class="bullet">
                                    <span> 3 </span>
                                </section>
                                <section class="check fas fa-check"></section>
                            </section>
    
                            <section class="step">
                                <p> Foto </p>
                                <section class="bullet">
                                    <span> 4 </span>
                                </section>
                                <section class="check fas fa-check"></section>
                            </section>
    
                            <section class="step">
                                <p> Login </p>
                                <section class="bullet">
                                    <span> 5 </span>
                                </section>
                                <section class="check fas fa-check"></section>
                            </section>
                        </section>
                    </section>

                    <section class="form-login">

                        <form action="#" method="POST" enctype="multipart/form-data">

                            <section class="page slidepage">
                                <section class="title"> 
                                    <h4> Informações estabelecimento </h4> 
                                </section>

                                <section class="field">
                                    <label for="nomeEsta"> Nome do estabelecimento </label>
                                    <input type="text" name="nomeEsta" id="nomeEsta" placeholder="Digite o nome do estabelecimento" value="<?php echo($nomeEsta);?>">
                                    <span class="erro"> O nome do estabelecimento não pode ser vazio. </span>
                                </section>

                                <section class="field">
                                    <label for="categoria"> Selecione a categoria do estabelecimento </label>
                                    <select name="categoria" id="categoria">
                                    <?php
                                        if($categoria == 1){
                                            echo('<option value="1"> Hospedagem </option>
                                                <option value="2"> Alimentação </option>
                                                <option value="3"> Compras </option>
                                                <option value="4"> Locomoção </option>');
                                        }else if($categoria == 2){
                                            echo('<option value="2"> Alimentação </option>
                                                <option value="1"> Hospedagem </option>
                                                <option value="3"> Compras </option>
                                                <option value="4"> Locomoção </option>');
                                        }else if($categoria == 3){
                                            echo('<option value="3"> Compras </option>
                                            <option value="1"> Hospedagem </option>
                                            <option value="2"> Alimentação </option>
                                            <option value="4"> Locomoção </option>');
                                        }else{
                                            echo(' <option value="4"> Locomoção </option>
                                                <option value="1"> Hospedagem </option>
                                                <option value="2"> Alimentação </option>
                                                <option value="3"> Compras </option>');
                                        }
                                    ?>
                                    </select>
                                </section>
                                
                                <section class="field">
                                    <label for="descricao"> Descrição </label>
                                    <textarea name="descricao" id="descricao"><?php echo($descricao);?></textarea>
                                    <span class="erro"> A descrição não pode ser vazia. </span>
                                </section>

                                <section class="field">
                                    <label for="cnpj"> CNPJ </label>
                                    <input type="text" name="cnpj" id="cnpj" placeholder="Digite o CNPJ" value="<?php echo($cnpj);?>">
                                    <span class="erro"> O CNPJ não pode ser vazio. </span>
                                    <span class="erro"> O CNPJ é inválido. </span>
                                </section>

                                <section class="field">
                                    <label for="horario"> Horários de funcionamento </label>
                                    <input type="text" name="horario" id="horario" placeholder="Digite o horário de funcionamento" value="<?php echo($horario);?>">
                                    <span class="erro"> O horário de funcionamento não pode ser vazio. </span>
                                </section>


                                <section class="field btns proxBtn">
                                    <section class="button"> Próximo </section>
                                </section>
                            </section>

                            <section class="page">
                                <section class="title"> 
                                    <h5> Informações de contato </h5> 
                                </section>

                                <section class="field">
                                    <label for="telefone"> Telefone </label>
                                    <input type="tel" name="telefone" id="telefone" placeholder="Digite o telefone" value="<?php echo($telefone);?>">
                                    <span class="erro"> O telefone não pode ser vazio. </span>
                                    <span class="erro"> O número de telefone não existe. </span>
                                </section>

                                <section class="field">
                                    <label for="emailCom"> E-mail comercial </label>
                                    <input type="email" name="emailCom" id="emailCom" placeholder="Digite o email comercial" value="<?php echo($emailCom);?>">
                                    <span class="erro"> O e-mail comercial não pode ser vazio. </span>
                                    <span class="erro"> O e-mail comercial é inválido. </span>
                                </section>


                                <section class="field">
                                    <label for="facebook"> Facebook </label>
                                    <input type="text" name="facebook" id="facebook" placeholder="Digite o link do Facebook" value="<?php echo($facebook);?>">
                                    <span class="erro"> O link do facebook excede o número de caracteres. </span>
                                </section>

                                <section class="field">
                                    <label for="instagram"> Instagram </label>
                                    <input type="text" name="instagram" id="instagram" placeholder="Digite o link do Instagram" value="<?php echo($instagram);?>">
                                    <span class="erro"> O link do instagram excede o número de caracteres. </span>
                                </section>

                                <section class="field">
                                    <label for="tiktok"> TikTok </label>
                                    <input type="text" name="tiktok" id="tiktok" placeholder="Digite o link do TikTok" value="<?php echo($tiktok);?>">
                                    <span class="erro"> O link do TikTok excede o número de caracteres. </span>
                                </section>

                                <section class="field btns">
                                    <section class="button volt-1 volt"> Voltar </section>
                                    <section class="button prox-1 prox"> Próximo </section>
                                </section>
                            </section>
                            
                            <section class="page">
                                <section class="title"> 
                                    <h5> Informações Endereço: </h5> 
                                </section>

                                <section class="field">
                                    <label for="bairro"> Bairro </label>
                                    <input type="text" name="bairro" id="bairro" placeholder="Digite o nome do bairro" value="<?php echo($bairro);?>">
                                    <span class="erro"> O nome do bairro não pode ser vazio. </span>
                                </section>

                                <section class="field">
                                    <label for="tipoEnde"> Selecione o tipo de endereço </label>
                                    <select name="tipoEnde" id="tipoEnde">
                                <?php
                                    if($tipoEnde == "Avenida"){
                                        echo('<option value="Avenida"> Avenida </option>
                                            <option value="Campo"> Campo </option>
                                            <option value="Estrada"> Estrada </option>
                                            <option value="Jardim"> Jardim </option>
                                            <option value="Parque"> Parque </option>
                                            <option value="Rodovia"> Rodovia </option>
                                            <option value="Rua"> Rua </option>');
                                    }else if($tipoEnde == "Campo"){
                                        echo('<option value="Campo"> Campo </option>
                                            <option value="Avenida"> Avenida </option>
                                            <option value="Estrada"> Estrada </option>
                                            <option value="Jardim"> Jardim </option>
                                            <option value="Parque"> Parque </option>
                                            <option value="Rodovia"> Rodovia </option>
                                            <option value="Rua"> Rua </option>');
                                    }else if($tipoEnde == "Estrada"){
                                        echo('<option value="Estrada"> Estrada </option>
                                            <option value="Avenida"> Avenida </option>
                                            <option value="Campo"> Campo </option>
                                            <option value="Jardim"> Jardim </option>
                                            <option value="Parque"> Parque </option>
                                            <option value="Rodovia"> Rodovia </option>
                                            <option value="Rua"> Rua </option>');
                                    }else if($tipoEnde == "Jardim"){
                                        echo('<option value="Jardim"> Jardim </option>
                                            <option value="Avenida"> Avenida </option>
                                            <option value="Campo"> Campo </option>
                                            <option value="Estrada"> Estrada </option>
                                            <option value="Parque"> Parque </option>
                                            <option value="Rodovia"> Rodovia </option>
                                            <option value="Rua"> Rua </option>');
                                    }else if($tipoEnde == "Parque"){
                                        echo('<option value="Parque"> Parque </option>
                                            <option value="Avenida"> Avenida </option>
                                            <option value="Campo"> Campo </option>
                                            <option value="Estrada"> Estrada </option>
                                            <option value="Jardim"> Jardim </option>
                                            <option value="Rodovia"> Rodovia </option>
                                            <option value="Rua"> Rua </option>');
                                    }else if($tipoEnde == "Rodovia"){
                                        echo('<option value="Rodovia"> Rodovia </option>
                                            <option value="Avenida"> Avenida </option>
                                            <option value="Campo"> Campo </option>
                                            <option value="Estrada"> Estrada </option>
                                            <option value="Jardim"> Jardim </option>
                                            <option value="Parque"> Parque </option>
                                            <option value="Rua"> Rua </option>');
                                    }else{
                                        echo('<option value="Rua"> Rua </option>
                                            <option value="Avenida"> Avenida </option>
                                            <option value="Campo"> Campo </option>
                                            <option value="Estrada"> Estrada </option>
                                            <option value="Jardim"> Jardim </option>
                                            <option value="Parque"> Parque </option>
                                            <option value="Rodovia"> Rodovia </option>');
                                    }
                                ?>
                                    </select>
                                </section>

                                <section class="field">
                                    <label for="endereco"> Endereço </label>
                                    <input type="text" name="endereco" id="endereco" placeholder="Digite o nome do endereço" value="<?php echo($endereco);?>">
                                    <span class="erro"> O nome do endereço não pode ser vazio. </span>
                                </section>

                                <section class="field">
                                    <label for="numero"> Número </label>
                                    <input type="number" name="numero" id="numero" placeholder="Digite o número do endereço" min="0" value="<?php echo($numero);?>">
                                    <span class="erro"> O número não pode ser vazio. </span>
                                    <span class="erro"> O número não pode ser negativo. </span>
                                </section>


                                <section class="field btns">
                                    <section class="button volt-2 volt"> Voltar </section>
                                    <section class="button prox-2 prox"> Próximo </section>
                                </section>
                            </section>

                            <section class="page">
                                <section class="title"> 
                                    <h5> Fotos estabelecimento </h5> 
                                </section>

                                <section class="field">
                                    <label for="fotoLogo"> Selecione uma foto da logo do estabelecimento </label>
                                    <input type="file" name="fotoLogo" id="fotoLogo" onchange="validarArquivo('#fotoLogo 0')" accept="image/jpeg, image/gif, image/png">
                                    <label for="fotoLogo" class="file"> <i class="fa-solid fa-upload"></i> Escolher imagem </label>
                                    <span class="certo"> Imagem selecionada com sucesso! </span>
                                </section>

                                
                                <section class="field">
                                    <label for="fotoPrim"> Selecione uma ou mais fotos do estabelecimento </label>
                                    <input type="file" name="fotoPrim" id="fotoPrim"  onchange="validarArquivo('#fotoPrim 1')" accept="image/jpeg, image/gif, image/png">
                                    <label for="fotoPrim" class="file"> <i class="fa-solid fa-upload"></i> Escolher imagem </label>
                                    <span class="certo"> Imagem selecionada com sucesso! </span>
                                    <span class="erro"> Selecione pelo menos a logo e a primeira imagem </span>
                                </section>

                                <section class="addImg">
                                    
                                    <section class="field pt-2">
                                        <input type="file" name="fotoSecu" id="fotoSecu" onchange="validarArquivo('#fotoSecu 2')" accept="image/jpeg, image/gif, image/png">
                                        <label for="fotoSecu" class="file"> <i class="fa-solid fa-upload"></i> Escolher imagem </label>
                                        <span class="certo"> Imagem selecionada com sucesso! </span>
                                    </section>
                                    
                                    <section class="field pt-2">
                                        <input type="file" name="fotoTerc" id="fotoTerc" onchange="validarArquivo('#fotoTerc 3')" accept="image/jpeg, image/gif, image/png">
                                        <label for="fotoTerc" class="file"> <i class="fa-solid fa-upload"></i> Escolher imagem </label>
                                        <span class="certo"> Imagem selecionada com sucesso! </span>
                                    </section>
                                    
                                    <section class="field pt-2">
                                        <input type="file" name="fotoQuart" id="fotoQuart" onchange="validarArquivo('#fotoQuart 4')" accept="image/jpeg, image/gif, image/png">
                                        <label for="fotoQuart" class="file"> <i class="fa-solid fa-upload"></i> Escolher imagem </label>
                                        <span class="certo"> Imagem selecionada com sucesso! </span>
                                    </section>
                                    
                                    <section class="field pt-2">
                                        <input type="file" name="fotoQuin" id="fotoQuin" onchange="validarArquivo('#fotoQuin 5')" accept="image/jpeg, image/gif, image/png">
                                        <label for="fotoQuin" class="file"> <i class="fa-solid fa-upload"></i> Escolher imagem </label>
                                        <span class="certo"> Imagem selecionada com sucesso! </span>
                                    </section>

                                    <section class="field pt-2">
                                        <input type="file" name="fotoSext" id="fotoSext" onchange="validarArquivo('#fotoSext 6')" accept="image/jpeg, image/gif, image/png">
                                        <label for="fotoSext" class="file"> <i class="fa-solid fa-upload"></i> Escolher imagem </label>
                                        <span class="certo"> Imagem selecionada com sucesso! </span>
                                    </section>

                                    <section class="field pt-2">
                                        <input type="file" name="fotoSeti" id="fotoSeti" onchange="validarArquivo('#fotoSeti 7')" accept="image/jpeg, image/gif, image/png">
                                        <label for="fotoSeti" class="file"> <i class="fa-solid fa-upload"></i> Escolher imagem </label>
                                        <span class="certo"> Imagem selecionada com sucesso! </span>
                                    </section>
                                    
                                    <section class="field pt-2">
                                        <input type="file" name="fotoOito" id="fotoOito" onchange="validarArquivo('#fotoOito 8')" accept="image/jpeg, image/gif, image/png">
                                        <label for="fotoOito" class="file"> <i class="fa-solid fa-upload"></i> Escolher imagem </label>
                                        <span class="certo"> Imagem selecionada com sucesso! </span>
                                    </section>

                                    <section class="field pt-2">
                                        <input type="file" name="fotoNove" id="fotoNove" onchange="validarArquivo('#fotoNove 9')" accept="image/jpeg, image/gif, image/png">
                                        <label for="fotoNove" class="file"> <i class="fa-solid fa-upload"></i> Escolher imagem </label>
                                        <span class="certo"> Imagem selecionada com sucesso! </span>
                                    </section>
                                    
                                    <section class="field pt-2">
                                        <input type="file" name="fotoDeci" id="fotoDeci" onchange="validarArquivo('#fotoDeci 10')" accept="image/jpeg, image/gif, image/png">
                                        <label for="fotoDeci" class="file"> <i class="fa-solid fa-upload"></i> Escolher imagem </label>
                                        <span class="certo"> Imagem selecionada com sucesso! </span>
                                    </section>

                                    <span class="erroImg"> Selecione a última imagem primeiro </span>
                                    <p class="addImgBtn d-flex align-items-center gap-1 m-0"> <i class="fa-solid fa-plus"></i> Adicionar imagem </p>
                                </section>
                                
                                <section class="field btns">
                                    <section class="button volt-3 volt"> Voltar </section>
                                    <section class="button prox-3 prox"> Próximo </section>
                                </section>
                    
                            </section>

                            <section class="page">
                                <section class="title"> 
                                    <h5> Informações de login </h5> 
                                </section>

                                <section class="field">
                                    <label for="email"> E-mail </label>
                                    <input type="email" name="email" id="email" placeholder="Digite o email de login" value="<?php echo($email);?>">
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
                                    <section class="button volt-4 volt"> Voltar </section>
                                    <section class="button submit"> Atualizar </section>
                                    <input type="submit" name="atualizarEst" id="atualizarEst" value="Cadastrar" class="d-none">
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
        <script src="/TechWay/js/formAltEstab.js" defer></script>
    </body>
</html>
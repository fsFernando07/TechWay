<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    
    require_once('../biblioteca/PHPMailer/src/Exception.php');
    require_once('../biblioteca/PHPMailer/src/PHPMailer.php');
    require_once('../biblioteca/PHPMailer/src/SMTP.php');

            require_once('./header.php');
            if(isset($_SESSION["id"])){
                header('location: ../index.php');
            }
?>
    <script src="/TechWay/js/formSucErr.js"></script>
<?php
            if(!isset($_POST["cadastrarEst"])){
                $nomeEsta = "";
                $categoria = ""; 
                $descricao = ""; 
                $cnpj = "";              
                $horario = "";

                $telefone = ""; 
                $emailCom = ""; 
                $facebook = ""; 
                $instagram = ""; 
                $tiktok = "";

                $bairro = "";                
                $tipoEnde = ""; 
                $endereco = ""; 
                $numero = "";
                
                $email = "";
                $senha = "";
                $confSenha = "";

                $totalerro = "";
            }

            if(isset($_POST["cadastrarEst"])){
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
                $senha = $_POST["senha"];
                $confSenha = $_POST["confSenha"];

                $numErro = 0;

                $error = array();

                $largura = 4000;

                $altura = 4000;

                $tamanho = 1024 * 1024 * 3;

                if($nomeEsta == '' || $categoria == '' || $descricao == '' || $cnpj == '' || $horario == ''){
                    $error[0] = "Um ou mais campos da primeira página estão vazios.";
                }else if(strlen($cnpj) < 18){
                    $error[1] = "O CNPJ é inválido.";
                }

                if($telefone == '' || $emailCom == ''){
                    $error[2] = "Telefone ou e-mail comercial na segunda página estão vazios.";
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

                if($email == '' || $senha == '' || $confSenha == ''){
                    $error[8] = "Um ou mais campos na quinta página estão vazios.";
                }

                if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                    $error[9] = "O e-mail de login é inválido.";
                }

                $sql = 'SELECT emailLog FROM Estabelecimento WHERE emailLog ="'. $email.'";';
                $resul = mysqli_query($conexao, $sql);
                $numLinhas = mysqli_num_rows($resul);

                $sqlSel = "SELECT AUTO_INCREMENT as id FROM information_schema.tables WHERE table_name = 'Estabelecimento' AND table_schema = 'BD_Techway' ;";;
                $resulSel = mysqli_query($conexao, $sqlSel);
                $estArray = mysqli_fetch_array($resulSel);
                $numLinhasSel = $estArray['id'];
                
                if($numLinhas > 0){
                    $error[10] = "O e-mail de login já é usado por outro estabelecimento.";
                }

                if(strlen($senha) < 6){
                    $error[11] = "A senha deve conter no mínimo 6 caracteres.";
                }

                if($senha != $confSenha){
                    $error[12] = "A confirmação de senha deve ser igual a senha.";
                }

                if (!empty($fotoLogo["name"])) {
                    if(!preg_match("/^image\/(jpg|jpeg|png|gif|bmp)$/", $fotoLogo["type"])){
                        $error[13] = "A foto de logo está em um formato inválido.";
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

                }else{
                    $error[17] = "A logo está vazia.";
                }
                
                for($i = 1; $i <= 10; $i++){
                    $fotoFor = $foto[$i];
                    if(!empty($foto[1]["name"])){
                        if(!empty($fotoFor["name"])){
                            if(!preg_match("/^image\/(jpg|jpeg|png|gif|bmp)$/", $fotoFor["type"])){
                                $error[18] = "Uma ou mais fotos estão em um formato inválido..";
                                break;
                            }
                            $dimensoes = getimagesize($fotoFor["tmp_name"]);
    
                            if($dimensoes[0] > $largura) {
                                $error[19] = "A largura da ".$i."º foto não deve ultrapassar ".$largura." pixels.";
                                break;
                            }
            
                            if($dimensoes[1] > $altura) {
                                $error[20] = "A altura da ".$i."º foto não deve ultrapassar ".$altura." pixels.";
                                break;
                            }
                            
                            if($fotoFor["size"] > $tamanho) {
                                $error[21] = "A ".$i."º foto deve ter no máximo ".$tamanho." bytes.";
                                break;
                            }
                        }
                    }else{
                        $error[22] = "A primeira foto está vazia.";
                    }
                }

                if (count($error) == 0) {
                    mkdir("../img/estabelecimento/est".$numLinhasSel);
                    for($i = 0; $i <= 10; $i++){
                        if(!empty($foto[$i]["name"])){

                            preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $foto[$i]["name"], $ext);
        
                            $nome_imagem[$i] = md5(uniqid(time())) . "." . $ext[1];
        
                            $caminho_imagem[$i] = "../img/estabelecimento/est". $numLinhasSel ."/". $nome_imagem[$i];
        
                            move_uploaded_file($foto[$i]["tmp_name"], $caminho_imagem[$i]);

                        }else{
                            $nome_imagem[$i] = '';
                        }
                    }

                    $senhaCrip = password_hash($senha,PASSWORD_DEFAULT);

                    $sqlInEst = 'INSERT INTO Estabelecimento (nome_estabelecimento, descricao, cnpj, bairro, tipo_logradouro, logradouro, numero, telefone, horario, instagram, tiktok, facebook, emailCom, emailLog, senha, id_categoria, autorizado)
                    VALUES ("'.$nomeEsta.'", "'. $descricao.'", "'.$cnpj.'","'.$bairro.'","'.$tipoEnde.'","'.$endereco.'", '.$numero.',"'.$telefone.'", "'.$horario.'","'.$instagram.'","'.$tiktok.'","'.$facebook.'","'.$emailCom.'","'.$email.'","'.$senhaCrip.'",'.$categoria.',"Em análise")';
                    $resul1 = mysqli_query($conexao, $sqlInEst);

                    $sqlin = 'INSERT INTO Fotos_Estabelecimento (id_estabelecimento, logo, foto_1, foto_2, foto_3, foto_4, foto_5, foto_6, foto_7, foto_8, foto_9, foto_10) 
                    VALUES ("'.$numLinhasSel.'", "'.$nome_imagem[0].'", "'.$nome_imagem[1].'", "'.$nome_imagem[2].'", "'.$nome_imagem[3].'", "'.$nome_imagem[4].'", "'.$nome_imagem[5].'", "'.$nome_imagem[6].'", "'.$nome_imagem[7].'", "'.$nome_imagem[8].'", "'.$nome_imagem[9].'", "'.$nome_imagem[10].'");';
                    $resul = mysqli_query($conexao, $sqlin);
                    
                    if ($resul && $resul1){
                        $certCon = 1;
                    }

                }

                $totalerro = "";
                
                if (count($error) != 0) {
                    $erroCon = 1;
                    for($i = 0; $i <= 22; $i++) {
                        if (!empty($error[$i])){
                            $totalerro .= '<p class="erroLog"> <img src="/TechWay/img/icones/iconesLink/erroImg.png" class="icones me-2" alt="Icone de certo no cadastro">'. $error[$i] .'</p>';
                        }
                    }
                }
            }

            if(!isset($_POST["cadastrarUsu"])){
                $nomeUsuCad = "";
                $emailUsuCad = "";
                $senhaUsuCad = "";
                $confSenhaUsu = "";

                $totalerro = "";
            }

            if(isset($_POST["cadastrarUsu"])){
                $nomeUsuCad = $_POST["nomeUsuCad"];
                $emailUsuCad = $_POST["emailUsuCad"];
                $senhaUsuCad = $_POST["senhaUsuCad"];
                $confSenhaUsu = $_POST["confSenhaUsu"];

                $error = array();

                if($nomeUsuCad == '' || $emailUsuCad == '' || $senhaUsuCad == '' || $confSenhaUsu == ''){
                    $error[0] = "Um ou mais campos estão vazios.";
                }

                if(!filter_var($emailUsuCad, FILTER_VALIDATE_EMAIL)){
                    $error[1] = "O e-mail é inválido.";
                }

                $sql = 'SELECT email FROM Usuario WHERE email ="'. $emailUsuCad.'";';
                $resul = mysqli_query($conexao, $sql);
                $numLinhas = mysqli_num_rows($resul);

                $sqlSel = "SELECT AUTO_INCREMENT as id FROM information_schema.tables WHERE table_name = 'Usuario' AND table_schema = 'BD_Techway' ;";
                $resulSel = mysqli_query($conexao, $sqlSel);
                $usuArray = mysqli_fetch_array($resulSel);
                $numLinhasSel = $usuArray["id"];
                
                if($numLinhas > 0){
                    $error[2] = "O e-mail já está em uso por outro usuário.";
                }

                if(strlen($senhaUsuCad) < 6){
                    $error[3] = "A senha deve conter no mínimo 6 caracteres.";
                }

                if($senhaUsuCad != $confSenhaUsu){
                    $error[4] = "A confirmação de senha deve ser igual a senha.";
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
                    mkdir("../img/usuario/usu".$numLinhasSel);
                    $senhaCrip = password_hash($senhaUsuCad,PASSWORD_DEFAULT);
                    $sqlIn = 'INSERT INTO Usuario(nome,email,senha) VALUES("'.$nomeUsuCad.'","'.$emailUsuCad.'","'.$senhaCrip.'")';
                    $resul = mysqli_query($conexao, $sqlIn);
                    
                    if ($resul){
                        $certCon = 1;
                    }
                }
            }

            if(isset($_POST["enviarLogGoogle"])){
                $nome = $_POST["nomeUsuGoogle"];
                $email = $_POST["emailUsuGoogle"];
                $verEmail = $_POST["verEmailUsuGoogle"];
                $idGoogle = $_POST["idUsuGoogle"];

                $sql = 'SELECT * FROM Usuario WHERE email ="'. $email .'" && senha != "";';
                $resul = mysqli_query($conexao, $sql);
                $numLinhas = mysqli_num_rows($resul);

                $sqlId = 'SELECT * FROM Usuario WHERE id_google ="'.$idGoogle.'";';
                $resulId = mysqli_query($conexao, $sqlId);
                $numLinhasId = mysqli_num_rows($resulId);

                $sqlSel = "SELECT AUTO_INCREMENT as id FROM information_schema.tables WHERE table_name = 'Usuario' AND table_schema = 'BD_Techway' ;";
                $resulSel = mysqli_query($conexao, $sqlSel);
                $usuArray = mysqli_fetch_array($resulSel);
                $numLinhasSel = $usuArray["id"];

                if($numLinhas > 0){
                    $error = "O email já está em uso por outro usuário.";
                    $erroCon = 1;
                    $totalerro = '<p class="erroLog"> <img src="/TechWay/img/icones/iconesLink/erroImg.png" class="icones me-2" alt="Icone de certo no cadastro">'. $error .'</p>';
                }else{
                    if($numLinhasId == 0 && $verEmail == True){
                        mkdir("../img/usuario/usu".$numLinhasSel);
                        $sqlIn = 'INSERT INTO Usuario(nome,email,id_google) VALUES("'.$nome.'","'.$email.'","'.$idGoogle.'")';
                        $resul = mysqli_query($conexao, $sqlIn);
                        
                        if ($resul){
                            $sqlId = 'SELECT * FROM Usuario WHERE id_google ="'.$idGoogle.'";';
                            $resulId = mysqli_query($conexao, $sqlId);

                            $contr = mysqli_fetch_array($resulId);
                            $_SESSION['id'] = $contr['id'];
                            $_SESSION['tipo'] = 'Usuario';
                            header('location: ../index.php');
                        }
                    }
    
                    if($numLinhasId > 0 && $verEmail == True){
                        $contr = mysqli_fetch_array($resulId);
                        $_SESSION['id'] = $contr['id'];
                        $_SESSION['tipo'] = 'Usuario';
                        header('location: ../index.php');
                    }
                }

            }

            if(!isset($_POST["loginUsu"])){
                $emailUsu = "";
                $senhaUsu = "";

                $totalerro = "";
            }

            if(isset($_POST["loginUsu"])){
                $emailUsu = $_POST["emailUsu"];
                $senhaUsu = $_POST["senhaUsu"];

                $sqlSel = 'SELECT * FROM Usuario WHERE email ="'. $emailUsu .'";';
                $resul = mysqli_query($conexao, $sqlSel);
                $numLinhas = mysqli_num_rows($resul);

                $error = array();

                if($numLinhas > 0){
                    while($contr = mysqli_fetch_array($resul)){
                        if(password_verify($senhaUsu , $contr['senha'])){
                            $_SESSION['id'] = $contr['id'];
                            $_SESSION['tipo'] = 'Usuario';
                            header('location: ../index.php');
                        }
                    }
                    $error[0] = "A senha está incorreta.";
                }else{
                    $error[1] = "Não existe um usuário com este e-mail.";
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

            if(!isset($_POST["loginEst"])){
                $emailLogEstab = "";
                $senhaLogEstab = "";

                $totalerro = "";
            }

            if(isset($_POST["loginEst"])){
                $emailLogEstab = $_POST["emailLogEstab"];
                $senhaLogEstab = $_POST["senhaLogEstab"];

                $sqlSel = 'SELECT * FROM Estabelecimento WHERE emailLog ="'. $emailLogEstab .'";';
                $resul = mysqli_query($conexao, $sqlSel);
                $numLinhas = mysqli_num_rows($resul);

                $error = array();

                if($numLinhas > 0){
                    while($contr = mysqli_fetch_array($resul)){
                        if(password_verify($senhaLogEstab , $contr['senha'])){
                            $_SESSION['id'] = $contr['id'];
                            $_SESSION['tipo'] = 'Estabelecimento';
                            header('location: ./cadastrado/alterarEst.php');
                        }
                    }
                    $error[0] = "A senha está incorreta.";
                }else{
                    $error[1] = "Não existe um usuário com este e-mail.";
                }

                if (count($error) != 0) {
                    $erroCon = 1;
                    for($i = 0; $i <= 2; $i++) {
                        if (!empty($error[$i])){
                            $totalerro .= '<p class="erroLog"> <img src="/TechWay/img/icones/iconesLink/erroImg.png" class="icones me-2" alt="Icone de certo no cadastro">'. $error[$i] .'</p>';
                        }
                    }
                }

            }

            if(!isset($_POST["loginMoni"])){
                $emailLogMoni = "";
                $senhaLogMoni = "";

                $totalerro = "";
            }

            if(isset($_POST["loginMoni"])){
                $emailLogMoni = $_POST["emailLogMoni"];
                $senhaLogMoni = $_POST["senhaLogMoni"];

                $sqlSel = 'SELECT * FROM Monitor WHERE email ="'. $emailLogMoni .'";';
                $resul = mysqli_query($conexao, $sqlSel);
                $numLinhas = mysqli_num_rows($resul);

                $error = array();

                if($numLinhas > 0){
                    while($contr = mysqli_fetch_array($resul)){
                        if(password_verify($senhaLogMoni , $contr['senha'])){
                            $_SESSION['id'] = $contr['id'];
                            $_SESSION['tipo'] = 'Monitor';
                            header('location: ./cadastrado/alterarMon.php');
                        }
                    }
                    $error[0] = "A senha está incorreta.";
                }else{
                    $error[1] = "Não existe um usuário com este e-mail.";
                }

                if (count($error) != 0) {
                    $erroCon = 1;
                    for($i = 0; $i <= 2; $i++) {
                        if (!empty($error[$i])){
                            $totalerro .= '<p class="erroLog"> <img src="/TechWay/img/icones/iconesLink/erroImg.png" class="icones me-2" alt="Icone de certo no cadastro">'. $error[$i] .'</p>';
                        }
                    }
                }

            }

            if(!isset($_POST["cadastrarMon"])){
                $nomeMoni = '';
                $tipoMoni = '';
                $descricaoMoni = '';
                $numMoniCadastur = '';
                $generoMoni = '';

                $areaAtuacao = '';
                $idiomaSec = '';
                $telefoneMoni = '';
                $facebookMoni = '';
                $instagramMoni = '';
                $tiktokMoni = '';

                $emailMoni = '';
                $senhaMoni = '';
                $confSenhaMoni = '';

                $totalerro = "";
            }

            if(isset($_POST["cadastrarMon"])){
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
                $senhaMoni = $_POST["senhaMoni"];
                $confSenhaMoni = $_POST["confSenhaMoni"];

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

                if($emailMoni == '' || $senhaMoni == '' || $confSenhaMoni == ''){
                    $error[5] = "Um ou mais campos na quarta página estão vazios.";
                }

                if(!filter_var($emailMoni, FILTER_VALIDATE_EMAIL)){
                    $error[6] = "O e-mail de login é inválido.";
                }

                $sql = 'SELECT email FROM Monitor WHERE email ="'. $emailMoni.'";';
                $resul = mysqli_query($conexao, $sql);
                $numLinhas = mysqli_num_rows($resul);

                $sqlSel = "SELECT AUTO_INCREMENT as id FROM information_schema.tables WHERE table_name = 'Monitor' AND table_schema = 'BD_Techway' ;";;
                $resulSel = mysqli_query($conexao, $sqlSel);
                $monArray = mysqli_fetch_array($resulSel);
                $numLinhasSel = $monArray['id'];

                if($numLinhas > 0){
                    $error[7] = "O e-mail de login já está em uso por outro usuário.";
                }

                if(strlen($senhaMoni) < 6){
                    $error[8] = "A senha deve conter no mínimo 6 caracteres.";
                }

                if($senhaMoni != $confSenhaMoni){
                    $error[9] = "A confirmação de senha deve ser igual a senha.";
                }

                if (!empty($fotoPerfil["name"])) {
                    if(!preg_match("/^image\/(jpg|jpeg|png|gif|bmp)$/", $fotoPerfil["type"])){
                        $error[10] = "A foto de logo está em um formato inválido.";
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

                }else{
                    $error[14] = "A foto de perfil está vazia.";
                }
                
                for($i = 1; $i <= 5; $i++){
                    $fotoFor = $fotoMoni[$i];
                    if(!empty($fotoMoni[1]["name"])){
                        if(!empty($fotoFor["name"])){
                            if(!preg_match("/^image\/(jpg|jpeg|png|gif|bmp)$/", $fotoFor["type"])){
                                $error[15] = "Uma ou mais fotos estão em um formato inválido..";
                                break;
                            }
                            $dimensoes = getimagesize($fotoFor["tmp_name"]);
    
                            if($dimensoes[0] > $largura) {
                                $error[16] = "A largura da ".$i."º foto não deve ultrapassar ".$largura." pixels.";
                                break;
                            }
            
                            if($dimensoes[1] > $altura) {
                                $error[17] = "A altura da ".$i."º foto não deve ultrapassar ".$altura." pixels.";
                                break;
                            }
                            
                            if($fotoFor["size"] > $tamanho) {
                                $error[18] = "A ".$i."º foto deve ter no máximo ".$tamanho." bytes.";
                                break;
                            }
                        }
                    }else{
                        $error[19] = "A primeira foto está vazia.";
                    }
                }

                if (count($error) == 0) {
                    mkdir("../img/monitor/mon".$numLinhasSel);
                    for($i = 0; $i <= 5; $i++){
                        if(!empty($fotoMoni[$i]["name"])){

                            preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $fotoMoni[$i]["name"], $ext);
        
                            $nome_imagem[$i] = md5(uniqid(time())) . "." . $ext[1];
        
                            $caminho_imagem[$i] = "../img/monitor/mon". $numLinhasSel ."/". $nome_imagem[$i];
        
                            move_uploaded_file($fotoMoni[$i]["tmp_name"], $caminho_imagem[$i]);

                        }else{
                            $nome_imagem[$i] = '';
                        }
                    }

                    $senhaCrip = password_hash($senhaMoni,PASSWORD_DEFAULT);

                    $sqlInMon = 'INSERT INTO Monitor (nome, descricao, numero_cadastur, genero, id_tipo, areas_especializacao, idiomas, telefone, instagram, tiktok, facebook, email, senha, autorizado)
                    VALUES ("'.$nomeMoni.'", "'. $descricaoMoni.'", "'.$numMoniCadastur.'","'.$generoMoni.'",'.$tipoMoni.',"'.$areaAtuacao.'","'.$idiomaSec.'","'.$telefoneMoni.'", "'.$instagramMoni.'","'.$tiktokMoni.'","'.$facebookMoni.'","'.$emailMoni.'","'.$senhaCrip.'", "Em análise")';
                    $resul1 = mysqli_query($conexao, $sqlInMon);

                    $sqlin = 'INSERT INTO Fotos_Monitor (id_monitor, foto_perfil , foto_1, foto_2, foto_3, foto_4, foto_5) 
                    VALUES ('.$numLinhasSel.', "'.$nome_imagem[0].'", "'.$nome_imagem[1].'", "'.$nome_imagem[2].'", "'.$nome_imagem[3].'", "'.$nome_imagem[4].'", "'.$nome_imagem[5].'");';
                    $resul = mysqli_query($conexao, $sqlin);
                    
                    if ($resul && $resul1){
                        $certCon = 1;
                    }

                }

                $totalerro = "";
                
                if (count($error) != 0) {
                    $erroCon = 1;
                    for($i = 0; $i <= 19; $i++) {
                        if (!empty($error[$i])){
                            $totalerro .= '<p class="erroLog"> <img src="/TechWay/img/icones/iconesLink/erroImg.png" class="icones me-2" alt="Icone de certo no cadastro">'. $error[$i] .'</p>';
                        }
                    }
                }
            }

            if(!isset($_POST["esqSenhaSub"])){
                $emailEsq = "";

                $totalerro = "";
            }

            if(isset($_POST["esqSenhaSub"])){
                $emailEsq = $_POST["emailEsq"];
                $tabela = $_POST["tabela"];

                $msg = "";
                $msg = $tabela == "Usuario" ? "usuário" : $msg;
                $msg = $tabela == "Estabelecimento" ? "estabelecimento" : $msg;
                $msg = $tabela == "Monitor" ? "monitor" : $msg;

                if($tabela == "Estabelecimento"){
                    $sqlSel = 'SELECT * FROM '.$tabela.' WHERE emailLog ="'. $emailEsq .'";';
                    $nome = "nome_estabelecimento";
                }else{
                    $sqlSel = 'SELECT * FROM '.$tabela.' WHERE email ="'. $emailEsq .'";';
                    $nome = "nome";
                }

                $resul = mysqli_query($conexao, $sqlSel);
                $contr = mysqli_fetch_array($resul);
                $numLinhas = mysqli_num_rows($resul);

                $error = array();

                if($numLinhas > 0){
                    $chaveRecuperarSenha = password_hash($contr["id"], PASSWORD_DEFAULT);

                    $sqlUp = 'UPDATE '.$tabela.' SET recuperar_senha = "'.$chaveRecuperarSenha.'" WHERE id ='.$contr["id"];
                    $resulUp = mysqli_query($conexao, $sqlUp);

                    $link = "http://localhost/TechWay/src/atualizarSenha.php?chave=$chaveRecuperarSenha&tabela=$tabela";

                    if($resulUp){
                        $mail = new PHPMailer(true);
                        try{
                            $mail->SMTPDebug = 0;
                            $mail->CharSet = "UTF-8";
                            $mail->isSMTP();
                            $mail->Host       = 'sandbox.smtp.mailtrap.io';
                            $mail->SMTPAuth   = true;
                            $mail->Username   = '82b5a5794b28b8';
                            $mail->Password   = '5a05d8aa21d876';
                            $mail->SMTPSecure = 'tls';
                            $mail->Port       = 465;
                            
                            $mail->setFrom('techwaytcc@gmail.com', 'TechWay');
                            $mail->addAddress($emailEsq, $contr[$nome]);
                            
                            $mail->isHTML(true);                 
                            $mail->Subject = 'Recuperar a Senha';
                            $mail->Body    = 'Prezado(a) '.$contr[$nome].'.<br> Você solicitou a alteração de sua senha. <br><br>
                                            Para continuar a alteração de sua senha, clique no link abaixo ou cole o endereço no seu
                                            navegador: <a href="'.$link.'">
                                                '.$link.'
                                            </a> <br>
                                            Se você não solicitou essa alteração, nenhuma ação é necessária. Sua senha permanecerá a mesma até
                                            que você ative este código.';
                            $mail->AltBody = 'Prezado(a) '.$contr[$nome].'. Você solicitou a alteração de sua senha. \n\n
                                            Para continuar a alteração de sua senha, clique no link abaixo ou cole o endereço no seu
                                            navegador: \n
                                                '.$link.' \n
                                            Se você não solicitou essa alteração, nenhuma ação é necessária. Sua senha permanecerá a mesma até
                                            que você ative este código.';

                            $mail->send();

                            $certEma = 1;

                            echo('<script>
                                setTimeout(function(){
                                    window.location.href = "login.php";
                                }, 5000);
                            </script>');
                        }catch (Exception $e) {
                            $error[0] = "Erro: O e-mail não pode ser enviado. Mailer Error: {$mail->ErrorInfo}";
                        }

                    }

                }else{
                    $error[1] = "Não existe um ".$msg." com este email";
                }

                if (count($error) != 0) {
                    $erroCon = 1;
                    for($i = 0; $i <= 2; $i++) {
                        if (!empty($error[$i])){
                            $totalerro .= '<p class="erroLog"> <img src="/TechWay/img/icones/iconesLink/erroImg.png" class="icones me-2" alt="Icone de certo no cadastro">'. $error[$i] .'</p>';
                        }
                    }
                }
            }

            require_once('./headerResponsivo.php');
?>
        <script src="https://accounts.google.com/gsi/client" async></script>

        <main class="container d-flex align-items-center">
            <section class="container tab-content d-block">
                <section class="tab-pane active" id="login">
                    
                    <section class="container d-flex justify-content-center pb-3">
                        <h1> Fazer Login </h1>
                    </section>
                    
                    <section class="secaoLogin d-flex flex-row justify-content-sm-between flex-wrap">
                        
                        <section class="card border-0">
                            <section class="card-body">
                                <section class="d-flex flex-column align-items-center">
                                    <img src="/TechWay/img/icones/iconesLink/usuarioImg.png" class="iconesLogin" alt="Icone usuário">
                                    <h4 class="pt-3"> Usuário </h4>
                                    <ul class="nav mb-3 gap-4">
                                        <li class="nav-item d-none">
                                            <a class="nav-link active d-none" data-bs-toogle="tab" href="#login"></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="botao nav-link" data-bs-toggle="tab" href="#cadUsuario"> Fazer Cadastro </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="botao nav-link" data-bs-toggle="tab" href="#loginUsuario"> Fazer Login </a>
                                        </li>

                                    </ul>
                                    <section id="botaoGoogle"></section>
                                </section>
                            </section>
                        </section>
        
                        <section class="card border-0">
                            <section class="card-body">
                                <section class="d-flex flex-column align-items-center">
                                    <img src="/TechWay/img/icones/iconesLink/estabelecimentoImg.png" class="iconesLogin" alt="Icone estabelecimento">
                                    <h4 class="pt-3"> Estabelecimento </h4>
                                    <ul class="nav gap-4">
                                        <li class="nav-item d-none">
                                            <a class="nav-link active d-none" data-bs-toogle="tab" href="#login"></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="botao nav-link" data-bs-toggle="tab" href="#cadEstabelecimento"> Fazer Cadastro </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="botao nav-link" data-bs-toggle="tab" href="#loginEstabelecimento"> Fazer Login </a>
                                        </li>
                                    </ul>
                                </section>
                            </section>
                        </section>
    
                        <section class="card border-0">
                            <section class="card-body">
                                <section class="d-flex flex-column align-items-center">
                                    <img src="/TechWay/img/icones/iconesLink/monitorImg.png" class="iconesLogin" alt="Icone guia e monitor">
                                    <h4 class="pt-3"> Guias e monitores </h4>
                                    <ul class="nav gap-4">
                                        <li class="nav-item d-none">
                                            <a class="nav-link active d-none" data-bs-toogle="tab" href="#login"></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="botao nav-link" data-bs-toggle="tab" href="#cadMonitor"> Fazer cadastro </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="botao nav-link" data-bs-toggle="tab" href="#loginMonitor"> Fazer login </a>
                                        </li>
                                    </ul>
                                </section>
                            </section>
                        </section>
                        
                    </section>

                </section>
                
                <section class="tab-pane fade" id="cadUsuario">
                
                    <section class="login">
                        <ul class="nav pt-3">
                            <li class="nav-item">
                                <a class="nav-link p-0" href="login.php"> <i class="fa-solid fa-arrow-left"></i> Voltar </a>
                            </li>
                        </ul>

                        <section class="d-flex flex-column align-items-center pt-3 pb-3">
                            <h3> Que bom ter você aqui! </h3>
                        </section>
                        <section class="form-loginEmail cad">
                            
                            <form action="#" method="POST">
                                
                                <section class="page">
                                    <section class="title"> 
                                        <h5> Informações de cadastro </h5> 
                                    </section>
                                    
                                    <section class="field">
                                        <label for="nomeUsuCad"> Nome </label>
                                        <input type="text" name="nomeUsuCad" id="nomeUsuCad" placeholder="Digite o seu nome" value="<?php echo($nomeUsuCad);?>">
                                        <span class="erro"> O nome não pode ser vazio. </span>
                                    </section>
                                    
                                    <section class="field">
                                        <label for="emailUsuCad"> E-mail </label>
                                        <input type="email" name="emailUsuCad" id="emailUsuCad" placeholder="Digite o seu e-mail" value="<?php echo($emailUsuCad); ?>">
                                        <span class="erro"> O e-mail não pode ser vazio. </span>
                                        <span class="erro"> O e-mail é inválido. </span>
                                        <span class="erro"> O e-mail já é utilizado por outro usuário. </span>
                                    </section>
                                    
                                    <section class="field">
                                        <label for="senhaUsuCad"> Senha </label>
                                        <input type="password" name="senhaUsuCad" id="senhaUsuCad" placeholder="Digite a sua senha">
                                        <span class="erro"> A senha não pode ser vazia. </span>
                                        <span class="erro"> A senha deve conter no mínimo 6 caracteres. </span>
                                    </section>
    
                                    <section class="field">
                                        <label for="confSenhaUsu"> Confirmação de senha </label>
                                        <input type="password" name="confSenhaUsu" id="confSenhaUsu" placeholder="Confirme a sua senha">
                                        <span class="erro"> A confirmação de senha não pode ser vazia. </span>
                                        <span class="erro"> A confirmação de senha deve ser igual a senha. </span>
                                    </section>
                                    
                                    <section class="field btns">
                                        <section class="button submit"> Fazer cadastro </section>
                                        <input type="submit" name="cadastrarUsu" id="cadastrarUsu" value="Cadastrar" class="d-none">
                                    </section>
                                    
                                    <section class="field d-flex align-items-center justify-content-center flex-row pt-2 mb-2">
                                        <h6 class="m-0 pe-1"> Já possui uma conta? </h6>
                                        <ul class="nav">
                                            <li class="nav-item d-none">
                                                <a class="active d-none" data-bs-toggle="tab" href="#cadUsuario"> Fazer cadastro </a>
                                            </li>
                                            <li class="nav-item">
                                                <a data-bs-toggle="tab" href="#loginUsuario"> Fazer login </a>
                                            </li>
                                        </ul>
                                    </section>
                                    
                                </section>
                
                            </form>
                            
                        </section>
                    </section>
                    <section class="footer-login d-flex flex-column align-items-center">
                        <p>
                            <small>
                                Ao continuar, você concorda com os <a href="termosUso.php"> Termos de uso </a>
                                e confirma que leu nossa <a href="politicaPrivacidade.php"> Política de privacidade e cookies</a>.
                            </small>
                        </p>
                    </section>
                    
                </section>

                <section class="tab-pane fade" id="loginUsuario">
                    
                    <section class="login">
                        <ul class="nav pt-3">
                            <li class="nav-item">
                                <a class="nav-link p-0" href="login.php"> <i class="fa-solid fa-arrow-left"></i> Voltar </a>
                            </li>
                        </ul>

                        <section class="d-flex flex-column align-items-center pt-3 pb-3">
                            <h3> Que bom ter você aqui! </h3>
                        </section>
                        <section class="form-loginEmail login">
                            
                            <form action="#" method="POST">
                                
                                <section class="page">
                                    <section class="title"> 
                                        <h5> Informações de login </h5> 
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
                                        <ul class="nav m-0">
                                            <li class="nav-item">
                                                <a data-bs-toggle="tab" href="#esqueceuSenha" onclick="esqueceuSenha('Usuario')" class="pt-2 pb-2"> Esqueceu a senha? </a>
                                            </li>
                                            <li class="nav-item d-none">
                                                <a class="active d-none" data-bs-toggle="tab" href="#loginUsuario"> Fazer Login </a>
                                            </li>
                                        </ul>
                                    </section>
                                    
                                    <section class="field btns">
                                        <section class="button submit"> Fazer login </section>
                                        <input type="submit" name="loginUsu" id="loginUsu" value="Login" class="d-none">
                                    </section>

                                    <section class="field d-flex align-items-center justify-content-center flex-row pt-2 mb-2">
                                        <h6 class="m-0 pe-1"> Ainda não tem uma conta? </h6>
                                        <ul class="nav m-0">
                                            <li class="nav-item">
                                                <a data-bs-toggle="tab" href="#cadUsuario"> Fazer Cadastro </a>
                                            </li>
                                            <li class="nav-item d-none">
                                                <a class="active d-none" data-bs-toggle="tab" href="#loginUsuario"> Fazer Login </a>
                                            </li>
                                        </ul>
                                    </section>

                                </section>

                            </form>

                        </section>
                    </section>
                    <section class="footer-login d-flex flex-column align-items-center">
                        <p>
                            <small>
                                Ao continuar, você concorda com os <a href="termosUso.php"> Termos de uso </a>
                                e confirma que leu nossa <a href="politicaPrivacidade.php"> Política de privacidade e cookies</a>.
                            </small>
                        </p>
                    </section>

                </section>
                
                <section class="tab-pane fade" id="cadEstabelecimento">
                    
                    <section class="login">
                        <ul class="nav pt-3">
                            <li class="nav-item">
                                <a class="nav-link p-0" href="login.php"> <i class="fa-solid fa-arrow-left"></i> Voltar </a>
                            </li>
                        </ul>

                        <section class="d-flex flex-column align-items-center pt-3 pb-3">
                            <h3> Que bom ter você aqui! </h3>
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
                                        <h4> Informações estabelecimento: </h4> 
                                    </section>
    
                                    <section class="field">
                                        <label for="nomeEsta"> Nome do estabelecimento </label>
                                        <input type="text" name="nomeEsta" id="nomeEsta" placeholder="Digite o nome do estabelecimento" value="<?php echo($nomeEsta);?>">
                                        <span class="erro"> O nome do estabelecimento não pode ser vazio. </span>
                                    </section>
    
                                    <section class="field">
                                        <label for="categoria"> Selecione a categoria do estabelecimento </label>
                                        <select name="categoria" id="categoria">
                                            <option value="1"> Hospedagem </option>
                                            <option value="2"> Alimentação </option>
                                            <option value="3"> Compras </option>
                                            <option value="4"> Locomoção </option>
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
                                        <label for="horario"> Horário de funcionamento </label>
                                        <input type="text" name="horario" id="horario" placeholder="Digite o horário de funcionamento" value="<?php echo($horario);?>">
                                        <span class="erro"> O horário de funcionamento não pode ser vazio. </span>
                                    </section>
    
    
                                    <section class="field btns proxBtn">
                                        <section class="button"> Próximo </section>
                                    </section>
                                </section>
    
                                <section class="page">
                                    <section class="title"> 
                                        <h5> Informações de contato: </h5> 
                                    </section>
    
                                    <section class="field">
                                        <label for="telefone"> Telefone </label>
                                        <input type="tel" name="telefone" id="telefone" placeholder="Digite o telefone" value="<?php echo($telefone);?>">
                                        <span class="erro"> O telefone não pode ser vazio. </span>
                                        <span class="erro"> O número de telefone não existe. </span>
                                    </section>
    
                                    <section class="field">
                                        <label for="emailCom"> E-mail comercial </label>
                                        <input type="email" name="emailCom" id="emailCom" placeholder="Digite o e-mail comercial" value="<?php echo($emailCom);?>">
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
                                        <h5> Informações de endereço: </h5> 
                                    </section>
    
                                    <section class="field">
                                        <label for="bairro"> Bairro </label>
                                        <input type="text" name="bairro" id="bairro" placeholder="Digite o nome do bairro" value="<?php echo($bairro);?>">
                                        <span class="erro"> O nome do bairro não pode ser vazio. </span>
                                    </section>
    
                                    <section class="field">
                                        <label for="tipoEnde"> Selecione o tipo de endereço </label>
                                        <select name="tipoEnde" id="tipoEnde">
                                            <option value="Avenida"> Avenida </option>
                                            <option value="Campo"> Campo </option>
                                            <option value="Estrada"> Estrada </option>
                                            <option value="Jardim"> Jardim </option>
                                            <option value="Parque"> Parque </option>
                                            <option value="Rodovia"> Rodovia </option>
                                            <option value="Rua"> Rua </option>
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
                                        <h5> Fotos do estabelecimento </h5> 
                                        
                                    </section>
                                    
                                    <p style="color: #dd0000;"> Os formatos de imagem aceitos são no máximo 3mb, e 4000px X 4000px de dimensão. </p>
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
                                            <span class="certo"> Imagem selecionada com sucess!o </span>
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
                                        <input type="email" name="email" id="email" placeholder="Digite o e-mail de login" value="<?php echo($email);?>">
                                        <span class="erro"> O e-mail não pode ser vazio. </span>
                                        <span class="erro"> O e-mail é inválido. </span>
                                        <span class="erro"> O e-mail já está em uso por outro usuário. </span>
                                    </section>
    
                                    <section class="field">
                                        <label for="senha"> Senha </label>
                                        <input type="password" name="senha" id="senha" placeholder="Digite a senha de login">
                                        <span class="erro"> A senha não pode ser vazia. </span>
                                        <span class="erro"> A senha deve conter no mínimo 6 caracteres. </span>
                                    </section>
    
                                    <section class="field">
                                        <label for="confSenha"> Confirme a senha </label>
                                        <input type="password" name="confSenha" id="confSenha" placeholder="Confirme a senha de login">
                                        <span class="erro"> A confirmação de senha não pode ser vazia. </span>
                                        <span class="erro"> A confirmação de senha deve ser igual a senha. </span>
                                    </section>
    
                                    <section class="field btns">
                                        <section class="button volt-4 volt"> Voltar </section>
                                        <section class="button submit"> Cadastrar </section>
                                        <input type="submit" name="cadastrarEst" id="cadastrarEst" value="Cadastrar" class="d-none">
                                    </section>
                                </section>
    
                            </form>
    
                        </section>
                    </section>
    
                    <section class="footer-login d-flex flex-column align-items-center">
                        <p>
                            <small>
                                Ao continuar, você concorda com os <a href="termosUso.php"> Termos de uso </a>
                                e confirma que leu nossa <a href="politicaPrivacidade.php"> Política de privacidade e cookies</a>.
                            </small>
                        </p>
                    </section>
                </section>

                <section class="tab-pane fade" id="loginEstabelecimento">
        
                    <section class="login">
                        <ul class="nav pt-3">
                            <li class="nav-item">
                                <a class="nav-link p-0" href="login.php"> <i class="fa-solid fa-arrow-left"></i> Voltar </a>
                            </li>
                        </ul>

                        <section class="d-flex flex-column align-items-center pt-3 pb-3">
                            <h3> Que bom ter você aqui! </h3>
                        </section>
                        <section class="form-loginEmail loginEstab">

                            <form action="#" method="POST">

                                <section class="page">
                                    <section class="title"> 
                                        <h5> Informações de login estabelecimento </h5> 
                                    </section>

                                    <section class="field">
                                        <label for="emailLogEstab"> E-mail </label>
                                        <input type="email" name="emailLogEstab" id="emailLogEstab" placeholder="Digite o e-mail de login" value="<?php echo($emailLogEstab);?>">
                                        <span class="erro"> O e-mail não pode ser vazio. </span>
                                        <span class="erro"> O e-mail é inválido. </span>
                                    </section>

                                    <section class="field">
                                        <label for="senhaLogEstab"> Senha </label>
                                        <input type="password" name="senhaLogEstab" id="senhaLogEstab" placeholder="Digite a senha de login">
                                        <span class="erro"> A senha não pode ser vazia. </span>
                                        <ul class="nav m-0">
                                            <li class="nav-item">
                                                <a data-bs-toggle="tab" href="#esqueceuSenha" onclick="esqueceuSenha('Estabelecimento')" class="pt-2 pb-2"> Esqueceu a senha? </a>
                                            </li>
                                            <li class="nav-item d-none">
                                                <a class="active d-none" data-bs-toggle="tab" href="#loginEstabelecimento"> Fazer Login </a>
                                            </li>
                                        </ul>
                                    </section>

                                    <section class="field btns">
                                        <section class="button submit"> Fazer login </section>
                                        <input type="submit" name="loginEst" id="loginEst" value="Login" class="d-none">
                                    </section>

                                    <section class="field d-flex align-items-center justify-content-center flex-row pt-2 mb-2">
                                        <h6 class="m-0 pe-1"> Ainda não tem uma conta? </h6>
                                        <ul class="nav m-0">
                                            <li class="nav-item">
                                                <a data-bs-toggle="tab" href="#cadEstabelecimento"> Fazer cadastro </a>
                                            </li>
                                            <li class="nav-item d-none">
                                                <a class="active d-none" data-bs-toggle="tab" href="#loginEstabelecimento"> Fazer login </a>
                                            </li>
                                        </ul>
                                    </section>

                                </section>

                            </form>

                        </section>
                    </section>
                    <section class="footer-login d-flex flex-column align-items-center">
                        <p>
                            <small>
                                Ao continuar, você concorda com os <a href="termosUso.php"> Termos de uso </a>
                                e confirma que leu nossa <a href="politicaPrivacidade.php"> Política de privacidade e cookies</a>.
                            </small>
                        </p>
                    </section>

                </section>
                
                <section class="tab-pane fade" id="cadMonitor">
        
                    <section class="login">
                        <ul class="nav pt-3">
                            <li class="nav-item">
                                <a class="nav-link p-0" href="login.php"> <i class="fa-solid fa-arrow-left"></i> Voltar </a>
                            </li>
                        </ul>

                        <section class="d-flex flex-column align-items-center pt-3 pb-3">
                            <h3> Que bom ter você aqui! </h3>
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

                        <section class="form-loginEmail cadMoni">

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
                                            <option value="1"> Monitor </option>
                                            <option value="2"> Guia </option>
                                            <option value="3"> Guia e Monitor </option>
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
                                            <option value="Masculino"> Masculino </option>
                                            <option value="Feminino"> Feminino </option>
                                            <option value="Transgênero"> Transgênero </option>
                                            <option value="Não-binário"> Não-binário </option>
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
                                            <option value="Hospedagem"> Hospedagem </option>
                                            <option value="Alimentação"> Alimentação </option>
                                            <option value="Compras"> Compras </option>
                                            <option value="Locomoção"> Locomoção </option>
                                        </select>
                                    </section>
    
                                    <section class="field">
                                        <label for="idiomaSec"> Idioma secundário </label>
                                        <select name="idiomaSec" id="idiomaSec">
                                            <option value="Nenhum"> Nenhum </option>
                                            <option value="Alemão"> Alemão </option>
                                            <option value="Espanhol"> Espanhol </option>
                                            <option value="Francês"> Francês </option>
                                            <option value="Inglês"> Inglês </option>
                                            <option value="Italiano"> Italiano </option>
                                            <option value="Russo"> Russo </option>
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
                                        <span class="certo"> Imagem selecionada com sucesso! </span>
                                    </section>

                                    
                                    <section class="field">
                                        <label for="fotoPrimMoni"> Selecione uma ou mais fotos de trabalhos realizados </label>
                                        <input type="file" name="fotoPrimMoni" id="fotoPrimMoni"  onchange="validarArquivoMon('#fotoPrimMoni 1')" accept="image/jpeg, image/gif, image/png">
                                        <label for="fotoPrimMoni" class="file"> <i class="fa-solid fa-upload"></i> Escolher imagem </label>
                                        <span class="certo"> Imagem selecionada com sucesso! </span>
                                        <span class="erro"> Selecione pelo menos a foto de perfil e a primeira imagem </span>
                                    </section>

                                    <section class="addImg">
                                        
                                        <section class="field pt-2">
                                            <input type="file" name="fotoSecuMoni" id="fotoSecuMoni" onchange="validarArquivoMon('#fotoSecuMoni 2')" accept="image/jpeg, image/gif, image/png">
                                            <label for="fotoSecuMoni" class="file"> <i class="fa-solid fa-upload"></i> Escolher imagem </label>
                                            <span class="certo"> Imagem selecionada com sucesso! </span>
                                        </section>
                                        
                                        <section class="field pt-2">
                                            <input type="file" name="fotoTercMoni" id="fotoTercMoni" onchange="validarArquivoMon('#fotoTercMoni 3')" accept="image/jpeg, image/gif, image/png">
                                            <label for="fotoTercMoni" class="file"> <i class="fa-solid fa-upload"></i> Escolher imagem </label>
                                            <span class="certo"> Imagem selecionada com sucesso! </span>
                                        </section>
                                        
                                        <section class="field pt-2">
                                            <input type="file" name="fotoQuarMoni" id="fotoQuarMoni" onchange="validarArquivoMon('#fotoQuarMoni 4')" accept="image/jpeg, image/gif, image/png">
                                            <label for="fotoQuarMoni" class="file"> <i class="fa-solid fa-upload"></i> Escolher imagem </label>
                                            <span class="certo"> Imagem selecionada com sucesso! </span>
                                        </section>
                                        
                                        <section class="field pt-2">
                                            <input type="file" name="fotoQuinMoni" id="fotoQuinMoni" onchange="validarArquivoMon('#fotoQuinMoni 5')" accept="image/jpeg, image/gif, image/png">
                                            <label for="fotoQuinMoni" class="file"> <i class="fa-solid fa-upload"></i> Escolher imagem </label>
                                            <span class="certo"> Imagem selecionada com sucesso! </span>
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
                                        <span class="erro"> O e-mail já está em uso por outro usuário. </span>
                                    </section>
    
                                    <section class="field">
                                        <label for="senhaMoni"> Senha </label>
                                        <input type="password" name="senhaMoni" id="senhaMoni" placeholder="Digite a senha de login">
                                        <span class="erro"> A senha não pode ser vazia. </span>
                                        <span class="erro"> A senha deve conter no mínimo 6 caracteres. </span>
                                    </section>
    
                                    <section class="field">
                                        <label for="confSenhaMoni"> Confirme a senha </label>
                                        <input type="password" name="confSenhaMoni" id="confSenhaMoni" placeholder="Confirme a senha de login">
                                        <span class="erro"> A confirmação de senha não pode ser vazia. </span>
                                        <span class="erro"> A confirmação de senha deve ser igual a senha. </span>
                                    </section>
    
                                    <section class="field btns">
                                        <section class="button volt-3 volt"> Voltar </section>
                                        <section class="button submit"> Cadastrar </section>
                                        <input type="submit" name="cadastrarMon" id="cadastrarMon" value="Cadastrar" class="d-none">
                                    </section>
                                </section>

                            </form>

                        </section>
                    </section>
                    <section class="footer-login d-flex flex-column align-items-center">
                        <p>
                            <small>
                                Ao continuar, você concorda com os <a href="termosUso.php"> Termos de uso </a>
                                e confirma que leu nossa <a href="politicaPrivacidade.php"> Política de privacidade e cookies</a>.
                            </small>
                        </p>
                    </section>

                </section>

                <section class="tab-pane fade" id="loginMonitor">
        
                    <section class="login">
                        <ul class="nav">
                            <li class="nav-item">
                                <a class="nav-link p-0" href="login.php"> <i class="fa-solid fa-arrow-left"></i> Voltar </a>
                            </li>

                        </ul>

                        <section class="d-flex flex-column align-items-center pt-3 pb-3">
                            <h3> Que bom ter você aqui! </h3>
                        </section>
                        <section class="form-loginEmail loginMoni">

                            <form action="#" method="POST">

                                <section class="page">
                                    <section class="title"> 
                                        <h5> Informações de login guias e monitores </h5> 
                                    </section>

                                    <section class="field">
                                        <label for="emailLogMoni"> E-mail </label>
                                        <input type="email" name="emailLogMoni" id="emailLogMoni" placeholder="Digite o e-mail de login" value="<?php echo($emailLogMoni);?>">
                                        <span class="erro"> O e-mail não pode ser vazio. </span>
                                        <span class="erro"> O e-mail é inválido. </span>
                                    </section>

                                    <section class="field">
                                        <label for="senhaLogMoni"> Senha </label>
                                        <input type="password" name="senhaLogMoni" id="senhaLogMoni" placeholder="Digite a senha de login">
                                        <span class="erro"> A senha não pode ser vazia. </span>
                                        <ul class="nav m-0">
                                            <li class="nav-item">
                                                <a data-bs-toggle="tab" href="#esqueceuSenha" onclick="esqueceuSenha('Monitor')" class="pt-2 pb-2"> Esqueceu a senha? </a>
                                            </li>
                                            <li class="nav-item d-none">
                                                <a class="active d-none" data-bs-toggle="tab" href="#loginMonitor"> Fazer Login </a>
                                            </li>
                                        </ul>
                                    </section>

                                    <section class="field btns">
                                        <section class="button submit"> Fazer login </section>
                                        <input type="submit" name="loginMoni" id="loginMoni" value="Login" class="d-none">
                                    </section>

                                    <section class="field d-flex align-items-center justify-content-center flex-row pt-2 mb-2">
                                        <h6 class="m-0 pe-1"> Ainda não tem uma conta? </h6>
                                        <ul class="nav m-0">
                                            <li class="nav-item">
                                                <a class="p-0" data-bs-toggle="tab" href="#cadMonitor"> Fazer cadastro </a>
                                            </li>
                                            <li class="nav-item d-none">
                                                <a class="p-0 active d-none" data-bs-toggle="tab" href="#loginMonitor"> Fazer login </a>
                                            </li>
                                        </ul>
                                    </section>

                                </section>

                            </form>

                        </section>
                    </section>
                    <section class="footer-login d-flex flex-column align-items-center">
                        <p>
                            <small>
                                Ao continuar, você concorda com os <a href="termosUso.php"> Termos de uso </a>
                                e confirma que leu nossa <a href="politicaPrivacidade.php"> Política de privacidade e cookies</a>.
                            </small>
                        </p>
                    </section>

                </section>

                <section class="tab-pane fade" id="esqueceuSenha">
        
                    <section class="login">
                        <ul class="nav">
                            <li class="nav-item">
                                <a class="nav-link p-0" href="login.php"> <i class="fa-solid fa-arrow-left"></i> Voltar </a>
                            </li>

                        </ul>

                        <section class="d-flex flex-column align-items-center pt-3 pb-3">
                            <h3> Esqueceu a senha? </h3>
                        </section>
                        <section class="form-loginEmail esqSenha">

                            <form action="#" method="POST">

                                <section class="page">

                                    <section class="field">
                                        <label for="emailEsq"> E-mail </label>
                                        <input type="email" name="emailEsq" id="emailEsq" placeholder="Digite o e-mail de login" value="<?php echo($emailEsq);?>">
                                        <span class="erro"> O e-mail não pode ser vazio. </span>
                                        <span class="erro"> O e-mail é inválido. </span>
                                    </section>

                                    <section class="field d-none">
                                        <input type="hidden" name="tabela" id="tabela">
                                    </section>

                                    <section class="field btns">
                                        <section class="button submit"> Recuperar </section>
                                        <input type="submit" name="esqSenhaSub" id="esqSenhaSub" value="Login" class="d-none">
                                    </section>


                                </section>

                            </form>

                        </section>
                    </section>
                </section>

                <section class="d-none">
                    <form action="#" method="POST">
                        <input type="text" name="nomeUsuGoogle" id="nomeUsuGoogle">
                        <input type="email" name="emailUsuGoogle" id="emailUsuGoogle">
                        <input type="text" name="verEmailUsuGoogle" id="verEmailUsuGoogle">
                        <input type="number" name="idUsuGoogle" id="idUsuGoogle">
                        <input type="submit" value="Enviar" name="enviarLogGoogle" id="enviarLogGoogle">
                    </form>
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

            <section class="modalLogin modal fade" id="envioCertoEmail" tabindex="-1" aria-hidden="true">
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
                           <p> Enviamos um e-mail com instruções para recuperar a senha. Acesse sua caixa de e-mail para recuperar a senha. </p>
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

            <button class="botaoHamburguer navbar-toggler d-none" type="button" id="btnCertoEmail" data-bs-toggle="modal" data-bs-target="#envioCertoEmail">
                <p> a </p>
            </button>

            <button class="botaoHamburguer navbar-toggler d-none" type="button" id="btnErro" data-bs-toggle="modal" data-bs-target="#envioErro">
                <p> a</p>
            </button>
            
        </main>
        <?php
                require_once('./footer.php');

                if(isset($erroCon)){
                    echo('<script> erroLogin(); </script>');
                }

                if(isset($certCon)){
                    echo('<script> certoLogin(); </script>');
                }

                if(isset($certEma)){
                    echo('<script> certoEnvioEmail(); </script>');
                }
        ?>
        <script src="/TechWay/js/formCadUsu.js" defer></script>
        <script src="/TechWay/js/formCadEstab.js" defer></script>
        <script src="/TechWay/js/formCadMoni.js" defer></script>
        <script src="/TechWay/js/formLogUsu.js" defer></script>
        <script src="/TechWay/js/formLogEstab.js" defer></script>
        <script src="/TechWay/js/formLogMoni.js" defer></script>
        <script src="/TechWay/js/loginGoogle.js" defer></script>
        <script src="/TechWay/js/esqSenha.js" defer></script>
    </body>
</html>
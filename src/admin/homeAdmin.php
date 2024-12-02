<?php
    require_once('headerAdmin.php');
    require_once('headerResponsivoAdmin.php');
?>
    <main class="container">
        <section class="d-flex justify-content-center pt-3">
            <h2> Usuários </h2>
        </section>
        <section class="d-flex justify-content-center">

        <?php
            if(isset($_POST["excluir"])){
                $id = $_POST["id"];
                $sqlSel = 'SELECT * FROM Usuario WHERE id ='. $id;
                $resul = mysqli_query($conexao,$sqlSel);
                $contr = mysqli_fetch_array($resul);

                if($contr["foto"] != ""){
                    unlink("../../img/usuario/usu".$id."/".$contr["foto"]);
                }
                rmdir('../../img/usuario/usu'.$id);
                $sqlEx = "DELETE FROM Usuario WHERE id =".$id;
                $resul = mysqli_query($conexao, $sqlEx);
                echo("<script> window.location.href = 'homeAdmin.php'; </script>");
            }
            $sql = 'SELECT * FROM Usuario';
            $resul = mysqli_query($conexao, $sql);
            $numLinhas = mysqli_num_rows($resul);

            if($numLinhas > 0){
                echo('<table class="tabela">');
        ?>
                    <tr class="headerTable">
                        <th> ID </th>
                        <th> Foto </th>
                        <th> Nome </th>
                        <th> E-mail </th>
                        <th> Id_google</th>
                        <th> Excluir </th>
                    </tr>
        <?php
                while($contr = mysqli_fetch_array($resul)){
        ?>
                    <tr class="bodyTable">
                        <td> <?php echo($contr['id']);?></td>
                        <td> 
                            <?php
                                if($contr['foto'] == ''){
                                    echo('<img class="iconeUsu admin" src="/TechWay/img/icones/iconesLink/usuarioImg.png" alt="Foto usuário '.$contr["nome"].'">');
                                }else{
                                    echo('<img class="iconeUsu Usu" src="/TechWay/img/usuario/usu'.$contr["id"].'/'.$contr["foto"].'" alt="Foto usuário '.$contr["nome"].'">');
                                }
                            ?>
                        </td>
                        <td> <?php echo($contr['nome']); ?></td>
                        <td> <?php echo($contr['email']); ?></td>
                        <td>
                            <?php
                                if($contr['id_google'] == ''){
                                    echo("Usuário local");
                                }else{
                                    echo($contr['id_google']);
                                }
                            ?>
                        </td>
                        <td>
                            <form action="#" method="POST">
                                <input type="hidden" name="id" id="id" value="<?php echo($contr['id']);?>">
                                <button type="submit" name="excluir" class="botao sair">
                                    Excluir
                                </button>
                            </form>
                        </td>
                    </tr>
        <?php
                }
                echo('</table>');
            }else{
                echo('<p> Nenhum usuário cadastrado </p>');
            }
        ?>
        </section>
    </main>
<?php
    require_once('footerAdmin.php');
?>
    </body>
</html>
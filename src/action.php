<?php
    require_once("conexao.php");

    if(isset($_POST['query'])){
        $inputText = $_POST['query'];
        $sql = 'SELECT nome_estabelecimento FROM Estabelecimento WHERE nome_estabelecimento LIKE "%'. $inputText.'%" && autorizado = "Autorizado";';
        $resul = mysqli_query($conexao, $sql);
        $numLinhas = mysqli_num_rows($resul);
        
        if($resul){
            if($numLinhas > 0){
                while($contr = mysqli_fetch_array($resul)){
                    echo('<a href="#" class="list-group-item list-group-item-action border-1">'. $contr["nome_estabelecimento"].'</a>');
                }
            }else{
                echo('<p> Nenhum resultado encontrado. </p>');
            }
        }
    }
?>
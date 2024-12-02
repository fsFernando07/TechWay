function erroLogin(){
    let btnErro = document.querySelector("#btnErro");
    btnErro.click();
}

function certoLogin(){
    let btnCerto = document.querySelector("#btnCerto"); 
    btnCerto.click();
    const caminho = window.location.pathname;

    setTimeout(function(){
        window.location.href = caminho;
    }, 4000);
}

function excluirConta(){
    let btnExcluir = document.querySelector("#btnExcluir"); 
    btnExcluir.click();

    setTimeout(function(){
        window.location.href = './sair.php';
    }, 4000);
}

function certoEnvioEmail(){
    let btnCertoEmail = document.querySelector("#btnCertoEmail"); 
    btnCertoEmail.click();
}
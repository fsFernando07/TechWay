function esqueceuSenha(tab){
    let inputTabela = document.querySelector('#tabela');
    
    inputTabela.value = tab;
}

const emailEsq = document.querySelector("#emailEsq");
const erroEsq = document.querySelectorAll("#esqueceuSenha .erro");
const submitEsqBtn = document.querySelector("#esqueceuSenha .submit");
const submitEsq = document.querySelector("#esqSenhaSub");

submitEsqBtn.addEventListener("click", function(){
    erroEsq[0].style.display = "none";
    erroEsq[1].style.display = "none";

    let numErro = 0;

    if(emailEsq.value == ''){
        erroEsq[0].style.display = 'block';
        numErro += 1;
    }else if(!emailRegex.test(emailEsq.value)){
        erroEsq[1].style.display = "block";
        numErro += 1;
    }

    if(numErro == 0){
        submitEsq.click();
    }
});
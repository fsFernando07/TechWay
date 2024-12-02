const inputSenha = document.querySelector('#senhaAlt');

const submitAltBtn = document.querySelector('.form-loginEmail .submit');
const submitAlt = document.querySelector("#alterarSenhaSub");

const erro = document.querySelectorAll(".form-loginEmail .erro");

submitAltBtn.addEventListener("click", function(){
    erro[0].style.display = 'none';
    erro[1].style.display = 'none';
    
    let numErro = 0;

    if(inputSenha.value == ''){
        erro[0].style.display = 'block';
        numErro += 1;
    }else if(inputSenha.value.length < 6){
        erro[1].style.display = 'block';
        numErro += 1;
    }

    if(numErro == 0){
        submitAlt.click();
    }
});
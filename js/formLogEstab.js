const inputEmailEstLog = document.querySelector("#emailLogEstab"); 
const inputSenhaEstLog = document.querySelector("#senhaLogEstab"); 

const submitEstLogBtn = document.querySelector('.form-loginEmail.loginEstab .submit');
const submitEstLog = document.querySelector("#loginEst");

const erroEstLog = document.querySelectorAll(".form-loginEmail.loginEstab .erro");

submitEstLogBtn.addEventListener("click", function(){
    erroEstLog[0].style.display = 'none';
    erroEstLog[1].style.display = 'none';
    erroEstLog[2].style.display = 'none';
    
    let numErro = 0;

    if(inputEmailEstLog.value == ''){
        erroEstLog[0].style.display = 'block';
        numErro += 1;
    }else if(!emailRegex.test(inputEmailEstLog.value)){
        erroEstLog[1].style.display = "block";
        numErro += 1;
    }

    if(inputSenhaEstLog.value == ''){
        erroEstLog[2].style.display = 'block';
        numErro += 1;
    }
    
    if(numErro == 0){
        setTimeout(function(){
            submitEstLog.click();
        }, 800);
    }
});
const inputEmailUsuLog = document.querySelector('#emailUsu');
const inputSenhaUsuLog = document.querySelector('#senhaUsu');

const submitUsuBtn = document.querySelector('.form-loginEmail.login .submit');
const submitUsu = document.querySelector("#loginUsu");

const erroUsuLog = document.querySelectorAll(".form-loginEmail.login .erro");

submitUsuBtn.addEventListener("click", function(){
    erroUsuLog[0].style.display = 'none';
    erroUsuLog[1].style.display = 'none';
    erroUsuLog[2].style.display = 'none';
    
    let numErro = 0;

    if(inputEmailUsuLog.value == ''){
        erroUsuLog[0].style.display = 'block';
        numErro += 1;
    }else if(!emailRegex.test(inputEmailUsuLog.value)){
        erroUsuLog[1].style.display = "block";
        numErro += 1;
    }

    if(inputSenhaUsuLog.value == ''){
        erroUsuLog[2].style.display = 'block';
        numErro += 1;
    }
    
    if(numErro == 0){
        setTimeout(function(){
            submitUsu.click();
        }, 800);
    }
});
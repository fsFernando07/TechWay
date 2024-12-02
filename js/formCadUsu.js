const inputnomeUsu = document.querySelector('#nomeUsuCad');
const inputEmailUsu = document.querySelector('#emailUsuCad');
const inputSenhaUsu = document.querySelector('#senhaUsuCad');
const inputConfSenhaUsu = document.querySelector('#confSenhaUsu');

const submitCadUsuBtn = document.querySelector('.form-loginEmail.cad .submit');
const submitCadUsu = document.querySelector("#cadastrarUsu");

const erroUsu = document.querySelectorAll(".form-loginEmail.cad .erro");

submitCadUsuBtn.addEventListener("click", function(){
    erroUsu[0].style.display = 'none';
    erroUsu[1].style.display = 'none';
    erroUsu[2].style.display = 'none';
    erroUsu[3].style.display = 'none';
    erroUsu[4].style.display = 'none';
    erroUsu[5].style.display = 'none';
    erroUsu[6].style.display = 'none';
    erroUsu[7].style.display = 'none';
    
    let numErro = 0;

    if(inputnomeUsu.value == ''){
        erroUsu[0].style.display = 'block';
    }

    if(inputEmailUsu.value == ''){
        erroUsu[1].style.display = 'block';
        numErro += 1;
    }else if(!emailRegex.test(inputEmailUsu.value)){
        erroUsu[2].style.display = "block";
        numErro += 1;
    }

    if(inputSenhaUsu.value == ''){
        erroUsu[4].style.display = 'block';
        numErro += 1;
    }else if(inputSenhaUsu.value.length < 6){
        erroUsu[5].style.display = 'block';
        numErro += 1;
    }

    if(inputConfSenhaUsu.value == ''){
        erroUsu[6].style.display = 'block';
        numErro += 1;
    }else if(inputConfSenhaUsu.value != inputSenhaUsu.value){
        erroUsu[7].style.display = 'block';
        numErro += 1;
    }

    
    if(numErro == 0){
        setTimeout(function(){
            submitCadUsu.click();
        }, 800);
    }
});
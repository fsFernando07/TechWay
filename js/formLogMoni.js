const inputEmailMoniLog = document.querySelector("#emailLogMoni"); 
const inputSenhaMoniLog = document.querySelector("#senhaLogMoni"); 

const submitMoniLogBtn = document.querySelector('.form-loginEmail.loginMoni .submit');
const submitMoniLog = document.querySelector("#loginMoni");

const erroMoniLog = document.querySelectorAll(".form-loginEmail.loginMoni .erro");

submitMoniLogBtn.addEventListener("click", function(){
    erroMoniLog[0].style.display = 'none';
    erroMoniLog[1].style.display = 'none';
    erroMoniLog[2].style.display = 'none';
    
    let numErro = 0;

    if(inputEmailMoniLog.value == ''){
        erroMoniLog[0].style.display = 'block';
        numErro += 1;
    }else if(!emailRegex.test(inputEmailMoniLog.value)){
        erroMoniLog[1].style.display = "block";
        numErro += 1;
    }

    if(inputSenhaMoniLog.value == ''){
        erroMoniLog[2].style.display = 'block';
        numErro += 1;
    }
    
    if(numErro == 0){
        setTimeout(function(){
            submitMoniLog.click();
        }, 800);
    }
});
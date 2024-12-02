const slidePageMoni = document.querySelector("#cadMonitor .slidepage");
const firstProxBtnMoni = document.querySelector("#cadMonitor .proxBtn");
const voltBtnSecMoni = document.querySelector("#cadMonitor .volt-1");
const proxBtnSecMoni = document.querySelector("#cadMonitor .prox-1");
const voltBtnThirdMoni = document.querySelector("#cadMonitor .volt-2");
const proxBtnThirdMoni = document.querySelector("#cadMonitor .prox-2");
const voltBtnFourthMoni = document.querySelector("#cadMonitor .volt-3");
const submitBtnMoni = document.querySelector("#cadMonitor .form-loginEmail .submit");
const progressTextMoni = document.querySelectorAll("#cadMonitor .step p");
const progressCheckMoni = document.querySelectorAll("#cadMonitor .step .check");
const bulletMoni = document.querySelectorAll("#cadMonitor .step .bullet");
const addImgBtnMoni = document.querySelector("#cadMonitor .addImgBtn");

const altSenha = document.querySelector(".altSenha label");
const secaoSenha = document.querySelector(".senha");

const inputNomeMoni = document.querySelector("#nomeMoni");
const inputDescMoni = document.querySelector("#descricaoMoni");
const inputNumMoniCadastur = document.querySelector("#numMoniCadastur");

const inputTelefoneMoni = document.querySelector("#telefoneMoni");
const inputFacebookMoni = document.querySelector("#facebookMoni");
const inputInstagramMoni = document.querySelector("#instagramMoni");
const inputTikTokMoni = document.querySelector("#tiktokMoni");

const inputEmailMoni = document.querySelector("#emailMoni");
const inputSenhaMoni = document.querySelector("#senhaMoni");
const inputConfSenhaMoni = document.querySelector("#confSenhaMoni");

const submitCadMon = document.querySelector("#alterarMon");

const inputPerfilMoni = document.querySelector("#fotoPerfil");
const inputfotoPrimMoni = document.querySelector("#fotoPrimMoni");
const inputsImgMoni = document.querySelectorAll('#cadMonitor .form-loginEmail input[type="file"]');
const secaoAddImgMoni = document.querySelectorAll('#cadMonitor .addImg .field');

const erroMoni = document.querySelectorAll("#cadMonitor .erro");
const erroImgMoni = document.querySelector("#cadMonitor .erroImg");
const certoMoni = document.querySelectorAll("#cadMonitor .certo");

let maxMoni = 4;
let currentMoni = 1;
let startMoni = 0;

let emailRegex = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;

if(altSenha){
    secaoSenha.style.display = "none";
    numClick = 0;
    
    altSenha.addEventListener("click", function(){
        secaoSenha.style.display = "block";
        if(numClick == 0){
            const inputSenha = document.createElement("input");
            inputSenha.setAttribute('type', 'password');
            inputSenha.name = "senha";
            inputSenha.id = "senha";
            inputSenha.placeholder = "Digite a sua nova senha";
            secaoSenha.appendChild(inputSenha);
            numClick += 1;
        }
    });
}

inputTelefoneMoni.addEventListener("input", function(){
    let limparValor = inputTelefoneMoni.value.replace(/\D/g, "").substring(0, 11);

    let numerosArray = limparValor.split("");

    let numeroFormatado = "";

    if(numerosArray.length > 0){
        numeroFormatado += `(${numerosArray.slice(0,2).join("")}`;
    }
    
    if(numerosArray.length > 2){
        numeroFormatado += `) ${numerosArray.slice(2,7).join("")}`;
    }
    
    if(numerosArray.length > 7){
        numeroFormatado += `-${numerosArray.slice(7,11).join("")}`;
    }

    inputTelefoneMoni.value = numeroFormatado;
});

inputNumMoniCadastur.addEventListener("input", function(){
    let limparValor = inputNumMoniCadastur.value.replace(/\D/g, "").substring(0, 14);

    let numerosArray = limparValor.split("");

    let numeroFormatado = "";

    if(numerosArray.length > 0){
        numeroFormatado += `${numerosArray.slice(0,2).join("")}`;
    }
    
    if(numerosArray.length > 2){
        numeroFormatado += `.${numerosArray.slice(2,5).join("")}`;
    }
    
    if(numerosArray.length > 5){
        numeroFormatado += `.${numerosArray.slice(5,8).join("")}`;
    }

    if(numerosArray.length > 8){
        numeroFormatado += `/${numerosArray.slice(8,12).join("")}`;
    }

    if(numerosArray.length > 12){
        numeroFormatado += `-${numerosArray.slice(12,14).join("")}`;
    }

    inputNumMoniCadastur.value = numeroFormatado;
});


firstProxBtnMoni.addEventListener("click", function(){
    erroMoni[0].style.display = 'none';
    erroMoni[1].style.display = 'none';
    erroMoni[2].style.display = 'none';
    erroMoni[3].style.display = 'none';

    let numErro = 0;

    if(inputNomeMoni.value == ''){
        erroMoni[0].style.display = "block";
        numErro += 1;
    }

    if(inputDescMoni.value == ''){
        erroMoni[1].style.display = "block";
        numErro += 1;
    }

    if(inputNumMoniCadastur.value == ''){
        erroMoni[2].style.display = "block";
        numErro += 1;
    }else if(inputNumMoniCadastur.value.length < 18){
        erroMoni[3].style.display = "block";
        numErro += 1;
    }

    if(numErro == 0){
        slidePageMoni.style.marginLeft = "-25%";
        bulletMoni[currentMoni - 1].classList.add("active");
        progressTextMoni[currentMoni - 1].classList.add("active");
        progressCheckMoni[currentMoni - 1].classList.add("active");
        currentMoni += 1;
    }
    
});

proxBtnSecMoni.addEventListener("click", function(){
    erroMoni[4].style.display = 'none';
    erroMoni[5].style.display = 'none';
    erroMoni[6].style.display = 'none';
    erroMoni[7].style.display = 'none';
    erroMoni[8].style.display = 'none';

    let numErro = 0;

    if(inputTelefoneMoni.value == ''){
        erroMoni[4].style.display = "block";
        numErro += 1;
    }else if(inputTelefoneMoni.value.length < 15){
        erroMoni[5].style.display = "block";
        numErro += 1;
    }

    if(inputFacebookMoni.value.length > 400){
        erroMoni[6].style.display = "block";
        numErro += 1;
    }

    if(inputInstagramMoni.value.length > 400){
        erroMoni[7].style.display = "block";
        numErro += 1;
    }

    if(inputTikTokMoni.value.length > 400){
        erroMoni[8].style.display = "block";
        numErro += 1;
    }

    if(numErro == 0){
        slidePageMoni.style.marginLeft = "-50%";
        bulletMoni[currentMoni - 1].classList.add("active");
        progressTextMoni[currentMoni - 1].classList.add("active");
        progressCheckMoni[currentMoni - 1].classList.add("active");
        currentMoni += 1;
    }
    
});

proxBtnThirdMoni.addEventListener("click", function(){
    erroMoni[9].style.display = 'none';
    let numErro = 0;

    if(numErro == 0){
        slidePageMoni.style.marginLeft = "-75%";
        bulletMoni[currentMoni - 1].classList.add("active");
        progressTextMoni[currentMoni - 1].classList.add("active");
        progressCheckMoni[currentMoni - 1].classList.add("active");
        currentMoni += 1;
    }
    
});

submitBtnMoni.addEventListener("click", function(){
    erroMoni[10].style.display = 'none';
    erroMoni[11].style.display = 'none';
    erroMoni[12].style.display = 'none';
    erroMoni[13].style.display = 'none';
    erroMoni[14].style.display = 'none';

    let numErro = 0;

    if(inputEmailMoni.value == ''){
        erroMoni[10].style.display = 'block';
        numErro += 1;
    }else if(!emailRegex.test(inputEmailMoni.value)){
        erroMoni[11].style.display = "block";
        numErro += 1;
    }

    if(altSenha && secaoSenha.style.display == 'block'){
        erroMoni[13].style.display = "none";
        erroMoni[14].style.display = "none";
        const senha = document.querySelector("#senha");
        if(senha.value == ''){
            erroMoni[13].style.display = "block";
            numErro += 1;
        }
        if(senha.value.length > 0 && senha.value.length < 6){
            erroMoni[14].style.display = "block";
            numErro += 1;
        }
    }
    
    if(numErro == 0){
        bulletMoni[currentMoni - 1].classList.add("active");
        progressTextMoni[currentMoni - 1].classList.add("active");
        progressCheckMoni[currentMoni - 1].classList.add("active");
        setTimeout(function(){
            submitCadMon.click();
        }, 800);
    }
});

voltBtnSecMoni.addEventListener("click", function(){
    slidePageMoni.style.marginLeft = "0%";
    bulletMoni[currentMoni - 2].classList.remove("active");
    progressTextMoni[currentMoni - 2].classList.remove("active");
    progressCheckMoni[currentMoni - 2].classList.remove("active");
    currentMoni -= 1;
});

voltBtnThirdMoni.addEventListener("click", function(){
    slidePageMoni.style.marginLeft = "-25%";
    bulletMoni[currentMoni - 2].classList.remove("active");
    progressTextMoni[currentMoni - 2].classList.remove("active");
    progressCheckMoni[currentMoni - 2].classList.remove("active");
    currentMoni -= 1;
});

voltBtnFourthMoni.addEventListener("click", function(){
    slidePageMoni.style.marginLeft = "-50%";
    bulletMoni[currentMoni - 2].classList.remove("active");
    progressTextMoni[currentMoni - 2].classList.remove("active");
    progressCheckMoni[currentMoni - 2].classList.remove("active");
    currentMoni -= 1;
});

addImgBtnMoni.addEventListener("click", function(){
    if(certoMoni[startMoni+1].style.display == ''){
        erroImgMoni.style.display = 'block';
    }else{
        erroImgMoni.style.display = 'none';
        secaoAddImgMoni[startMoni].style.display = 'block';
        startMoni++;
    }
});

function validarArquivoMon(seletorCampo){
    let texto = seletorCampo.split(" ");
    let input = document.querySelector(texto[0]);
    let numErro = 0;
    
    if(input.files[0].type != 'image/jpeg' && input.files[0].type != 'image/gif' && input.files[0].type != 'image/png'){
        alert("Erro: Tipo de arquivo inválido, selecione um arquivo PNG, JPEG ou GIF");
        input.value = '';
        numErro++;
        certoMoni[texto[1]].style.display = 'none';
    }

    if(input.files[0].size > (1024 * 1024 * 3)){
        alert("Erro: Tamanho máximo permitido de imagem é 3mb");
        input.value = '';
        numErro++;
        certoMoni[texto[1]].style.display = 'none';
    }

    if(numErro == ''){
        certoMoni[texto[1]].style.display = 'block';
    }
}


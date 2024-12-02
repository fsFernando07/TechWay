const slidePage = document.querySelector("#altEstabelecimento .slidepage");
const firstProxBtn = document.querySelector("#altEstabelecimento .proxBtn");
const voltBtnSec = document.querySelector("#altEstabelecimento .volt-1");
const proxBtnSec = document.querySelector("#altEstabelecimento .prox-1");
const voltBtnThird = document.querySelector("#altEstabelecimento .volt-2");
const proxBtnThird = document.querySelector("#altEstabelecimento .prox-2");
const proxBtnFourth = document.querySelector("#altEstabelecimento .prox-3");
const voltBtnFourth = document.querySelector("#altEstabelecimento .volt-3");
const voltBtnFifth = document.querySelector("#altEstabelecimento .volt-4");
const submitBtn = document.querySelector("#altEstabelecimento .form-login .submit");
const progressText = document.querySelectorAll("#altEstabelecimento .step p");
const progressCheck = document.querySelectorAll("#altEstabelecimento .step .check");
const bullet = document.querySelectorAll("#altEstabelecimento .step .bullet");
const addImgBtn = document.querySelector("#altEstabelecimento .addImgBtn");

const altSenha = document.querySelector(".altSenha label");
const secaoSenha = document.querySelector(".senha");

const inputEsta = document.querySelector("#nomeEsta");
const inputDesc = document.querySelector("#descricao");
const inputCnpj = document.querySelector("#cnpj");
const inputHorario = document.querySelector("#horario");

const inputTele = document.querySelector("#telefone");
const inputEmailCom = document.querySelector("#emailCom");
const inputFace = document.querySelector("#facebook");
const inputInst = document.querySelector("#instagram");
const inputTikT = document.querySelector("#tiktok");

const inputBair = document.querySelector("#bairro");
const inputEnde = document.querySelector("#endereco");
const inputNume = document.querySelector("#numero");

const inputLogo = document.querySelector("#fotoLogo");
const inputfotoPrim = document.querySelector("#fotoPrim");
const inputsImg = document.querySelectorAll('#altEstabelecimento .form-login input[type="file"]');
const secaoAddImg = document.querySelectorAll('#altEstabelecimento .addImg .field');

const inputEmai = document.querySelector("#email");
const inputSenh = document.querySelector("#senha");
const inputCoSe = document.querySelector("#confSenha");

const erro = document.querySelectorAll("#altEstabelecimento .form-login .erro");
const erroImg = document.querySelector("#altEstabelecimento .erroImg");
const certo = document.querySelectorAll("#altEstabelecimento .certo");

const form = document.querySelector("#altEstabelecimento .form-login form");
const submitEst = document.querySelector("#atualizarEst");

let max = 4;
let current = 1;
let start = 0;

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

inputTele.addEventListener("input", function(){
    let limparValor = inputTele.value.replace(/\D/g, "").substring(0, 11);

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

    inputTele.value = numeroFormatado;
});

inputCnpj.addEventListener("input", function(){
    let limparValor = inputCnpj.value.replace(/\D/g, "").substring(0, 14);

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

    inputCnpj.value = numeroFormatado;
});

firstProxBtn.addEventListener("click", function(){
    erro[0].style.display = 'none';
    erro[1].style.display = 'none';
    erro[2].style.display = 'none';
    erro[3].style.display = 'none';
    erro[4].style.display = 'none';

    let numErro = 0;

    if(inputEsta.value == ''){
        erro[0].style.display = "block";
        numErro += 1;
    }

    if(inputDesc.value == ''){
        erro[1].style.display = "block";
        numErro += 1;
    }
    
    if(inputCnpj.value == ''){
        erro[2].style.display = "block";
        numErro += 1;
    }else if(inputCnpj.value.length < 18){
        erro[3].style.display = "block";
        numErro += 1;
    }

    if(inputHorario.value == ''){
        erro[4].style.display = "block";
        numErro += 1;
    }

    if(numErro == 0){
        slidePage.style.marginLeft = "-25%";
        form.style.width = "400%";
        bullet[current - 1].classList.add("active");
        progressText[current - 1].classList.add("active");
        progressCheck[current - 1].classList.add("active");
        current += 1;
    }
    
});

proxBtnSec.addEventListener("click", function(){
    erro[5].style.display = 'none';
    erro[6].style.display = 'none';
    erro[7].style.display = 'none';
    erro[8].style.display = 'none';
    erro[9].style.display = 'none';
    erro[10].style.display = 'none';
    erro[11].style.display = 'none';

    let numErro = 0;

    if(inputTele.value == ''){
        erro[5].style.display = "block";
        numErro += 1;
    }else if(inputTele.value.length < 15){
        erro[6].style.display = "block";
        numErro += 1;
    }

    if(inputEmailCom.value == ''){
        erro[7].style.display = "block";
        numErro += 1;
    }else if(!emailRegex.test(inputEmailCom.value)){
        erro[8].style.display = "block";
        numErro += 1;
    }

    if(inputFace.value.length > 400){
        erro[9].style.display = "block";
        numErro += 1;
    }

    if(inputInst.value.length > 400){
        erro[10].style.display = "block";
        numErro += 1;
    }

    if(inputTikT.value.length > 400){
        erro[11].style.display = "block";
        numErro += 1;
    }

    if(numErro == 0){
        slidePage.style.marginLeft = "-50%";
        bullet[current - 1].classList.add("active");
        progressText[current - 1].classList.add("active");
        progressCheck[current - 1].classList.add("active");
        current += 1;
    }
});

proxBtnThird.addEventListener("click", function(){
    erro[12].style.display = 'none';
    erro[13].style.display = 'none';
    erro[14].style.display = 'none';
    erro[15].style.display = 'none';
    
    let numErro = 0;

    if(inputBair.value == ''){
        erro[12].style.display = "block";
        numErro += 1;
    }

    if(inputEnde.value == ''){
        erro[13].style.display = "block";
        numErro += 1;
    }

    if(inputNume.value == ""){
        erro[14].style.display = "block";
        numErro += 1;
    }else if(inputNume.value < 0){
        erro[15].style.display = "block";
        numErro += 1;
    }

    if(numErro == 0){
        slidePage.style.marginLeft = "-75%";
        bullet[current - 1].classList.add("active");
        progressText[current - 1].classList.add("active");
        progressCheck[current - 1].classList.add("active");
        current += 1;
    }
});

proxBtnFourth.addEventListener("click", function(){
    erro[16].style.display = 'none';
    let numErro = 0;

    if(numErro == 0){
        slidePage.style.marginLeft = "-100%";
        bullet[current - 1].classList.add("active");
        progressText[current - 1].classList.add("active");
        progressCheck[current - 1].classList.add("active");
        current += 1;
    }
});

submitBtn.addEventListener("click", function(){
    erro[17].style.display = 'none';
    erro[18].style.display = 'none';
    erro[19].style.display = 'none';

    let numErro = 0;

    if(inputEmai.value == ''){
        erro[17].style.display = 'block';
        numErro += 1;
    }else if(!emailRegex.test(inputEmai.value)){
        erro[18].style.display = "block";
        numErro += 1;
    }

    if(altSenha && secaoSenha.style.display == 'block'){
        erro[20].style.display = "none";
        erro[21].style.display = "none";
        const senha = document.querySelector("#senha");
        if(senha.value == ''){
            erro[20].style.display = "block";
            numErro += 1;
        }
        if(senha.value.length > 0 && senha.value.length < 6){
            erro[21].style.display = "block";
            numErro += 1;
        }
    }

    
    if(numErro == 0){
        bullet[current - 1].classList.add("active");
        progressText[current - 1].classList.add("active");
        progressCheck[current - 1].classList.add("active");
        setTimeout(function(){
            submitEst.click();
        }, 800);
    }
});



voltBtnSec.addEventListener("click", function(){
    form.style.width = "500%";
    slidePage.style.marginLeft = "0%";
    bullet[current - 2].classList.remove("active");
    progressText[current - 2].classList.remove("active");
    progressCheck[current - 2].classList.remove("active");
    current -= 1;
});

voltBtnThird.addEventListener("click", function(){
    slidePage.style.marginLeft = "-25%";
    bullet[current - 2].classList.remove("active");
    progressText[current - 2].classList.remove("active");
    progressCheck[current - 2].classList.remove("active");
    current -= 1;
});

voltBtnFourth.addEventListener("click", function(){
    slidePage.style.marginLeft = "-50%";
    bullet[current - 2].classList.remove("active");
    progressText[current - 2].classList.remove("active");
    progressCheck[current - 2].classList.remove("active");
    current -= 1;
});

voltBtnFifth.addEventListener("click", function(){
    slidePage.style.marginLeft = "-75%";
    bullet[current - 2].classList.remove("active");
    progressText[current - 2].classList.remove("active");
    progressCheck[current - 2].classList.remove("active");
    current -= 1;
});

addImgBtn.addEventListener("click", function(){
    if(certo[start+1].style.display == ''){
        erroImg.style.display = 'block';
    }else{
        erroImg.style.display = 'none';
        secaoAddImg[start].style.display = 'block';
        start++;
    }
});

function validarArquivo(seletorCampo){
    let texto = seletorCampo.split(" ");
    let input = document.querySelector(texto[0]);
    let numErro = 0;
    
    if(input.files[0].type != 'image/jpeg' && input.files[0].type != 'image/gif' && input.files[0].type != 'image/png'){
        alert("Erro: Tipo de arquivo inválido, selecione um arquivo PNG, JPEG ou GIF");
        input.value = '';
        numErro++;
        certo[texto[1]].style.display = 'none';
    }

    if(input.files[0].size > (1024 * 1024 * 3)){
        alert("Erro: Tamanho máximo permitido de imagem é 3mb");
        input.value = '';
        numErro++;
        certo[texto[1]].style.display = 'none';
    }

    if(numErro == ''){
        certo[texto[1]].style.display = 'block';
    }
}
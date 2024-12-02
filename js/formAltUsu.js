const nomeUsu = document.querySelector("#nomeUsuAlt");
const emailUsu = document.querySelector("#emailUsuAlt");

const altSenha = document.querySelector(".altSenha label");
const secaoSenha = document.querySelector(".senha");

const submitBtn = document.querySelector(".form-loginEmail .submit");
const erro = document.querySelectorAll(".form-loginEmail .erro");
const submitUsu = document.querySelector("#atualizarUsu");

const certo = document.querySelector(".certo");
const fotoPerfilUsu = document.querySelector("#fotoPerfil");
const imgFotoPerfilUsu = document.querySelector(".imgUsu");

let emailRegex = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;

if(altSenha){
    secaoSenha.style.display = "none";
    numClick = 0;
    
    altSenha.addEventListener("click", function(){
        secaoSenha.style.display = "block";
        if(numClick == 0){
            const inputSenhaUsu = document.createElement("input");
            inputSenhaUsu.setAttribute('type', 'password');
            inputSenhaUsu.name = "senhaUsuAlt";
            inputSenhaUsu.id = "senhaUsuAlt";
            inputSenhaUsu.placeholder = "Digite a sua nova senha";
            secaoSenha.appendChild(inputSenhaUsu);
            numClick += 1;
        }
    });
}


submitBtn.addEventListener("click", function(){
    erro[0].style.display = "none";
    erro[1].style.display = "none";
    erro[2].style.display = "none";
    
    let numErro = 0;
    
    if(nomeUsu.value == ''){
        erro[0].style.display = "block";
        numErro += 1;
    }
    
    if(emailUsu.value == ''){
        erro[1].style.display = "block";
        numErro += 1;
    }else if(!emailRegex.test(emailUsu.value)){
        erro[2].style.display = "block";
        numErro += 1;
    }
    
    if(altSenha && secaoSenha.style.display == 'block'){
        erro[3].style.display = "none";
        erro[4].style.display = "none";
        const senhaUsu = document.querySelector("#senhaUsuAlt");
        if(senhaUsu.value == ''){
            erro[3].style.display = "block";
            numErro += 1;
        }
        if(senhaUsu.value.length > 0 && senhaUsu.value.length < 6){
            erro[4].style.display = "block";
            numErro += 1;
        }
    }
    
    if(numErro == 0){
        submitUsu.click();
    }
})

fotoPerfilUsu.addEventListener("change", function(){
    const reader = new FileReader;
    reader.onload = function(event){
        imgFotoPerfilUsu.src = event.target.result;
    }
    reader.readAsDataURL(fotoPerfilUsu.files[0]);
});

function validarArquivo(seletorCampo){
    let texto = seletorCampo;
    let input = document.querySelector(texto);
    
    if(input.files[0].type != 'image/jpeg' && input.files[0].type != 'image/gif' && input.files[0].type != 'image/png'){
        alert("Erro: Tipo de arquivo inválido, selecione um arquivo PNG, JPEG ou GIF");
        input.value = '';
    }

    if(input.files[0].size > (1024 * 1024 * 3)){
        alert("Erro: Tamanho máximo permitido de imagem é 3mb");
        input.value = '';
    }
}
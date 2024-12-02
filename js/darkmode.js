const check = document.getElementById('check');
const logoArredondada = document.querySelectorAll('.modal-body .logoArredondada');
var headerPrincipal = document.querySelector('.headerPrincipal');

check.addEventListener('change', function({ target }) {
    setTheme(target.checked ? 'dark' : 'light');
});

function setTheme(newTheme) {
    if(newTheme == 'dark'){
        if(!document.body.classList.contains('temaescuro')){
            document.body.classList.toggle('temaescuro');
        }
        document.body.classList.remove('temaclaro');
        check.checked = true;

        for(i = 0; i < logoArredondada.length; i++){
            logoArredondada[i].src = "/TechWay/img/icones/logo/logoArredondadaBranco.png";
        }
        
    }else{
        if(!document.body.classList.contains('temaclaro')){
            document.body.classList.toggle('temaclaro');
        }
        document.body.classList.remove('temaescuro');
        check.checked = false;

        for(i = 0; i < logoArredondada.length; i++){
            logoArredondada[i].src = "/TechWay/img/icones/logo/logoArredondadaAzul.png";
        }
    }
  
    localStorage.setItem('theme', newTheme); 
}

const theme = localStorage.getItem('theme');

if( theme ) {
  setTheme(theme)
}
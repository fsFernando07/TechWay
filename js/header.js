var headerPrincipal = document.querySelector('.headerPrincipal');
var headerResponsivo = document.querySelector('.headerResponsivo');

headerPrincipal.className += ' headerIndex';
headerResponsivo.className += ' headerIndex';

document.addEventListener("scroll", () => {
    var y = window.scrollY;

    if(y >= 0 && y < 800){
        if(!headerPrincipal.classList.contains('headerIndex')){
            headerPrincipal.className += ' headerIndex';
            headerResponsivo.className += ' headerIndex';
        }
    }else{
        headerPrincipal.classList.remove('headerIndex');
        headerResponsivo.classList.remove('headerIndex');
    }
});
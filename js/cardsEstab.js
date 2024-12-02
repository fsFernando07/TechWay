const cardEstab = document.querySelectorAll('.wrapper.est .card');

cardEstab.forEach(card => {
    let desc = card.querySelector('.card-text');
    let novaDesc = desc.innerHTML.split(" ");
    if(novaDesc.length > 30){
        desc.innerHTML = `${novaDesc.slice(0,30).join(" ")}...`;
    }
    card.addEventListener('click', () => {
        let submitEst = card.querySelector('#enviar');
        submitEst.click();
    });
});
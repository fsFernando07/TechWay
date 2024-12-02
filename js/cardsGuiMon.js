const cardGuiMon = document.querySelectorAll('.wrapper.mon .card');

cardGuiMon.forEach(card => {
    card.addEventListener('click', () => {
        let submitEst = card.querySelector('#enviar');
        submitEst.click();
    });
});
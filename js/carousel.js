const arrowBtn = document.querySelectorAll(".wrapper i");

arrowBtn.forEach(btn => {
    btn.addEventListener("click", () => {
        const wrapper = btn.closest(".wrapper");
        const carousel = wrapper.querySelector(".carousel");
        const card = carousel.querySelector(".card");
        const firstCardWidth = card.offsetWidth;
        carousel.scrollLeft += btn.id === "left" ? -firstCardWidth : firstCardWidth;
    })
});
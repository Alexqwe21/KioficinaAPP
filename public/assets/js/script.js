
document.addEventListener("DOMContentLoaded", function () {

    //** Controle de nota para depoimentos */
    const stars = document.querySelectorAll('.star');
    const notaInput = document.getElementById('nota_depoimento');

    stars.forEach(star => {
        star.addEventListener('click', () => {
            let value = star.getAttribute('data-value');
            notaInput.value = value;

            // Remove a classe de seleção de todas as estrelas
            stars.forEach(s => s.classList.remove('selected'));

            // Adiciona a classe até a estrela selecionada
            for (let i = 0; i < value; i++) {
                stars[i].classList.add('selected');
            }
        });
    });
})
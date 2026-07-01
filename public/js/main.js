// ==========================================================
// Modal de confirmação de exclusão
// ==========================================================

const botoesExcluir = document.querySelectorAll('.btn-excluir');
const modal = document.querySelector('#modalConfirmacao');
const nomePizzaModal = document.querySelector('#nomePizzaModal');
const btnConfirmar = document.querySelector('#btnConfirmarExclusao');
const btnCancelar = document.querySelector('#btnCancelarExclusao');

// Inicializa o modal apenas nas páginas em que ele existe.
if (modal && nomePizzaModal && btnConfirmar && btnCancelar) {

    // Abre o modal e carrega dinamicamente o nome e a URL da exclusão.
    botoesExcluir.forEach(function (botao) {

        botao.addEventListener('click', function (event) {


            event.preventDefault();

            const url = botao.dataset.url;
            const nome = botao.dataset.nome;

            nomePizzaModal.textContent = nome;
            btnConfirmar.href = url;
            modal.classList.remove('d-none');
        });
    });

    // Fecha o modal ao clicar em "Cancelar".
    btnCancelar.addEventListener('click', function () {
        modal.classList.add('d-none');
    });

    // Fecha o modal ao clicar fora da caixa de diálogo.
    modal.addEventListener('click', function (event) {
        if (event.target === modal) {
            modal.classList.add('d-none');
        }
    });

     // Fecha o modal ao pressionar a tecla ESC.
    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape') {
            modal.classList.add('d-none');
        }
    });
}

// ==========================================================
// Atualização dinâmica do horário da barra superior
// ==========================================================

const horaAtual = document.querySelector('#horaAtual');

/**
 * Atualiza o horário exibido na topbar utilizando
 * a hora atual do navegador.
 */
function atualizarHora() {
    if (!horaAtual) return;

    const agora = new Date();

    const horas = String(agora.getHours()).padStart(2, '0');
    const minutos = String(agora.getMinutes()).padStart(2, '0');

    horaAtual.textContent = `${horas}:${minutos}`;
}

// Atualiza imediatamente ao carregar a página.
atualizarHora();

// Mantém o horário sincronizado em tempo real.
setInterval(atualizarHora, 1000);
import './bootstrap';
import '~resources/scss/app.scss';
import * as bootstrap from 'bootstrap';
import.meta.glob([
    '../img/**'
])

const allDeleteButtons = document.querySelectorAll('.js-delete-btn');

allDeleteButtons.forEach((deleteButton) => {
    deleteButton.addEventListener('click', function(event) {
        event.preventDefault();

        const deleteModal = document.getElementById('confirmDeleteModal');
        const apartmentTitle = this.dataset.apartmentTitle;
        deleteModal.querySelector('.modal-body').innerHTML = `Sei sicuro di voler eliminare l'appartamento ${apartmentTitle}?`

        const bsDeleteModal = new bootstrap.Modal(deleteModal);
        bsDeleteModal.show();

        const modalConfirmDelition = document.getElementById('confirm-deletion');
        modalConfirmDelition.addEventListener('click', function() {
            deleteButton.parentElement.submit();
        });
    });
});
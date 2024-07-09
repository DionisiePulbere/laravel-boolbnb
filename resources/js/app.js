import './bootstrap';
import '~resources/scss/app.scss';
import * as bootstrap from 'bootstrap';
import.meta.glob([
    '../img/**'
])

/* INZIO BUTTON ELIMINA NELLA SHOW APARTMENTS */
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
/* FINE BUTTON ELIMINA NELLA SHOW APARTMENTS */


/* INIZIO MODALE CAROSELLO IMMAGINI */
document.addEventListener('DOMContentLoaded', function () {
    var lightboxModal = document.getElementById('lightboxModal');
    var lightboxCarousel = document.getElementById('lightboxCarousel');

    document.querySelectorAll('#apartmentImagesCarousel .carousel-item img').forEach((img, index) => {
        img.addEventListener('click', function () {
            var bsLightboxCarousel = new bootstrap.Carousel(lightboxCarousel);
            bsLightboxCarousel.to(index);
        });
    });

    lightboxModal.addEventListener('shown.bs.modal', function () {
        var bsLightboxCarousel = new bootstrap.Carousel(lightboxCarousel);
        bsLightboxCarousel.to(0);
    });
});
/* FINE MODALE CAROSELLO IMMAGINI */

/* INIZIO RICERCA TRAMITE TOM TOM INDIRIZZO NELLA CRUD */
document.getElementById('address').addEventListener('input', function () {
    const query = this.value;
    /* L'utente deve inserire alemeno 4 caratteri prima di far uscire i suggerimenti */
    if (query.length > 4) {
        fetchSuggestions(query);
    } else {
        clearSuggestions();
    }
});

function fetchSuggestions(query) {
    const apiKey = '3AC1MRPiIv2a942lYsYeHx621M3GAx0y';
    const url = `https://api.tomtom.com/search/2/search/${query}.json?key=${apiKey}&typeahead=true&limit=5`;

    fetch(url)
        .then(response => response.json()).then(data => {
            const suggestions = data.results;
            displaySuggestions(suggestions);
        })
        .catch(error => console.error('Errore:', error));
}

function displaySuggestions(suggestions) {
    const suggestionsList = document.getElementById('suggestions');
    suggestionsList.innerHTML = '';

    suggestions.forEach(suggestion => {
        const listItem = document.createElement('li');
        listItem.textContent = suggestion.address.freeformAddress;
        listItem.addEventListener('click', function() {
            document.getElementById('address').value = suggestion.address.freeformAddress;
            document.getElementById('latitude').value = suggestion.position.lat;
            document.getElementById('longitude').value = suggestion.position.lon;
            clearSuggestions();
        });
        suggestionsList.appendChild(listItem);
    });
}

    /* SE LA VIA E' STATA SCELTA, CANCELLA I SUGGERIMENTI */
function clearSuggestions() {
    const suggestionsList = document.getElementById('suggestions');
    suggestionsList.innerHTML = '';
}

let map;
let marker;

function initMap(latitude, longitude) {
    map = tt.map({
        key: '3AC1MRPiIv2a942lYsYeHx621M3GAx0y',
        container: 'map',
        center: [longitude, latitude],
        zoom: 15
    });

    marker = new tt.Marker().setLngLat([longitude, latitude]).addTo(map);
}

document.addEventListener('DOMContentLoaded', function () {
    const latitude = parseFloat(document.getElementById('latitude').textContent);
    const longitude = parseFloat(document.getElementById('longitude').textContent);
    initMap(latitude, longitude);
});
/* FINE RICERCA TRAMITE TOM TOM INDIRIZZO NELLA CRUD */

//funzione che blocca l'invio del form create dopo il primo click sul submit
const CreateForm = document.querySelector('#create-form');
const CreateBtnSubmit = document.querySelector('#createSubmit');
CreateForm.addEventListener('sumbit',onFormSubmit);
function onFormSubmit(){
    CreateBtnSubmit.classList.add('disabled');
}

/* INIZIO PAGAMENTO */
let form = document.querySelector('#payment-form');
let clientToken = "{{ $clientToken }}"; // Token del cliente generato da Braintree

braintree.dropin.create({
    authorization: clientToken,
    container: '#bt-dropin'
}, function (createErr, instance) {
    if (createErr) {
        console.error('Errore durante la creazione di Drop-in UI:', createErr);
        return;
    }

    form.addEventListener('submit', function (event) {
        event.preventDefault();

        instance.requestPaymentMethod(function (requestPaymentMethodErr, payload) {
            if (requestPaymentMethodErr) {
                console.error('Errore durante la richiesta del metodo di pagamento:', requestPaymentMethodErr);
                return;
            }

            // Inserisci il nonce generato in un campo nascosto nel form
            document.querySelector('#nonce').value = payload.nonce;

            // Invia il form al server per la transazione
            form.submit();
        });
    });
});
/* gestisci la data del carta */
document.getElementById('expiration-date').addEventListener('input', function(e) {
    let input = e.target.value;
    if (input.length === 5 && input[2] !== '/') {
        input = input.slice(0, 2) + '/' + input.slice(2);
    }
    e.target.value = input.slice(0, 5);
});
/* FINE PAGAMENTO */


/* prova */
document.addEventListener('DOMContentLoaded', function () {
    if ("{{ session('success') }}") {
        alert("{{ session('success') }}");
    }

    if ("{{ session('error') }}") {
        alert("{{ session('error') }}");
    }
});
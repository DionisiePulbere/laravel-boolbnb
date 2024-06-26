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

// Validazione Client Side 
const form = document.getElementById('create-form');
const title = document.getElementById('title');
const address = document.getElementById('address');
// const thumb = document.getElementById('thumb');
const price = document.getElementById('price');
const description = document.getElementById('description');
const squareMeters = document.getElementById('square_meters');
// const coverImage = document.getElementById('cover_image');

// form.addEventListener('submit', e => {
//     e.preventDefault();

//     validateInputs();
// });

const setError = (element, message) => {
    const inputControl = element.parentElement;
    const errorDisplay = inputControl.querySelector('.error');

    errorDisplay.innerText = message;
    inputControl.classList.add('error');
    inputControl.classList.remove('success')
}

const setSuccess = element => {
    const inputControl = element.parentElement;
    const errorDisplay = inputControl.querySelector('.error');

    errorDisplay.innerText = '';
    inputControl.classList.add('success');
    inputControl.classList.remove('error');
};

const validateInputs = () => {
    const titleValue = title.value;
    const addressValue = address.value;
    // const thumbValue = thumb.;
    const priceValue = price.value;
    const descriptionValue = description.value;
    const squareMetersValue = squareMeters.value;
    // const coverImageValue = coverImage.;


    if(titleValue === '') {
        setError(title, 'Il titolo è richiesto');
    } else {
        setSuccess(title);
    }

    if(addressValue === '') {
        setError(address, 'L\'indirizzo è richiesto');
    } else {
        setSuccess(address);
    }

    // if(thumbValue === '') {
    //     setError(thumb, 'L\'immagine di copertina è richiesta');
    // } else {
    //     setSuccess(thumb);
    // }

    if(priceValue === '') {
        setError(price, 'Il prezzo è richiesto');
    } else {
        setSuccess(price);
    }

    if(descriptionValue === '') {
        setError(description, 'La descrizione è richiesta');
    } else {
        setSuccess(description);
    }

    if(squareMetersValue === '') {
        setError(squareMeters, 'I metri quadrati sono richiesti');
    } else {
        setSuccess(squareMeters);
    }

    // if( coverImageValue === '') {
    //     setError(coverImage, 'Sono richieste almeno 3 immagini');
    // } else if( coverImageValue === 1) {
    //     setError(coverImage, 'Sono richieste altre 2 immagini');
    // } else if( coverImageValue === 2) {
    //     setError(coverImage, 'È richiesta un\'altra immagine');
    // } else {
    //     setSuccess(coverImage);
    // }
};
//funzione che blocca l'invio del form create dopo il primo click sul submit
const CreateForm = document.querySelector('#create-form');
const CreateBtnSubmit = document.querySelector('#createSubmit');
CreateForm.addEventListener('sumbit',onFormSubmit);
function onFormSubmit(){
    CreateBtnSubmit.classList.add('disabled');
}
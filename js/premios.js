const premioRadio = document.getElementById('premioCheckbox');
const estrellaCheckbox = document.getElementById('estrellaCheckbox');
const tenedorCheckbox = document.getElementById('tenedorCheckbox');
const siriCheckbox = document.getElementById('siriCheckbox');

// Agrega un controlador de eventos al radio "Premio"
premioRadio.addEventListener('change', function () {
    if (premioRadio.checked) {
        estrellaCheckbox.disabled = false;
        tenedorCheckbox.disabled = false;
        siriCheckbox.disabled = false;
    } else {
        estrellaCheckbox.disabled = true;
        tenedorCheckbox.disabled = true;
        siriCheckbox.disabled = true;
        estrellaCheckbox.checked = false;
        tenedorCheckbox.checked = false;
        siriCheckbox.checked = false;
    }
});
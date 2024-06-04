
// script.js
document.addEventListener('DOMContentLoaded', function () {
    var openPopup = document.getElementById('openPopup');
    var closePopup = document.getElementById('closePopup');
    var popup = document.getElementById('popup');

    openPopup.addEventListener('click', function (event) {
        event.preventDefault();
        popup.style.display = 'flex';
    });

    closePopup.addEventListener('click', function () {
        popup.style.display = 'none';
    });
});
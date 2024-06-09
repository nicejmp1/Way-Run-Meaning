document.addEventListener('DOMContentLoaded', function () {
    const imgSave = document.querySelector('#imgSave');

    imgSave.addEventListener('click', function () {
        const svgPath = imgSave.querySelector('svg path');
        svgPath.classList.toggle('active');
    });
});
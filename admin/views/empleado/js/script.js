const video = document.getElementById('video');
const photo = document.getElementById('photo');
const captureButton = document.getElementById('capture-btn');
const repeatButton = document.getElementById('repeat-btn');
const photoDataInput = document.getElementById('foto');
const tomarFotoCheckbox = document.getElementById('tomar-foto-checkbox');
const fotoContainer = document.getElementById('foto-container');
const canvas = document.createElement('canvas');
const context = canvas.getContext('2d');

function initializeCamera() {
    navigator.mediaDevices.getUserMedia({
        video: true
    })
        .then(function (stream) {
            video.srcObject = stream;
        })
        .catch(function (err) {
            console.log("Error al acceder a la cámara: " + err);
        });
}

document.addEventListener('DOMContentLoaded', function () {
    if (tomarFotoCheckbox.checked) {
        initializeCamera();
    }
});

captureButton.addEventListener('click', function () {
    context.drawImage(video, 0, 0, canvas.width, canvas.height);
    photoDataInput.value = canvas.toDataURL('image/png');
    photo.src = photoDataInput.value;
    photo.style.display = 'inline';
    repeatButton.style.display = 'inline';
});

repeatButton.addEventListener('click', function () {
    photo.style.display = 'none';
    video.style.display = 'inline';
    initializeCamera();
});

tomarFotoCheckbox.addEventListener('change', function () {
    if (tomarFotoCheckbox.checked) {
        fotoContainer.style.display = 'block';
        initializeCamera();
    } else {
        fotoContainer.style.display = 'none';
        if (video.srcObject) {
            video.srcObject.getTracks().forEach(function (track) {
                track.stop();
            });
        }
    }
});

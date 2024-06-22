const backgroundCanvas = document.getElementById('backgroundCanvas');
const drawingCanvas = document.getElementById('drawingCanvas');
const backgroundCtx = backgroundCanvas.getContext('2d');
const drawingCtx = drawingCanvas.getContext('2d');

const iconoPincel = document.getElementById('pincel');
const iconoBorrador = document.getElementById('borrador');
const iconoColorAzul = document.getElementById('colorAzul');
const iconoColorRojo = document.getElementById('colorRojo');
const iconoColorAmarillo = document.getElementById('colorAmarillo');
const iconoGuardar = document.getElementById('guardar');

const iconoTamanoPequeno = document.getElementById('tamanoPequeno');
const iconoTamanoMediano = document.getElementById('tamanoMediano');
const iconoTamanoGrande = document.getElementById('tamanoGrande');

let pintando = false;
let posAnterior = null;
let herramientaSeleccionada = 'pincel';
let colorSeleccionado = 'blue';

// Cargar la imagen de fondo
const img = new Image();
img.src = './images/odontograma.png';
img.onload = () => {
    backgroundCtx.drawImage(img, 0, 0, backgroundCanvas.width, backgroundCanvas.height);
};

// Funciones para cambiar la herramienta y el color
function seleccionarPincel() {
    herramientaSeleccionada = 'pincel';
}

function seleccionarBorrador() {
    herramientaSeleccionada = 'borrador';
}

function cambiarColor(color) {
    colorSeleccionado = color;
}

// Función para pintar
function pintar(x, y) {
    drawingCtx.beginPath();
    drawingCtx.strokeStyle = colorSeleccionado;
    drawingCtx.lineWidth = 5;
    drawingCtx.lineJoin = 'round';
    drawingCtx.moveTo(posAnterior.x, posAnterior.y);
    drawingCtx.lineTo(x, y);
    drawingCtx.closePath();
    drawingCtx.stroke();
    posAnterior = { x, y };
}

// Función para borrar
let tamanoBorrador = 10;

// Funciones para cambiar el tamaño del borrador
function seleccionarTamanoPequeno() {
    tamanoBorrador = 5;
}

function seleccionarTamanoMediano() {
    tamanoBorrador = 10;
}

function seleccionarTamanoGrande() {
    tamanoBorrador = 20;
}
// Eventos para cambiar el tamaño del borrador
iconoTamanoPequeno.addEventListener('click', seleccionarTamanoPequeno);
iconoTamanoMediano.addEventListener('click', seleccionarTamanoMediano);
iconoTamanoGrande.addEventListener('click', seleccionarTamanoGrande);

function borrar(x, y) {
    drawingCtx.clearRect(x - tamanoBorrador / 2, y - tamanoBorrador / 2, tamanoBorrador, tamanoBorrador);
}

// Función para guardar la imagen
function guardarImagen() {
    const tempCanvas = document.createElement('canvas');
    const tempCtx = tempCanvas.getContext('2d');
    tempCanvas.width = backgroundCanvas.width;
    tempCanvas.height = backgroundCanvas.height;
    tempCtx.drawImage(backgroundCanvas, 0, 0);
    tempCtx.drawImage(drawingCanvas, 0, 0);

    const enlace = document.createElement('a');
    enlace.href = tempCanvas.toDataURL('image/jpeg');
    enlace.download = 'paciente_odontograma.jpg';
    enlace.click();
}

// Eventos para cambiar la herramienta y el color
iconoPincel.addEventListener('click', seleccionarPincel);
iconoBorrador.addEventListener('click', seleccionarBorrador);
iconoColorAzul.addEventListener('click', () => cambiarColor('blue'));
iconoColorRojo.addEventListener('click', () => cambiarColor('red'));
iconoColorAmarillo.addEventListener('click', () => cambiarColor('yellow'));
iconoGuardar.addEventListener('click', guardarImagen);

// Eventos para pintar o borrar
drawingCanvas.addEventListener('mousedown', (event) => {
    const rect = drawingCanvas.getBoundingClientRect();
    const x = event.clientX - rect.left;
    const y = event.clientY - rect.top;
    pintando = true;
    posAnterior = { x, y };
});

drawingCanvas.addEventListener('mousemove', (event) => {
    if (!pintando) return;

    const rect = drawingCanvas.getBoundingClientRect();
    const x = event.clientX - rect.left;
    const y = event.clientY - rect.top;

    if (herramientaSeleccionada === 'pincel') {
        pintar(x, y);
    } else if (herramientaSeleccionada === 'borrador') {
        borrar(x, y);
    }
});

drawingCanvas.addEventListener('mouseup', () => {
    pintando = false;
    posAnterior = null;
});

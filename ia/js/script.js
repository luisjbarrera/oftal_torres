const dientes = {
    superiorIzquierdo: ['18', '17', '16', '15', '14', '13', '12', '11'],
    superiorDerecho: ['21', '22', '23', '24', '25', '26', '27', '28'],
    csuperiorIzquierdo: ['55', '54', '53', '52', '51'],
    csuperiorDerecho: ['61', '62', '63', '64', '65'],
    cinferiorIzquierdo: ['85', '84', '83', '82', '81'],
    cinferiorDerecho: ['71', '72', '73', '74', '75'],
    inferiorIzquierdo: ['48', '47', '46', '45', '44', '43', '42', '41'],
    inferiorDerecho: ['31', '32', '33', '34', '35', '36', '37', '38']
};

function agregarDientes(cuadranteId, listaDientes) {
    const cuadrante = document.getElementById(cuadranteId);
    listaDientes.forEach((numero) => {
        const diente = document.createElement('div');
        diente.classList.add('diente');
        diente.style.backgroundImage = `url('./images/diente${numero}.png')`;

        const texto = document.createElement('span');
        texto.classList.add('numero');
        texto.innerText = numero;
        diente.appendChild(texto);

        cuadrante.appendChild(diente);
    });
}

agregarDientes('superior-izquierdo', dientes.superiorIzquierdo);
agregarDientes('superior-derecho', dientes.superiorDerecho);
agregarDientes('csuperior-izquierdo', dientes.csuperiorIzquierdo);
agregarDientes('csuperior-derecho', dientes.csuperiorDerecho);
agregarDientes('cinferior-izquierdo', dientes.cinferiorIzquierdo);
agregarDientes('cinferior-derecho', dientes.cinferiorDerecho);
agregarDientes('inferior-izquierdo', dientes.inferiorIzquierdo);
agregarDientes('inferior-derecho', dientes.inferiorDerecho);
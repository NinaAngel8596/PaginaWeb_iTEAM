function filtrarPorModelo() {
    var filtro = document.getElementById("modeloFiltro").value;
    var equipos = document.querySelectorAll('.item');

    equipos.forEach(function(equipo) {
        var modelo = equipo.querySelector('.info-product h2').innerText.toLowerCase().replace(/\s/g, '');

        if (filtro === 'todos' || modelo === filtro) {
            equipo.style.display = 'block';  // Muestra el equipo
        } else {
            equipo.style.display = 'none';   // Oculta el equipo
        }
    });
}

function buscarPorNombre() {
    var nombreABuscar = document.getElementById("buscarNombre").value.toLowerCase();
    var equipos = document.querySelectorAll('.item');

    equipos.forEach(function(equipo) {
        var nombreEquipo = equipo.querySelector('.info-product h2').innerText.toLowerCase();

        if (nombreEquipo.includes(nombreABuscar)) {
            equipo.style.display = 'block';  // Muestra el equipo si coincide con la búsqueda
        } else {
            equipo.style.display = 'none';   // Oculta el equipo si no coincide
        }
    });
}

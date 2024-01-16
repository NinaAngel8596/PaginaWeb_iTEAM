<?php
// Conéctate a la base de datos (reemplaza con tus propios datos)
$mysqli = new mysqli('localhost', 'root', '', 'formulario');

if ($mysqli->connect_error) {
    die('Error de conexión: ' . $mysqli->connect_error);
}

// Obtén el término de búsqueda desde la solicitud AJAX
$searchTerm = $_GET['nombre'];

// Escapa el término de búsqueda para evitar inyección SQL
$searchTerm = $mysqli->real_escape_string($searchTerm);

// Consulta SQL para buscar productos por nombre
$sql = "SELECT id, nombre, precio FROM productos WHERE nombre LIKE '%$searchTerm%'";
$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
    // Construye la lista de resultados
    $results = array();
    while ($row = $result->fetch_assoc()) {
        $results[] = $row;
    }

    // Devuelve los resultados como JSON
    echo json_encode($results);
} else {
    // No se encontraron resultados
    echo json_encode(array('mensaje' => 'No se encontraron resultados'));
}

// Cierra la conexión a la base de datos
$mysqli->close();
?>

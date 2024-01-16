<?php
include("conexion.php");

if (isset($_POST['btnEnviar'])) {
    
    $nombre = trim($_POST["txtNombres"]);
    $email = trim($_POST["txtEmail"]);
    $telefono = trim($_POST["txtTlfCelular"]);
    $tipoSugerencia = trim($_POST["cbxTipoSuge"]);
    $descripcion = trim($_POST["txtDescripcion"]);  


     // Datos del archivo
     if (isset($_FILES["fileImagen"])) {
        $nombreArchivo = $_FILES["fileImagen"]["name"];
        $tipoArchivo = $_FILES["fileImagen"]["type"];
        $tamanoArchivo = $_FILES["fileImagen"]["size"];
        $rutaTemporal = $_FILES["fileImagen"]["tmp_name"];

        // Carpeta de destino para almacenar archivos
        $carpetaDestino = "carpeta_destino/"; // Reemplaza con tu carpeta

        // Generar un nombre único para el archivo
        $nombreArchivoFinal = uniqid() . "_" . $nombreArchivo;

        // Mover el archivo a la carpeta de destino
        $rutaFinal = $carpetaDestino . $nombreArchivoFinal;
        move_uploaded_file($rutaTemporal, $rutaFinal);
    }

    $consulta = "INSERT INTO datos (nombre, email, celular, Tipo_Sugerencia, descripcion, imagen_ruta) 
                 VALUES (?, ?, ?, ?, ?, ?)";

    // Utilizar una declaración preparada
    $stmt = mysqli_prepare($conex, $consulta);

    if (!$stmt) {
        die("Error al preparar la consulta: " . mysqli_error($conex));
    }

    // Vincular parámetros
    mysqli_stmt_bind_param($stmt, "ssssss", $nombre, $email, $telefono, $tipoSugerencia, $descripcion, $rutaFinal);

    // Ejecutar la consulta
    $resultado = mysqli_stmt_execute($stmt);




    

    // Verificar el resultado
    if ($resultado) {
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="style2.css">
            <title>Document</title>
        </head>
        <body>
        <header>

        <div class="menu container">

            <img class="logo-1" src="images/iteam-logo.png">
            <input type="checkbox" id="menu"/>
            <label for="menu">
                <img src="images/menu.png">
            </label>
            <nav class="navbar">
                <div class="menu-1">
                    <ul>
                        <li><a href="index.html">Inicio</a></li>
                        <li><a href="productosCarrito.html">Productos</a></li>
                        <li><a href="soporte.html">Soporte</a></li>
                    </ul>
                </div>
                <img class="logo-2" src="images/iteam-logo.png" alt="">
                <div class="menu-2">
                    <ul>
                        <li><a href="#">Horario</a></li>
                    </ul>
                    <div class="socials">
                        <a href="#">
                            <div class="social">
                                <img src="images/s1.svg">
                            </div>
                        </a>
                        <a href="#">
                            <div class="social">
                                <img src="images/s2.svg">
                            </div>
                        </a>
                        <a href="#">
                            <div class="social">
                                <img src="images/s3.svg">
                            </div>
                        </a>

                    </div>
                </div>


            </nav>
        </div>

        </header>

        <main>
        <div class="box_soporte">
            <form action="registrar.php" method="post" enctype="multipart/form-data">
                <fieldset>
                    <!-- Resto del formulario -->
                    <fieldset>
                        <legend>Contacto</legend>
                        <label>Nombre</label>
                        <input type="text" name="txtNombres" placeholder="Ingrese su nombre" required/>
                        <label>Correo Electrónico</label>
                        <input type="text" name="txtEmail" placeholder="E-mail" required/>
                        <label>Teléfono celular</label>
                        <input type="text" name="txtTlfCelular" placeholder="Teléfono celular" maxlength="9" pattern="[0-9]+" required/>
                    </fieldset>
                    <fieldset>
                        <legend>Detalle</legend>
                        <label>Tipo de sugerencia</label>
                        <select name="cbxTipoSuge">
                            <option value="mejora">Mejora del Servicio</option>
                            <option value="funciones">Nueva Funcionalidad</option>
                            <option value="problemTecnico">Problema Técnico</option>
                            <option value="Comentario">Comentario General</option>
                            <option value="Producto">Sugerencia de Producto</option>
                            <option value="Experiencia">Compartir experiencia con iTEAM</option>
                            <option value="third">Otro</option>
                        </select>
        
                        <label>Descripción de la sugerencia</label>
                        <textarea name="txtDescripcion" rows="5" cols="80" required pattern=".*\S.*"></textarea>
                        <label for="fileImagen" class="form-label">Subir una imagen</label>
                        
                        <input type="file" name="fileImagen" id="fileImagen" accept="image/*" class="form-file-input" onchange="mostrarVistaPrevia(this);" />
                        <img id="vistaPrevia" src="" alt="Vista previa de la imagen" class="vista-previa" />
                    </fieldset>
                </fieldset>
        
                <input type="submit" name="btnEnviar" value="Enviar"/>
            </form>

            <!-- Agrega este div al final del formulario para mostrar el mensaje -->
            <div id="mensajeRegistro" class="mensaje"></div>


            
        </div>
        




    </main>
        <script>
        // Mostrar un mensaje emergente (popup) después de que el registro se haya enviado
        alert('Registro enviado');
        </script>


        </body>
        </html>
        <?php
    } else {
        ?>
        <h3 class="error">Ocurrió un error</h3>
        <?php
    }

    // Cerrar la declaración preparada
    mysqli_stmt_close($stmt);
}
?>

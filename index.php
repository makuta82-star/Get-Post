<?php
// Inicializar variables
$seccionActual = "inicio";
$nombreFormulario = "";
$emailFormulario = "";
$mensajeFormulario = "";

// Procesar GET - Navegación entre secciones
if (isset($_GET['seccion'])) {
    $seccionActual = htmlspecialchars($_GET['seccion']);
}

// Procesar POST - Formulario de contacto
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['nombre']) && isset($_POST['email'])) {
    $nombreFormulario = htmlspecialchars($_POST['nombre']);
    $emailFormulario = htmlspecialchars($_POST['email']);
    $mensajeFormulario = "¡Datos recibidos correctamente!";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proyecto PHP - GET y POST</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
            color: #333;
        }

        .contenedor {
            max-width: 1000px;
            margin: 0 auto;
            background: white;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            overflow: hidden;
        }

        /* Encabezado */
        header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 40px 20px;
            text-align: center;
        }

        header h1 {
            font-size: 2.5em;
            margin-bottom: 10px;
        }

        header p {
            font-size: 1.1em;
            opacity: 0.9;
        }

        /* Navegación */
        .navegacion {
            display: flex;
            gap: 0;
            background: #f5f5f5;
            border-bottom: 2px solid #667eea;
            flex-wrap: wrap;
        }

        .enlace {
            flex: 1;
            padding: 15px 20px;
            text-decoration: none;
            color: #333;
            text-align: center;
            border-right: 1px solid #ddd;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .enlace:last-child {
            border-right: none;
        }

        .enlace:hover {
            background: #e0e0e0;
            color: #667eea;
        }

        .enlace.activo {
            background: #667eea;
            color: white;
            border-bottom: 3px solid #764ba2;
        }

        /* Contenido principal */
        main {
            display: flex;
            gap: 20px;
            padding: 30px;
        }

        .contenido {
            flex: 1;
        }

        .seccion {
            animation: fadeIn 0.5s ease-in;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .seccion h2 {
            color: #667eea;
            margin-bottom: 20px;
            font-size: 2em;
        }

        .seccion p {
            margin-bottom: 15px;
            line-height: 1.6;
            color: #555;
        }

        .seccion ul {
            margin: 20px 0 20px 30px;
            line-height: 1.8;
        }

        .seccion li {
            margin-bottom: 10px;
        }

        .seccion code {
            background: #f0f0f0;
            padding: 2px 6px;
            border-radius: 3px;
            font-family: 'Courier New', monospace;
            color: #764ba2;
        }

        .seccion h3 {
            color: #667eea;
            margin-top: 20px;
            margin-bottom: 10px;
        }

        /* Formulario */
        .formulario {
            margin-top: 20px;
            padding: 20px;
            background: #f9f9f9;
            border-radius: 8px;
            border: 2px solid #e0e0e0;
        }

        .grupo-formulario {
            margin-bottom: 20px;
        }

        .grupo-formulario label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #333;
        }

        .grupo-formulario input {
            width: 100%;
            padding: 12px;
            border: 2px solid #ddd;
            border-radius: 5px;
            font-size: 1em;
            transition: border-color 0.3s ease;
        }

        .grupo-formulario input:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 5px rgba(102, 126, 234, 0.3);
        }

        .boton {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 12px 30px;
            border: none;
            border-radius: 5px;
            font-size: 1em;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            width: 100%;
        }

        .boton:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        .boton:active {
            transform: translateY(0);
        }

        /* Mensaje de éxito */
        .mensaje-exito {
            background: #d4edda;
            border: 2px solid #28a745;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            color: #155724;
        }

        .mensaje-exito h3 {
            color: #28a745;
            margin-bottom: 15px;
        }

        .mensaje-exito p {
            margin-bottom: 8px;
        }

        /* Barra lateral */
        .info-tecnica {
            width: 280px;
            background: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            border: 2px solid #e0e0e0;
            height: fit-content;
            position: sticky;
            top: 20px;
        }

        .info-tecnica h3 {
            color: #667eea;
            margin-bottom: 15px;
            border-bottom: 2px solid #667eea;
            padding-bottom: 10px;
        }

        .info-tecnica p {
            margin-top: 10px;
            font-size: 0.9em;
            color: #666;
        }

        .info-tecnica code {
            display: block;
            background: #fff;
            padding: 10px;
            border-radius: 5px;
            border-left: 3px solid #667eea;
            font-family: 'Courier New', monospace;
            word-break: break-all;
            color: #764ba2;
            font-size: 0.85em;
            margin-bottom: 15px;
        }

        /* Footer */
        footer {
            background: #f5f5f5;
            padding: 20px;
            text-align: center;
            color: #666;
            border-top: 2px solid #e0e0e0;
        }

        footer p {
            margin: 0;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .navegacion {
                flex-direction: column;
            }

            .enlace {
                border-right: none;
                border-bottom: 1px solid #ddd;
            }

            main {
                flex-direction: column;
            }

            .info-tecnica {
                width: 100%;
                position: static;
            }

            header h1 {
                font-size: 1.8em;
            }

            .seccion h2 {
                font-size: 1.5em;
            }
        }
    </style>
</head>
<body>
    <div class="contenedor">
        <!-- Encabezado -->
        <header>
            <h1>Sistema de Navegación y Contacto</h1>
            <p>Demostración de métodos GET y POST en PHP</p>
        </header>

        <!-- Navegación -->
        <nav class="navegacion">
            <a href="?seccion=inicio" class="enlace <?php echo $seccionActual === 'inicio' ? 'activo' : ''; ?>">
                🏠 Inicio
            </a>
            <a href="?seccion=unidades" class="enlace <?php echo $seccionActual === 'unidades' ? 'activo' : ''; ?>">
                📚 Unidades
            </a>
            <a href="?seccion=informacion" class="enlace <?php echo $seccionActual === 'informacion' ? 'activo' : ''; ?>">
                ℹ️ Información
            </a>
            <a href="?seccion=contacto" class="enlace <?php echo $seccionActual === 'contacto' ? 'activo' : ''; ?>">
                ✉️ Contacto
            </a>
        </nav>

        <!-- Contenido principal -->
        <main class="contenido">
            <?php
            // Mostrar contenido según la sección (GET)
            switch ($seccionActual) {
                case 'inicio':
                    echo '<div class="seccion">';
                    echo '<h2>Bienvenido - Sección: INICIO</h2>';
                    echo '<p>Esta es la página de inicio del proyecto. Utiliza los enlaces de navegación para explorar diferentes secciones.</p>';
                    echo '<p><strong>Método utilizado:</strong> GET (a través de parámetros en la URL)</p>';
                    echo '<p>Observa la URL: <code>?seccion=inicio</code></p>';
                    echo '</div>';
                    break;

                case 'unidades':
                    echo '<div class="seccion">';
                    echo '<h2>Sección: UNIDADES</h2>';
                    echo '<p>Aquí se mostrarían las unidades educativas del curso.</p>';
                    echo '<ul>';
                    echo '<li>Unidad 1: Introducción a PHP</li>';
                    echo '<li>Unidad 2: Métodos GET y POST</li>';
                    echo '<li>Unidad 3: Manejo de formularios</li>';
                    echo '<li>Unidad 4: Validación de datos</li>';
                    echo '</ul>';
                    echo '<p><strong>Método utilizado:</strong> GET (parámetro: <code>seccion=unidades</code>)</p>';
                    echo '</div>';
                    break;

                case 'informacion':
                    echo '<div class="seccion">';
                    echo '<h2>Sección: INFORMACIÓN</h2>';
                    echo '<p>Información general sobre el proyecto.</p>';
                    echo '<h3>Sobre este proyecto:</h3>';
                    echo '<p>Este proyecto demuestra el uso de métodos GET y POST en PHP:</p>';
                    echo '<ul>';
                    echo '<li><strong>GET:</strong> Utilizado para navegar entre secciones</li>';
                    echo '<li><strong>POST:</strong> Utilizado para enviar formularios de contacto</li>';
                    echo '</ul>';
                    echo '<p><strong>Método utilizado:</strong> GET (parámetro: <code>seccion=informacion</code>)</p>';
                    echo '</div>';
                    break;

                case 'contacto':
                    echo '<div class="seccion">';
                    echo '<h2>Sección: CONTACTO</h2>';
                    echo '<p>Envía tus datos de contacto utilizando el formulario de abajo.</p>';
                    echo '<p><strong>Método utilizado:</strong> GET para navegar + POST para el formulario</p>';
                    
                    // Mostrar mensaje si el formulario fue enviado
                    if ($mensajeFormulario) {
                        echo '<div class="mensaje-exito">';
                        echo '<h3>' . $mensajeFormulario . '</h3>';
                        echo '<p><strong>Datos recibidos por POST:</strong></p>';
                        echo '<p><strong>Nombre:</strong> ' . $nombreFormulario . '</p>';
                        echo '<p><strong>Email:</strong> ' . $emailFormulario . '</p>';
                        echo '</div>';
                    }
                    
                    echo '<form method="POST" class="formulario">';
                    echo '<div class="grupo-formulario">';
                    echo '<label for="nombre">Nombre:</label>';
                    echo '<input type="text" id="nombre" name="nombre" required>';
                    echo '</div>';
                    echo '<div class="grupo-formulario">';
                    echo '<label for="email">Correo Electrónico:</label>';
                    echo '<input type="email" id="email" name="email" required>';
                    echo '</div>';
                    echo '<button type="submit" class="boton">Enviar (POST)</button>';
                    echo '</form>';
                    echo '</div>';
                    break;

                default:
                    echo '<div class="seccion">';
                    echo '<h2>Sección no encontrada</h2>';
                    echo '<p>La sección solicitada no existe. Por favor, utiliza los enlaces de navegación.</p>';
                    echo '</div>';
            }
            ?>
        </main>

        <!-- Información técnica -->
        <aside class="info-tecnica">
            <h3>Información Técnica</h3>
            <p><strong>Sección Actual (GET):</strong></p>
            <code><?php echo "?seccion=" . $seccionActual; ?></code>
            <p><strong>Método Utilizado:</strong></p>
            <code><?php echo $_SERVER['REQUEST_METHOD']; ?></code>
            <?php if ($_SERVER['REQUEST_METHOD'] == 'POST'): ?>
                <p><strong>Variables POST Recibidas:</strong></p>
                <code>
                    <?php
                    echo "nombre: " . $nombreFormulario . "<br>";
                    echo "email: " . $emailFormulario;
                    ?>
                </code>
            <?php endif; ?>
        </aside>

        <footer>
            <p>&copy; 2024 Proyecto PHP - GET y POST | Ejercicio Educativo</p>
        </footer>
    </div>
</body>
</html>

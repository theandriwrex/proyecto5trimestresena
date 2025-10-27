<?php

// Incluir conexión a base de datos
require_once 'config/conexion.php';

// Obtener el controlador y la acción desde la URL, con valores por defecto
$controller = isset($_GET['controller']) ? $_GET['controller'] : 'registrop';
$action = isset($_GET['action']) ? $_GET['action'] : 'index';

$controllerFile = 'controllers/' . $controller . '.php';

if (file_exists($controllerFile)) {
    require_once $controllerFile;

    
    $controllerClass = ucfirst($controller);

    if (class_exists($controllerClass)) {
        $controllerObj = new $controllerClass();

        if (method_exists($controllerObj, $action)) {
            $controllerObj->$action();
        } else {
            echo "La acción '{$action}' no existe en el controlador '{$controllerClass}'.";
        }
    } else {
        echo "La clase de controlador '{$controllerClass}' no existe.";
    }
} else {
    echo "El archivo del controlador '{$controller}.php' no existe.";
}
?>

<?php
session_start();
require_once './config/global.php';
require_once './core/HttpClient.php';

// Obtener la URL de la solicitud
$request = $_SERVER['REQUEST_URI'];
$request = parse_url($request, PHP_URL_PATH);
$segments = explode('/', trim($request, '/'));

// Función para mostrar la página de inicio y devolver un código 404
function home() {
    http_response_code(404);
    require ROOT_DIR . '/view/home.php';
    exit;
}

// Función para verificar el login (aún sin implementación)
function verificarlogin() {
    // Implementar la lógica de verificación de login aquí
}

// Manejo de rutas
if ($segments[0] === 'clientes') {
    switch ($segments[1] ?? '') {
        case "web":
            switch ($segments[2] ?? '') {
                case "cli":
                    switch ($segments[3] ?? '') {
                        case "list":
                            include ROOT_VIEW . '/web/clientes/list.php';
                            break;
                        case 'edit':
                            if (isset($segments[4])) {
                                $_GET['id'] = $segments[4];
                                $_GET['accion'] = 'EDIT';
                                require ROOT_VIEW . '/web/clientes/edit.php';
                            } else {
                                home();
                            }
                            break;
                        case 'new':
                            if (isset($segments[4])) {
                                $_GET['id'] = $segments[4];
                                $_GET['accion'] = 'NEW';
                                require ROOT_VIEW . '/web/clientes/edit.php';
                            } else {
                                home();
                            }
                            break;
                        case 'delete':
                            if (isset($segments[4])) {
                                $_GET['id'] = $segments[4];
                                $_GET['accion'] = 'DELETE';
                                require ROOT_VIEW . '/web/clientes/edit.php';
                            } else {
                                home();
                            }
                            break;
                        case 'view':
                            if (isset($segments[4])) {
                                $_GET['id'] = $segments[4];
                                $_GET['accion'] = 'VIEW';
                                require ROOT_VIEW . '/web/clientes/edit.php';
                            } else {
                                home();
                            }
                            break;
                        default:
                            home();
                            break;
                    }
                    break;
                default:
                    home();
                    break;
            }
            break;
        default:
            home();
            break;
    }
} else {
    home();
}

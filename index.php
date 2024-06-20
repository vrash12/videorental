<?php
// Start the session
session_start();

// Define the base URL
define('BASE_URL', 'http://localhost/VideoRentalSystem');

// Include the configuration and utility files
require_once 'config/config.php';
require_once 'config/utils.php';
require_once 'models/Video.php';
require_once 'models/User.php';
require_once 'models/Rental.php';

// Utility function to load views
function loadView($view, $data = [])
{
    extract($data);
    require 'views/' . $view . '.php';
}

// Load the controller and action from the URL parameters
$controllerName = isset($_GET['controller']) ? ucfirst($_GET['controller']) . 'Controller' : 'HomeController';
$actionName = isset($_GET['action']) ? $_GET['action'] : 'index';

// Check if the controller file exists
$controllerFile = 'controllers/' . $controllerName . '.php';
if (file_exists($controllerFile)) {
    require_once $controllerFile;
} else {
    die('Controller not found: ' . $controllerFile);
}

// Instantiate the controller class
if (class_exists($controllerName)) {
    $controller = new $controllerName();
} else {
    die('Class not found: ' . $controllerName);
}

// Check if the method exists in the controller
if (method_exists($controller, $actionName)) {
    $controller->$actionName();
} else {
    die('Action not found: ' . $actionName);
}
?>

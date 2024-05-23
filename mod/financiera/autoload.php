
<?php
// function controllers_autoload($classname){

// 	include 'controllers/' . $classname . '.php';
// }

// spl_autoload_register('controllers_autoload');


function controllers_autoload($classname) {
    $parts = explode('\\', $classname);
    $filename = implode('/', $parts) . '.php';

    if (file_exists(__DIR__ . '/controllers/' . $filename)) {
        include __DIR__ . '/controllers/' . $filename;
    } elseif (file_exists(__DIR__ . '/../../vendor/' . $filename)) {
        include __DIR__ . '/../../vendor/' . $filename;
    }
}

spl_autoload_register('controllers_autoload');

// Aquí puedes tener otras configuraciones o inclusiones que necesites





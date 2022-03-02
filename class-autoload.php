<?php


spl_autoload_register("autohload");

function autohload($classname)
{
    $path = 'classes/';
    $ext = '.class.php';
    $fileName = $path . $classname . $ext;

    if (!file_exists($fileName)) {
        return false;
    }

    include_once $fileName;
}

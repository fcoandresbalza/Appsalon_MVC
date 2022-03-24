<?php

function debuguear($variable) : string {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

// Escapa / Sanitizar el HTML
function s($html) : string {
    $s = htmlspecialchars($html);
    return $s;
}

//Para verificar si se accede desde una cuenta autenticada
function isAuth() :void {
    if(!$_SESSION['login']){
        header('Location: /');
    }
}

function esUltimo(string $actual, string $proximo) :bool {
    if($actual !== $proximo){
        return true;
    }
    return false;
}

//Para verificar si se accede desde una cuenta autenticada
function isAdmin() :void {
    if(!$_SESSION['admin']){
        header('Location: /');
    }
}
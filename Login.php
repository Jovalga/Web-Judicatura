<?php

// Iniciamos las variables de sesión
if(session_status()==PHP_SESSION_NONE){
	session_start();
}

// Activamos que se muestren los errores
error_reporting(E_ALL);
ini_set('display_errors', '1');

// Declaramos que necesitamos el archivo db.php para acceso a base de datos
require "db.php";


echo <<< HTML
	<main id="Contenido">
HTML;


echo <<< HTML

    <h1>Función aún sin implementar</h1>

HTML;



    // Finalmente mostramos el botón para volver a
    // la lista de artículos completa
    echo <<< HTML
    <div class="BotonAtras">
        <form action="index.php?p=Evaluar" method="post">
            <input type='submit' name='VolverEvaluarEscrito' value='Volver'>
        </form>        
    </div>
HTML;

echo <<< HTML
    </main>
HTML;
?>
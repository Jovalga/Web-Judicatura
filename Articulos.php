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


    // Vemos si se ha seleccionado algún artículo de la lista
    if(isset($_GET["Art"])){

        // Mostramos el título del artículo
        echo "<h3>".htmlentities($_GET["Art"])."</h3>";
        
        // Mostramos el contenido del artículo
        echo "<article class='ContenidoArticulo'>";
        $db = DB_conectar();
        if($db != 'error'){
            DB_mostrarContenidoArticulo($db, $_GET["Art"]);
        }
        echo "</article>";

        // Finalmente mostramos el botón para volver a
        // la lista de artículos completa
echo <<< HTML
        <div class="BotonAtras">
            <form action="index.php?p=Ver Articulos" method="post">
				<input type='submit' name='Atrás' value='Volver a la lista completa'>
            </form>        
        </div>
HTML;
    }

    // Si no se ha seleccionado ningún elemento de la lista
    // se le pide a la DB que muestre el título de
    // los artículos que hay guardados en a DB
    else{

echo <<< HTML
        <h2>Articulos</h2>
	    <article id="Articulos">
		    <p class="TextoGeneral"> En esta pagina
               puede ver la lista de articulos, por
               favor escoja el que desee leer.
            </p>
	    </article>

HTML;

    // Nos conectamos a la base de datos y mostramos
    // la lista con los títulos de los artículos 
    $db = DB_conectar();
    if ($db != 'error')
        $res = DB_mostrarTitulosArticulos($db);
    }


echo <<< HTML
    </main>
HTML;

?>
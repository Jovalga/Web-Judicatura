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

   <h2>Evaluar</h2>
		<article id="Evaluar">
			<p class="TextoGeneral">Esta es la pagina de
                evaluacion de conocimiento de los articulos,
                puede seleccionar el modo escrito o el modo dictado.
            </p>
		</article>
HTML;


       // Mostramos los botones para que el usuario
       // escoja la opción que más desea
echo <<< HTML
        <div class="BotonOpcionEvaluar">
            <form action="index.php?p=EvaluarEscrito" method="post">
                <input type='submit' name='OpcionEscrito' value='Escrito'>
            </form>   
        </div>

        <div class="BotonOpcionEvaluar">
            <form action="index.php?p=EvaluarVoz" method="post">
                <input type='submit' name='OpcionVoz' value='Voz'>
            </form>        
        </div>
HTML;

echo <<< HTML
    </main>
HTML;

?>
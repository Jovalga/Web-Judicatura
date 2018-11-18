<?php

// Iniciamos las variables de sesión
if(session_status()==PHP_SESSION_NONE){
	session_start();
}

// Activamos que se muestren los errores
error_reporting(E_ALL);
ini_set('display_errors', '1');

// Declaramos que necesitamos el archivo db.php para acceso a base de datos
// Necesitamos también el archivo Corregir.php
require "db.php";


?>

<script type="text/javascript">

// Declaramos las siguientes líneas para que se llame
// a la función aplicarPorcentaje nada más cargar la 
// página, de este modo el textarea aparecerá con el
// texto del artículo ya codificado con el porcentaje
// indicado al llamar a la función aplicarPorcentaje.
window.onload = function(){
    aplicarPorcentaje(100);
};

// Función que dado un string se reemplaza la letra en el indice
// index por la letra indicada en replace
function replaceAt(string, index, replace){
    return string.substring(0, index) + replace + string.substring(index + 1);
}

/////////////////////////////////////////////////////////////////////

function aplicarPorcentaje(porcentaje){
    
    // Si el porcentaje que han puesto está vacío avisamos al respecto
    if(porcentaje.length == 0)
        alert("El valor del porcentaje está vacío. Por favor, ponga un valor válido entre 0 y 100.");
    else{
        var texto = document.getElementById('ContenidoArticulo').value;
        var longitud = texto.length;
        
        // Vamos a obtener un valor entre 0 y 100 para
        // luego comparar con el porcentaje dado y así
        // saber si hay que borrar una palabra o no
        var azar = Math.floor(Math.random() * 101);
        if(porcentaje > azar -1)
            var borrar = true;
        else
            var borrar = false;

        // Recorremos todos los caracteres del texto
        for(var i=0 ; i<longitud; i++){

            // Comprobamos que el caracter a reemplazar
            // no sea un punto, ni una coma, ni un salto de línea    
            if(texto.charAt(i) != ',' &&
               texto.charAt(i) != '.' &&
               texto.charAt(i) != '\n' ){

                // Si el caracter a reemplazar es un espacio en blanco se respeta.
                // En el caso de encontrarnos con un espacio en blanco
                // volvemos a lanzar el azar para ver si vamos a borrar
                // a partir de este espacio en blanco hasta el siguiente 
                if(texto.charAt(i) == ' '){
                    azar = Math.floor(Math.random() * 101);
                    if(porcentaje > azar -1)
                        borrar = true;
                    else
                        borrar = false;
                }
                else{
                    // Solo se borra si el variable borrar == true
                    if(borrar)
                        texto = replaceAt(texto, i, '_');
                }
            }
        }
        document.getElementById('TextoBruto').innerHTML = texto;
    }
}

/////////////////////////////////////////////////////////////////////

function corregir(){
    
    // Guardamos los textos (el original y el escrito por el alumno)
    // en sus respectivas variables
    var textoOriginal = document.getElementById('ContenidoArticulo').value;
    var textoAlumno = document.getElementById('TextoBruto').textContent;

    // Guardamos las palabras del texto original y
    // las palabras del texto escrito por el alumno
    var palabrasOriginal = textoOriginal.split(' ');
    var palabrasAlumno = textoAlumno.split(' ');
    
    // Primero comprobamos que estén escritas todas las palabras
    // Si no, mostramos el nº de palabras que sobran/faltan
    if (palabrasAlumno.length != palabrasOriginal.length){
        if(palabrasAlumno.length < palabrasOriginal.length){
            var falta = palabrasOriginal.length - palabrasAlumno.length;
            alert("Te faltan " + falta + " palabras por escribir.");
        }
        else{
            var sobra = palabrasAlumno.length - palabrasOriginal.length;
            alert("Te sobran " + sobra + " palabras");
        }
    }
    // Una vez comprobado que los textos tienen las mismas palabras
    // pasamos a comprobar si las palabras coinciden, si no es
    // así, mandamos la palabra incorrecta al método highlight,
    // el cual se encarga de pintarla en rojo para indicar que
    // es incorrecta.
    else{
        textoFinal = new Array(); // Declaramos el array que contendrá
                                  // el textoFinal que irá al textarea 
        for (i=0 ; i < palabrasOriginal.length; i++){
            
            // Si hay error ponemas la palabra en rojo
            if (palabrasAlumno[i] != palabrasOriginal[i]){
                
                palabraNueva = "<span class='highlightError'>" + palabrasAlumno[i] + '</span>';
                textoFinal.push(palabraNueva);
            }
            // Si las palabras son iguales simplemente añadimos
            // la palabra correcta.
            else{
                palabraNueva = "<span class='highlightAcierto'>" + palabrasAlumno[i] + '</span>';
                textoFinal.push(palabraNueva);
            }
        }
        // Tras acabar el bucle mandamos mostrar el textoAlumno
        // con aquellas palabras que han sido marcadas con highlight
        document.getElementById('TextoBruto').innerHTML = textoFinal.join(" ");
    }
}



</script>



<?php
echo <<< HTML
	<main id="Contenido">
HTML;

   
    // Nos conectamos a la base de datos y le pedimos un
    // artículo aleatorio de todos los que hay
    $db = DB_conectar();
    if($db != 'error'){
        $articulo = DB_getArticuloAleatorio($db);
        if ($articulo != 'error'){

            // Si no ha habido errores mostramos el título del artículo
            // que el alumno deberá completar
            echo "<h3>".htmlentities($articulo['Titulo'], ENT_QUOTES)."</h3>";

            // Guardamos los valores del artículo
            // de una forma más cómoda
            $titulo = $articulo['Titulo'];
            $contenido = $articulo['Contenido'];
            $tema = $articulo['Tema'];
            $materia = $articulo['Materia'];

            // Mostramos seguidamente el área de texto donde el alumno
            // deberá escribir el artículo.
            // Vamos a crear el div editable donde
            // el alumno escribirá el artículo.
            // Vamos a llamar al método aplicarPorcentaje, que lo
            // que hace es borrar palabras con un porcentaje dado,
            // al comienzo será del 100, pero el alumno lo puede
            // cambiar siempre que quiera
            // Hay un textarea inicial con id=ContenidoArticulo y 
            // display none; que contiene el contenido original
            // del artículo para poder cambiar el 
            // del alumno en todo momento mediante Javascript
echo <<< HTML

        <div class="CuadroTexto">
            <textarea id='ContenidoArticulo'
                    name='ContenidoArticulo'
                    style='display: none;'>
HTML;
                    echo "".$articulo['Contenido']."</textarea>";
echo <<< HTML
            <label>Escriba el artículo:<br>
                <div contenteditable="true"
                    id='TextoBruto'
                    name='TextoBruto'
                ></div>
            </label>
            
            <div class='BotonesCuadroTexto'>
                <input type='submit' name='EvaluarCorregir' value='Corregir'
                    onclick="corregir()">Porcentaje de vaciado:<br>
                <input type='number' id='Porcentaje' name='Porcentaje' value='100'
                    min='0' max ='100' onchange="aplicarPorcentaje(document.getElementById('Porcentaje').value)">
HTML;
            // Código para que aparezca un botón aplicar
                //<input type='button' name='BotonAplicarPorcentaje' value='Aplicar'
                //    onclick="aplicarPorcentaje(document.getElementById('Porcentaje').value)">
echo <<< HTML
                </div>
        </div>
HTML;


            }
        }
        // Damos la opción de mostrar otro artículo si el alumno desea
        // resolver otro distinto del que ha aparecido
echo <<< HTML
    <div class="BotonAtras">
        <form action="index.php?p=EvaluarEscrito" method="post">
            <input type='submit' name='CambiarArticulo' value='Cambiar Artículo'>
        </form>
    </div>
HTML;



    // Finalmente mostramos el botón para volver a
    // la lista de artículos completa
echo <<< HTML
        <div class="BotonAtras">
            <form action="index.php?p=Evaluar" method="post">
				<input type='submit' name='VolverEvaluarEscrito' value='Salir'>
            </form>
        </div>
HTML;

echo <<< HTML
    </main>
HTML;
?>
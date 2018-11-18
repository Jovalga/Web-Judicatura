<?php

// Iniciamos las variables de sesión
if(session_status()==PHP_SESSION_NONE){
	session_start();
}


error_reporting(E_ALL);
ini_set('display_errors', '1');

// Declaramos los archivos .php que nos hacen falta
require "comun.php";
	
	
	// Empezamos a generar código html mediante php
	HTMLinicio();

	
	
	// Vamos a ver que contenido tenemos que mostrar según lo seleccionado
	// en el navegador, aunque primero tenemos que comprobar si
	// se ha solicitado alguna página en el navegador o no
	if(!isset($_GET["p"]))
		$_GET['p'] = 'Inicio';
	else if($_GET["p"] < 0 || $_GET["p"] > 3)
		$_GET['p'] = 'Inicio';
	
	
	// Si $_GET["p"] == "Inicio" mostramos el header (imagen)
	if($_GET["p"] == "Inicio")
		HTMLheaderInicial();
	
	
	// Mandamos que se muestre el navegador mandando como elemento
	// activo aquel que haya sido seleccionado
	HTMLnav($_GET["p"]);


	// Si se está identificado mostramos el navegador correspondiente
	// al tipo de usuario identificado
	if(isset($_SESSION["usuario"])){
		if($_SESSION["tipo"] == 'admin'){
			HTMLnavAdmin($_GET["p"]);
		}
		if($_SESSION["tipo"] == 'gestor'){
			HTMLnavGestor($_GET["p"]);
		}
	}
	

	switch($_GET["p"]){
		
		// En el caso de que se elija inicio desde el navegador mostramos
		// el contenido de la página inicio
		case 'Inicio':
			include "inicio.html";
			break;
		
		// En el caso de Biografía mostramos la página de la biografía
		// del grupo
		case 'Ver Articulos':
			include "Articulos.php";
			break;
			
		// Para este caso tenemos que ver si se ha seleccionado algún
		// disco en concreto
		case 'Evaluar':
			include "Evaluar.php";
			break;
		
		// Si nos piden desde la página "evaluar" la opción 
		// escrito incluimos el archivo php correspondiente
		case 'EvaluarEscrito':
			include "EvaluarEscrito.php";
			break;

		// Si nos piden desde la página "evaluar" la opción voz
		// incluimos el archivo php correspondiente
		case 'EvaluarVoz':
			include "EvaluarVoz.php";
			break;

		// Vemos si el visitante quiere hacer Login
		case 'Login':
			include "Login.php";
			break;

	}


	HTMLfooter();
	HTMLfin();


?>

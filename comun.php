<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

function HTMLinicio(){
	
echo <<< HTML

	<!DOCTYPE html>

	<html lang="es">
	
	<head>
		<meta charset="UTF-8">
		<meta name="author" content="Jorge Valenzuela García">
		<title>Autocompletar Artículos</title>
		<link href="Imágenes/icono.jpg" rel="shortcut icon" type="image/x-icon">	
		<link rel="stylesheet" href="estilo.css">
</head>

	<body>

HTML;
}
 

function HTMLfin(){
echo <<< HTML

	</body>
	</html>

HTML;
}


function HTMLheaderInicial(){
echo <<< HTML

		<header id="Cabecera">
		</header>

HTML;
}

/* Cambiar Logout en header por logout en nav
function HTMLheaderLogout(){
echo <<< HTML

		<header id="Cabecera">
		<h1 id="TituloHeader">Destino Final: Juez</h1>
			<div class="Logeo" id="Logeo">
				<a href="index.php?p=Login&Logout=Logout">Logout</a>
			</div>
		</header>

HTML;
}
*/


function HTMLnav($activo){

echo <<< HTML
	
	<nav id="Navegador">
		<div class="IndicesNav">
			<ul>
HTML;

	$items = ["Inicio", "Ver Articulos", "Evaluar"];

	foreach ($items as $k => $v){
	/*if($v == "Evaluar"){
		echo 
		"<div class='dropdown'>
			<a href='index.php?p=".($v)."'>
			<li".($v==$activo?" class='activo'":"").">".($v)."</li></a>";
		echo	
			"<div class='dropdown-content'>
				<a href='index.php?p=EvaluarEscrito'>
				<a href='index.php?p=EvaluarVoz'>
			</div>
		</div>";

	}
	else*/
		echo 
			 "<a href='index.php?p=".($v)."'>
			 <li".($v==$activo?" class='activo'":"").">".($v)."</li></a>";
	}
echo <<< HTML

			</ul>
		</div>
		<div class="Logeo">
			<a href="index.php?p=Login">Login</a>
		</div>
	</nav>

HTML;
}



function HTMLnavAdmin($activo){
echo <<< HTML
	
	<nav id="Navegador">
		<ul>
HTML;

	$items = [	"VerUsuarios", "EditarUsuarios", "CrearUsuario",
				"AñadirBiografía","EditarBiografia",
				"AñadirComponente", "EditarComponentes",
				"AñadirDisco", "EditarDiscografía",
				"CrearConcierto", "EditarConciertos",
				"VerLog", "BBDD"];

	foreach ($items as $k => $v)
		echo "<li".($v==$activo?" class='activo'":"").">".
			 "<a href='index.php?p=".($v)."'>".$v."</a></li>";

echo <<< HTML

		</ul>
	</nav>

HTML;
}



function HTMLfooter(){
echo <<< HTML

	<footer id="Pie">
		
		<div class="FooterEnlaces">
			<div class="enlace hvr-underline-from-left" id="urlOficial">
				<a href="http://www.poderjudicial.es/cgpj/es/Servicios/Acceso-a-la-Carrera-Judicial--Jueces-y-Fiscales/Anuncios/">Visita la Web Oficial del Poder Judicial para ver los anuncios de las oposiciones</a>
			</div>
			
			<div class="enlace hvr-underline-from-left" id="EnlaceBOE">
				<a href="https://www.boe.es/diario_boe/">BOE</a>
			</div>	
			
			<div class="enlace hvr-underline-from-left" id="Documentacion">
				<a href="./Documentación.pdf">Documentación</a>
			</div>
		</div>

		<div class="copyright" id="copy">
			&copy; 2018 por Jorge Valenzuela García. Todos los derechos reservados.
		</div>
			
	</footer>

HTML;
}

?>

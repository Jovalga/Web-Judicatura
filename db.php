<?php

// Activamos que se muestren los errores
error_reporting(E_ALL);
ini_set('display_errors', '1');

// Declaramos que necesitamos el archivo dbcredenciales.php
// para acceso a base de datos
require_once('dbcredenciales.php');
	
	
// Función para conectar con la base de datos
// Devuelve la base de datos si tiene éxito
// Devuelve 'error' si no se puede conectar
function DB_conectar(){
	
	$db = mysqli_connect(DB_HOST, DB_USER, DB_PASSWD, DB_DATABASE);
	if($db){
		mysqli_set_charset($db,"utf8");
		return $db;
	}
	else{
		mysqli_set_charset($db,"utf8");
		echo "<p class='ErrorDB'>Error de conexión</p>";
		echo "<p class='ErrorDB'>Código: ".mysqli_connect_errno()."</p>";
		echo "<p class='ErrorDB'>Mensaje: ".mysqli_connect_error()."</p>";
		die("Adiós");
		return 'error';
	}
}



// Función para mostrar los títulos de los artículos de la DB
function DB_mostrarTitulosArticulos($db){
	
	$res = mysqli_query($db, "SELECT Titulo FROM Articulos");
	if($res){
		if(mysqli_num_rows($res) > 0){
			
			echo "<h4>Lista de artículos</h4>";
			echo "<ul class='ListaArticulos'>";

			while($tupla=mysqli_fetch_array($res))
				echo "<li>
						<a href='index.php?p=Ver Articulos&Art=".urlencode($tupla['Titulo'])."'>- <span class=' hvr-sweep-to-right'>".($tupla['Titulo'])."</span></a>
					</li>";
			
			echo "</ul>";
		}
		else
			echo "<p class='MensajeDB'>No hay artículos guardados en la base de datos.</p>";
	}
	else
		echo "<p class='ErrorDB'>Error en la consulta a la base de datos</p>";
}



// Función que muestra el contenido de un artículo
// dado el título del mismo
function DB_mostrarContenidoArticulo($db, $titulo){

	// Queremos obtener de la DB todos los datos del artículo
	// dado el título del mismo
	$res = mysqli_query($db, "SELECT * FROM Articulos WHERE Titulo=
		'".mysqli_real_escape_string($db,$titulo)."'");

	// Una vez obtenidos los datos los mostramos
	if($res){
		while($datos = mysqli_fetch_array($res)){
			
			echo "<div class='Articulo'>
			<p class='ArticuloContenido'>
			".htmlentities($datos['Contenido'], ENT_QUOTES)."</p>";
			
			echo "<p class='ArticuloTema'>
			".htmlentities($datos['Tema'], ENT_QUOTES)."</p>";
			
			echo "<p class='ArticuloMateria'>
			".htmlentities($datos['Materia'], ENT_QUOTES)."</p>
			</div>";
		}
	}
	else
		echo "<p class='ErrorDB'>Error en la consulta a los datos del artículo</p>";

}



// Función que devuelve un artículo aleatorio de entre todos
// los que hay en la DB
function DB_getArticuloAleatorio($db){
	
	// Seleccionamos un artículo de la lista aleatoriamente gracias
	// a la función RAND de MySQL
	$res = mysqli_query($db, "SELECT * FROM Articulos ORDER BY RAND() LIMIT 1");
	
	if($res){	
		// Guardamos el valor obtenido en $articulo
		$articulo = mysqli_fetch_assoc($res);		
		// Finalmente devolvemos el artículo obtenido
		return $articulo;
	}
	else{
		echo "<p class='ErrorDB'>Error a la hora de obtener un artículo de la base de datos</p>";
		return 'error';
	}
}


?>

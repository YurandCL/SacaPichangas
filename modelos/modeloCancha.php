<?php
header("Access-Control-Allow-Origin:*");
header("Content-Type: application/x-www-form-urlencoded");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

$server = "localhost";
$user = "root";
$pass = "";
$bd = "sacapichangas";

session_start();

$conexion = mysqli_connect($server, $user, $pass,$bd)
or die("error");


$postdata = json_decode(file_get_contents("php://input"));


/* Funcion para Listar Canchas*/
if($postdata->metodo=="listarCanchas"){
	$sql="SELECT canchas.id_cancha, canchas.nro_cancha, tipo_canchas.nombre_tipo_cancha, canchas.descripcion_cancha, canchas.ruta_imagen_cancha
		FROM canchas INNER JOIN tipo_canchas ON tipo_canchas.id_tipo_cancha = canchas.id_tipo_cancha
		WHERE canchas.id_local = '".$postdata->id_local."';";
	$resultado = mysqli_query($conexion, $sql) or die("hubo un error");
	$res = array();
	while($row = $resultado->fetch_array(MYSQLI_ASSOC)){
		array_push($res,$row);
	}
}



echo json_encode($res,1000);

 ?>

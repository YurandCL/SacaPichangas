<?php
header("Access-Control-Allow-Origin:*");
//header("Access-Control-Allow-Origin:http://192.168.0.6:8100");
header("Content-Type: application/x-www-form-urlencoded");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");


$server = "localhost";
$user = "root";
$pass = "";
$bd = "sacapichangas";

session_start();

$conexion = mysqli_connect($server, $user, $pass,$bd)
or die("error");

//echo "conexion exitosa";

$postdata = json_decode(file_get_contents("php://input"));
		//echo $postdata->user;


if($postdata->metodo=="listarLocales"){
    $sql="SELECT * FROM locales WHERE estado = 1";
    $resultado = mysqli_query($conexion, $sql) or die("hubo un error");
    $res = array();
    while($row = $resultado->fetch_array(MYSQLI_ASSOC)){
        array_push($res,$row);
    }      
}

/* Funcion para listar informacion del local */
else if($postdata->metodo=="listarInformacion"){
	$sql="SELECT locales.id_local, locales.nombre_local as nombre_local, locales.ubicacion_local, locales.latitud, locales.longitud, 
    distritos.nombre_distrito as nombre_distrito FROM locales INNER JOIN distritos ON distritos.id_distrito = locales.id_distrito
    where locales.id_local = '".$postdata->id_local."';";
	$result = mysqli_query($conexion, $sql) or die("hubo un error");
	$res=$result->fetch_array(MYSQLI_ASSOC);
	$row_cnt = mysqli_num_rows($result);
}

echo json_encode($res,1000);

 ?>

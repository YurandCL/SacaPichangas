<?php
header("Access-Control-Allow-Origin:*");
//header("Access-Control-Allow-Origin:http://192.168.0.6:8100");
header("Content-Type: application/x-www-form-urlencoded");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

$server = "pcp-ts.com:3306";
$user = "pcpts_admin";
$pass = "123456789";
$bd = "pcpts_sacapichangas";

// $server = "localhost";
// $user = "root";
// $pass = "";
// $bd = "sacapichangas";

session_start();

$conexion = mysqli_connect($server, $user, $pass,$bd)
or die("error");

//echo "conexion exitosa";

$postdata = json_decode(file_get_contents("php://input"));
		//echo $postdata->user;

//$hashed_password = hash('sha512', $postdata->pass);echo $hashed_password;
/*iniciar sesion*/

if($postdata->metodo=="listarlocales"){
	$sql="SELECT * FROM local WHERE estado = 1";
	$resultado = mysqli_query($conexion, $sql) or die("hubo un error");
	$filas = array();
	while($row = $resultado->fetch_array(MYSQLI_ASSOC)){
		array_push($filas,$row);
	}
	echo json_encode($filas,1000);

}


/*Conexion dental*/



 ?>

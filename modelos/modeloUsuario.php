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


if($postdata->metodo=="validarUsuario"){

	$sql0="SELECT password FROM users WHERE  tipo_usuario='N' AND  usuario = '".$postdata->usuario."';";
	$result0= mysqli_query($conexion, $sql0) or die("hubo un error");
	$res0=mysqli_fetch_array($result0);
	$row_cnt0 = mysqli_num_rows($result0);
	


	if($row_cnt0>0)
	{
		$contrasena=$res0[0];
		//echo $postdata->pass;
		if (password_verify($postdata->password, $contrasena)) {
		   // $row_cnt = mysqli_num_rows($result);
			$sql="SELECT * FROM users WHERE  usuario = '".$postdata->usuario."' AND password = '".$contrasena."' ;";
			$result = mysqli_query($conexion, $sql) or die("hubo un error");
			$res=$result->fetch_array(MYSQLI_ASSOC);
		} 
		else {
		    $res=0;
		}
	}
	else
	{
		$res=0;
	}	
	/*Añadiendo */

}

/* Funcion para obterner nombre y apellidos con el dni */
else if ($postdata->metodo=="obtenerDatos") {

	$request='http://aplicaciones007.jne.gob.pe/srop_publico/Consulta/Afiliado/GetNombresCiudadano?DNI='.$postdata->dni;

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $request);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_TIMEOUT, 60);
	// This is what solved the issue (Accepting gzip encoding)
	curl_setopt($ch, CURLOPT_ENCODING, "gzip,deflate");
	$response = curl_exec($ch); ///CAPTURA DATOS DE RESPUESTA DEL API SMS
	curl_close($ch);

	//LA LOGICA DE LA PAGINAS ES APELLIDO PATERNO | APELLIDO MATERNO | NOMBRES
		$partes = explode("|", $response);
		$res["dni"] = $postdata->dni;
		$res["apellidos"] = $partes[0]." ".$partes[1];
		$res["nombres"] = $partes[2];
}

else if ($postdata->$metodo=="registrarUsuario") {
	$passHash = password_hash($postdata->password, PASSWORD_BCRYPT);
	$estado = "1";

	$tipo_usuario = "N";
	$codigo_validacion = "A";

	$fsql = "SELECT name, apellido FROM users WHERE dni='".$postdata->dni."'";
	$result = mysqli_query($conexion, $fsql)or die("hubo un error1");
	if($result->num_rows>0){
		$res0 = 0;
	}
	else{
		$sql = "INSERT INTO users (
		name,
		email,
		password,
		apellido,
		dni,
		celular,
		usuario,
		codigo_validacion,
		tipo_usuario,
		estado
		)
		VALUES (
		'".$postdata->nombre."',
		'".$postdata->email."',
		'".$passHash."',
		'".$postdata->apellido."',
		'".$postdata->dni."',
		'".$postdata->celular."',
		'".$postdata->usuario."',
		'".$codigo_validacion."',
		'".$tipo_usuario."',
		'".$estado."');";

		/*		echo($sql);die();*/
		$result = mysqli_query($conexion, $sql)or die("hubo un error2");
		/*En viar codigo */
		$res0 = 1;

		if($res0 === 1){
			$sql2="SELECT * FROM users WHERE  dni = '".$postdata->dni."';";
			$result2 = mysqli_query($conexion, $sql2)or die("hubo un error2");
			$res=$result2->fetch_array(MYSQLI_ASSOC);
		}
	}
}



echo json_encode($res,1000);

 ?>

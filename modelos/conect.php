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

//$hashed_password = hash('sha512', $postdata->pass);echo $hashed_password;
/*iniciar sesion*/

// if($postdata->metodo=="cliente"){
// 	$sql="SELECT * FROM cliente WHERE  dni = '".$postdata->dni."' AND contrasena = '".$postdata->pass."' ;";
// 	$result = mysqli_query($conexion, $sql) or die("hubo un error");
// 	$res=$result->fetch_array(MYSQLI_ASSOC);
// 	$row_cnt = mysqli_num_rows($result);
// 	if ($row_cnt>0) {
// 		$sql2 = "UPDATE cliente SET token = '".$postdata->token."' WHERE idcliente = ".$res["idcliente"]." ;";
// 		$result2 = mysqli_query($conexion, $sql2) or die("hubo un error");
// 		}

// 	/*Añadiendo */

// }
if($postdata->metodo=="usuarios"){
	$sql="SELECT * FROM usuarios WHERE  celular = '".$postdata->celular."' AND password = '".$postdata->password."' ;";
	$result = mysqli_query($conexion, $sql) or die("hubo un error");
	$res=$result->fetch_array(MYSQLI_ASSOC);
	$row_cnt = mysqli_num_rows($result);

}

else if($postdata->metodo=="usuario3"){
	$sql="SELECT * FROM users WHERE  nombre = '".$postdata->nombre."' AND email = '".$postdata->email."' ;";
	$result = mysqli_query($conexion, $sql) or die("hubo un error");
	$res=$result->fetch_array(MYSQLI_ASSOC);
	$row_cnt = mysqli_num_rows($result);
}



/*Conexion dental*/

else if($postdata->metodo=="usuario2"){

	$sql0="SELECT password FROM users WHERE  email = '".$postdata->email."';";
	$result0= mysqli_query($conexion, $sql0) or die("hubo un error");
	$res0=mysqli_fetch_array($result0);
	$row_cnt0 = mysqli_num_rows($result0);
	


	if($row_cnt0>0)
	{
		$contrasena=$res0[0];
		//echo $postdata->pass;
		if (password_verify($postdata->pass, $contrasena)) {
		   // $row_cnt = mysqli_num_rows($result);
			$sql="SELECT * FROM users WHERE  email = '".$postdata->email."' AND password = '".$contrasena."' ;";
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




elseif ($postdata->metodo=="operador") {
	$sql="SELECT * FROM usuario WHERE estado = 1 AND usuario = '".$postdata->user."' AND contrasena = '".$postdata->pass."'";
	$result = mysqli_query($conexion, $sql) or die("hubo un error");
	$res=$result->fetch_array(MYSQLI_ASSOC);
	$row_cnt = mysqli_num_rows($result);
		if ($row_cnt>0) {
			$sql2 = "UPDATE usuario SET token_firebase = '".$postdata->token."' WHERE idusuario = ".$res["idusuario"]." ;";
			$result2 = mysqli_query($conexion, $sql2) or die("hubo un error");
		}
}
/*Escoje usuario para cambiar estado */
elseif ($postdata->metodo=="validarcodigo") {
	$sql="SELECT * FROM cliente WHERE estado = 0 AND confirmacion = '".$postdata->confirmacion."'";
	$result = mysqli_query($conexion, $sql) or die("hubo un error");
	$cliente=$result->fetch_array(MYSQLI_ASSOC);
	$row_cnt = mysqli_num_rows($result);

	if ($row_cnt>0) {
	$estado=1;
	$sql2 ="UPDATE cliente SET estado = '$estado' WHERE idcliente =".$cliente["idcliente"];

    $result2 = mysqli_query($conexion, $sql2) or die("hubo un error validando la clave");
	$res=1;	
	}else{
		$res=0;
	}

	
}

/*Funcion para volver a enviar codigo de confirmacion*/
elseif ($postdata->metodo=="volverenviar") {

	$cadena_base =  'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$cadena_base .= '0123456789' ;

	$confirmacion = '';
	$limite = strlen($cadena_base) - 1;

	for ($i=0; $i < 6; $i++){
		$confirmacion .= $cadena_base[rand(0, $limite)];
	}


	$sql="SELECT * FROM cliente WHERE estado = 0 AND dni = '".$postdata->dni."'";
	$result = mysqli_query($conexion, $sql) or die("hubo un error");
	$cliente=$result->fetch_array(MYSQLI_ASSOC);
	$row_cnt = mysqli_num_rows($result);

	/*Envio de nuevo codigo de confirmacion*/

			$mensaje ="Hola ".$cliente["nombre"].", tu codigo de confirmacion es ".$confirmacion;
			$request='http://api.holacliente.com/api/sendsms/plain'.
																	'?user=pruebahc_corto&password=hcprueba123&SMSText=' .urlencode($mensaje).
																	'&GSM=51'   .$cliente["telefono"];

				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $request);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_TIMEOUT, 60);
				// This is what solved the issue (Accepting gzip encoding)
				curl_setopt($ch, CURLOPT_ENCODING, "gzip,deflate");
				$response = curl_exec($ch); ///CAPTURA DATOS DE RESPUESTA DEL API SMS
				curl_close($ch);

				$sql2 ="UPDATE cliente SET confirmacion = '$confirmacion' WHERE idcliente =".$cliente["idcliente"];

					$result2 = mysqli_query($conexion, $sql2) or die("hubo un error cambiando el codigo de confirmacion");

				$res=1;



}


/**/
elseif ($postdata->metodo=="recuperar") {
	$sql="SELECT * FROM cliente WHERE estado = 1 AND dni = '".$postdata->dni."'";
	$result = mysqli_query($conexion, $sql) or die("hubo un error");
	$cliente=$result->fetch_array(MYSQLI_ASSOC);
	$row_cnt = mysqli_num_rows($result);

	if($row_cnt>0 ){
		$cadena_base =  'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
		$cadena_base .= '0123456789' ;

		$password = '';
		$limite = strlen($cadena_base) - 1;

		for ($i=0; $i < 6; $i++){
			$password .= $cadena_base[rand(0, $limite)];
		}

		/*-------------*/

		$mensaje ="Hola ".$cliente["nombre"].", tu nueva clave es ".$password;
	$request='http://api.holacliente.com/api/sendsms/plain'.
															'?user=pruebahc_corto&password=hcprueba123&SMSText=' .urlencode($mensaje).
															'&GSM=51'   .$cliente["telefono"];

			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $request);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_TIMEOUT, 60);
			// This is what solved the issue (Accepting gzip encoding)
			curl_setopt($ch, CURLOPT_ENCODING, "gzip,deflate");
			$response = curl_exec($ch); ///CAPTURA DATOS DE RESPUESTA DEL API SMS
			curl_close($ch);



		$sql2 ="UPDATE cliente SET contrasena = '$password' WHERE idcliente =".$cliente["idcliente"];

			$result2 = mysqli_query($conexion, $sql2) or die("hubo un error cambiando la clave");

		$res=1;
	}else{
		$res=0;

	}
	/*Generar nueva contraseña*/


}
echo json_encode($res);

 ?>

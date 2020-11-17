<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>

<body>

	<?php
		

		$email = $_GET["email"];
		$usuario = $_GET["usuario"];
		$password = $_GET["password"];
		//$perfil = $_GET["perfil"];
		
		    
		$passHash = password_hash($password, PASSWORD_BCRYPT);
		print_r($passHash);
		include ("conexion.php");
		
		 
		 /*Control 1: debes saber lo que ocurre con la conexión*/
		$response = array();
		if ($mysqli){

			/*Prefiero variables para todo, me parece que es más limpio, es algo personal*/
			$sql="INSERT INTO usuario (email, usuario, password) VALUES (?,?,?)";
			$statement = mysqli_prepare($mysqli, $sql);
			
		/*Control 2: ¿El $statement se preparó o no?*/
		if ($statement) {
			$statement->bind_param("sss", $email, $usuario, $passHash);
			//mysqli_stmt_bind_param("sss", $usu, $con, $perfil);
			$statement->execute();
			//mysqli_stmt_execute($statement);

        /*Control 3: ¿Qué pasó en la ejecución?*/

        $contador=mysqli_stmt_affected_rows($statement);

        if ($contador){         
            $response["success"] = true;  
            $response["mensaje"] = "Se insertaron ".$contador." registros"; 
			//header("Location: index.php");

        }else{
            $mensaje=mysqli_stmt_error($statement);     
            $response["success"] = false;  
            $response["mensaje"] = "Error insertando. Datos duplicados o algún dato erróneo: ".$mensaje;  

        }

        /* cerrar sentencia */
        mysqli_stmt_close($statement);

    }else{
        $mensaje=mysqli_stmt_error($statement);     
        $response["success"] = false;  
        $response["mensaje"] = "Error preparando la consulta SQL: ".$mensaje;  

    }   

    /* cerrar conexión (si es preciso)*/
    mysqli_close($mysqli);

}else{
    $mensaje=mysqli_connect_errno().PHP_EOL. mysqli_connect_error();
    $response["success"] = false;  
    $response["mensaje"] = $mensaje;  

}
echo json_encode($response);
		
		/*if($conexion->connect_errno){
			die("Conexion faliida: " . $conexion->connect_error);
				
			exit();
			}
		
		mysqli_select_db($conexion,$db_nombre) or die ("No se encuentra la BBDD");
		
		mysqli_set_charset($conexion, "utf8");
		 
		$sql="INSERT INTO PERFILUSUARIOS (USUARIO, PASSWORD, PERFIL) VALUES (?,?,?)";
		
		$resultado=mysqli_prepare($conexion, $sql);
		
		$ok=mysqli_stmt_bind_param($resultado,"sss", $usu, $con, $perfil);
		
		$ok=mysqli_stmt_execute($resultado);
		
		if($ok==false){
			
			echo "Error al ejecutar la consulta";
			
		}else{
			
			
			//$ok=mysqli_stmt_bind_result($resultado, $codigo, $seccion, $precio, $pais);
			
			echo "Agregado nuevo registro";
			
			/*while(mysqli_stmt_fetch($resultado)){
				
				echo $codigo . " " . $seccion . " " . $precio . " " . $pais . "<br>";	
				
			}*/
			
			/*mysqli_stmt_close($resultado);*/
			
		
		 
		
		
		 
		 
		 
	
	?>


</body>
</html>
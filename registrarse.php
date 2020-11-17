
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="x-ua-compatible" content="ie-edge">

	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">

	<style type="text/css">
		.borde{
			background-color: gray;
			height: 400px;
		}
		.borde2{
			background-color:  pink;
			height: 1500px;
		}
		.borde3{
			background-color: salmon;
			height: 50px;
			text-align: center;

		}

	</style>
	<title>Registrar</title>
</head>
<body>
	<div class="card text-white bg-dark mb-3">
		<div class="card-body">
			<form action="insertar.php" method="get">
				<h1 class="card-title">Registrarse</h1>
				<div class="form-group">
					<label for="email">Correo Electronico</label>
					<input type="text" name="email" placeholder=" Ingrese su correo">
				</div>
				<div class="form-group">
					<label for="usuario">Usuario</label>
					<input type="text" name="usuario" placeholder=" Ingrese un usuario">
				</div>
				<div class="form-group">
					<label for="contraseña">Contraseña</label>	
					<input type="password" name="password" placeholder="Ingrese una contraseña">
				</div>
				<input type="submit" value="enviar">
			</form>
			<a href="index.php">INICIO</a>
		</div>
	</div>





<script src="js/jquery-3.4.1.slim.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
		<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
		<link href='https://fonts.googleapis.com/css?family=Merriweather:400,400italic,700,700italic' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="css/estilos.css">
		<script src="plugins/jQuery/validaciones.js"></script>
		<link rel="icon" href="imagenes/favicon.ico" type="image/x-icon">
		<title>Taste</title>
	</head>
	<body id="cuerpologin">
		<img id="background" src="imagenes/fondo.png">
		<div class="contenedor" style="background:url(imagenes/fondo.png) no-repeat">
			<form id="login" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
				<h1 id="titulologin">Inicio Sesión</h1>
				<hr class="border">
				<div class="form-group">
					<label class="hidden-xs control-label">Usuario</label>
					<div class="input-group">
						<span class="input-group-addon"><img src="imagenes/user.png"/></span>
						<input type="text" name="usuario" id="usuario" class="form-control" maxlength="10" onkeypress="return validar_texto(event)" required placeholder="Ingrese el Usuario">
					</div>
				</div>
				<div class="form-group">
					<label class="hidden-xs control-label">Contraseña</label>
					<div class="input-group">
						<span class="input-group-addon"><img src="imagenes/contrasena.png"/></span>
						<input type="password" name="clave" id="clave" class="form-control" maxlength="10" onkeypress="return validar_textonumero(event)" required placeholder="Ingrese la Contraseña">
					</div>
				</div>
				<?php
				if(!empty($errores)):?>
					<div class="alert alert-danger fade in">
						<a class="close" data-dismiss="alert" aria-label="close">&times;</a>
						<ul><strong>Error!</strong><?php echo $errores;?></ul>
					</div>
				<?php endif;?>
				<div class="form-group">
					<input type="submit" name="ingresar" id="ingresar" class="btn btn-primary" value="Ingresar">
				</div>
			</form>
		</div>
		<footer class="footer">
			<p><img src="imagenes/logocs.png" width="50"> Copyright &copy; <?=date('Y',time())?> Todos los derechos reservados.</p>
		</footer>
		<script src="plugins/jQuery/jQuery-2.2.0.min.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>
	</body>
</html>

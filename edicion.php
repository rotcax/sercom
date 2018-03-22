<?php
	
	require 'modelo/conexion.php';

	$id = $_POST['id'];
	$nombre = $_POST['nombre'];
	$usuario = $_POST['usuario'];
	$email = $_POST['email'];
	$tipo_usuario = isset($_POST['tipo_usuario']) ? $_POST['tipo_usuario'] : 0;
	
	$sql = "UPDATE usuarios SET nombre='$nombre', correo='$email', usuario = '$usuario', id_tipo='$tipo_usuario' WHERE id = '$id'";
	$resultado = $mysqli->query($sql);

	if($resultado){

		echo"<script type=\"text/javascript\">alert('Usuario modificado con exito'); window.location='gestion.php';</script>";  

	}else{

		echo"<script type=\"text/javascript\">alert('Error al modificar'); window.location='gestion.php';</script>";  
	}
	
?>
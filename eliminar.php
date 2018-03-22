<?php
	
	require 'modelo/conexion.php';

	$id = $_GET['id'];
	
	$sql = "DELETE FROM usuarios WHERE id = '$id'";
	$resultado = $mysqli->query($sql);

	if($resultado){

		echo"<script type=\"text/javascript\">alert('Registro Eliminado'); window.location='gestion.php';</script>";  

	}else{

		echo"<script type=\"text/javascript\">alert('Error al eliminar'); window.location='gestion.php';</script>";  
	}
	
?>

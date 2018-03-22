<?php
	require 'modelo/conexion.php';
	require 'controlador/funcs.php';
	
	$errors = array();
	
	if(!empty($_POST))
	{


	$user_id = $mysqli->real_escape_string($_POST['user_id']);
	$token = $mysqli->real_escape_string($_POST['token']);
	$password = $mysqli->real_escape_string($_POST['password']);
	$con_password = $mysqli->real_escape_string($_POST['con_password']);
	
	if(validaPassword($password, $con_password))
	{
		
		$pass_hash = hashPassword($password);
		
		if(cambiaPassword($pass_hash, $user_id, $token))
		{
			echo"<script type=\"text/javascript\">alert('Contraseña modificada'); window.location='sesion.php';</script>";  
		}
		else 
		{
			$errors[] = "Error al modificar contrase&ntilde;a";
		}
	}
	else
	{
		$errors[] = "Las contraseñas no coiciden";
	}

	}

	?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SERCOM UNEFA</title>

    <!-- Bootstrap Core CSS -->
    <link href="estilos/css/bootstrap.min.css" rel="stylesheet">
	
	<!--LOGIN CCS y JQUERY-->
	<link rel="stylesheet" href="estilos/css/bootstrap.min.css" >
	<link rel="stylesheet" href="estilos/css/bootstrap-theme.min.css" >
	<script src="estilos/js/bootstrap.min.js" ></script>
	
    <!-- Custom CSS -->
    <link href="estilos/css/sb-admin.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="estilos/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Extensión UNEFA CARACAS</a>
            </div>
			<div style="
				padding: 15px 50px 5px 50px;
				float: right;
				font-size: 13px;">
				<a href="sesion.php" class="btn btn-danger square-btn-adjust">Personal del SERCOM</a>
			</div>
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li>
                        <a href="index.php"><i class="fa fa-fw fa-home"></i>Principal</a>
                    </li>
                    <li>
                        <a href="extension.php">Extension: Mision Vision Objetivos</a>
                    </li>
                    <li>
                        <a href="descargas.php">SERCOM: Descargas Notificaciones</a>
                    </li>
                    <li>
                        <a href="ferias_virtuales.php"></i> Ferias Virtuales del Servicio Comunitario</a>
                    </li>
                    <li>
                        <a href="cursos_diplomados.php"></i>Cursos y Diplomados</a>
                    </li>
                    <li>
                        <a href="videos.php"></i>Videos</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">


            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            USUARIOS UNEFA
                        </h1>
                        
		<div class="container">    
			<div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
				<div class="panel panel-info" >
					<div class="panel-heading">
						<div class="panel-title">Cambiar Password</div>
						<div style="float:right; font-size: 80%; position: relative; top:-10px"><a href="index.php">Iniciar Sesi&oacute;n</a></div>
					</div>     
					
					<div style="padding-top:30px" class="panel-body" >
						
						<form id="loginform" class="form-horizontal" role="form" action="guarda_pass.php" method="POST" autocomplete="off">
							
							<input type="hidden" id="user_id" name="user_id" value ="<?php echo $user_id; ?>" />
							
							<input type="hidden" id="token" name="token" value ="<?php echo $token; ?>" />
							
							<div class="form-group">
								<label for="password" class="col-md-3 control-label">Nuevo Password</label>
								<div class="col-md-9">
									<input type="password" class="form-control" name="password" placeholder="Password" required>
								</div>
							</div>
							
							<div class="form-group">
								<label for="con_password" class="col-md-3 control-label">Confirmar Password</label>
								<div class="col-md-9">
									<input type="password" class="form-control" name="con_password" placeholder="Confirmar Password" required>
								</div>
							</div>
							
							<div style="margin-top:10px" class="form-group">
								<div class="col-sm-12 controls">
									<button id="btn-login" type="submit" class="btn btn-info">Modificar</a>
								</div>
							</div>   
						</form>
						<?php resultBlock($errors); ?>
					</div>                     
				</div>  
			</div>
		</div>	
                    </div>
                </div>
                <!-- /.row -->
			<div class="row">
			
			<p></p>
			</div>
			<div class="row">
			
			<p></p>
			</div>	
			<div class="row">
			
			<p></p>
			</div>
			<div class="row">
			
			<p></p>
			</div>
			<div class="row">
			
			<p></p>
			</div>
			<div class="row">
			
			<p></p>
			</div>
			<div class="row">
			
			<p></p>
			</div>	
			<div class="row">
			
			<p></p>
			</div>
			<div class="row">
			
			<p></p>
			</div>
			<div class="row">
			
			<p></p>
			</div>
			<div class="row">
			
			<p></p>
			</div>
			<div class="row">
			
			<p></p>
			</div>	
			<div class="row">
			
			<p></p>
			</div>
			<div class="row">
			
			<p></p>
			</div>
			<div class="row">
			
			<p></p>
			</div>
			
            </div>			
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->	
    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>

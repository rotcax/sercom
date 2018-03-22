<?php
    session_start();
    require 'modelo/conexion.php';
    require 'controlador/funcs.php';

    if(!isset($_SESSION["id_usuario"])){
        header("Location: index.php");
    }
    
    $idUsuario = $_SESSION['id_usuario'];
    
    $sql = "SELECT id, nombre,last_session FROM usuarios WHERE id = '$idUsuario'";
    $result = $mysqli->query($sql);
    
    $row = $result->fetch_assoc();

    $errors = array();

    if(!empty($_POST)){

        $nombre = $mysqli->real_escape_string($_POST['nombre']);
		$apellido = $mysqli->real_escape_string($_POST['apellido']);
		$cedula = $mysqli->real_escape_string($_POST['cedula']);
        $personal = $mysqli->real_escape_string($_POST['personal']);
        $cargo = $mysqli->real_escape_string($_POST['cargo']);
        $vicerrectorado = $mysqli->real_escape_string($_POST['vicerrectorado']);
        $nucleo = $mysqli->real_escape_string($_POST['nucleo']);
		$telefono = $mysqli->real_escape_string($_POST['telefono']);
        $usuario = $mysqli->real_escape_string($_POST['usuario']);
        $password = $mysqli->real_escape_string($_POST['password']);
        $con_password = $mysqli->real_escape_string($_POST['con_password']);
        $email = $mysqli->real_escape_string($_POST['email']);
        $activo = 1;
        $tipo_usuario = 2;

        if(isNull($nombre, $apellido, $cedula, $personal, $cargo, $vicerrectorado, $nucleo, $telefono, $usuario, $password, $con_password, $email)){

            $errors[] = "Debe llenar todos los campos";
        }

        if(!isEmail($email)){

            $errors[] = "Direccion de correo invalido";
        }

        if(!validaPassword($password, $con_password)){

            $errors[] = "Las contraseñas no coiciden";
        }

        if(usuarioExiste($usuario)){

            $errors[] = "El nombre de usuario $usuario ya existe";
        }

        if(emailExiste($email)){

            $errors[] = "El correo electronico $email ya existe";
        }

        if(cedulaExiste($cedula)){

            $errors[] = "La cedula $cedula ya existe";
        }

        if(existente($nombre, $apellido)){

            $errors[] = "Nombre y Apellido repetido no pueden existir usuarios iguales";
        }

        if(count($errors) == 0){

            $pass_hash = hashPassword($password);
            $token = generateToken();

            $registro = registraUsuario($usuario, $pass_hash, $cedula, $nombre, $apellido, $personal, $cargo, $vicerrectorado, $nucleo, $telefono, $email, $activo, $token, $tipo_usuario);

            echo "<script> alert('USUARIO REGISTRADO CON EXITO')</script>";

        }else{

            $errors[] = "Error al registrar";
        }
    }
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SERCOM: Registro de Usuarios</title>
	<!-- BOOTSTRAP STYLES-->
    <link href="estilos/css/bootstrap.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="estilos/css/font-awesome.css" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
    <link href="estilos/css/custom.css" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
   <!--JScrip-->
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
   <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
   <script type='text/javascript' src='estilos/js/formexp.js'></script>

   

		<style type="text/css">
${demo.css}
		</style>
</head>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
               <a class="navbar-brand" href="inicio.php"><?php echo utf8_decode($row['nombre']); ?></a> 
            </div>
  <div style="color: white;
padding: 15px 50px 5px 50px;
float: right;
font-size: 16px;"> Ultimo Acceso : <?php echo $row['last_session']; ?> &nbsp; <a href="modelo/logout.php" class="btn btn-danger square-btn-adjust">Salir</a> </div>
        </nav>   
           <!-- /. NAV TOP  -->
                <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
				<li class="text-center">
                    <img src="estilos/img/escudounefa.gif" class="user-image img-responsive"/>
					</li>
				
					
                    <li>
                        <a  href="inicio.php"><i class="fa fa-home fa-3x"></i> Inicio</a>
                    </li>
                    
                    <li>
                                <a href="registro-alu.php"><i class="fa fa-edit fa-3x"></i> Registrar alumno</a>
                            </li>   
                     
						   <li  >
                        <a href="estadistica.php"><i class="fa fa-bar-chart-o fa-3x"></i> Graficos</a>
                    </li>	

                    <?php if($_SESSION["tipo_usuario"] == 1){ ?>
                    	<li>
                    		<a class="active-menu" href = "gestion.php"><i class = "fa fa-hand-o-up fa-3x"></i> Gestion de Usuarios</a>
                    	</li>
                    	<?php } ?>
                    		
                </ul>
               
            </div>
            
        </nav> 

        <!-- /. NAV SIDE  -->

        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>Registros de Usuarios SERCOM</h2>   
                    </div>
                </div>
                <hr style = "height: 2px; color: blue; background-color: black"/>


<!--	/////////////////////////////////Registro//////////////////////////////////////////////////////-->
          

<style type="text/css">
        #capainicio{
        position:relative;
        }

        #capaexpansion{
        position:relative;
        display:none;
        }

        #capaexpansion2{
        position:relative;
        display:none;
        }
</style>


                <div class="container">
			<div id="signupbox" style="margin-top:50px" class="mainbox col-md-8 col-md-offset-1 col-sm-8 col-sm-offset-2">
				<div class="panel panel-info">
					<div class="panel-heading">
						<div class="panel-title">Reg&iacute;strate</div>
						
					</div>  
					
					<div class="panel-body" >
						
						<form id="signupform" class="form-horizontal" role="form" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" autocomplete="off" name = f1>
							
							<div id="signupalert" style="display:none" class="alert alert-danger">
								<p>Error:</p>
								<span></span>
							</div>
							
                            

							<div class="form-group">
								<label for="nombre" class="col-md-3 control-label">Nombre:</label>
								<div class="col-md-9">
									<input type="text" class="form-control" name="nombre" placeholder="Nombre" value="<?php if(isset($nombre)) ?>" required >
								</div>
							</div>
							
							<div class="form-group">
								<label for="apellido" class="col-md-3 control-label">Apellido:</label>
								<div class="col-md-9">
									<input type="text" class="form-control" name="apellido" placeholder="Apellido" value="<?php if(isset($apellido)) ?>" required >
								</div>
							</div>
							
							<div class="form-group">
								<label for="cedula" class="col-md-3 control-label">Cedula:</label>
								<div class="col-md-9">
									<input type="text" class="form-control" name="cedula" placeholder="Cedula" value="<?php if(isset($cedula)) ?>" required >
								</div>
							</div>

                            <div class = "form-group" id = "capainicio">
                                <label for = "personal" class = "col-md-3 control-label">Personal:</label>
                                <div class = "col-md-9">
                                    <select class = "form-control" name = "personal" onchange="expandir_formulario()">
                                        <option value = "0" selected disabled hidden>Personal</option>
                                        <option value = "Administrativo">Administrativo</option>
                                        <option value = "Docente">Docente</option>
                                    </select>
                                </div>
                            </div>

                            <div class = "form-group" id = "capaexpansion">
                                <label for = "cargo" class = "col-md-3 control-label">Unidad Perteneciente:</label>
                                <div class = "col-md-9">
                                    <input type="text" class = "form-control" name="cargo" placeholder = "Unidad">
                                </div>
                            </div>

                            <div class = form-group id = capaexpansion2>
                                <label for = "cargo" class = "col-md-3 control-label">Categoria:</label>
                                <div class = col-md-9>
                                    <select class = form-control name = cargo>
                                        <option value = Fijo>Fijo</option>
                                        <option value = Contratado>Contratado</option>
                                    </select>
                                </div>
                            </div>

                            <div class = form-group>
                                <label for = "vicerrectorado" class = "col-md-3 control-label">Vicerrectorado:</label>
                                <div class = col-md-9>
                                    <select class = form-control name = "vicerrectorado" onchange="agregarOpciones(this.form)">
                                        <option value = "" selected disabled hidden>Vicerrectorado</option>
                                        <option value = "Capital">Regional Capital</option>
                                        <option value = "Central">Regional Central</option>
                                    </select>
                                </div>
                            </div>

                            <div class = form-group>
                                <label for = nucleo class ="col-md-3 control-label">Nucleo:</label>
                                <div class = col-md-9>
                                    <select class = form-control name = "nucleo">
                                    <option value = "" selected disabled hidden>Nucleo</option>
                                </select>
                                </div>
                            </div>
							
							<div class="form-group">
								<label for="telefono" class="col-md-3 control-label">Telefono:</label>
								<div class="col-md-9">
									<input type="text" class="form-control" name="telefono" placeholder="Telefono" value="<?php if(isset($telefono)) ?>" required >
								</div>
							</div>

                            <div class="form-group">
                                <label for="email" class="col-md-3 control-label">Email:</label>
                                <div class="col-md-9">
                                    <input type="email" class="form-control" name="email" placeholder="Email" value="<?php if(isset($email)) ?>" required>
                                </div>
                            </div>
							
							<div class="form-group">
								<label for="usuario" class="col-md-3 control-label">Usuario:</label>
								<div class="col-md-9">
									<input type="text" class="form-control" name="usuario" placeholder="Usuario" value="<?php if(isset($usuario)) ?>" required>
								</div>
							</div>
							
							<div class="form-group">
								<label for="password" class="col-md-3 control-label">Password:</label>
								<div class="col-md-9">
									<input type="password" class="form-control" name="password" placeholder="Password" required>
								</div>
							</div>
							
							<div class="form-group">
								<label for="con_password" class="col-md-3 control-label">Confirmar Password:</label>
								<div class="col-md-9">
									<input type="password" class="form-control" name="con_password" placeholder="Confirmar Password" required>
								</div>
							</div>
							
							<div class="form-group">                                      
								<div class="col-md-offset-3 col-md-9">
									<a href="gestion.php" class = "btn btn-success">Volver</a>
									<button id="btn-signup" type="submit" class="btn btn-info"><i class="icon-hand-right"></i>Registrar</button> 
								</div>
							</div>
                         
						</form>
						<?php  

							echo resultBlock($errors);
						?>
					</div>
				</div>
			</div>
		</div>



<!--	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->


                
         </div>

             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
        </div>
     <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="estilos/js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="estilos/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="estilos/js/jquery.metisMenu.js"></script>
     <!-- MORRIS CHART SCRIPTS -->
     <script src="estilos/js/morris/raphael-2.1.0.min.js"></script>
    <script src="estilos/js/morris/morris.js"></script>
      <!-- CUSTOM SCRIPTS -->
    <script src="estilos/js/custom.js"></script>
    
   
</body>
</html>

<script>
    function expandir_formulario(){
    if (document.f1.personal.value == "Administrativo"){
        xDisplay('capaexpansion', 'block')
        xDisplay('capaexpansion2', 'none')
     }
     
     if (document.f1.personal.value == "Docente"){
        xDisplay('capaexpansion', 'none')
        xDisplay('capaexpansion2', 'block')
     }
    }

    function agregarOpciones(form){

        var select = form.vicerrectorado.options;
        var combo = form.nucleo.options;
        combo.length = null;



        if(select[0].selected == true){

            var seleccionar = new Option("Nucleo", "", "", "");
            combo[0] = seleccionar;
        }

        if(select[1].selected == true){

            var capital1 = new Option("Caracas", "Caracas", "", "");
            var capital2 = new Option("Miranda", "Miranda", "", "");
            var capital3 = new Option("Guatire", "Guatire", "", "");
            var capital4 = new Option("Vargas", "Vargas", "", "");
            combo[0] = capital1;
            combo[1] = capital2;
            combo[2] = capital3;
            combo[3] = capital4;
        }

        if(select[2].selected == true){

            var central1 = new Option("Aragua", "Aragua", "", "");
            var central2 = new Option("Naguanagua", "Naguanagua", "", "");
            var central3 = new Option("La Isabelica", "La Isabelica", "", "");
            var central4 = new Option("Guacara", "Guacara", "", "");
            var central5 = new Option("Puerto Cabello", "Puerto Cabello", "", "");
            var central6 = new Option("Yaracuy", "Yaracuy", "", "");
            combo[0] = central1;
            combo[1] = central2;
            combo[2] = central3;
            combo[3] = central4;
            combo[4] = central5;
            combo[5] = central6;
        }
    }
</script>
    

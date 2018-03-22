﻿<?php
    session_start();
    
    require 'modelo/conexion.php';
    require 'controlador/funcs.php';
    
    if(!isset($_SESSION["id_usuario"])){
        header("Location: index.php");
    }
    
    $idUsuario = $_SESSION['id_usuario'];
    
    $sql = "SELECT id, nombre, last_session FROM usuarios WHERE id = '$idUsuario'";
    $result = $mysqli->query($sql);
    
    $row = $result->fetch_assoc();
?>


<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SERCOM: Inicio</title>
	<!-- BOOTSTRAP STYLES-->
    <link href="estilos/css/bootstrap.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="estilos/css/font-awesome.css" rel="stylesheet" />
     <!-- MORRIS CHART STYLES-->
    <link href="estilos/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
    <link href="estilos/css/custom.css" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
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
				
				<!--/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
                    <li>
                        <a class="active-menu"  href="inicio.php"><i class="fa fa-home fa-3x"></i> Inicio</a>
                    </li>
                    
                    <li>
                                <a href="registro-alu.php"><i class="fa fa-edit fa-3x"></i> Registrar alumno</a>
                            </li>	
                    
                    
                     
						   <li  >
                        <a   href="estadistica.php"><i class="fa fa-bar-chart-o fa-3x"></i> Graficos</a>
                    </li>	

                    <?php if($_SESSION["tipo_usuario"] == 1){ ?>
                    	<li>
                    		<a href = "gestion.php"><i class = "fa fa-hand-o-up fa-3x"></i> Gestion de Usuarios</a>
                    	</li>
                    	<?php } ?>
					
                </ul>
               
            </div>
            
            <!--	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
            
        </nav>  
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                    <?php if($_SESSION['tipo_usuario'] == 1){ ?>
                     <h2>Usuario Administrador</h2>   
                        <h5>Bienvenidos, Administrador de la unefa </h5>
                        <?php } ?>
                    </div>
                </div>              
                 <!-- /. ROW  -->
                  <hr style= "height: 2px; background-color: black"/>
                <div class="row">
                <div class="col-md-3 col-sm-6 col-xs-6">           
			
                    </div>
                      
                    </div>
                </div>     
                 <!-- /. ROW  -->           
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

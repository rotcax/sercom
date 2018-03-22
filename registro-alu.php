<?php
    session_start();
    require 'modelo/conexion.php';
    require 'controlador/funcs.php';

    if(!isset($_SESSION["id_usuario"])){
        header("Location: index.php");
    }
    
    $idUsuario = $_SESSION['id_usuario'];
    
    $sql = "SELECT id, nombre FROM usuarios WHERE id = '$idUsuario'";
    $result = $mysqli->query($sql);
    
    $row = $result->fetch_assoc();
?>


<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SERCOM: Registro</title>
	<!-- BOOTSTRAP STYLES-->
    <link href="estilos/css/bootstrap.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="estilos/css/font-awesome.css" rel="stylesheet" />
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
font-size: 16px;"> <a href="modelo/logout.php" class="btn btn-danger square-btn-adjust">Salir</a> </div>
        </nav>   
           <!-- /. NAV TOP  -->
                <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
				<li class="text-center">
                    <img src="estilos/img/escudounefa.gif" class="user-image img-responsive"/>
					</li>
				
					
                    <li>
                        <a href="inicio.php"><i class="fa fa-home fa-3x"></i> Inicio</a>
                    </li>
                    
                    <li>
                                <a class="active-menu" href="registro-alu.php"><i class="fa fa-edit fa-3x"></i> Registrar alumno</a>
                            </li>   
                    
                     
						   <li  >
                        <a   href="estadistica.php"><i class="fa fa-bar-chart-o fa-3x"></i> Gráficos</a>
                    </li>

                    <?php if($_SESSION["tipo_usuario"] == 1){ ?>
                        <li>
                            <a  href = "gestion.php"><i class = "fa fa-hand-o-up fa-3x"></i> Gestion de Usuarios</a>
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
                     <h2>Registrar Alumno</h2>   
                    </div>
                </div>
                 <!-- /. ROW  -->
                 <hr style="height: 2px; background-color:black" />
                <div class="container">
                <div id="signupbox" style="margin-top:50px" class="mainbox col-md-9 col-md-offset-1 col-sm-1 col-sm-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                    Registrar un alumno
                        <div class="panel-title"></div>
                        
                    </div>  
                    
                    <div class="panel-body" >
                        <form id="signupform" class="form-horizontal" role="form" action="#" method="POST" autocomplete="off">
                            
                            <div id="signupalert" style="display:none" class="alert alert-danger">
                                <p>Error:</p>
                                <span></span>
                            </div>
                            
                            <div class="form-group">
                    <label for="nombre" class="col-sm-2 control-label">Primer Nombre</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="nombre1" name="pnombre" placeholder="Nombre" required/>
                    </div>
                </div>


                    <input type="hidden" id="id" name="id" />

                <div class="form-group">
                    <label for="usuario" class="col-sm-2 control-label">Segundo Nombre</label>
                    <div class="col-sm-10">
                        <input type="usuario" class="form-control" id="nombre2" name="sapellido" placeholder="Nombre" required/>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="usuario" class="col-sm-2 control-label">Primer Apellido</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="apellido1" name="papellido" placeholder="Apellido" required/>
                    </div>
                </div>
                <div class="form-group">
                    <label for="usuario" class="col-sm-2 control-label">Segundo Apellido</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="apellido2" name="sapellido" placeholder="Apellido" required/>
                    </div>
                </div>
                <div class="form-group">
                    <label for="usuario" class="col-sm-2 control-label">Cedula: </label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="cedula1" name="cedula" placeholder="Cedula" required/>
                    </div>
                </div> 
                <div class="form-group">
                    <label for="usuario" class="col-sm-2 control-label">Carrera</label>
                    <div class="col-sm-10">
                        <select class="form-control" required>
                            <option>Seleccionar</option>
                            <option>Ing de sistemas</option>
                        </select>
                    </div>
                </div> 
                <div class="form-group">
                    <label for="usuario" class="col-sm-2 control-label">Semestre</label>
                    <div class="col-sm-10">
                        <select class="form-control">
                            <option>Seleccionar</option>
                            <?php
                            for ($i=1; $i < 11; $i++) { 
                                ?>
                            <option value=<?php echo $i?> > <?php echo $i?> </option>
                            <?php
                                }
                            ?>
                        </select>
                    </div>
                </div>                               
                <div class="form-group">
                    <label for="usuario" class="col-sm-2 control-label">Sección</label>
                    <div class="col-sm-10">
                        <select class="form-control">
                            <option>Seleccionar</option>
                            <option>D001</option>
                            <option>D002</option>
                            <option>D003</option>
                            <option>D004</option>
                            <option>D005</option>
                        </select>
                    </div>
                </div> 
                <div class="form-group">
                    <label for="usuario" class="col-sm-2 control-label">Turno</label>
                    <div class="col-sm-10">
                        <select class="form-control">
                            <option>Seleccionar</option>
                            <option>Diurno</option>
                            <option>Nocturno</option>
                        </select>
                    </div>
                </div>                                             
                            <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-danger">Guardar</button>
                    </div>
                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
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
      <!-- CUSTOM SCRIPTS -->
    <script src="estilos/js/custom.js"></script>
    
   
</body>
</html>

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

    $id = $_GET['id'];
    
    $resultado = $mysqli->query("SELECT * FROM usuarios WHERE id = '$id'");
    $busca = $resultado->fetch_array(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SERCOM: Modificar Usuario</title>
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
                     <h2>Administracion de Usuarios</h2>   
                        <h5>Edicion de Usuario</h5>
                    </div>
                    <div style="
                padding: 15px 50px 5px 50px;
                float: right;
                font-size: 13px;">
                </div>
                 <!-- /. ROW  -->
                 <hr />

<!--    /////////////////////////////////Registro//////////////////////////////////////////////////////-->
               
        <div class="container">
            <div id="signupbox" style="margin-top:50px" class="mainbox col-md-9 col-md-offset-1 col-sm-1 col-sm-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-title"></div>
                        
                    </div>  
                    
                    <div class="panel-body" >
                        
                        <form id="signupform" class="form-horizontal" role="form" action="edicion.php" method="POST" autocomplete="off">
                            
                            <div id="signupalert" style="display:none" class="alert alert-danger">
                                <p>Error:</p>
                                <span></span>
                            </div>
                            
                            <div class="form-group">
                    <label for="nombre" class="col-sm-2 control-label">Nombre</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" value="<?php echo $busca['nombre']; ?>" required>
                    </div>
                </div>


                    <input type="hidden" id="id" name="id" value="<?php echo $busca['id']; ?>" />

                <div class="form-group">
                    <label for="usuario" class="col-sm-2 control-label">Usuario</label>
                    <div class="col-sm-10">
                        <input type="usuario" class="form-control" id="usuario" name="usuario" placeholder="Usuario" value="<?php echo $busca['usuario']; ?>"  required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="email" class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="<?php echo $busca['correo']; ?>"  required>
                    </div>
                </div>

                
                
                <div class="form-group">
                    <label for="tipo_usuario" class="col-sm-2 control-label">¿Administrador?</label>
                    
                    <div class="col-sm-10">
                        <label class="radio-inline">
                            <input type="radio" id="tipo_usuario" name="tipo_usuario" value="1" <?php if($busca['id_tipo']=='1') echo 'checked'; ?>> SI
                        </label>
                        
                        <label class="radio-inline">
                            <input type="radio" id="tipo_usuario" name="tipo_usuario" value="0" <?php if($busca['id_tipo']=='0') echo 'checked'; ?>> NO
                        </label>
                    </div>
                </div>
                        
                            
                            <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <a href="gestion.php" class="btn btn-success">Regresar</a>
                        <button type="submit" class="btn btn-info">Guardar</button>
                    </div>
                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
<!--    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->


                
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

<?php
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

    $where = "";
    
    if(!empty($_POST))
    {
        $valor = $_POST['campo'];
        if(!empty($valor)){
            $where = "WHERE nombre LIKE '%$valor'";
        }
    }
   
    $resultado = $mysqli->query("SELECT * FROM usuarios $where");
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SERCOM: Gestion de Usuario</title>
    <!-- BOOTSTRAP STYLES-->
    <link href="estilos/css/bootstrap.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="estilos/css/font-awesome.css" rel="stylesheet" />
     <!-- MORRIS CHART STYLES-->
   
        <!-- CUSTOM STYLES-->
    <link href="estilos/css/custom.css" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
     <!-- TABLE STYLES-->
    <link href="estilos/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
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
                        <a   href="estadistica.php"><i class="fa fa-bar-chart-o fa-3x"></i> Graficos</a>
                    </li>   

                    <?php if($_SESSION["tipo_usuario"] == 1){ ?>
                        <li>
                            <a class ="active-menu" href = "gestion.php"><i class = "fa fa-hand-o-up fa-3x"></i> Gestion de Usuarios</a>
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
                        <h5>Bienvenido al area de gestion de usuarios</h5>
                    </div>
                    </div>
                    <div style="
                padding: 15px 50px 5px 50px;
                float: right;
                font-size: 13px;">
                <a href="registrar_user.php" class="btn btn-info square-btn-adjust">Registrar nuevo usuario</a>
                </div>
                 <!-- /. ROW  -->
                  <hr style = "height: 2px; background-color: black" />
            <div class="row">
                <div class="col-md-12">

                
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                             Tabla de registros
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Cedula</th>
                                            <th>Nombre</th>
											<th>Apellido</th>
											<th>Telefono</th>
                                            <th>Correo</th>
                                            <th></th>
											<th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php while($busca = $resultado->fetch_array(MYSQLI_ASSOC)) { ?>
                                        <tr class="gradeA">
                                            <td><?php echo $busca['cedula']; ?></td>
                                            <td><?php echo $busca['nombre']; ?></td>
											<td><?php echo $busca['apellido'] ?></td>
											<td><?php echo $busca['telefono'] ?></td>
                                            <td><?php echo $busca['correo']; ?></td>
                                            <td class="center"><a href="modificar.php?id=<?php echo $busca['id']; ?>"><span class="glyphicon glyphicon-pencil"></span></a></td>
                                            <td class="center"><a href="#" data-href="eliminar.php?id=<?php echo $busca['id']; ?>" data-toggle="modal" data-target="#confirm-delete"><span class="glyphicon glyphicon-trash"></span></a></td>
                                        </tr>
                                        <?php } ?>
                                       
                                    </tbody>
                                </table>
                            </div>
                            
                        </div>
                    </div>
                    <!--End Advanced Tables -->

                    <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Eliminar Registro</h4>
                    </div>
                    
                    <div class="modal-body">
                        ¿Desea eliminar este registro?
                    </div>
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">NO</button>
                        <a class="btn btn-danger btn-ok">SI</a>
                    </div>
                </div>
            </div>
        </div>
                </div>
            </div>
                </div>
            </div>
                </div>
                </div>
            </div>
        </div>
               
    </div>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
     <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="estilos/js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="estilos/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="estilos/js/jquery.metisMenu.js"></script>
     <!-- DATA TABLE SCRIPTS -->
    <script src="estilos/js/dataTables/jquery.dataTables.js"></script>
    <script src="estilos/js/dataTables/dataTables.bootstrap.js"></script>
        <script>
            $(document).ready(function () {
                $('#dataTables-example').dataTable();
            });
    </script>
    <script>
            $('#confirm-delete').on('show.bs.modal', function(e) {
                $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
                
                $('.debug-url').html('Delete URL: <strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');
            });
        </script>   
         <!-- CUSTOM SCRIPTS -->
    <script src="estilos/js/custom.js"></script>
    
   
</body>
</html>

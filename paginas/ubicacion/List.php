<?php require_once('../../Connections/connect_DB.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

mysql_select_db($database_connect_DB, $connect_DB);
$query_ubi2 = "SELECT * FROM ubicacion";
$ubi2 = mysql_query($query_ubi2, $connect_DB) or die(mysql_error());
$row_ubi2 = mysql_fetch_assoc($ubi2);
$totalRows_ubi2 = mysql_num_rows($ubi2);

    $link =mysqli_connect("localhost","root","");
    if($link){
        mysqli_select_db($link,"ferreteriacolmex");
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Administrador - Ferretería Colmex</title>
        <meta charset="utf-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
        <meta name="description" content=""/>
        <meta name="author" content=""/>
        <!-- Bootstrap core CSS-->
        <link href="/ProyectoBases2/resources/vendor/bootstrap/css/bootstrap1.min.css" rel="stylesheet"/>
        <!-- Custom fonts for this template-->
        <link href="/ProyectoBases2/resources/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <!-- My styles-->
        <link href="/ProyectoBases2/resources/css/base.css" rel="stylesheet"/>
        <link href="/ProyectoBases2/resources/css/display-lg.css" rel="stylesheet"/>
        <link href="/ProyectoBases2/resources/css/display-md.css" rel="stylesheet"/>    
        <link href="/ProyectoBases2/resources/css/display-sm.css" rel="stylesheet"/>
    </head>
    <body>
        <div class="wrapper">
            <!-- Barra lateral en tamaños grandes y medianos  -->
            <nav id="sidebar">
                <div class="header">
                    <h4>
                        <img id="sidebarCollapse" src="/ProyectoBases2/resources/images/LogoCirculo1.png"/>
                        <a data-toggle="collapse" href="#bienvenida" role="button">StockManage</a>
                    </h4> 
                    <strong id="sm">
                        <a data-toggle="collapse" id="linkSm" >
                            <img src="/ProyectoBases2/resources/images/LogoCirculo1.png"/>
                        </a>
                    </strong>
                </div>
                <ul class="list-unstyled components">
                    <li>
                        <a data-toggle="collapse" href="#add" role="button" aria-expanded="false" aria-controls="add" class="nav-link"><i class="fa fa-plus"></i> Agregar </a>
                    </li>
                    <li>
                        <a data-toggle="collapse" href="#list" role="button" aria-expanded="false" aria-controls="list" class="nav-link"><i class="fa fa-list-alt"></i> Listar </a>
                    </li>
                    <li>
                        <a href="/ProyectoBases2/paginas/factura/List.php" class="nav-link"><i class="fa fa-book"></i> Facturas </a>
                    </li>
                     <li>
                        <a data-toggle="collapse" href="#settings" role="button" aria-expanded="false" aria-controls="settings" class="nav-link"><i class="fa fa-support"></i> Funciones Base </a>
                    </li>
                    <li>
                        <a class="nav-link" data-toggle="modal" data-target="#confirm" href="">
                            <i class="fa fa-power-off" id="cerrar"></i><span class="nav-link-text">Cerrar sesión</span>
                        </a>
                    </li>
                </ul>
                <div class="footer">
                    <h6>Ferretería COLMEX S.A.S &copy;</h6>
                </div>
            </nav>
        
        
            <!--Navbar para telefonos -->
            <nav class="ocultar navbarSh navbar navbar-expand-lg navbar-light bg-light">
                <a data-toggle="collapse" class="navbar-brand" href="#bienvenida">StockManage</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a data-toggle="collapse" href="#add" role="button" aria-expanded="false" aria-controls="add" class="nav-link"><i class="fa fa-plus"></i> Agregar </a>
                        </li>
                        <li class="nav-item">
                            <a data-toggle="collapse" href="#list" role="button" aria-expanded="false" aria-controls="list" class="nav-link"><i class="fa fa-list"></i> Listar </a>
                        </li>
                        <li class="nav-item">
                            <a href="/ProyectoBases2/paginas/factura/List.php" class="nav-link"><i class="fa fa-book"></i> Facturas </a>
                        </li>
                        <li class="nav-item">
                            <a data-toggle="collapse" href="#settings" role="button" aria-expanded="false" aria-controls="settings" class="nav-link"><i class="fa fa-support"></i> Funciones Base </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="modal" data-target="#confirm" href="">
                                <i class="fa fa-fw fa-power-off"></i><span class="nav-link-text">Cerrar sesión</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Contenido de la pagina  -->
            <div id="content" class="background-page">
                <!--Espacio para "inicio"-->
                <div class="collapse" id="bienvenida">
                    <div class="contenido">
                        <h2>¡Bienvenido!</h2>
                        <p>Aquí deberíamos poner información chévere, quiza algunas de las funciones anañiticas o una vista</p>
                    </div>
                </div>    


                <!--Contenido de listar categoria-->
                <div class="contenido">
                    
                    <table border="1" class="table table-light text-font">
                       <thead class="thead-dark">
                            <tr>
                                <th scope="col">Id Ubicacion</th>
                                <th scope="col">Id Barrio</th>
                                <th scope="col">Direccion</th>
                                <th scope="col">Codigo Postal</th>
                                <th scope="col">&nbsp;</th>
                            </tr>
                      <?php do { ?>
                        <tr>
                          <td><?php echo $row_ubi2['ubicacion_id']; ?></td>
                          <td><?php echo $row_ubi2['barrio_id']; ?></td>
                          <td><?php echo $row_ubi2['direccion']; ?></td>
                          <td><?php echo $row_ubi2['codigo_postal']; ?></td>
                          <td><a href="Edit.php? ubicacion_id=<?php echo $row_ubi2['ubicacion_id']; ?>">Modificar</a></td>
                        </tr>
                        <?php } while ($row_ubi2 = mysql_fetch_assoc($ubi2)); ?>
                    </table>
<p>                   <a class="btn btn-ambar" href="Create.html">Crear nueva categoria</a>
                      <a class="btn btn-ambar" href="/ProyectoBases2/administrador.html">Inicio</a></p>
              </div>

                <!--espacio agregar-->
                <div class="collapse" id="add">
                    <div class="contenido">
                        <h3>Agregar</h3>
                        <p>¿Te hace falta algo? No te preocupes, aquí puedes agregar lo que haga falta. Solo recuerda que tienes que 
                        ser un poco ordenado.</p>
                        <div class="row">
                            <div class="col-sm-12 col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Proveedor</h5>
                                        <p class="card-text">Aquí va información acerca de algo.</p>
                                        <a href="/ProyectoBases2/paginas/proveedor/Create.php" class="btn btn-danger">Agregar</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Cliente</h5>
                                        <p class="card-text">Aquí va información acerca de algo.</p>
                                        <a href="/ProyectoBases2/paginas/cliente/Create.html" class="btn btn-danger">Agregar</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4 ">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Producto</h5>
                                        <p class="card-text">Aquí va información acerca de algo.</p>
                                        <a href="/ProyectoBases2/paginas/producto/Create.php" class="btn btn-danger">Agregar</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row my-4">
                            <div class="offset-md-2 col-sm-12 col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Empleado</h5>
                                        <p class="card-text">Aquí va información acerca de algo.</p>
                                        <a href="/ProyectoBases2/paginas/empleado/Create.html" class="btn btn-danger">Agregar</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Categoria de producto</h5>
                                        <p class="card-text">Aquí va información acerca de algo.</p>
                                        <a href="/ProyectoBases2/paginas/categoria/Create.html" class="btn btn-danger">Agregar</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!--Espacio Listar-->
                <div class="collapse" id="list">
                    <div class="contenido">
                        <h3>Listas</h3>
                        <p>Estos son las cosas mas importantes para listar, recuerda que puedes ver detalles, editar o eliminar los registros.</p>
                        <div class="row">
                            <div class="col-sm-12 col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Proveedor</h5>
                                        <p class="card-text">Aquí va información acerca de algo.</p>
                                        <a href="/ProyectoBases2/paginas/proveedor/List.php" class="btn btn-danger">Mostrar</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Cliente</h5>
                                        <p class="card-text">Aquí va información acerca de algo.</p>
                                        <a href="/ProyectoBases2/paginas/cliente/List.php" class="btn btn-danger">Mostrar</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Producto</h5>
                                        <p class="card-text">Aquí va información acerca de algo.</p>
                                        <a href="/ProyectoBases2/paginas/producto/List.php" class="btn btn-danger">Mostrar</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row my-4">
                            <div class="col-sm-12 offset-md-2 col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Empleado</h5>
                                        <p class="card-text">Aquí va información acerca de algo.</p>
                                        <a href="/ProyectoBases2/paginas/empleado/List.php" class="btn btn-danger">Mostrar</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Categoria de producto</h5>
                                        <p class="card-text">Aquí va información acerca de algo.</p>
                                        <a href="/ProyectoBases2/paginas/categoria/List.php" class="btn btn-danger">Mostrar</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            <!--Espacio funciones basicas-->
            <div class="collapse" id="settings">
                    <div class="contenido">
                        <h3>Funciones Base</h3>
                        <p>Aquí encontraras información que quizá te interece sin embargo te recomendamos no tocar mucho de esto y si lo haces
                        que sea con ayuda de un experto.</p>
                        <ul class="list-group">
                            <li class="list-group-item" aria-disabled="true">
                                <a href="/ProyectoBases2/paginas/departamento/List.php">Lista de Departamentos</a>
                            </li>
                            <li class="list-group-item">
                                <a href="/ProyectoBases2/paginas/ciudad/List.php">Lista de Ciudades</a>
                            </li>
                            <li class="list-group-item">
                                <a href="/ProyectoBases2/paginas/barrio/List.php">Lista de Barrios</a>
                            </li>
                            <li class="list-group-item">
                                <a href="/ProyectoBases2/paginas/ubicacion/List.php">Lista de Direcciones</a>
                            </li>
                            <li class="list-group-item">
                                <a href="/ProyectoBases2/paginas/cargo/List.php">Lista de Cargos</a>
                            </li>
                            <li class="list-group-item">
                                <a href="/ProyectoBases2/paginas/ubicacion/List.php">Lista de Ubicaciones</a>
                            </li>
                        </ul>
                    </div>
            </div>
            </div>
            <!--Letrero de confirmación en cierre de sesion-->
            <div class="modal fade" id="confirm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Confirmación</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>¿Seguro que quieres cerrar sesión?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <a class="btn btn-ambar" href="/ProyectoBases2/index.html">Cerrar sesión</a>
                        </div>
                    </div>
                </div>
            </div>

            <!--Letrero de confirmación para eliminar una categoria-->
            <div class="modal fade" id="confirmarCampo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="confirmacion">Confirmación</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>¿Seguro que quieres eliminar una categoría?</p>
                            <p>Por favor ingresa el id de la categoría que quieres eliminar</p>
                            <input class="form-control" id="idCat" type="text"/>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button class="btn btn-ambar" onclick="eliminar()">Confirmar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      <!-- Bootstrap core JavaScript-->
        <script src="/ProyectoBases2/resources/vendor/jquery/jquery.min.js"></script>
        <script src="/ProyectoBases2/resources/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- Core plugin JavaScript-->
        <script src="/ProyectoBases2/resources/vendor/jquery-easing/jquery.easing.min.js"></script>
        <!--Mis scripts-->
        <script src="/ProyectoBases2/resources/js/controlBarra.js"></script>
        <script src="/ProyectoBases2/Logica/Javascript/Categoria.js"></script>
    </body>
</html>
<?php
mysql_free_result($ubi2);
?>
<?xml version="1.0" encoding="UTF-8" ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"
      xmlns:ui="http://xmlns.jcp.org/jsf/facelets"
      xmlns:h="http://xmlns.jcp.org/jsf/html"
      xmlns:f="http://xmlns.jcp.org/jsf/core">

    <ui:composition template="/template.xhtml">
        <ui:define name="title">
            <h:outputText value="#{bundle.ListUbicacionTitle}"></h:outputText>
        </ui:define>
        <ui:define name="entidad">
            <h:form styleClass="jsfcrud_list_form">
                <h:panelGroup id="messagePanel" layout="block">
                    <h:messages errorStyle="color: red" infoStyle="color: green" layout="table"/>
                </h:panelGroup>
                <h:outputText escape="false" value="#{bundle.ListUbicacionEmpty}" rendered="#{ubicacionController.items.rowCount == 0}"/>
                <h:panelGroup rendered="#{ubicacionController.items.rowCount > 0}">
                    <h:outputText value="#{ubicacionController.pagination.pageFirstItem + 1}..#{ubicacionController.pagination.pageLastItem + 1}/#{ubicacionController.pagination.itemsCount}"/>&nbsp;
                    <h:commandLink action="#{ubicacionController.previous}" value="#{bundle.Previous} #{ubicacionController.pagination.pageSize}" rendered="#{ubicacionController.pagination.hasPreviousPage}"/>&nbsp;
                    <h:commandLink action="#{ubicacionController.next}" value="#{bundle.Next} #{ubicacionController.pagination.pageSize}" rendered="#{ubicacionController.pagination.hasNextPage}"/>&nbsp;
                    <h:dataTable value="#{ubicacionController.items}" var="item" border="0" cellpadding="2" cellspacing="0" rowClasses="jsfcrud_odd_row,jsfcrud_even_row" rules="all" style="border:solid 1px">
                        <h:column>
                            <f:facet name="header">
                                <h:outputText value="#{bundle.ListUbicacionTitle_ubicacionId}"/>
                            </f:facet>
                            <h:outputText value="#{item.ubicacionId}"/>
                        </h:column>
                        <h:column>
                            <f:facet name="header">
                                <h:outputText value="#{bundle.ListUbicacionTitle_direccion}"/>
                            </f:facet>
                            <h:outputText value="#{item.direccion}"/>
                        </h:column>
                        <h:column>
                            <f:facet name="header">
                                <h:outputText value="#{bundle.ListUbicacionTitle_codigoPostal}"/>
                            </f:facet>
                            <h:outputText value="#{item.codigoPostal}"/>
                        </h:column>
                        <h:column>
                            <f:facet name="header">
                                <h:outputText value="#{bundle.ListUbicacionTitle_barrioId}"/>
                            </f:facet>
                            <h:outputText value="#{item.barrioId}"/>
                        </h:column>
                        <h:column>
                            <f:facet name="header">
                                <h:outputText value="&nbsp;"/>
                            </f:facet>
                            <h:commandLink action="#{ubicacionController.prepareView}" value="#{bundle.ListUbicacionViewLink}"/>
                            <h:outputText value=" "/>
                            <h:commandLink action="#{ubicacionController.prepareEdit}" value="#{bundle.ListUbicacionEditLink}"/>
                            <h:outputText value=" "/>
                            <h:commandLink action="#{ubicacionController.destroy}" value="#{bundle.ListUbicacionDestroyLink}"/>
                        </h:column>
                    </h:dataTable>
                </h:panelGroup>
                <br />
                <h:commandLink action="#{ubicacionController.prepareCreate}" value="#{bundle.ListUbicacionCreateLink}"/>
                <br />
                <br />
                <h:link outcome="/index" value="#{bundle.ListUbicacionIndexLink}"/>
            </h:form>
        </ui:define>
    </ui:composition>

</html>

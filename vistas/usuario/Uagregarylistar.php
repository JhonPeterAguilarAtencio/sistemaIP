<?php
//Activamos el almacenamiento en el buffer
ob_start();
session_start();

if (!isset($_SESSION["Ulogin"]))
{
    header("Location: ../login.php");
}
else{

 include '../header.php';
 ?>

    <!-- Begin Page Content --> <!-- CONTENIDO DEL DASDBOARD -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Mantenimiento de Usuarios</h1>
            <button class="btn btn-primary" id="btnAgregar" onclick="mostrarfrom(true)">
            <i class="fa fa-user-plus fa-sm text-white-120"></i>Agregar </button>
        </div>

        <!------------------------------INICIO Contenido Principal---------------------------------->
        <div class="content-wrapper">
        <!--Main content-->
            <section class="content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="box">
                            <!--<div class="box-header with-border">
                            <h1 class="h3 mb-50 text-gray-500">Teclados</h1>
                                <div class="box-tools pull-right">
                                </div>
                            </div> -->
                             <!--INICIO id content-->
                            <div class="panel-body table-responsive" id="listadoregistros">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <h4 class="header-title mt-0">Detalles de Usuarios</h4>
                                                <div class="table-responsive dash-social">
                                                    <table id="tbllistado" class="display">
                                                    <thead>
                                                            <th>OPCIONES</th>
                                                            <th>Persona</th>
                                                            <th>Cargo</th>
                                                            <th>Login</th>
                                                            <th>Imagen</th>
                                                            <th>estado</th>
                                                        </thead>
                                                        <tbody>
                                                            <tfoot>
                                                            <th>OPCIONES</th>
                                                            <th>Persona</th>
                                                            <th>Cargo</th>
                                                            <th>Login</th>
                                                            <th>Imagen</th>
                                                            <th>estado</th>
                                                            </tfoot>
                                                        </tbody>  
                                                    </table>
                                                </div>
                                            </div>
                                            <!--end card-body-->
                                        </div>
                                        <!--end card-->
                                    </div>
                                    <!--end col-->
                                </div>
                                <!--end row-->
                            </div>
                            <div class="panel-body" style="height: 400px;" id="formularioregistros">
                            <!-- ========================================================================================== -->
                            <!-- INICIA SECCION CONTENIDO -->
                            <!-- ========================================================================================== -->
                            <div class="row">
                                <div class="col-md-12 col-lg-12">
                                    <div class="card">
                                        <form name="formulario" id="formulario" method="POST">
                                        <div class="row">
                                            <div class="col-md-12 col-lg-11">
                                                <div class="card-body">
                                                <h4 class="mt-0 header-title">Datos del Usuario</h4>
                                                    <div class="row clearfix">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label>Seleccionar Persona:</label>
                                                                <input type="hidden" name="idusuario" id="idusuario">
                                                                <select class="form-control selectpicker" data-live-search="true" id="idpersona" name="idpersona">
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group ">
                                                                <label>Cargo</label>
                                                                <input class="form-control" type="text" name="Ucargo" id="Ucargo" maxLength="50"
                                                                placeholder="">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group ">
                                                                <label>Login</label>
                                                                <input class="form-control" type="text" name="Ulogin" id="Ulogin" maxLength="50"
                                                                    placeholder="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row clearfix">
                                                        <div class="col-md-4">
                                                            <div class="form-group ">
                                                                <label>Clave</label>
                                                                <input class="form-control" type="password" name="Uclave" id="Uclave" maxLength="50"
                                                                    placeholder="">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group ">
                                                                <label>Permisos:</label>
                                                                <ul style="list-style: none;" id="permisos">
                                                                </ul>
                                                                
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label>Imagen</label>
                                                                <input type="file" class="form-control-file" name="Uimagen" id="Uimagen">
                                                                <input type="hidden" name="Uimagenactual" id="Uimagenactual">
                                                                <br></br>
                                                                <img src="" width="150px" class="rounded" alt="Eniun" height="120px" name="Uimagenmuestra" id="Uimagenmuestra">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12 col-lg-12">
                                                <div class="card-body">
                                                    <div class="row clearfix text-right  ">
                                                        <div class="form-group mb-0">
                                                            <td class="border-0">
                                                            <button class="btn btn-primary" type="submit" value="" id="btnGuardar"><i class="fa fa-save"></i>
                                                                Guardar</button>
                                                            </td>

                                                            <button class="btn btn-danger" onclick="cancelarfrom()" type="button"><i class="fa fa-times-circle"></i>
                                                            Cancelar</button>
                                                        </div>
                                                        <!--end form-group-->
                                                    </div>
                                                </div>
                                                <!--end card-body-->
                                            </div>

                                        </div>
                                        </form>
                                        <!--end form-->
                                    </div>
                                    <!--end row-->
                                </div><!-- container -->
                            </div><!-- container -->
                            </div>
                            <!--FIN id content-->
                        </div>
                    </div>
                </div>
            </section>
        </div>
         <!------------------------------FIN Contenido Principal---------------------------------->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- End of Main Content -->
<?php
require '../footer.php';
?>
<script type="text/javascript" src="../scripts/susuario.js"></script>
<?php
 }
 ob_end_flush();
?>
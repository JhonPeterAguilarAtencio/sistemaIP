<?php

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
            <h1 class="h3 mb-0 text-gray-800">Mantenimiento de Areas</h1>
            <button class="btn btn-primary" id="btnAgregar" onclick="mostrarfrom(true)">
            <i class="fa fa-plus-circle fa-sm text-white-120"></i>  Agregar</button>
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
                                                <h4 class="header-title mt-0">Detalle de Areas</h4>
                                                <div class="table-responsive dash-social">
                                                    <table id="tbllistado" class="display">
                                                    <thead>
                                                            <th>Opciones</th>
                                                            <th>Sigla</th>
                                                            <th>nombre</th>
                                                            <th>descripcion</th>
                                                            <th>estado</th>
                                                        </thead>
                                                        <tbody>
                                                            <tfoot>
                                                            <th>Opciones</th>
                                                            <th>Sigla</th>
                                                            <th>nombre</th>
                                                            <th>descripcion</th>
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
                                                <h4 class="mt-0 header-title">Datos de Area</h4>
                                                    <div class="row clearfix">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Nombre sigla:</label>
                                                                <input type="hidden" name="idarea" id="idarea">
                                                                <input class="form-control" type="text" name="Asiglas" id="Asiglas"
                                                                placeholder="Nombre Sigla">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Nombre Area:</label>
                                                                <input class="form-control" type="text" name="Anombre" id="Anombre"
                                                                placeholder="Nombre Area">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row clearfix">
                                                        <div class="col-md-6">
                                                        <div class="form-group">
                                                                <label>Descripcion:</label>
                                                                <textarea class="form-control" rows="3" name="Adescripcion" id="Adescripcion" 
                                                                placeholder="Enter ..."></textarea>
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
<script type="text/javascript" src="../scripts/sarea.js"></script>

<?php
 }
 ob_end_flush();
?>
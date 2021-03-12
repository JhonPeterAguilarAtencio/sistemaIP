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

 if ($_SESSION['Mantenimiento equipos']==1)
 {
 ?>

    <!-- Begin Page Content --> <!-- CONTENIDO DEL DASDBOARD -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h4 mb-0 text-gray-800">Mantenimiento Teclados</h1>
            <button class="btn btn-primary" id="btnAgregar" onclick="mostrarfrom(true)">
            <i class="fa fa-plus-circle fa-sm text-white-120"></i>Agregar </button>
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
                                                <h5 class="header-title mt-0">Detalles de Teclados</h5>
                                                <div class="table-responsive dash-social">
                                                    <table id="tbllistado" class="display">
                                                        <thead>
                                                            <th>ID</th>
                                                            <th>codigo patrimonial</th>
                                                            <th>marca</th>
                                                            <th>modelo</th>
                                                            <th>area</th>
                                                            <th>imagen</th>
                                                            <th>estado</th>
                                                        </thead>
                                                        <tbody>
                                                            <tfoot>
                                                            <th>ID</th>
                                                            <th>codigo patrimonial</th>
                                                            <th>marca</th>
                                                            <th>modelo</th>
                                                            <th>area</th>
                                                            <th>imagen</th>
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
                                                <h5 class="mt-0 header-title">Datos del Teclado</h5>
                                                    <div class="row clearfix">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Codigo patrimonial</label>
                                                                <input type="hidden" name="idteclado" id="idteclado">
                                                                <input class="form-control" type="text" name="Tcodigopatrimonial" id="Tcodigopatrimonial" 
                                                                maxLength="50" placeholder="Codigo Patrimonial" required/>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                    <label>Marca</label>
                                                                    <input class="form-control" type="text" name="Tmarca" id="Tmarca" maxLength="50"
                                                                    placeholder="Marca" required>
                                                            </div>
                                                        </div> 
                                                    </div>
                                                    <div class="row clearfix">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Modelo</label>
                                                                <input class="form-control" type="text" name="Tmodelo" id="Tmodelo" maxLength="50"
                                                                placeholder="Modelo" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group ">
                                                                <label>Seleccionar Area:</label>
                                                                <select class="form-control selectpicker" id="idarea" name="idarea">
                                                                </select>
                                                            </div>
                                                        </div> 
                                                    </div>
                                                    <div class="row clearfix">
                                                        <div class="form-group">
                                                            <label>Imagen</label>
                                                            <input type="file" class="form-control-file" name="Timagen" id="Timagen">
                                                            <input type="hidden" name="Timagenactual" id="Timagenactual">
                                                            <br></br>
                                                            <img src="" width="150px" class="rounded" alt="Eniun" height="120px" name="Timagenmuestra" id="Timagenmuestra">
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
}
else{
    require '../noacceso.php';
}
require '../footer.php';
?>
<script type="text/javascript" src="../scripts/steclado.js"></script>
<?php
 }
 ob_end_flush();
?>
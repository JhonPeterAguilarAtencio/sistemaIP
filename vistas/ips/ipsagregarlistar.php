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
            <h1 class="h3 mb-0 text-gray-800">Mantenimiento de IPS VLan 8</h1>
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
                                                <h4 class="header-title mt-0">Detalles de IPS VLan 8</h4>
                                                <div class="table-responsive dash-social">
                                                    <table id="tbllistado" class="display">
                                                    <thead>
                                                            <th>Opcion</th>
                                                            <th>Sigla</th>
                                                            <th>Nombre</th>
                                                            <th>TipoEquipo</th>
                                                            <th>Nro IPS</th>
                                                            <th>Persona</th>
                                                            <th>Cargo</th>
                                                            <th>Nivel</th>
                                                            <th>Estado</th>
                                                        </thead>
                                                        <tbody>
                                                            <tfoot>
                                                            <th>Opcion</th>
                                                            <th>Sigla</th>
                                                            <th>Nombre</th>
                                                            <th>TipoEquipo</th>
                                                            <th>Nro IPS</th>
                                                            <th>Persona</th>
                                                            <th>Cargo</th>
                                                            <th>Nivel</th>
                                                            <th>Estado</th>
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
                                        <form name="formulario1" id="formulario1" method="POST">
                                        <div class="row">
                                            <div class="col-md-12 col-lg-11">
                                                <div class="card-body">
                                                <h4 class="mt-0 header-title">Datos de IPS VLan 8</h4>
                                                    <div class="row clearfix">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Selecionar area:(*)</label>
                                                                <input type="hidden" name="idips" id="idips">
                                                                <select class="form-control selectpicker" data-live-search="true" id="idarea" name="idarea">
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                            <label>Selecionar Persona:(*)</label>
                                                                <select class="form-control selectpicker" data-live-search="true" id="idpersona" name="idpersona">
                                                                </select>
                                                            </div>
                                                        </div> 
                                                    </div>
                                                    <div class="row clearfix">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                            <label>Selecionar Tipo Equipo:(*)</label>
                                                                <select class="form-control select-picker" data-live-search="true" id="IPtipoequipo" name="IPtipoequipo">
                                                             
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group ">
                                                                <label>Selecionar Equip:(*)</label>
                                                                    <select class="form-control selectpicker" data-live-search="true" id="idequipos" name="idequipos">
                                                                    </select>
                                                            </div>
                                                        </div>
                                                    </div>

                                                  
                                                    <div class="row clearfix">
                                                        <div class="col-md-6">
                                                            <div class="form-group ">
                                                            <label>Nro IP</label>
                                                                    <input class="form-control" type="text" name="IPnumips" id="IPnumips" maxLength="50"
                                                                    placeholder="">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                            <label>Nro DNS</label>
                                                                        <input class="form-control" type="text" name="IPnumdns" id="IPnumdns" maxLength="50"
                                                                        placeholder="">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row clearfix">
                                                        <div class="col-md-6">
                                                            <div class="form-group ">
                                                            <label>Nro Proxy</label>
                                                                    <input class="form-control" type="text" name="IPnumproxy" id="IPnumproxy" maxLength="50"
                                                                    placeholder="">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                            <label>Nro Puerto proxy</label>
                                                                        <input class="form-control" type="text" name="IPnumpuertoproxy" id="IPnumpuertoproxy" 
                                                                        maxLength="50"
                                                                        placeholder="">
                                                            </div>
                                                        </div>
                                                    </div>

                                                        <div class="row clearfix">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                <label>Usuario Nivel</label>
                                                                            <input class="form-control" type="text" name="IPusuariocredencial" id="IPusuariocredencial" 
                                                                            maxLength="50"
                                                                            placeholder="">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                <label>Usuario Clavecreencial</label>
                                                                        <input class="form-control" type="text" name="IPclavecreencial" id="IPclavecreencial" 
                                                                        maxLength="50"
                                                                        placeholder="">
                                                                </div>
                                                            </div>
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
                                                            <button class="btn btn-primary" type="submit" value="" id="btnGuarda1r"><i class="fa fa-save"></i>
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


    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

<script type="text/javascript" src="../scripts/sips.js"></script>
<?php
 }
 ob_end_flush();
?>

<script >


</script>
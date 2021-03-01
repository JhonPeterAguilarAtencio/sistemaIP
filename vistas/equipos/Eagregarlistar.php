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
            <h1 class="h3 mb-0 text-gray-800">Mantenimiento de Equipos</h1>
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
                                                <h4 class="header-title mt-0">Detalles de Equipos</h4>
                                                <div class="table-responsive dash-social">
                                                    <table id="tbllistado" class="display">
                                                    <thead>
                                                            <th>ID</th>
                                                            <th>Tipo E.</th>
                                                            <th>codigo patrimonial</th>
                                                            <th>marca</th>
                                                            <th>modelo</th>
                                                            <th>area</th>                                                          
                                                            <th>estado</th>
                                                        </thead>
                                                        <tbody>
                                                            
                                                         
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
                                            <div class="col-md-12 col-lg-12">
                                                <div class="card-body">
                                                <h4 class="mt-0 header-title">Datos del Equipo</h4>
                                                    <div class="row clearfix">

                                                      <div class="col-md-4">
                                                            <div class="form-group">
                                                            <input type="hidden" name="idequipo" id="idequipo">
                                                            <label>Selecionar Tipo Equipo:(*)</label>
                                                                <select class="form-control select-picker" data-live-search="true" id="IPtipoequipo" name="IPtipoequipo">
                                                             
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                    <label>Codigo patrimonial</label>
                                                                    <input class="form-control" type="text" name="Ecodigo" id="Ecodigo" 
                                                                    placeholder="Codigo">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label>Marca</label>
                                                                <input class="form-control" type="text" name="Emarca" id="Emarca" 
                                                                placeholder="Modelo">
                                                            </div>
                                                        </div>
                                                   
                                                        
                                                    </div>
                                                    <div class="row clearfix">
                                                       
                                                        <div class="col-md-4">
                                                            <div class="form-group ">
                                                                <label>Modelo</label>
                                                                <input class="form-control" type="text" name="Emodelo" id="Emodelo" 
                                                                placeholder="Modelo">
                                                            </div>
                                                        </div> 
                                                        <div class="col-md-6">
                                                            <div class="form-group ">                                                               
                                                                <label>Seleccionar area:</label>
                                                                <select class="form-control selectpicker" data-live-search="true" id="Earea" name="Earea">
                                                                </select>
                                                            </div>
                                                        </div>

                                                         <div class="col-md-2">
                                                         <label>Seleccionar Dueño</label>
                                                              <div class="form-check form-check-inline">
                                                                    <input
                                                                    class="form-check-input"
                                                                    type="radio"
                                                                    name="perteneciente"
                                                                    id="rbdpropio"
                                                                    value="Propio"
                                                                />
                                                                <label class="form-check-label" for="inlineRadio1">Propio</label>
                                                                </div>

                                                                <div class="form-check form-check-inline">
                                                                <input
                                                                    class="form-check-input"
                                                                    type="radio"
                                                                    name="perteneciente"
                                                                    id="rbdentidad"
                                                                    value="Entidad"
                                                                />
                                                                <label class="form-check-label" for="inlineRadio2">Entidad</label>
                                                                </div>
                                                                </div>
                                                   </div>
                                                    <div class="row clearfix">
                                                       <!--
                                                        <div class="form-group">
                                                            <label>Imagen</label>
                                                            <input type="file" class="form-control-file" name="Eimagen" id="Eimagen">
                                                            <input type="hidden" name="Eimagenactual" id="Eimagenactual">
                                                            <br></br>
                                                            <img src="" width="150px" class="rounded" alt="Eniun" height="120px" name="Eimagenmuestra" id="Eimagenmuestra">
                                                        </div>-->
                                                    </div>
                                                    <div class="row clearfix"  id="PartesEquipo">
                                                    <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Selecionar Codigo P. de Pantalla:</label>
                                                    <select class="form-control selectpicker" data-live-search="true" id="idpantalla" name="idpantalla">
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Selecionar Codigo P. de Teclado:</label>
                                                    <select class="form-control selectpicker" data-live-search="true" id="idteclado" name="idteclado">
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Seleccionar Codigo Mouse aaa:</label>
                                                    <select class="form-control selectpicker" data-live-search="true" id="idmouse" name="idmouse">
                                                    </select>
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

<script type="text/javascript" src="../scripts/sEquipo.js"></script>
<?php
 }
 ob_end_flush();
?>
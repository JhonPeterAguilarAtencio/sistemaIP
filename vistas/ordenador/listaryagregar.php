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
            <h1 class="h3 mb-0 text-gray-800">Mantenimiento de Ordenadores</h1>
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
                                                <h4 class="header-title mt-0">Detalles de Ordenadores</h4>
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
                                                <h4 class="mt-0 header-title">Datos del Ordenador</h4>
                                                    <div class="row clearfix">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label>Codigo patrimonial</label>
                                                                <input type="hidden" name="idordenador" id="idordenador">
                                                                <input class="form-control" type="text" name="Ocodigopatrimonial" id="Ocodigopatrimonial" 
                                                                maxLength="50" placeholder="Codigo Patrimonial">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                    <label>Marca</label>
                                                                    <input class="form-control" type="text" name="Omarca" id="Omarca" maxLength="50"
                                                                    placeholder="Marca">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label>Modelo</label>
                                                                <input class="form-control" type="text" name="Omodelo" id="Omodelo" maxLength="50"
                                                                placeholder="Modelo">
                                                            </div>
                                                        </div> 
                                                    </div>
                                                    <div class="row clearfix">
                                                        <div class="col-md-6">
                                                            <div class="form-group ">
                                                              
                                                                <label>Seleccionar area:</label>
                                                               
                                                                <select class="form-control "  id="Oarea1" name="Oarea1">
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
                                                    <div class="row clearfix">
                                                       <div class="col-md-4">
                                                            <div class="form-group ">
                                                                <label>Marca mouse</label>
                                                                <input class="form-control" type="text" name="txtmarcasmouse" id="txtmarcasmouse" maxLength="50"
                                                                placeholder="Marca Mouse">
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
                                                            <div class="form-group ">
                                                                <label>Marca</label>
                                                                <input class="form-control" type="text" name="txtmarcateclado" id="txtmarcateclado" maxLength="50"
                                                                placeholder="">
                                                            </div>
                                                        </div>
                                                       
                                                    </div>
                                                    <div class="row clearfix">
                                                      <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label>Selecionar Codigo P. de Pantalla:</label>
                                                                <select class="form-control selectpicker" data-live-search="true" id="idpantalla" name="idpantalla">
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group ">
                                                                <label>Marca</label>
                                                                <input class="form-control" type="text" name="txtmarcapantalla" id="txtmarcapantalla" maxLength="50"
                                                                placeholder="">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label>Imagen</label>
                                                                <input type="file" class="form-control-file" name="Oimagen" id="Oimagen">
                                                                <input type="hidden" name="Oimagenactual" id="Oimagenactual">
                                                                <br></br>
                                                                <img src="" width="150px" class="rounded" alt="Eniun" height="120px" name="Oimagenmuestra" id="Oimagenmuestra">
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
<script type="text/javascript" src="../scripts/sordenador.js"></script>
<?php
 }
 ob_end_flush();
?>
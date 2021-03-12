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

 if ($_SESSION['Mantenimiento usuarios']==1)
 {
 ?>
    <!-- Begin Page Content --> <!-- CONTENIDO DEL DASDBOARD -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h4 mb-0 text-gray-800">Permisos</h1>
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
                                                <h5 class="header-title mt-0">Detalles de Permisos</h5>
                                                <div class="table-responsive dash-social">
                                                    <table id="tbllistado" class="display">
                                                    <thead>
                                                        <th>ID</th>
                                                        <th>nombre</th>
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
<script type="text/javascript" src="../scripts/spermiso.js"></script>
<?php
 }
 ob_end_flush();
?>
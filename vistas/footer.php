<?php
//Activamos el almacenamiento en el buffer
 ob_start();
 

 if (!isset($_SESSION["Ulogin"]))
 {
     header("Location: login.php");
 }
 else{

?>

<footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2020</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal MENSAJE PARA SALIDA DEL LOGEO-->
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
                    <a class="btn btn-primary" href="../../ajax/xusuario.php?op=salir">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL DE VISTA-->
    <div class="modal fade" id="ordenadorModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detalle Equipo:</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                    <div class="row clearfix">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Codigo Patrimonial:</label>
                                <br>
                                <input type="hidden" name="idordenador" id="idordenador">
                                <label for="recipient-name"  id="txtOcodigopatrimonial" class="col-form-label"></label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Marca:</label>
                                <input type="text"  class="form-control" disabled id="txtmarcaordenador">
                            </div>
                        </div>
                    </div>
                   <div id="divpartes">                
                    
                   <label>Detalle de Teclado</label>
                    <div class="row clearfix">
                        <div class="col-md-6">
                            <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Codigo Patrimonial:</label>
                                <input type="text" class="form-control" disabled id="txtodelo">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Area:</label>
                                <input type="text" class="form-control" disabled id="txtArea">
                            </div>
                        </div>
                    </div>
                    <label>Detalle de Pantalla</label>
                    <div class="row clearfix">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Codigo Patrimonial:</label>
                                
                                <input type="text" class="form-control"  disabled name="txtcodigopatpantalla" id="txtcodigopatpantalla">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Marca:</label>
                                <input type="text" class="form-control"  disabled name="txtmarcapantalla1" id="txtmarcapantalla1">
                            </div>
                        </div>
                    </div>
                    

                    <label>Detalle de Mouse</label>
                    <div class="row clearfix">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Codigo Patrimonial:</label>
                                
                                <input type="text" class="form-control"  disabled name="txtcodigopatpantalla" id="txtcodigopatpantalla">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Marca:</label>
                                <input type="text" class="form-control"  disabled name="txtmarcapantalla1" id="txtmarcapantalla1">
                            </div>
                        </div>
                    </div>

                  </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <!--<button type="button" class="btn btn-primary">Send message</button>-->
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL DE VISTA IPS-->
    <div class="modal fade" id="ipsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalIPS" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalIPS">Detalle IPS:</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                    <label>Detalle de IPS</label>
                    <div class="row clearfix">
                            <div class="col-md-6">
                                <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Area/Oficina:</label>
                                    <br>
                                
                                    <label for="recipient-name"  id="txt0" class="col-form-label"></label>
                                    <br>
                                    <hr class="dotted">
                                    <label for="recipient-name" class="col-form-label">Equipo:</label>
                                        <br>
                                        <label for="recipient-name"  id="txt1" class="col-form-label"></label>
                                        <br>
                                    <label for="recipient-name" class="col-form-label">IPS:</label>
                                        <br>
                                        <label for="recipient-name"  id="txt2" class="col-form-label"></label>
                                        <br>
                                    <label for="recipient-name" class="col-form-label">Nro DNS:</label>
                                        <br>
                                        <label for="recipient-name"  id="txt3" class="col-form-label"></label>
                                        <br>
                                    <label for="recipient-name"  class="col-form-label">Nro Proxy:</label>
                                        <br>
                                        <label for="recipient-name" id="txt4"   class="col-form-label"></label>
                                        <br>
                                    <label for="recipient-name" class="col-form-label">Nro Puerto Proxy:</label>
                                        <br>
                                        <label for="recipient-name"  id="txt5" class="col-form-label"></label>
                                        <br>
                                    <label for="recipient-name" class="col-form-label">Nivel Credencial:</label>
                                        <br>
                                        <label for="recipient-name"  id="txt6" class="col-form-label"></label>
                                        <br>
                                    <label for="recipient-name" class="col-form-label">Clave Credencial:</label>
                                        <br>
                                        <label for="recipient-name"  id="txt7" class="col-form-label"></label>
                                </div>
                            </div>
                    </div>
                    <label>Detalle de Persona</label>
                    <div class="row clearfix">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Nombre:</label>
                                        <br>
                                        <label for="recipient-name"  id="txt8" class="col-form-label"></label>
                                        <br>
                                    <label for="recipient-name" class="col-form-label">Cargo:</label>
                                        <br>
                                        <label for="recipient-name"  id="txt9" class="col-form-label"></label>
                                </div>
                            </div>
                    </div>
                   <div id="divpartes">                       
                    <label>Detalle de Equipo:</label>
                        <div class="row clearfix">
                            <div class="col-md-6">
                                <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Codigo Equipo:</label>
                                    <br>
                                    <label for="recipient-name"  id="txt10" class="col-form-label"></label>
                                    <br>
                                <label for="recipient-name" class="col-form-label">Marca Equipo:</label>
                                    <br>
                                    <label for="recipient-name"  id="txt11" class="col-form-label"></label>
                                    <br>
                                <label for="recipient-name" class="col-form-label">Modelo Equipo:</label>
                                    <br>
                                    <label for="recipient-name"  id="txt12" class="col-form-label"></label>
                                </div>
                            </div>
                        </div>
                  </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <!--<button type="button" class="btn btn-primary">Send message</button>-->
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="../../public/vendor/jquery/jquery.min.js"></script>
    <script src="../../public/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../../public/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../../public/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../../public/vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../../public/js/demo/chart-area-demo.js"></script>
    <script src="../../public/js/demo/chart-pie-demo.js"></script>

     <!-- DATATABLE -->
     <script src="../../public/datatables/js/jquery-3.5.1.js"></script>
     <script src="../../public/datatables/js/jquery.dataTables.min.js"></script>
     <script src="../../public/datatables/js/dataTables.buttons.min.js"></script>
     <script src="../../public/datatables/js/jszip.min.js"></script>
     <script src="../../public/datatables/js/pdfmake.min.js"></script>
     <script src="../../public/datatables/js/vfs_fonts.js"></script>
     <script src="../../public/datatables/js/buttons.html5.min.js"></script>
     <script src="../../public/dropify/js/dropify.min.js"></script>

     <!-- ALERT BOOTBOX -->
     <script src="../../public/bootbox/bootbox.min.js"></script>
     <script src="../../public/bootbox/bootbox.all.min.js"></script>
     <script src="../../public/bootbox/bootbox.all.js"></script>
     <script src="../../public/bootbox/bootbox.locales.min.js"></script>

     <script src="../../public/js/sweetalert2@10.js"></script>

     <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>



</body>

</html>
<?php
 }
 ob_end_flush();
?>
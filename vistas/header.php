<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin IPs- Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="../../public/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../../public/css/sb-admin-2.min.css" rel="stylesheet">


    <!-- DATATABLE -->
    <link href="../../public/datatables/css/jquery.dataTables.min.css" rel="stylesheet"/>
    <link href="../../public/datatables/css/buttons.dataTables.min.css" rel="stylesheet"/>

    <!-- DROPY -->
    <link href="../../public/dropify/css/dropify.min.css" rel="stylesheet">

    



</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar PARTE MENU DERECHO-->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-13">
                    <img src="../../public/img/logo2.png" width="60" height="50">        
                </div>
                <div class="sidebar-brand-text mx-3">IPs Admin</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="../Dashboard/index.php">
                    <i class="fas fa-fw fa-laptop"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Registro IPs 4
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Registro IPs</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Registro IPs:</h6>
                        <a class="collapse-item" href="buttons.html">Lista</a>
                        <a class="collapse-item" href="cards.html">Agregar</a>
                    </div>
                </div>
            </li>
            
            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Mantenimiento
            </div>  

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="../ordenador/listaryagregar.php">
                    <i class="fas fa-fw fa-desktop"></i>
                    <span>Ordenador</span></a>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="../pantalla/listaryagregar.php">
                    <i class="fas fa-fw fa-desktop"></i>
                    <span>Pantallas</span></a>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="../teclado/listar.php">
                    <i class="fas fa-fw fa-keyboard"></i>
                    <span>Teclado</span></a>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="../mouse/listaryagregar.php">
                    <i class="fas fa-fw fa-rocket"></i>
                    <span>Mouse</span></a>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="../laptop/llistaryagregar.php">
                    <i class="fas fa-fw fa-laptop"></i>
                    <span>Laptop</span></a>
            </li>
    

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

            <!-- Sidebar Message -->
            <div class="sidebar-card">
                <img class="sidebar-card-illustration mb-2" src="../../public/img/undraw_rocket.svg" alt="">
                <p class="text-center mb-2"><strong>Admin IPs</strong> Aqui podras administrar las IPs de la Entidad.</p>
                <a class="btn btn-success btn-sm" href="https://startbootstrap.com/theme/sb-admin-pro">Upgrade to Pro!</a>
            </div>

        </ul>
        <!-- End of Sidebar -->
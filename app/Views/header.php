<?php 
    $user_session = session();
?> 

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>POS</title>

    <!-- Custom fonts for this template -->
    <link href="<?php echo base_url();  ?>/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?php echo base_url();  ?>/css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="<?php echo base_url();  ?>/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <!-- JQuery -->
    <script src="<?php echo base_url();  ?>/vendor/jquery/jquery.min.js"></script>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">POST <sup></sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - Productos -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-shopping-basket"></i>
                    <span>Productos</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="<?php echo base_url() ?>productos">Productos</a>
                        <a class="collapse-item" href="<?php echo base_url() ?>unidades">Unidades</a>
                        <a class="collapse-item" href="<?php echo base_url() ?>categorias">Categorías</a>
                    </div>
                </div>
            </li>

             <!-- Nav Item - Clientes -->
             <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url() ?>clientes">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Clientes</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCompras" aria-expanded="true" aria-controls="collapseCompras">
                    <i class="fas fa-fw fa-cash-register"></i>
                    <span>Compras</span>
                </a>
                <div id="collapseCompras" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="<?php echo base_url() ?>compras/nuevo">Nueva compra</a>
                        <a class="collapse-item" href="<?php echo base_url() ?>compras">Compras</a>
                    </div>
                </div>
            </li>

             <!-- Nav Item - Administración -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-tools"></i>
                    <span>Administración</span>
                </a>
                <div id="collapseThree" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="<?php echo base_url() ?>configuracion">Configuración</a>
                        <a class="collapse-item" href="<?php echo base_url() ?>usuarios">Usuarios</a>
                        <a class="collapse-item" href="<?php echo base_url() ?>cajas">Cajas</a>
                        <a class="collapse-item" href="<?php echo base_url() ?>roles">Roles</a>
                    </div>
                </div>  
            </li>

           
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <form class="form-inline">
                        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                            <i class="fa fa-bars"></i>
                        </button>
                    </form>

                    <!-- Topbar Search -->
                    <!-- <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form> -->

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php  echo $user_session->nombre ?></span>
                                <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Perfil
                                </a>
                                <a class="dropdown-item" href="<?php  echo base_url() ?>usuarios/cambia_password">
                                    <i class="fas fa-key fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Cambiar contraseña
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="<?php  echo base_url() ?>usuarios/logout">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Cerrar sesión
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->
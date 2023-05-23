<?php 
 $user_session = session();
 if ($user_session != null) {
    
 }
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>POS - Login</title>

    <!-- Custom fonts for this template-->
    <link href="<?php echo base_url(); ?>/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?php echo base_url(); ?>/css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="<?php echo base_url(); ?>/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <style>
        html, body {
            height: 100%;
        }

        .wrapper {
            min-height: 100%;
            margin-bottom: -60px; /* Altura del footer */
        }

        .footer {
            height: 60px; /* Altura del footer */
            background-color: #f8f9fc;
            text-align: center;
            padding-top: 20px;
        }
    </style>

</head>

<body class="bg-gradient-primary">
<?php print_r($user_session->nombre); ?>
    <div class="wrapper">

        <div class="container">

            <!-- Outer Row -->
            <div class="row justify-content-center">

                <div class="col-xl-10 col-lg-12 col-md-9">

                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <div class="card-body p-0">
                            <!-- Nested Row within Card Body -->
                            <div class="row">
                                <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                                <div class="col-lg-6">
                                    <div class="p-5">
                                        <div class="text-center">
                                            <h1 class="h4 text-gray-900 mb-4">Iniciar sesión</h1>
                                        </div>
                                        <form class="user" method="POST" action="<?php echo base_url(); ?>/usuarios/valida">
                                            <div class="form-group">
                                                <label class="small mb-1" for="usuario">Usuario</label>
                                                <input type="text" class="form-control form-control-user" id="usuario" name="usuario" aria-describedby="emailHelp" placeholder="Ingresa tu usuario..." required>
                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-1" for="password">Contraseña</label>
                                                <input type="password" class="form-control form-control-user" id="password" name="password"  placeholder="Ingresa tu contraseña..." required>
                                            </div>

                                            <button class="btn btn-primary btn-user btn-block" type="submit">
                                                Iniciar sesión
                                            </button>
                                            <br>
                                            <?php if(isset($validation)) { ?>
                                                <div class="alert alert-danger">
                                                    <?php echo $validation->listErrors();  ?>
                                                </div>
                                            <?php } ?>
                                            
                                            <?php if(isset($error)) { ?>
                                                <div class="alert alert-danger">
                                                    <?php echo $error;  ?>
                                                </div>
                                            <?php } ?>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="<?php echo base_url(); ?>/vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?php echo base_url(); ?>/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?php echo base_url(); ?>/js/sb-admin-2.min.js"></script>

    <footer class="footer">
        <div class="container my-auto">
            <span>© Ogoobox <?php echo date('Y'); ?></span>
        </div>
    </footer>

</body>

</html>

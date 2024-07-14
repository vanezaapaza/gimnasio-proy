<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    try {
        $data = [
            'ope' => 'login',
            'correo_electronico' => $_POST['correo'],
            'contrasena' =>  $_POST['pass'],
        ];
        $client = new HttpClient(HTTP_BASE);
        $result = $client->post('/controller/LoginController.php', $data);
  
        if ($result["ESTADO"] && isset($result['DATA']) &&  !empty($result['DATA'])) {
            $_SESSION['login'] = $result['DATA'][0];
            if (isset($_SESSION['login']['nombre'])) {
                echo "<script>alert('Acceso Autorizado');</script>";
                echo '<script>window.location.href ="' . HTTP_BASE . '/web/cli/list";</script>';
            } else {
                echo "<script>alert('Acceso No Autorizado');</script>";
            }
        } else {
            echo "<script>alert('Hubo un problema, Contactarse con el Administrador de Sistemas');</script>";
        }
    } catch (Exception $e) {
        echo "<script>alert('Hubo un problema, Contactarse con el Administrador de Sistemas');</script>";
    }
}



?>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Log in</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&amp;display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo URL_RESOURCES . "/lib/adminlte/"; ?>plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?php echo URL_RESOURCES . "/lib/adminlte/"; ?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo URL_RESOURCES . "/lib/adminlte/"; ?>dist/css/adminlte.min.css">
</head>

<body class="login-page" style="min-height: 494.8px;">
    <div class="login-box">
        <div class="login-logo">
            <a href="../../index2.html"><b>Admin</b>LTE</a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Sign in to start your session</p>

                <form action="" method="post">
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" placeholder="Email" name="correo">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Password" name="pass">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">

                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>


                <!-- /.social-auth-links -->


                <p class="mb-0">
                    <a href="register.html" class="text-center">Register a new membership</a>
                </p>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="<?php echo URL_RESOURCES . "/lib/adminlte/"; ?>plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?php echo URL_RESOURCES . "/lib/adminlte/"; ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo URL_RESOURCES . "/lib/adminlte/"; ?>dist/js/adminlte.min.js"></script>


</body>

</html>
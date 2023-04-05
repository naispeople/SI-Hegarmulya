<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login | SI Hegar Mulya</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center align-items-center mt-5">

            <div class="col-md-8">

                <div class="card border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <div class="p-5">
                                    <div class="text-center">
                                        <img src="<?= base_url('/img/logo.png'); ?>" alt="ummi baby logo" style="width:150px" class="mb-4">
                                        <h1 class="h5 text-gray-900 mb-2">Selamat Datang</h1>
                                        <h1 class="h6 text-gray-900 mb-2">Sistem Informasi Produksi PT Hegar Mulya</h1>
                                        <small>Jl. Cibaligo No.6,8, Cigugur Tengah, Kec. Cimahi Tengah, Kota Cimahi, Jawa Barat</small>
                                    </div>
                                    <hr class="my-4">
                                    <form class="user" action="/login" method="post">
                                        <?= csrf_field(); ?>
                                        <div class="form-group">
                                            <input type="text" name="username" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Username">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password">
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="remember" name="remember" <?php if (isset($_COOKIE["loginId"])) { ?> checked="checked" <?php } ?>>
                                                <label class="custom-control-label" for="remember">Remember
                                                    Me</label>
                                            </div>
                                        </div>

                                        <?php if (session()->getFlashdata('err')) : ?>
                                            <div class="alert alert-warning fade-in">
                                                <?= session()->getFlashdata('err') ?>
                                            </div>
                                        <?php endif; ?>

                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Login
                                        </button>

                                    </form>
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
    <script type="application/javascript">
        /** After windod Load */
        $(window).bind("load", function() {
            window.setTimeout(function() {
                $(".alert").fadeTo(500, 0).slideUp(500, function() {
                    $(this).remove();
                });
            }, 4000);
        });
    </script>



</body>

</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include __VIEW__ . 'admin/head.php'; ?>
</head>
<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <?php include __VIEW__ . 'admin/menu.php'; ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?php include __VIEW__ . 'admin/sidebar.php'; ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <?php include __VIEW__ . 'alert.php'; ?>
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-primary" style="margin-top: 15px;margin-bottom: 0;">
                                <div class="card-header">
                                    <h3 class="card-title"><?=$title?></h3>
                                </div>
                            </div>
                            <div class="card-body bg-white">
                                <?php include __VIEW__ . 'admin/' . $template . '.php'; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- /.content -->
        </div>


        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
            <b>Version</b> 3.2.0
            </div>
            <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="<?=$_ENV['BASE_URL']?>/template/admin/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?=$_ENV['BASE_URL']?>/template/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?=$_ENV['BASE_URL']?>/template/admin/dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?=$_ENV['BASE_URL']?>/template/admin/dist/js/demo.js"></script>
    <!-- Page specific script -->


    <script src="<?=$_ENV['BASE_URL']?>/template/admin/js/main.js?v=<?=time()?>"></script>
</body>
</html>

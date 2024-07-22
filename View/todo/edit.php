<?php view('static/header') ?>
<div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <!-- Navbar Search -->
            <li class="nav-item d-none d-sm-inline-block">
                <a href="<?= URL.'cikis';?>" class="nav-link">Çıkış yap</a>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
   <?= view('static/sidebar')?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper p-5">

        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">

                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Kategori ekle</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->

                            <?php
                            echo get_session('error') ? '<div class="alert alert-'.$_SESSION['error']['type'].'">'.$_SESSION['error']['message'].'</div>': null;
                            ?>
                            <form action="" method="post">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="title">Kategori başlığı</label>
                                        <input type="text" name="title" class="form-control" id="title" value="<?=$data['title']?>" placeholder="Kategori adı giriniz">
                                        <input type="hidden" name="id" class="form-control" id="id" value="<?=$data['id']?>">

                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" name="submit" value="1" class="btn btn-primary">Güncelle</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /.col-md-6 -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->



    <!-- Main Footer -->
   <?php view('static/footer') ?>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="<?= assets('plugins/jquery/jquery.min.js')?>"></script>
<!-- Bootstrap 4 -->
<script src="<?= assets('plugins/bootstrap/js/bootstrap.bundle.min.js')?>"></script>
<!-- AdminLTE App -->
<script src="<?= assets('js/adminlte.min.js')?>"></script>
</body>
</html>

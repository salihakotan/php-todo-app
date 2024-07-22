<?php view('static/header') ?>
<div class="login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="../../index2.html"><b>Todo</b>APP</a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg"><?= lang('Oturum Açın') ?></p>
                <?php
                echo get_session('error') ? '<div class="alert alert-'.$_SESSION['error']['type'].'">'.$_SESSION['error']['message'].'</div>': null;
                ?>
                <form action="<?= URL.'login' ?>" method="post">
                    <div class="input-group mb-3">

                        <input type="email" name="eposta" value="<?= $_SESSION['post']['eposta'] ? $_SESSION['post']['eposta'] : ''?>" class="form-control" placeholder="<?= lang('E-posta') ?>">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="sifre" value="<?= $_SESSION['post']['sifre'] ? $_SESSION['post']['sifre'] : ''?>" class="form-control" placeholder="<?= lang('Şifreniz') ?>">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <!-- /.col -->
                        <div class="col-12">
                            <button type="submit" name="submit" value="1"
                                    class="btn btn-primary btn-block w-100"><?= lang('Giriş Yap') ?></button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="<?= assets('plugins/jquery/jquery.min.js') ?>"></script>
<!-- Bootstrap 4 -->
<script src="<?= assets('plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
<!-- AdminLTE App -->
<script src="<?= assets('js/adminlte.min.js') ?>"></script>
</body>
</html>

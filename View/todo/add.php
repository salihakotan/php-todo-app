<?php view('static/header') ?>
<div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <!-- Navbar Search -->
            <li class="nav-item d-none d-sm-inline-block">
                <a href="<?= URL . 'cikis'; ?>" class="nav-link">Çıkış yap</a>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <?= view('static/sidebar') ?>

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
                                <h3 class="card-title">Yapılacaklar listenize ekleyin</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <?php
                            echo get_session('error') ? '<div class="alert alert-' . $_SESSION['error']['type'] . '">' . $_SESSION['error']['message'] . '</div>' : null;
                            ?>
                            <form id="todo" action="" method="post">
                                <div class="card-body">

                                    <div class="form-group">
                                        <label for="title">Kategori seçiniz</label>
                                        <select id="category_id" class="form-control">
                                            <option value="0">- Kategori seçimi yapınız -</option>
                                            <?php foreach ($data as $category): ?>
                                                <option value="<?= $category['id'] ?>"><?= $category['title'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="title">Başlık</label>
                                        <input type="text" name="title" class="form-control" id="title"
                                               placeholder="Başlık girin">
                                    </div>

                                    <div class="form-group">
                                        <label for="description">Açıklama</label>
                                        <input type="text" name="description" class="form-control" id="description"
                                               placeholder="Açıklama girin">
                                    </div>
                                    <div class="form-group">
                                        <label for="status">Durum</label>
                                        <select class="form-control" id="status">
                                            <option value="a">Aktif</option>
                                            <option value="p">Pasif</option>
                                            <option value="s">Süreçte</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="progress">İlerleme</label>
                                        <input type="range" class="form-control" id="progress" min="0" max="100">
                                    </div>

                                    <div class="form-group">
                                        <label for="color">Renk</label>
                                        <input type="color" class="form-control" id="color" value="#007bff">
                                    </div>

                                    <div class="form-group">
                                        <label for="start_date">Başlangıç tarihi</label>
                                        <div class="row">
                                            <input type="date" class="form-control col-8" id="start_date"/>
                                            <input type="time" class="form-control col-4" id="start_date_time"/>

                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="end_date">Bitiş tarihi</label>
                                        <div class="row">
                                            <input type="date" class="form-control col-8" id="end_date"/>
                                            <input type="time" class="form-control col-4" id="end_date_time"/>

                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" name="submit" value="1" class="btn btn-primary">Add</button>
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
<script src="<?= assets('plugins/jquery/jquery.min.js') ?>"></script>
<!-- Bootstrap 4 -->
<script src="<?= assets('plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
<script src="<?= assets('plugins/sweetalert2/sweetalert2.all.js') ?>"></script>
<!-- AdminLTE App -->
<script src="<?= assets('js/adminlte.min.js') ?>"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.7.2/axios.min.js"
        integrity="sha512-JSCFHhKDilTRRXe9ak/FJ28dcpOJxzQaCd3Xg8MyF6XFjODhy/YMCM8HW0TFDckNHWUewW+kfvhin43hKtJxAw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>

    const todo = document.getElementById("todo")

    todo.addEventListener('submit', (e) => {

        let title = document.getElementById('title').value;
        let description = document.getElementById('description').value;
        let category_id = document.getElementById('category_id').value;
        let color = document.getElementById('color').value;
        let start_date = document.getElementById('start_date').value;
        let end_date = document.getElementById('end_date').value;
        let start_date_time = document.getElementById('start_date_time').value;
        let end_date_time = document.getElementById('end_date_time').value;
        let status = document.getElementById('status').value;
        let progress = document.getElementById('progress').value;

        let formatDate = new FormData();

        formatDate.append('title', title)
        formatDate.append('description', description)
        formatDate.append('category_id', category_id)
        formatDate.append('color', color)
        formatDate.append('start_date', start_date)
        formatDate.append('end_date', end_date)
        formatDate.append('start_date_time', start_date_time)
        formatDate.append('end_date_time', end_date_time)
        formatDate.append('status', status);
        formatDate.append('progress', progress);

        axios.post('<?=url('api/addtodo') ?>', formatDate).then(res => {

            if (res.data.redirect) {
                window.location.href = res.data.redirect;
            } else {
                Swal.fire({
                    title: res.data.title,
                    text: res.data.msg,
                    icon: res.data.status
                })
            }


            console.log(res)
        }).catch(err => console.log(err))

        e.preventDefault();
    })

</script>

</body>
</html>

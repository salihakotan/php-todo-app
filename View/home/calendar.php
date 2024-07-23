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
    <div class="content-wrapper p-2">

        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div id="calendar">

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
<script src="<?= assets('plugins/fullcalendar/main.js')?>"></script>
<script src="<?= assets('plugins/fullcalendar/locales-all.js')?>"></script>
<!-- AdminLTE App -->
<script src="<?= assets('js/adminlte.min.js')?>"></script>

<script>

    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            locale: '<?=default_lang()?>',
            events: '<?= url('api/calendar/')?>'
        });
        calendar.render();
    });

</script>
</body>
</html>

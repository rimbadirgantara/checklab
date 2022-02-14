<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= $baner; ?> | <?= $title; ?></title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?= base_url(); ?>/assets/plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?= base_url(); ?>/assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url(); ?>/assets/dist/css/adminlte.min.css">
  <link rel="shortcut icon" type="image/png" href="<?= base_url(); ?>/assets/dist/img/polbeng_.png"/>

  <!-- mycss -->
  <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/css/style.css">
</head>
<body class="hold-transition light-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <!-- <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__wobble" src="<?= base_url(); ?>/assets/dist/img/polbeng_.png" alt="polbeng" height="60" width="60">
  </div> -->

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto">

    </ul>
  </nav>

  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="<?= base_url(); ?>/assets/dist/img/polbeng_.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light"><?= $baner; ?></span>
    </a>

    <div class="sidebar">
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?= base_url(); ?>/assets/dist/img/<?= $data_profile['foto']; ?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <?php if (session()->get('level') === 'komting'): ?>
            <a href="<?= base_url('/profiles/') . '/' . session()->get('username') . '/komting'; ?>" class="d-block"><?= session()->get('username'); ?></a>
          <?php elseif (session()->get('level') === 'laboran'): ?>
            <a href="<?= base_url('/profiles/') . '/' . session()->get('username') . '/laboran'; ?>" class="d-block"><?= session()->get('username'); ?></a> 
          <?php elseif (session()->get('level') === 'dosen'): ?>
            <a href="<?= base_url('/profiles/') . '/' . session()->get('username') . '/dosen'; ?>" class="d-block"><?= session()->get('username'); ?></a> 
          <?php endif; ?>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item menu-open">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>

            <!-- komting -->
            <?php if (session()->get('level') === 'komting'): ?>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <?php if ($menuSegment === 'ko'): ?>
                  <a href="<?= base_url('/ko') ?>" class="nav-link active">
                <?php else: ?>
                  <a href="<?= base_url('/ko') ?>" class="nav-link">
                <?php endif; ?>
                  <i class="fas fa-house-user"></i>
                  <p>Rumah</p>
                </a>
              </li>
            </ul>


            <ul class="nav nav-treeview">
              <li class="nav-item">
                <?php if ($menuSegment === 're'): ?>
                  <a href="<?= base_url('/re') ?>" class="nav-link active">
                <?php else: ?>
                  <a href="<?= base_url('/re') ?>" class="nav-link">
                <?php endif; ?>
                  <i class="fas fa-laptop-code"></i>
                  <p>Reservasi</p>
                </a>
              </li>
            </ul>
            <!-- END komting -->

            <!-- DOSEN -->
            <?php elseif (session()->get('level') === 'dosen'): ?>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <?php if ($menuSegment === 'do'): ?>
                  <a href="<?= base_url('/do') ?>" class="nav-link active">
                <?php else: ?>
                  <a href="<?= base_url('/do') ?>" class="nav-link">
                <?php endif; ?>
                  <i class="fas fa-house-user"></i>
                  <p>Rumah</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <?php if ($menuSegment === 're'): ?>
                  <a href="<?= base_url('/re/do') ?>" class="nav-link active">
                <?php else: ?>
                  <a href="<?= base_url('/re/do') ?>" class="nav-link">
                <?php endif; ?>
                  <i class="fas fa-laptop-code"></i>
                  <p>Reservasi</p>
                </a>
              </li>
            </ul>

            <ul class="nav nav-treeview">
              <li class="nav-item">
                <?php if ($menuSegment === 'komt'): ?>
                  <a href="<?= base_url('/komt') ?>" class="nav-link active">
                <?php else: ?>
                  <a href="<?= base_url('/komt') ?>" class="nav-link">
                <?php endif; ?>
                  <i class="fas fa-user-graduate"></i>
                  <p>Komting</p>
                </a>
              </li>
            </ul>
            <!-- END DOSEN -->

            <!-- Laboran -->
            <?php elseif (session()->get('level') === 'laboran'): ?>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <?php if ($menuSegment === 'lab'): ?>
                  <a href="<?= base_url('/lab') ?>" class="nav-link active">
                <?php else: ?>
                  <a href="<?= base_url('/lab') ?>" class="nav-link">
                <?php endif; ?>
                  <i class="fas fa-house-user"></i>
                  <p>Rumah</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <?php if ($menuSegment === 'labre'): ?>
                  <a href="<?= base_url('/labre') ?>" class="nav-link active">
                <?php else: ?>
                  <a href="<?= base_url('/labre') ?>" class="nav-link">
                <?php endif; ?>
                  <i class="fas fa-laptop-code"></i>
                  <p>Reservasi</p>
                </a>
              </li>
            </ul>

            <ul class="nav nav-treeview">
              <li class="nav-item">
                <?php if ($menuSegment === 'kom'): ?>
                  <a href="<?= base_url('/kom'); ?>" class="nav-link active">
                <?php else: ?>
                  <a href="<?= base_url('/kom'); ?>" class="nav-link">
                <?php endif; ?>
                  <i class="fas fa-user-graduate"></i>
                  <p>Komting</p>
                </a>
              </li>
            </ul>

            <ul class="nav nav-treeview">
              <li class="nav-item">
                <?php if($menuSegment === 'komd'): ?>
                  <a href="<?= base_url('/komd'); ?>" class="nav-link active">
                <?php else: ?>
                  <a href="<?= base_url('/komd'); ?>" class="nav-link">
                <?php endif; ?>
                  <i class="fas fa-chalkboard-teacher"></i>
                  <p>Dosen</p>
                </a>
              </li>
            </ul>
            <!-- END Laboran -->

            <li></li>
            </ul>
            <?php endif; ?>
            <li class="nav-header"><a href="/lgt">Logout</a></li>
          </li>
        </ul>
      </nav>
    </div>
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><?= $title; ?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#"><?= $name_page; ?></a></li>
              <li class="breadcrumb-item active"><?= $sub_name; ?></li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <?= $this->renderSection('all_content'); ?>        
      </div>
    </section>
  </div>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
  </aside>

  <!-- Main Footer -->
  <footer class="main-footer">
    <strong>Copyright &copy; <?= date('Y'); ?> <a href="<?= base_url(); ?>"><?= base_url(); ?></a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      
    </div>
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="<?= base_url(); ?>/assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="<?= base_url(); ?>/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<script src="<?= base_url(); ?>/assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>

<script src="<?= base_url(); ?>/assets/dist/js/adminlte.js"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="<?= base_url(); ?>/assets/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="<?= base_url(); ?>/assets/plugins/raphael/raphael.min.js"></script>
<script src="<?= base_url(); ?>/assets/plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="<?= base_url(); ?>/assets/plugins/jquery-mapael/maps/usa_states.min.js"></script>
<!-- ChartJS -->
<!-- <script src="<?= base_url(); ?>/assets/plugins/chart.js/Chart.min.js"></script> -->

<!-- AdminLTE for demo purposes -->
<!-- <script src="<?= base_url(); ?>/assets/dist/js/demo.js"></script> -->
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!-- <script src="<?= base_url(); ?>/assets/dist/js/pages/dashboard2.js"></script> -->

<!-- Sweet alert -->
<script src="<?= base_url(); ?>/assets/dist/latihan/dist/sweetalert2.all.min.js"></script>
<!-- my js -->
<script src="<?= base_url(); ?>/assets/dist/latihan/dist/myscript.js"></script>
</body>
</html>
 
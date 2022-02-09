<?= $this->extend('login/template'); ?>

<?= $this->section('konten_login'); ?>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <img src="/assets/dist/img/polbeng.png" alt="Polbeng" class="img" width="120" height="120">
    <a href="index"><b>Polbeng</b><small><?= $title; ?></small></a>
  </div>
  <div class="card">
    <div class="card-body login-card-body"> 
      <p class="login-box-msg">Masuk untuk Memulai Sesi Anda</p>

      <form action="<?= base_url(); ?>/login/cek" method="post">
        <?= csrf_field(); ?>
        <div class="login-dulu" data-flashdata="<?= session()->getFlashdata('login_dulu'); ?>"></div>

        <div class="input-group mb-3"> 

            <input type="text" name="username" class="form-control <?= ($validation->hasError('username')) ? 'is-invalid' : '' ?>" value="<?= old('username') ?>" placeholder="Username" autofocus="" autocomplete="off">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span> 
            </div>
          </div>
          <div class="invalid-feedback">
            <?= $validation->getError('username'); ?>
          </div>
        </div>


        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : '' ?>" value="<?= old('password') ?>" placeholder="Password" autocomplete="off">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div> 
          </div>
          <div class="invalid-feedback">
            <?= $validation->getError('password'); ?>
          </div>
        </div>

        <div class="row">
          <div class="col-sm">
          <!-- select -->
            <div class="form-group">
              <select class="form-control" name="level">
                <option>Komting</option>
                <option>Dosen</option>
                <option>Laboran</option>
              </select>
            </div>
          <div>

          <center>
            <div class="col">
              <button class="btn btn-info btn-block">Login</button>
            </div>
          </center>
        </div>
      </form>
    </div>
<?= $this->endSection(); ?>
  </div>
</div>
  
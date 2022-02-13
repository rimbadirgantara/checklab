<?= $this->extend('all_layout/templates'); ?>

<?= $this->section('all_content'); ?>
        <section class="content">
          <div class="container-fluid">
            <div class="row">

              <div class="col-md-8">
                  <div class="card card-primary">
                    <div class="card-header">
                      <h3 class="card-title"></h3>
                    </div>
                    <!-- /.card-header -->
                    <form class="form-horizontal" method="post" action="<?= base_url('/komd/senddatadosen'); ?>">
                      <div class="card-body">
                        <div class="form-group row">
                          <?= csrf_field(); ?>
                          <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control <?= ($valid->hasError('nama')) ? 'is-invalid' : ''; ?>" name="nama" id="nama" value="<?= (old('nama')) ? old('nama') : ''; ?>">
                            <div class="invalid-feedback">
                              <?= $valid->getError('nama'); ?>
                            </div>
                          </div>
                        </div>
                        <div class="form-group row">
                          <?= csrf_field(); ?>
                          <label for="username" class="col-sm-2 col-form-label">Username</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control <?= ($valid->hasError('username')) ? 'is-invalid' : ''; ?>" name="username" id="username" value="<?= (old('username')) ? old('username') : ''; ?>">
                            <div class="invalid-feedback">
                              <?= $valid->getError('username'); ?>
                            </div>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="email" class="col-sm-2 col-form-label">Email</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control <?= ($valid->hasError('email')) ? 'is-invalid' : ''; ?>" name="email" id="email" value="<?= (old('email')) ? old('email') : ''; ?>">
                            <div class="invalid-feedback">
                              <?= $valid->getError('email'); ?>
                            </div>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="nip" class="col-sm-2 col-form-label">NIP</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control <?= ($valid->hasError('nip')) ? 'is-invalid' : ''; ?>" name="nip" id="nip" value="<?= (old('nip')) ? old('nip') : ''; ?>">
                            <div class="invalid-feedback">
                              <?= $valid->getError('nip'); ?>
                            </div>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="password" class="col-sm-2 col-form-label">Password</label>
                          <div class="col-sm-10">
                            <input type="password" class="form-control <?= ($valid->hasError('password')) ? 'is-invalid' : ''; ?>" name="password" id="password" value="<?= (old('password')) ? old('password') : ''; ?>">
                            <div class="invalid-feedback">
                              <?= $valid->getError('password'); ?>
                            </div>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="realpassword" class="col-sm-2 col-form-label">Ulangi Password</label>
                          <div class="col-sm-10">
                            <input type="password" class="form-control <?= ($valid->hasError('realpassword')) ? 'is-invalid' : ''; ?>" name="realpassword" id="realpassword" value="<?= (old('realpassword')) ? old('realpassword') : ''; ?>">
                            <div class="invalid-feedback">
                              <?= $valid->getError('realpassword'); ?>
                            </div>
                          </div>
                        </div>

                        <div class="form-group row">
                          <label for="status" class="col-sm-2 col-form-label">Status</label>
                          <div class="col-sm-10">
                            <select class="form-control" name="status">
                              <option>Aktif</option>
                              <option>Non Aktif</option>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                      </div>
                    </form>
                  </div>
                </div>

            </div>
          </div>          
        </section>
<?= $this->endSection(); ?>
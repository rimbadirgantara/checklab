<?= $this->extend('all_layout/templates'); ?>

<?= $this->section('all_content'); ?>
        <section class="content">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-4">
                <div class="berhasileditprofile" data-flashdata="<?= session()->getFlashdata('berhasileditprofile'); ?>"></div>
                <div class="metainance" data-flashdata="<?= session()->getFlashdata('metainance'); ?>"></div>
                <!-- Profile Image -->
                <div class="card card-primary card-outline">
                  <div class="card-body box-profile">
                    <div class="text-center">
                      <img class="profile-user-img img-fluid img-circle" src="<?= base_url(); ?>/assets/dist/img/<?= $data_profile['foto']; ?>" alt="User profile picture"></div>

                    <h3 class="profile-username text-center"><?= $data_profile['nama']; ?></h3>

                    <p class="text-muted text-center"><?= $data_profile['level']; ?></p>

                    <ul class="list-group list-group-unbordered mb-3">
                      <li class="list-group-item">
                        <b>Username</b> <a class="float-right"><?= $data_profile['username']; ?></a>
                      </li>
                      <li class="list-group-item">
                        <b>Email</b> <a class="float-right"><?= $data_profile['email']; ?></a>
                      </li>
                      <li class="list-group-item">
                        <b>NIP</b> <a class="float-right"><?= $data_profile['nip']; ?></a>
                      </li>
                      <li class="list-group-item">
                        <b>Status</b> <a class="float-right btn <?= ($data_profile['status'] === 'aktif') ? 'btn-success btn-sm' : 'btn-danger btn-sm'; ?>"><?= $data_profile['status']; ?></a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div> 

              <div class="col-md-8">
                  <div class="card card-primary">
                    <div class="card-header">
                      <h3 class="card-title">Edit</h3>
                    </div>
                    <!-- /.card-header -->
                    <form class="form-horizontal" method="post" action="<?= base_url(); ?>/edit_profile_dosen/<?= $data_profile['username']; ?>">
                      <div class="card-body">
                        <div class="form-group row">
                          <?= csrf_field(); ?>
                          <label for="username" class="col-sm-2 col-form-label">Username</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control <?= ($valid->hasError('username')) ? 'is-invalid' : ''; ?>" name="username" id="username" value="<?= (old('username')) ? old('username') : $data_profile['username']; ?>">
                            <div class="invalid-feedback">
                              <?= $valid->getError('username'); ?>
                            </div>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="email" class="col-sm-2 col-form-label">Email</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control <?= ($valid->hasError('email')) ? 'is-invalid' : ''; ?>" name="email" id="email" value="<?= (old('email')) ? old('email') : $data_profile['email']; ?>">
                            <div class="invalid-feedback">
                              <?= $valid->getError('email'); ?>
                            </div>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="nip" class="col-sm-2 col-form-label">NIP</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control <?= ($valid->hasError('nip')) ? 'is-invalid' : ''; ?>" name="nip" id="nip" value="<?= (old('nip')) ? old('nip') : $data_profile['nip']; ?>">
                            <div class="invalid-feedback">
                              <?= $valid->getError('nip'); ?>
                            </div>
                          </div>
                        </div>
                        
                        <div class="form-group row">
                          <label for="passwordbaru" class="col-sm-2 col-form-label">Password Baru</label>
                          <div class="col-sm-10">
                            <input type="password" class="form-control <?= ($valid->hasError('passwordbaru')) ? 'is-invalid' : ''; ?>" name="passwordbaru" id="passwordbaru" value="<?= (old('passwordbaru')) ? old('passwordbaru') : ''; ?>">
                            <div class="invalid-feedback">
                              <?= $valid->getError('passwordbaru'); ?>
                            </div>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="ulangipassword" class="col-sm-2 col-form-label">Ulangi Password</label>
                          <div class="col-sm-10">
                            <input type="password" class="form-control <?= ($valid->hasError('ulangipassword')) ? 'is-invalid' : ''; ?>" name="ulangipassword" id="ulangipassword">
                            <div class="invalid-feedback">
                              <?= $valid->getError('ulangipassword'); ?>
                            </div>
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
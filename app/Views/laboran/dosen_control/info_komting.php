<?= $this->extend('all_layout/templates'); ?>

<?= $this->section('all_content'); ?>
        <section class="content">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-4">
                <div class="berhasileditprofile" data-flashdata="<?= session()->getFlashdata('berhasileditprofile'); ?>"></div>
                <!-- Profile Image -->
                <div class="card card-primary card-outline">
                  <div class="card-body box-profile">
                    <div class="text-center">
                      <img class="profile-user-img img-fluid img-circle" src="<?= base_url(); ?>/assets/dist/img/<?= $data_dosen['foto']; ?>" alt="User profile picture"></div>

                    <h3 class="profile-username text-center"><?= $data_dosen['nama']; ?></h3>

                    <p class="text-muted text-center"><?= $data_dosen['level']; ?></p>

                    <ul class="list-group list-group-unbordered mb-3">
                      <li class="list-group-item">
                        <b>Username</b> <a class="float-right"><?= $data_dosen['username']; ?></a>
                      </li>
                      <li class="list-group-item">
                        <b>Email</b> <a class="float-right"><?= $data_dosen['email']; ?></a>
                      </li>
                      <li class="list-group-item">
                        <b>NIP</b> <a class="float-right"><?= $data_dosen['nip']; ?></a>
                      </li>
                      <li class="list-group-item">
                        <b>Status</b> <a class="float-right btn <?= ($data_dosen['status'] === 'aktif') ? 'btn-success btn-sm' : 'btn-danger btn-sm'; ?>"><?= $data_dosen['status']; ?></a>
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
                    <form class="form-horizontal" method="post" action="<?= base_url('/komd/' . $data_dosen['username'] . '/update_dosen/' . $data_dosen['id']); ?>">
                      <div class="card-body">
                        <div class="form-group row">
                          <?= csrf_field(); ?>
                          <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control <?= ($valid->hasError('nama')) ? 'is-invalid' : ''; ?>" name="nama" id="nama" value="<?= (old('nama')) ? old('nama') : $data_dosen['nama']; ?>">
                            <div class="invalid-feedback">
                              <?= $valid->getError('nama'); ?>
                            </div>
                          </div>
                        </div>
                        <div class="form-group row">
                          <?= csrf_field(); ?>
                          <label for="username" class="col-sm-2 col-form-label">Username</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control <?= ($valid->hasError('username')) ? 'is-invalid' : ''; ?>" name="username" id="username" value="<?= (old('username')) ? old('username') : $data_dosen['username']; ?>">
                            <div class="invalid-feedback">
                              <?= $valid->getError('username'); ?>
                            </div>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="email" class="col-sm-2 col-form-label">Email</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control <?= ($valid->hasError('email')) ? 'is-invalid' : ''; ?>" name="email" id="email" value="<?= (old('email')) ? old('email') : $data_dosen['email']; ?>">
                            <div class="invalid-feedback">
                              <?= $valid->getError('email'); ?>
                            </div>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="nip" class="col-sm-2 col-form-label">NIP</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control <?= ($valid->hasError('nip')) ? 'is-invalid' : ''; ?>" name="nip" id="nip" value="<?= (old('nip')) ? old('nip') : $data_dosen['nip']; ?>">
                            <div class="invalid-feedback">
                              <?= $valid->getError('nip'); ?>
                            </div>
                          </div>
                        </div>

                        <div class="form-group row">
                          <label for="status" class="col-sm-2 col-form-label">Status</label>
                          <div class="col-sm-10">
                            <select class="form-control" name="status">
                              <?= 
                              ($data_dosen['status'] === 'aktif') ? 
                              "
                              <option>Aktif</option>
                              <option>Non Aktif</option>
                              " :
                              "
                              <option>Non Aktif</option>
                              <option>Aktif</option>
                              ";

                              ?>
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
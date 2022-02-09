<?= $this->extend('all_layout/templates'); ?>

<?= $this->section('all_content'); ?>
      <div class="container">
        <div class="row">
		      <div class="col">
            <div class="format-waktu" data-flashdata="<?= session()->getFlashdata('format-waktu-tidak-valid'); ?>"></div>
		        <div class="invoice p-3 mb-3">
              <div class="row">
                <div class="col-sm">
                  <h4>
                    <i class="fas fa-globe"></i> <?= $data_lab['nama_lab']; ?>
                  </h4>
                </div>
              </div>

              <form action="<?= base_url(); ?>/lab/abcd/<?= $data_lab['slug']; ?>/efgh" method="post">
                <?= csrf_field(); ?>
                <div class="row invoice-info">
                  <div class="col-sm invoice-col mt-1"> 
                  	<label>Nama</label>
                    	<input class="form-control <?= ($valid->hasError('nama')) ? 'is-invalid' : '' ?>" value="<?= session()->get('nama'); ?>" name="nama">
                      <div class="invalid-feedback">
                        <?= $valid->getError('nama'); ?>
                      </div>
                  </div>
                  <div class="col-sm invoice-col">
                    <label>Waktu Masuk</label>
                   	  <input class="form-control  <?= ($valid->hasError('waktuM')) ? 'is-invalid' : '' ?>" value="<?= (old('waktuM')) ? old('waktuM') : date('d-m-Y') .' 00:00'; ?>" name="waktuM">
                      <div class="invalid-feedback">
                        <?= $valid->getError('waktuM'); ?>
                      </div>
                  </div>
                  <div class="col-sm invoice-col">
                    <label>Waktu Keluar</label>
                      <input class="form-control  <?= ($valid->hasError('waktuK')) ? 'is-invalid' : '' ?>" value="<?= (old('waktuK')) ? old('waktuK') : date('d-m-Y') .' 00:00'; ?>" name="waktuK">
                      <div class="invalid-feedback">
                        <?= $valid->getError('waktuK'); ?>
                      </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col invoice-col">
                    <button class="btn btn-danger mt-2 mb-2">Booking</button>
                  </div>
                </div>
              </form>
		        </div>
          </div>
        </div>
      </div>
<?= $this->endSection(); ?>	
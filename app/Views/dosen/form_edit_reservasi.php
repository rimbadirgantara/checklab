<?php $this->extend('all_layout/templates'); ?>

<?php $this->section('all_content'); ?>
				<div class="card card-info">
          <div class="card-header">
            <div class="format-waktu" data-flashdata="<?= session()->getFlashdata('format-waktu-tidak-valid'); ?>"></div>
            <div class="update-data-reservasi" data-flashdata="<?= session()->getFlashdata('update-reservasi-data'); ?>"></div>
            <h3 class="card-title"></h3>
          </div>

            <div class="card-body">
            	<div class="row">
            		<div class="col-6">
            			<?= csrf_field(); ?>
		              <div class="form-group">
		                <label>Nama</label>
		                <input type="text" class="form-control" name="nama" value="<?= $data_reservasi['nama']; ?>" disabled>
		              </div>
            		</div>
            		<div class="col-6">
		              <div class="form-group">
		              	<label>Check in</label>
		                <input type="text" class="form-control" name="checkin" value="<?= date('d-m-Y H:i', $data_reservasi['check_in']); ?>" disabled>
		              </div>
            		</div>
            	</div>
            	<div class="row">
            		<div class="col-6">
		              <div class="form-group">
		                <label>Check out</label>
		                <input type="text" class="form-control" name="checkout" value="<?= date('d-m-Y H:i', $data_reservasi['check_out']); ?>" disabled>
		              </div>
            		</div>
            		<div class="col-6">
		              <div class="form-group">
		              	<label for="exampleInputPassword1">Status</label>
		                <div class="form-group">
				              <select class="form-control" name="status" disabled>
				                <?php if ($data_reservasi['status'] === 'Belum diterima'): ?>
				               		<option>Belum diterima</option>
				               		<option>Terima</option>
				               	<?php else: ?>
				               		<option>Terima</option>
				               		<option>Belum diterima</option>
				               	<?php endif; ?>
				              </select>
				            </div>
		              </div>
            		</div>
            		<div class="col">
                  <div class="form-group">
                    <label>Keterangan</label>
                    <textarea class="form-control" placeholder="Enter ..." name="ket" disabled><?= $data_reservasi['ket']; ?></textarea>
                  </div>
	            		<form action="<?= base_url('/re/do/'.$data_reservasi['id']); ?>" method="post">
	                  <?= csrf_field(); ?>
	                  <input type="hidden" name="_method" value="DELETE">
	                  <button type="submit" class="btn btn-danger btn-sm" title="Hapus"><i class="fas fa-trash"></i></button>
	                </form>
            		</div>
            	</div>
            </div>
        </div>
<?php $this->endSection() ?>
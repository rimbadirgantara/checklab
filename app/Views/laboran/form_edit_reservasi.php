<?php $this->extend('all_layout/templates'); ?>

<?php $this->section('all_content'); ?>
				<div class="card card-info">
          <div class="card-header">
            <div class="format-waktu" data-flashdata="<?= session()->getFlashdata('format-waktu-tidak-valid'); ?>"></div>
            <div class="update-data-reservasi" data-flashdata="<?= session()->getFlashdata('update-reservasi-data'); ?>"></div>
            <h3 class="card-title"></h3>
          </div>

          <form action="<?= base_url('/lab/'.$slug_lab.'/'.$data_reservasi['id'].'/edit_reservasi/'); ?>" method="post">
            <div class="card-body">
            	<div class="row">
            		<div class="col-6">
            			<?= csrf_field(); ?>
		              <div class="form-group"> 
		                <label>Nama</label>
		                <input type="text" class="form-control" name="nama" value="<?= $data_reservasi['nama']; ?>">
		              </div>
            		</div>
            		<div class="col-6">
		              <div class="form-group">
		              	<label>Check in</label>
		                <input type="text" class="form-control" name="checkin" value="<?= date('d-m-Y H:i', $data_reservasi['check_in']); ?>">
		              </div>
            		</div>
            	</div>
            	<div class="row">
            		<div class="col-6">
		              <div class="form-group">
		                <label>Check out</label>
		                <input type="text" class="form-control" name="checkout" value="<?= date('d-m-Y H:i', $data_reservasi['check_out']); ?>">
		              </div>
            		</div>
            		<div class="col-6">
		              <div class="form-group">
		              	<label for="exampleInputPassword1">Status</label>
		                <div class="form-group">
				              <select class="form-control" name="status">
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
                    <textarea class="form-control" placeholder="Enter ..." name="ket"><?= $data_reservasi['ket']; ?></textarea>
                  </div>
            		</div>
            	</div>
            </div>
            <div class="card-footer">
              <button class="btn btn-primary">Update</button>
            </div>
          </form>

        </div>
<?php $this->endSection() ?>
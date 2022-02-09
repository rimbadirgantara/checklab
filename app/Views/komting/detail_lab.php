<?= $this->extend('all_layout/templates'); ?>

<?= $this->section('all_content'); ?>
<div class="container">
	<div class="row">
		<div class="col">
      <div class="berhasilSimpanDataReservasi" data-flashdata="<?= session()->getFlashdata('berhasilSimpanDataReservasi'); ?>"></div>
		  <div class="invoice p-3 mb-3">
        <div class="row">
          <div class="col-12">
            <h4>
              <i class="fas fa-globe"></i> <?= $data_lab['nama_lab']; ?>
            </h4>
          </div>
        </div>
 
        <div class="row invoice-info">
          <div class="col-sm-4 invoice-col">
            <img src="/assets/gambar_ruangan/<?= $data_lab['foto']; ?>" alt="<?= $data_lab['nama_lab']; ?>" width="300">
          </div>

            <div class="col-sm-4 invoice-col mt-1">
            	<label>Ruangan</label>
              	<input class="form-control" value="<?= $data_lab['nama_lab']; ?>" disabled><br>
             	<label>Lokasi</label>
               	<input class="form-control" value="<?= $data_lab['nama_gedung']; ?>" disabled><br>
            </div>

            <div class="col-sm-4 invoice-col">
              <label>Total Booking</label>
                <input class="form-control" value="<?= $data_lab['total_booking']; ?> Booking" disabled><br>
                	
              <label>Fasilitas</label>
                <textarea class="form-control" disabled=""><?= $data_lab['fasilitas']; ?></textarea>
               	<a href="/ko/lab/<?= $data_lab['slug']; ?>/form" class="btn btn-danger mt-2 mb-2">Booking</a><br>
            </div>

            <div class="col table-responsive">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Check In</th>
                    <th>Check out</th>
                    <th>Stat</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i = 1; 
                  foreach($data_reservasi_lab as $a): ?>
                    <tr>
                      <td><?= $i++; ?></td>
                      <td><?= $a['nama']; ?><br><small><?= date('H:i | d-m-Y ', $a['waktu_dibuat']); ?></small></td>
                      <td><?= date('H:i | d-m-Y ', $a['check_in']); ?></td>
                      <td><?= date('H:i | d-m-Y ', $a['check_out']); ?></td>
                      <?php if ($a['status'] === 'Belum diterima'): ?>
                        <td><span class="badge badge-warning"><?= $a['status']; ?></td>
                      <?php elseif ($a['status'] === 'Terima'): ?>
                        <td><span class="badge badge-success"><?= $a['status']; ?></td>
                      <?php endif; ?>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div> <!-- -->
        </div>
		  </div>
	  </div>
  </div>
</div>
<?= $this->endSection(); ?>
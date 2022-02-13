<?= $this->extend('all_layout/templates'); ?>

<?= $this->section('all_content'); ?>
<div class="hapusreservasi" data-flashdata="<?= session()->getFlashdata('hapus_reservasi'); ?>"></div>
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col">
            
          </div>
        </div>
        <div class="row">
          <div class="col">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Daftar Reservasi Ruangan</h3>
              </div>
              <div class="card-body table-responsive">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th class="text-center" width="50">No</th>
                      <th class="text-center">Lab</th>
                      <th class="text-center">Gedung</th>
                      <th class="text-center">Check In / Check Out</th>
                      <th class="text-center">Status</th>
                      <th class="text-center" width="60">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i = 1; 
                    foreach ($data_reservasi as $a): ?>
                      <tr class="text-center">
                        <td>
                          <?= $i; ?>
                        </td>
                        <td><?= $a['lab__']; ?><br><small class="badge badge-info"><?= date('H:i [ d-m-Y ]', $a['waktu_dibuat']); ?></small></td>
                        <td><?= $a['gedung__']; ?></td>
                        <td><?= date('H:i | d-m-Y ', $a['check_in']); ?> / <?= date('H:i | d-m-Y ', $a['check_out']); ?></td>
                        <td>
                          <?php if ($a['status'] === 'Belum diterima'): ?>
                            <span class="badge badge-warning"><?= $a['status']; ?></span> 
                          <?php elseif ($a['status'] === 'Terima'): ?>
                            <span class="badge badge-success"><?= $a['status']; ?></span> 
                          <?php endif; ?>
                        </td>
                        <td>
                          <a href="<?= base_url('/re/do/'.$a['id'].'/detail/reservasi'); ?>" title="Info" class="btn btn-info btn-sm"><i class="fas fa-info-circle"></i></a>

                          <form action="<?= base_url('/re/do/'.$a['id']); ?>" method="post">
                            <?= csrf_field(); ?>
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="btn btn-danger btn-sm" title="Hapus"><i class="fas fa-trash"></i></button>
                          </form>
                        </td>
                      </tr>
                    <?php $i++; ?>
                    <?php endforeach; ?>
                  </tbody>
                  <tfoot>
                    <tr>
                      <th class="text-center" width="50">No</th>
                      <th class="text-center">Ruangan</th>
                      <th class="text-center">Gedung</th>
                      <th class="text-center">Check In / Check Out</th>
                      <th class="text-center">Status</th>
                      <th class="text-center" width="60">Aksi</th> 
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?= $this->endSection(); ?>
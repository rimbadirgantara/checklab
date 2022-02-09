<?= $this->extend('/all_layout/templates'); ?>

<?= $this->section('all_content'); ?>
      <div class="row"> 
        <div class="col">
          <!-- <form action="">
            <div class="input-group mb-3">
              <input type="search" name="#" class="form-control form-control" placeholder="Ketik keyword anda disini">
              <?= csrf_field(); ?>
              <div class="input-group-append">
                <button type="submit" class="btn btn-default">
                  <i class="fa fa-search"></i>
                </button>
                <a class="btn btn-warning" href="#"><i class="fas fa-sync-alt"></i></a> 
              </div>
            </div>
          </form> -->
        </div>
      </div>
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Lab</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div>
        <div class="card-body">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th class="text-center" width="50">No</th>
                <th class="text-center">Lab</th>
                <th class="text-center">Total Booking</th>
                <th class="text-center" width="60">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php $i = 1;
              foreach ($data_lab as $dg): ?>
                <tr>
                  <td>
                    <center><?= $i++; ?></center>
                  </td>
                  <td><?= $dg['nama_lab']; ?></td>
                  <td><?= $dg['total_booking']; ?> Booking</td>
                  <td>
                    <a href="/lab/<?= $dg['slug']; ?>/detail/labor" class="btn btn-info btn-sm"><i class="fas fa-info-circle"></i></a>
                  </td>
                </tr>
              <?php endforeach; ?>

            </tbody>
            <tfoot>
              <tr>
                <th class="text-center" width="50">No</th>
                <th class="text-center">Gedung</th>
                <th class="text-center">Total Ruangan</th>
                <th class="text-center" width="60">Aksi</th>
              </tr>
            </tfoot>
          </table>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          Footer
        </div>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->
<?= $this->endSection(); ?>
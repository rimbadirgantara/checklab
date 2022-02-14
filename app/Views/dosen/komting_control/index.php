<?= $this->extend('all_layout/templates'); ?>

<?= $this->section('all_content'); ?>
				<!-- Main content -->
		    <section class="content">

		      <!-- Default box -->
		      <div class="card card-solid">
		      	<div class="hapus_komting" data-flashdata="<?= session()->getFlashdata('hapuskomting'); ?>"></div>
		      	<div class="berhasiltambahkomting" data-flashdata="<?= session()->getFlashdata('berhasiltambahkomting'); ?>"></div>
		        <div class="card-body pb-0">
		          <a href="<?= base_url('/komt/tmbhkomting'); ?>" class="btn btn-success btn-sm mb-3">Tambah User <i class="fas fa-users"></i></a>
		          <div class="row">
		          	<?php foreach($data_komting as $a): ?>
			            <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
			              <div class="card bg-light d-flex flex-fill">
			                <div class="card-header text-muted border-bottom-0">
			                	<?php if ($a['status'] === 'aktif'){ ?>
			                  	<small class="badge badge-success">Akun Aktif</small>
			                  <?php } elseif ($a['status'] === 'nonaktif'){ ?>
			                  	<small class="badge badge-danger">Akun Tidak Aktiff</small>
			                  <?php } ?>
			                </div>
			                <div class="card-body pt-0">
			                  <div class="row">
			                    <div class="col-7">
			                      <h2 class="lead"><b><?= $a['nama']; ?></b></h2>
			                      <p class="text-muted text-sm"><b>NIM </b> <br><?= $a['nim']; ?></p>
			                      <p class="text-muted text-sm"><b>Prodi </b><br><?= $a['prodi']; ?></p>
			                    </div>
			                    <div class="col-5 text-center">
			                      <img src="<?= base_url('/assets/dist/img/' . $a['foto']); ?>" alt="user-avatar" class="img-circle img-fluid">
			                    </div>
			                  </div>
			                </div>
			                <div class="card-footer">
			                  <div class="text-right">
			                    <a href="<?= base_url('/komt/' . $a['username'] . '/info_komting'); ?>" class="btn btn-sm btn-info">
			                      <i class="fas fa-info"></i>
			                    </a>
			                    <form action="<?= base_url('/komt/' . $a['id'] . '/hapus_komting'); ?>" method="post" class="d-inline">
		                        <?= csrf_field(); ?>
		                        <input type="hidden" name="_method" value="DELETE">
		                        <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
		                      </form>
			                    </a>
			                  </div>
			                </div>
			              </div>
			            </div>
		          	<?php endforeach; ?>
		          </div>
		        </div>
		      </div>
		    </section>
<?= $this->endSection(); ?>
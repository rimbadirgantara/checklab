<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <h1>Home</h1>
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Sampul</th>
                  <th scope="col">Judul</th>
                  <th scope="col">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($test as $t): ?>
                <tr>
                  <th scope="row">1</th>
                  <td><img src="/img/<?= $t['sampul']; ?>" alt="<?= $t['sampul']; ?>" class="sampul"></td>
                  <td><?= $t['judul']; ?></td>
                  <td>
                      <a href="" class="btn btn-success">Detail</a>
                  </td>
                </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>
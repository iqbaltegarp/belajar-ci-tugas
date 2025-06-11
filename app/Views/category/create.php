<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>

<div class="pagetitle"><h1><?= $title ?></h1></div>

<form action="/category/store" method="post">
  <div class="mb-3">
    <label>Nama Kategori</label>
    <input type="text" name="category_name" class="form-control" value="<?= old('category_name') ?>">
    <?php if (session('errors.category_name')) : ?>
      <div class="text-danger"><?= session('errors.category_name') ?></div>
    <?php endif ?>
  </div>
  <button class="btn btn-success">Simpan</button>
</form>

<?= $this->endSection() ?>

<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<h1>Edit Kategori</h1>

<form action="<?= base_url('category/update/' . $category['id']) ?>" method="post">
    <div class="form-group mb-3">
        <label for="name">Nama Kategori</label>
        <input type="text" class="form-control" name="name" id="name" value="<?= esc($category['name']) ?>" required>
    </div>

    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    <a href="<?= base_url('category') ?>" class="btn btn-secondary">Batal</a>
</form>

<?= $this->endSection() ?>

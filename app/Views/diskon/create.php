<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">Tambah Diskon</div>
    <div class="card-body">
        <?php if (session('errors')): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php foreach (session('errors') as $error): ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach ?>
                </ul>
            </div>
        <?php endif ?>

        <form action="<?= base_url('diskon/store') ?>" method="post">
            <div class="mb-3">
                <label for="tanggal" class="form-label">Tanggal</label>
                <input type="date" name="tanggal" class="form-control" value="<?= old('tanggal') ?>">
            </div>
            <div class="mb-3">
                <label for="nominal" class="form-label">Nominal Diskon</label>
                <input type="number" name="nominal" class="form-control" value="<?= old('nominal') ?>">
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="<?= base_url('diskon') ?>" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
<?= $this->endSection() ?>
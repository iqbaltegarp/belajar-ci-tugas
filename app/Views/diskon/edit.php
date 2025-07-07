<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<h3>Edit Diskon</h3>

<?php if (session()->getFlashdata('errors')): ?>
    <div class="alert alert-danger">
        <ul>
            <?php foreach (session()->getFlashdata('errors') as $error): ?>
                <li><?= esc($error) ?></li>
            <?php endforeach ?>
        </ul>
    </div>
<?php endif ?>

<form action="<?= base_url('diskon/update/' . $diskon['id']) ?>" method="post">
    <?= csrf_field() ?>
    
    <div class="mb-3">
        <label for="tanggal" class="form-label">Tanggal</label>
        <input type="date" name="tanggal" class="form-control" value="<?= $diskon['tanggal'] ?>" required>
    </div>

    <div class="mb-3">
        <label for="nominal" class="form-label">Nominal Diskon</label>
        <input type="number" name="nominal" class="form-control" value="<?= $diskon['nominal'] ?>" required>
    </div>

    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="<?= base_url('diskon') ?>" class="btn btn-secondary">Kembali</a>
</form>

<?= $this->endSection() ?>

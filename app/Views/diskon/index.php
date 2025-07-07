<?php helper('number'); ?>

<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Data Diskon</h5>
        <a href="<?= base_url('diskon/create') ?>" class="btn btn-primary">+ Tambah</a>
    </div>
    <div class="card-body">
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success"><?= session('success') ?></div>
        <?php endif ?>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Nominal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; foreach ($diskon as $row): ?>
                <tr>
                    <td><?= $i++ ?></td>
                    <td><?= $row['tanggal'] ?></td>
                    <td><?= number_to_currency($row['nominal'], 'IDR') ?></td>
                    <td>
                        <a href="<?= base_url('diskon/edit/' . $row['id']) ?>" class="btn btn-sm btn-warning">Edit</a>
                        <a href="<?= base_url('diskon/delete/' . $row['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus data ini?')">Hapus</a>
                    </td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>
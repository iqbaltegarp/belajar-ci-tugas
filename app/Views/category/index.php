<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<h1>Product Category</h1>

<a href="<?= base_url('category/create') ?>" class="btn btn-primary">Tambah Kategori</a>

<table class="table mt-3">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Kategori</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1; foreach ($categories as $cat): ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= esc($cat['name']) ?></td>
            <td>
                <a href="<?= base_url('category/edit/'.$cat['id']) ?>" class="btn btn-warning btn-sm">Edit</a>
                <a href="<?= base_url('category/delete/'.$cat['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</a>
            </td>
        </tr>
        <?php endforeach ?>
    </tbody>
</table>

<?= $this->endSection() ?>

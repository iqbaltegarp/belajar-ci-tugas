<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="mb-0">Produk kategori</h2>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Produk Kategori</li>
            </ol>
        </nav>
    </div>
</div>

<div class="card shadow-sm rounded-card mb-4">
    <div class="card-body">
        <h3 class="mb-4">Produk kategori</h3>

        <!-- Paginasi dan Search Bar atas tabel -->
        <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">
            <!-- Tombol "Tambah Data" yang memicu modal untuk form tambah -->
            <button type="button" class="btn btn-primary rounded" data-bs-toggle="modal" data-bs-target="#addCategoryModal">Tambah Data</button>
            
            <div class="d-flex align-items-center mt-2 mt-md-0">
                <span class="me-2">Show</span>
                <select class="form-select form-select-sm rounded" style="width: auto;">
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
                <span class="ms-2">entries per page</span>
            </div>

            <div class="ms-auto mt-2 mt-md-0">
                <div class="input-group">
                    <input type="text" class="form-control rounded" placeholder="Search..." aria-label="Search" aria-describedby="button-search">
                    <button class="btn btn-outline-secondary rounded" type="button" id="button-search"><i class="fas fa-search"></i></button>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-hover rounded-table">
                <thead class="bg-light text-dark">
                    <tr>
                        <th scope="col" class="rounded-top-left">#</th>
                        <th scope="col">Nama Kategori</th>
                        <th scope="col" class="rounded-top-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($categories)): ?>
                        <tr>
                            <td colspan="3" class="text-center py-4">Belum ada kategori.</td>
                        </tr>
                    <?php else: ?>
                        <?php $i = 1; ?>
                        <?php foreach ($categories as $category): ?>
                            <tr>
                                <th scope="row"><?= $i++ ?></th>
                                <td><?= esc($category['name']) ?></td>
                                <td>
                                    <!-- Tombol Ubah yang memicu modal edit -->
                                    <button type="button" class="btn btn-success btn-sm rounded me-2" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#editCategoryModal" 
                                            data-bs-id="<?= esc($category['id']) ?>"
                                            data-bs-name="<?= esc($category['name']) ?>">Ubah</button>

                                    <!-- Tombol Hapus yang memicu modal konfirmasi penghapusan -->
                                    <button type="button" class="btn btn-danger btn-sm rounded" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#deleteConfirmModal" 
                                            data-bs-id="<?= esc($category['id']) ?>">Hapus</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Paginasi di bawah tabel (jika ada) -->
        <div class="d-flex justify-content-between align-items-center mt-3">
            <div class="text-muted">Showing 1 to <?= count($categories) ?> of <?= count($categories) ?> entries</div>
            <nav aria-label="Page navigation example">
                <ul class="pagination mb-0">
                    <li class="page-item disabled"><a class="page-link rounded" href="#">Previous</a></li>
                    <li class="page-item active"><a class="page-link rounded" href="#">1</a></li>
                    <li class="page-item disabled"><a class="page-link rounded" href="#">Next</a></li>
                </ul>
            </nav>
        </div>
    </div>
</div>

<!-- Modal Tambah Data (tetap sama seperti sebelumnya) -->
<div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content rounded">
            <div class="modal-header bg-primary text-white rounded-top">
                <h5 class="modal-title" id="addCategoryModalLabel">Tambah Data</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('category/store') ?>" method="post">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="add_name" class="form-label">Nama</label>
                        <input type="text" class="form-control rounded" id="add_name" name="name" required placeholder="Masukkan nama kategori">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary rounded" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary rounded">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Data (tetap sama seperti sebelumnya) -->
<div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content rounded">
            <div class="modal-header bg-warning text-white rounded-top">
                <h5 class="modal-title" id="editCategoryModalLabel">Edit Data</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editCategoryForm" action="" method="post">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <input type="hidden" name="id" id="edit_id">
                    <div class="mb-3">
                        <label for="edit_name" class="form-label">Nama</label>
                        <input type="text" class="form-control rounded" id="edit_name" name="name" required placeholder="Masukkan nama kategori baru">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary rounded" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary rounded">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi Hapus Data (tetap sama seperti sebelumnya) -->
<div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-labelledby="deleteConfirmModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content rounded">
            <div class="modal-header bg-danger text-white rounded-top">
                <h5 class="modal-title" id="deleteConfirmModalLabel">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Yakin hapus data ini?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary rounded" data-bs-dismiss="modal">Cancel</button>
                <a href="#" id="deleteButton" class="btn btn-danger rounded">OK</a>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Logika untuk Modal Edit Data
        var editCategoryModal = document.getElementById('editCategoryModal');
        editCategoryModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;
            var id = button.getAttribute('data-bs-id');
            var name = button.getAttribute('data-bs-name');

            var modalTitle = editCategoryModal.querySelector('.modal-title');
            var form = editCategoryModal.querySelector('#editCategoryForm');
            var inputId = editCategoryModal.querySelector('#edit_id');
            var inputName = editCategoryModal.querySelector('#edit_name');

            modalTitle.textContent = 'Edit Data: ' + name;
            form.action = '<?= base_url('category/update/') ?>' + id;
            inputId.value = id;
            inputName.value = name;
        });

        // Logika untuk Modal Konfirmasi Hapus Data
        var deleteConfirmModal = document.getElementById('deleteConfirmModal');
        deleteConfirmModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;
            var id = button.getAttribute('data-bs-id');
            var deleteButton = deleteConfirmModal.querySelector('#deleteButton');
            deleteButton.href = '<?= base_url('category/delete/') ?>' + id;
        });
    });
</script>
<?= $this->endSection() ?>
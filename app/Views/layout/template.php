<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Aplikasi Toko' ?></title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" xintegrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Font Awesome untuk ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Google Fonts: Inter (jika belum ada) -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f4f6f9; /* Warna latar belakang body */
        }
        #wrapper {
            display: flex;
        }
        #sidebar-wrapper {
            min-width: 250px;
            max-width: 250px;
            background-color: #343a40; /* Warna sidebar, seperti di gambar */
            color: #fff;
            transition: all 0.3s;
            height: 100vh;
            position: sticky; /* Sidebar tetap di tempatnya */
            top: 0;
            left: 0;
            overflow-y: auto; /* Untuk scroll jika menu banyak */
            padding-top: 20px;
        }
        #sidebar-wrapper .sidebar-heading {
            padding: 0.875rem 1.25rem;
            font-size: 1.2rem;
            color: #f8f9fa;
            font-weight: bold;
            text-align: center;
            border-bottom: 1px solid rgba(255,255,255,.1);
            margin-bottom: 20px;
        }
        #sidebar-wrapper .list-group {
            width: 100%;
        }
        #sidebar-wrapper .list-group-item {
            background-color: transparent;
            color: #adb5bd; /* Warna teks menu */
            border: none;
            padding: 10px 20px;
            display: flex;
            align-items: center;
            border-radius: 0; /* Hilangkan rounded-corner default */
            font-size: 0.95rem;
            transition: background-color 0.2s, color 0.2s;
        }
        #sidebar-wrapper .list-group-item:hover {
            background-color: rgba(255,255,255,.05);
            color: #fff;
        }
        #sidebar-wrapper .list-group-item.active {
            background-color: #007bff; /* Warna aktif, sesuaikan dengan gambar jika berbeda */
            color: #fff;
            border-left: 5px solid #fff; /* Garis putih di kiri untuk active item */
            padding-left: 15px; /* Sesuaikan padding setelah garis */
        }
        #sidebar-wrapper .list-group-item i {
            margin-right: 10px;
            width: 20px; /* Lebar ikon tetap */
            text-align: center;
        }
        #page-content-wrapper {
            flex-grow: 1;
            padding: 20px;
        }
        .navbar-custom {
            background-color: #fff; /* Warna navbar atas */
            border-bottom: 1px solid #dee2e6;
            box-shadow: 0 2px 4px rgba(0,0,0,.04);
            margin-bottom: 20px;
            padding: 10px 20px;
        }
        .navbar-custom .form-control {
            border-radius: 20px;
            border-color: #e9ecef;
            background-color: #f8f9fa;
        }
        .navbar-custom .btn-outline-success {
            border-radius: 20px;
            margin-left: 5px;
        }
        .navbar-custom .nav-item .nav-link {
            color: #6c757d;
        }
        .navbar-custom .nav-item .nav-link:hover {
            color: #343a40;
        }
        .rounded-card {
            border-radius: 0.5rem; /* Rounded corners for cards */
        }
        .rounded-table thead th {
            border-top-left-radius: 0.5rem;
            border-top-right-radius: 0.5rem;
        }
        .rounded-top-left { border-top-left-radius: 0.5rem !important; }
        .rounded-top-right { border-top-right-radius: 0.5rem !important; }

        /* General styles for consistent rounding on elements */
        .btn.rounded, .form-control.rounded, .card.rounded {
            border-radius: 0.5rem !important;
        }
    </style>
</head>
<body>
    <div id="wrapper">
        <!-- Sidebar -->
        <div id="sidebar-wrapper" class="rounded-right"> <!-- Added rounded-right for visual consistency -->
            <div class="sidebar-heading">
                <img src="https://placehold.co/40x40/007bff/ffffff?text=LT" alt="Logo Toko" class="me-2 rounded-circle">
                LT Toko
            </div>
            <div class="list-group list-group-flush">
                <a href="<?= base_url('home') ?>" class="list-group-item list-group-item-action">
                    <i class="fas fa-home"></i> Home
                </a>
                <a href="<?= base_url('keranjang') ?>" class="list-group-item list-group-item-action">
                    <i class="fas fa-shopping-cart"></i> Keranjang
                </a>
                <a href="<?= base_url('produk') ?>" class="list-group-item list-group-item-action">
                    <i class="fas fa-box"></i> Produk
                </a>
                <a href="<?= base_url('category') ?>" class="list-group-item list-group-item-action active">
                    <i class="fas fa-tags"></i> Kategori Produk
                </a>
                <a href="<?= base_url('profile') ?>" class="list-group-item list-group-item-action">
                    <i class="fas fa-user"></i> Profile
                </a>
                <a href="<?= base_url('faq') ?>" class="list-group-item list-group-item-action">
                    <i class="fas fa-question-circle"></i> F.A.Q
                </a>
                <a href="<?= base_url('contact') ?>" class="list-group-item list-group-item-action">
                    <i class="fas fa-envelope"></i> Contact
                </a>
            </div>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-light navbar-custom rounded-bottom">
                <div class="container-fluid">
                    <button class="btn btn-outline-secondary d-lg-none" id="sidebarToggle">
                        <i class="fas fa-bars"></i>
                    </button>
                    <form class="d-flex ms-auto me-3">
                        <input class="form-control me-2 rounded" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-primary rounded" type="submit"><i class="fas fa-search"></i></button>
                    </form>
                    <ul class="navbar-nav mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="#"><i class="fas fa-bell"></i></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#"><i class="fas fa-envelope"></i></a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="https://placehold.co/30x30/6c757d/ffffff?text=AD" alt="User Avatar" class="rounded-circle me-1">
                                aprillns (admin)
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="#">Profile</a></li>
                                <li><a class="dropdown-item" href="#">Settings</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="#">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Menampilkan pesan flash dari session (misalnya 'success' atau 'errors') -->
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success alert-dismissible fade show rounded" role="alert">
                    <?= session()->getFlashdata('success') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('errors')): ?>
                <div class="alert alert-danger alert-dismissible fade show rounded" role="alert">
                    <ul>
                        <?php foreach (session()->getFlashdata('errors') as $error): ?>
                            <li><?= esc($error) ?></li>
                        <?php endforeach; ?>
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <!-- Konten utama dari setiap view akan dirender di sini -->
            <?= $this->renderSection('content') ?>

            <!-- Footer (opsional, bisa ditempatkan di sini atau di luar page-content-wrapper) -->
            <footer class="footer mt-auto py-3 text-center">
                <div class="container">
                    <span class="text-muted">© Copyright Toko. All Rights Reserved</span><br>
                    <span class="text-muted">Designed by BootstrapMade</span>
                </div>
            </footer>
        </div>
        <!-- /#page-content-wrapper -->
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" xintegrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
    <!-- Script untuk Toggle Sidebar (opsional, jika Anda ingin sidebar bisa disembunyikan di mobile) -->
    <script>
        var sidebarToggle = document.getElementById('sidebarToggle');
        if (sidebarToggle) {
            sidebarToggle.addEventListener('click', function () {
                document.getElementById('wrapper').classList.toggle('toggled');
            });
        }
    </script>
    <!-- Bagian ini akan memuat script dari view yang meng-extend template -->
    <?= $this->renderSection('scripts') ?> 
</body>
</html>
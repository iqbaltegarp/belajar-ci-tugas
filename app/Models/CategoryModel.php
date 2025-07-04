<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoryModel extends Model
{
    // Properti ini tidak lagi diperlukan jika Anda tidak menggunakan database nyata
    // protected $table = 'categories';
    // protected $primaryKey = 'id';
    // protected $allowedFields = ['id', 'name'];
    // protected $useTimestamps = false;

    // Data akan disimpan dalam properti private $data, yang diambil dari session
    private $data = [];

    public function __construct()
    {
        // Panggil konstruktor parent untuk memastikan inisialisasi yang benar
        parent::__construct(); 
        
        // Mengambil data simulasi dari session saat model diinisialisasi
        // Jika belum ada, inisialisasi dengan array kosong
        $this->data = session()->get('categories') ?? [];
    }

    /**
     * Mengembalikan semua data kategori yang disimulasikan dari session.
     * Mengabaikan $limit dan $offset karena data disimpan dalam array sederhana.
     * Anda bisa menambahkan logika paginasi di sini jika diperlukan.
     *
     * @param int $limit Jumlah data yang ingin diambil (tidak digunakan dalam implementasi ini)
     * @param int $offset Offset data (tidak digunakan dalam implementasi ini)
     * @return array Array berisi semua data kategori
     */
    public function findAll(int $limit = 0, int $offset = 0)
    {
        // Mengembalikan semua data yang ada di properti $this->data
        // Ini adalah data yang diambil dari session
        return $this->data;
    }

    /**
     * Menyimpan kategori baru ke dalam data simulasi session.
     * Memberikan ID unik untuk setiap kategori baru.
     *
     * @param array $category Array asosiatif yang berisi data kategori (misalnya ['name' => 'Nama Kategori'])
     * @return void
     */
    public function saveCategory($category)
    {
        // Menghasilkan ID unik untuk kategori baru
        $category['id'] = uniqid();
        // Menambahkan kategori baru ke array data
        $this->data[] = $category;
        // Menyimpan kembali array data yang diperbarui ke session
        session()->set('categories', $this->data);
    }

    /**
     * Memperbarui data kategori yang sudah ada berdasarkan ID.
     * Mencari kategori berdasarkan ID dan memperbarui properti 'category_name'.
     *
     * @param string $id ID kategori yang akan diperbarui
     * @param array $newData Array asosiatif yang berisi data baru (misalnya ['category_name' => 'Nama Baru'])
     * @return void
     */
    public function updateCategory($id, $newData)
    {
        // Iterasi melalui data dengan referensi (&) agar bisa langsung diubah
        foreach ($this->data as &$cat) {
            // Jika ID kategori cocok
            if ($cat['id'] === $id) {
                // Memperbarui nama kategori
                // Perhatikan: Anda menggunakan 'category_name' di sini, 
                // sementara di `allowedFields` (jika digunakan) dan di `saveCategory`
                // Anda menggunakan 'name'. Pastikan konsistensi!
                $cat['name'] = $newData['name']; // Disarankan menggunakan 'name' agar konsisten
                break; // Hentikan iterasi setelah ditemukan dan diperbarui
            }
        }
        // Menyimpan kembali array data yang diperbarui ke session
        session()->set('categories', $this->data);
    }

    /**
     * Menghapus kategori dari data simulasi session berdasarkan ID.
     * Menggunakan array_filter untuk membuat array baru tanpa kategori yang dihapus.
     *
     * @param string $id ID kategori yang akan dihapus
     * @return void
     */
    public function deleteCategory($id)
    {
        // Memfilter array data, hanya menyisakan kategori yang ID-nya tidak cocok
        $this->data = array_filter($this->data, fn($c) => $c['id'] !== $id);
        // Menyimpan kembali array data yang sudah difilter ke session
        session()->set('categories', $this->data);
    }

    /**
     * Mencari dan mengembalikan satu kategori berdasarkan ID.
     *
     * @param string|null $id ID kategori yang dicari. Jika null, fungsi akan mengembalikan null.
     * @return array|null Mengembalikan array data kategori jika ditemukan, null jika tidak.
     */
    public function find($id = null)
    {
        // Jika ID tidak diberikan, kembalikan null
        if ($id === null) {
            return null;
        }

        // Iterasi melalui data untuk mencari kategori berdasarkan ID
        foreach ($this->data as $cat) {
            if ($cat['id'] === $id) {
                return $cat; // Kembalikan kategori jika ditemukan
            }
        }
        return null; // Kembalikan null jika tidak ditemukan
    }
}

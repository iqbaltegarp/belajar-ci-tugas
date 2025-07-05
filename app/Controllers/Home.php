<?php

namespace App\Controllers;

use App\Models\ProductModel;
use CodeIgniter\Controller;
use App\Models\TransactionModel;
use App\Models\TransactionDetailModel;

class Home extends Controller
{
    public function contact()
{
    return view('v_contact');
}

    protected $product;
    protected $transaction;
    protected $transaction_detail;

    public function __construct()
{
    helper(['form', 'number']);
    $this->product = new ProductModel();
    $this->transaction = new TransactionModel(); // ✅ Tambahkan ini
    $this->transaction_detail = new TransactionDetailModel(); // ✅ Tambahkan ini (pastikan ejaannya benar!)
}

    public function index()
    {
        // Mengambil semua data produk dari database
        $product = $this->product->findAll();

        // Menyimpan data produk ke dalam array $data
        $data['product'] = $product;

        // Meneruskan data ke view v_home
        return view('v_home', $data);
    }
    public function profile()
{
    $username = session()->get('username');
    $data['username'] = $username;

    $buy = $this->transaction->where('username', $username)->findAll();
    $data['buy'] = $buy;

    $product = [];

    if (!empty($buy)) {
        foreach ($buy as $item) {
            $detail = $this->transaction_detail->select('transaction_detail.*, product.nama, product.harga, product.foto')->join('product', 'transaction_detail.product_id=product.id')->where('transaction_id', $item['id'])->findAll();

            if (!empty($detail)) {
                $product[$item['id']] = $detail;
            }
        }
    }

    $data['product'] = $product;

    return view('v_profile', $data);
}
}

<?php

namespace App\Controllers;

use App\Models\ProductModel;
use CodeIgniter\Controller;

class Home extends Controller
{
    public function contact()
{
    return view('v_contact');
}

    protected $product;

    public function __construct()
    {
        // Membuat objek dari model ProductModel dan menyimpannya ke property $product
        helper('form');
        helper('number');
        $this->product = new ProductModel();
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
}

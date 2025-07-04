<?php

namespace App\Controllers;

use App\Models\CategoryModel;

class Category extends BaseController
{
    protected $categoryModel;

    public function __construct()
    {
        $this->categoryModel = new CategoryModel();
    }

    public function index()
    {
        $data['title'] = 'Kategori Produk';
        $data['categories'] = $this->categoryModel->findAll();
        return view('category/index', $data);
    }

public function create()
{
    $data['title'] = 'Tambah Kategori';
    return view('category/create', $data); // Pastikan ini mengarah ke file yang benar
}

    public function store()
{
    $rules = ['name' => 'required|min_length[3]'];
    if (!$this->validate($rules)) {
        return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    }

    // --- Tambahkan ini untuk debugging ---
    // echo "Validasi berhasil, mencoba menyimpan kategori...";
    // die(); // Atau dd($this->request->getPost('name'));

    $this->categoryModel->saveCategory([
        'name' => $this->request->getPost('name')
    ]);

    // --- Tambahkan ini untuk debugging ---
    // echo "Kategori berhasil disimpan, mencoba redirect...";
    // die(); // Atau dd(session()->get('categories'));

    return redirect()->to('/category')->with('success', 'Kategori berhasil ditambahkan!');
}

    public function edit($id)
    {
        $data['category'] = $this->categoryModel->find($id);
        $data['title'] = 'Edit Kategori';
        return view('category/edit', $data);
    }

    public function update($id)
{
    // Pastikan aturan validasi menggunakan 'name'
    $rules = ['name' => 'required|min_length[3]']; 
    if (!$this->validate($rules)) {
        return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    }

    $this->categoryModel->updateCategory($id, [
        'name' => $this->request->getPost('name') // Pastikan mengambil dari input 'name'
    ]);
    // ...
}

    public function delete($id)
    {
        $this->categoryModel->deleteCategory($id);
        return redirect()->to('/category')->with('success', 'Kategori berhasil dihapus!');
    }
}

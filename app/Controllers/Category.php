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
        return view('category/create', $data);
    }

    public function store()
    {
        $rules = ['category_name' => 'required|min_length[3]'];
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->categoryModel->saveCategory([
            'category_name' => $this->request->getPost('category_name')
        ]);

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
        $rules = ['category_name' => 'required|min_length[3]'];
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->categoryModel->updateCategory($id, [
            'category_name' => $this->request->getPost('category_name')
        ]);

        return redirect()->to('/category')->with('success', 'Kategori berhasil diperbarui!');
    }

    public function delete($id)
    {
        $this->categoryModel->deleteCategory($id);
        return redirect()->to('/category')->with('success', 'Kategori berhasil dihapus!');
    }
}

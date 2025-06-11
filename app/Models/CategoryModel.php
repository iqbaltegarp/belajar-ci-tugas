<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoryModel extends Model
{
    protected $table = 'categories';
    protected $primaryKey = 'id';
    protected $allowedFields = ['category_name'];
    
    protected $useTimestamps = false;

    private $data = [];

    public function __construct()
    {
        // Simulasi data, bisa dari file JSON juga
        $this->data = session()->get('categories') ?? [];
    }

 public function findAll(int $limit = 0, int $offset = 0)
{
    // isi sesuai logika kamu, atau:
    return parent::findAll($limit, $offset);
}

    public function saveCategory($category)
    {
        $category['id'] = uniqid();
        $this->data[] = $category;
        session()->set('categories', $this->data);
    }

    public function updateCategory($id, $newData)
    {
        foreach ($this->data as &$cat) {
            if ($cat['id'] === $id) {
                $cat['category_name'] = $newData['category_name'];
                break;
            }
        }
        session()->set('categories', $this->data);
    }

    public function deleteCategory($id)
    {
        $this->data = array_filter($this->data, fn($c) => $c['id'] !== $id);
        session()->set('categories', $this->data);
    }

    public function find($id = null)

    {
        foreach ($this->data as $cat) {
            if ($cat['id'] === $id) return $cat;
        }
        return null;
    }
}

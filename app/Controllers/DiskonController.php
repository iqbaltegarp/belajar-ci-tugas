<?php

namespace App\Controllers;

use App\Models\DiskonModel;
use CodeIgniter\Controller;

class DiskonController extends Controller
{
    protected $diskon;

    public function __construct()
    {
        helper(['form', 'url']);
        $this->diskon = new DiskonModel();
    }

    public function index()
    {
        $data['diskon'] = $this->diskon->orderBy('tanggal', 'DESC')->findAll();
        return view('diskon/index', $data);
    }

    public function create()
    {
        return view('diskon/create');
    }

    public function store()
    {
        $rules = [
            'tanggal' => 'required|valid_date[Y-m-d]|is_unique[diskon.tanggal]',
            'nominal' => 'required|numeric|greater_than_equal_to[0]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->diskon->insert([
            'tanggal'    => $this->request->getPost('tanggal'),
            'nominal'    => $this->request->getPost('nominal'),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);

        return redirect()->to('/diskon')->with('success', 'Diskon berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $diskon = $this->diskon->find($id);
        if (!$diskon) {
            return redirect()->to('/diskon')->with('error', 'Diskon tidak ditemukan.');
        }

        $data['diskon'] = $diskon;
        return view('diskon/edit', $data);
    }

    public function update($id)
    {
        $diskonLama = $this->diskon->find($id);

        if (!$diskonLama) {
            return redirect()->to('/diskon')->with('error', 'Diskon tidak ditemukan.');
        }

        $tanggalBaru = $this->request->getPost('tanggal');
        $nominalBaru = $this->request->getPost('nominal');

        // Validasi hanya jika tanggal berubah
        if ($tanggalBaru !== $diskonLama['tanggal']) {
            $rules = ['tanggal' => 'required|is_unique[diskon.tanggal]', 'nominal' => 'required|numeric'];
        } else {
            $rules = ['tanggal' => 'required', 'nominal' => 'required|numeric'];
        }

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->diskon->update($id, [
            'tanggal'    => $tanggalBaru,
            'nominal'    => $nominalBaru,
            'updated_at' => date("Y-m-d H:i:s"),
        ]);

        return redirect()->to('/diskon')->with('success', 'Diskon berhasil diperbarui.');
    }

    public function delete($id)
    {
        if ($this->diskon->find($id)) {
            $this->diskon->delete($id);
            return redirect()->to('/diskon')->with('success', 'Diskon berhasil dihapus.');
        }

        return redirect()->to('/diskon')->with('error', 'Diskon tidak ditemukan.');
    }
}

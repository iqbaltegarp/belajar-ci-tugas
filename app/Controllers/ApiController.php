<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

use App\Models\UserModel;
use App\Models\TransactionModel;
use App\Models\TransactionDetailModel;

class ApiController extends ResourceController
{
    protected $apiKey;
    protected $user;
    protected $transaction;
    protected $transaction_detail;

    public function __construct()
    {
        // Ambil API_KEY dari file .env
        $this->apiKey = env('API_KEY');
        $this->user = new UserModel();
        $this->transaction = new TransactionModel();
        $this->transaction_detail = new TransactionDetailModel();
    }

    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function index()
{
    $data = [ 
        'results' => [],
        'status' => ["code" => 401, "description" => "Unauthorized"]
    ];

    $headers = $this->request->headers();

    // Ubah nilai headers menjadi string
    array_walk($headers, function (&$value, $key) {
        $value = $value->getValue();
    });

    if (array_key_exists("Key", $headers)) {
        if ($headers["Key"] == $this->apiKey) {
            $penjualan = $this->transaction->asObject()->findAll();

            foreach ($penjualan as &$pj) {
                $pj->details = $this->transaction_detail
                    ->asObject()
                    ->where('transaction_id', $pj->id)
                    ->findAll();
            }

            $data['status'] = ["code" => 200, "description" => "OK"];
            $data['results'] = $penjualan;
        }
    }

    return $this->respond($data);
}


    // Fungsi bawaan RESTful (belum digunakan)
    public function new() { /* ... */ }
    public function create() { /* ... */ }
    public function edit($id = null) { /* ... */ }
    public function update($id = null) { /* ... */ }
    public function delete($id = null) { /* ... */ }
}

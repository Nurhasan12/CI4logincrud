<?php

namespace App\Controllers;

use App\Models\LocalModel;
use App\Models\SqlServerModel;
use CodeIgniter\Controller;

class InventoryController extends Controller
{
    protected $sqlServerModel;
    protected $mySQLModel;

    public function __construct()
    {
        $this->sqlServerModel = new SqlServerModel();  // Model untuk SQL Server
        $this->mySQLModel = new LocalModel();  // Model untuk MySQL
    }


    public function searchName()
    {
        $searchTerm = $this->request->getGet('search');  // Pastikan kita mendapatkan 'search' dan 'field'
        $results = $this->sqlServerModel->searchByName($searchTerm);

        return $this->response->setJSON($results);  // Mengembalikan data JSON
    }

    public function searchPartNumber()
    {
        $searchTerm = $this->request->getGet('search');  // Pastikan kita mendapatkan 'search' dan 'field'
        $results = $this->sqlServerModel->searchByPartNumber($searchTerm);

        return $this->response->setJSON($results);  // Mengembalikan data JSON
    }

    // Fungsi untuk menyimpan data ke MySQL
    public function saveData()
    {
        $data = [
            'name' => $this->request->getPost('name'),
            'part_number' => $this->request->getPost('partNumber'),
        ];

        // Simpan data ke database MySQL
        if ($this->mySQLModel->insert($data)) {
            return redirect()->to('/testinput')->with('success', 'Data saved successfully.');
        } else {
            return redirect()->to('/testinput')->with('error', 'Failed to save data.');
        }
    }

    public function delete($id)
    {
        // Hapus data mahasiswa berdasarkan ID
        $this->mySQLModel->delete($id);
        return redirect()->to('/testinput')->with('message', 'Data Mahasiswa berhasil dihapus.');
    }
}

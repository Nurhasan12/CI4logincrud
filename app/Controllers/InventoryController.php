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

    // Fungsi untuk mencari berdasarkan nama di SQL Server (OITM)
    public function searchName()
    {
        $query = $this->request->getGet('query');
        $results = $this->sqlServerModel->searchByName($query);

        // Mengirim hasil pencarian ke view
        $output = '';
        if ($results) {
            foreach ($results as $result) {
                $output .= '<p>' . $result['ItemName'] . '</p>';
            }
        }
        return $output;
    }

    // Fungsi untuk mencari berdasarkan part number di SQL Server (OITM)
    public function searchPartNumber()
    {
        $query = $this->request->getGet('query');
        $results = $this->sqlServerModel->searchByPartNumber($query);

        // Mengirim hasil pencarian ke view
        $output = '';
        if ($results) {
            foreach ($results as $result) {
                $output .= '<p>' . $result['ItemCode'] . '</p>';
            }
        }
        return $output;
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
}

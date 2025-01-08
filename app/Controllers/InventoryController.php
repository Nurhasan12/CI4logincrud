<?php

// namespace App\Controllers;

// use CodeIgniter\Controller;
// use App\Models\SqlServerModel;
// use App\Models\InventoryModel;

// class InventoryController extends Controller
// {
//     protected $db;

//     public function __construct()
//     {
//         $this->db = \Config\Database::connect('sqlsrv');
//     }
//     // Method untuk pencarian name di SQL Server
//     public function searchName()
//     {
//         $query = $this->request->getVar('query');

//         // Load model untuk SQL Server
//         $sqlServerModel = new SqlServerModel();

//         // Cari data berdasarkan name di SQL Server
//         $result = $sqlServerModel->searchName($query);

//         return $this->response->setJSON($result); // Return hasil pencarian dalam format JSON
//     }

//     // Method untuk pencarian part number di SQL Server
//     public function searchPartNumber()
//     {
//         $query = $this->request->getVar('query');

//         // Load model untuk SQL Server
//         $sqlServerModel = new SqlServerModel();

//         // Cari data berdasarkan part number di SQL Server
//         $result = $sqlServerModel->searchPartNumber($query);

//         return $this->response->setJSON($result); // Return hasil pencarian dalam format JSON
//     }

//     // Method untuk menyimpan data ke MySQL
//     public function tambah()
//     {
//         $name = $this->request->getPost('name');
//         $partNumber = $this->request->getPost('partNumber');

//         // Insert data ke MySQL
//         $inventoryModel = new InventoryModel();
//         $inventoryModel->saveData($name, $partNumber);

//         return redirect()->to('/inventory');  // Redirect setelah penyimpanan
//     }
// }

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\SqlServerModel;
use App\Models\InventoryModel;

class InventoryController extends Controller
{
    // Method untuk pencarian name di SQL Server
    public function searchName()
    {
        $query = $this->request->getVar('query');

        // Gunakan model untuk SQL Server
        $sqlServerModel = new SqlServerModel();
        $result = $sqlServerModel->searchName($query);

        return $this->response->setJSON($result); // Kembalikan hasil pencarian dalam format JSON
    }

    // Method untuk pencarian part number di SQL Server
    public function searchPartNumber()
    {
        $query = $this->request->getVar('query');

        // Gunakan model untuk SQL Server
        $sqlServerModel = new SqlServerModel();
        $result = $sqlServerModel->searchPartNumber($query);

        return $this->response->setJSON($result); // Kembalikan hasil pencarian dalam format JSON
    }

    // Method untuk menyimpan data ke MySQL
    public function tambah()
    {
        $name = $this->request->getPost('name');
        $partNumber = $this->request->getPost('partNumber');

        // Insert data ke MySQL (database lokal)
        $inventoryModel = new InventoryModel();
        $inventoryModel->saveData($name, $partNumber);

        return redirect()->to('/inventory');  // Redirect setelah penyimpanan
    }
}

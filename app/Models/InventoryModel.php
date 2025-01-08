<?php

// namespace App\Models;

// use CodeIgniter\Model;

// class InventoryModel extends Model
// {
//     protected $DBGroup = 'default';  // Koneksi ke MySQL

//     // Fungsi untuk menyimpan data ke MySQL
//     public function saveData($name, $partNumber)
//     {
//         $data = [
//             'name' => $name,
//             'part_number' => $partNumber
//         ];

//         $this->insert($data);
//     }
// }

namespace App\Models;

use CodeIgniter\Model;

class InventoryModel extends Model
{
    // Menggunakan koneksi default (MySQL)
    protected $DBGroup = 'default';  // Koneksi MySQL (database lokal)

    public function saveData($name, $partNumber)
    {
        $data = [
            'name' => $name,
            'part_number' => $partNumber
        ];
        return $this->insert($data);
    }
}

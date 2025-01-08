<?php

// namespace App\Models;

// use CodeIgniter\Model;

// class SqlServerModel extends Model
// {
//     protected $DBGroup = 'sqlserver';  // Koneksi ke SQL Server

//     // Fungsi pencarian berdasarkan name di SQL Server
//     public function searchName($query)
//     {
//         $builder = $this->table('dbo.OITM');  // Ganti dengan nama tabel yang sesuai di SQL Server
//         $builder->like('ItemName', $query);  // Pencarian menggunakan LIKE
//         $result = $builder->get()->getResultArray();

//         return $result;
//     }

//     // Fungsi pencarian berdasarkan part number di SQL Server
//     public function searchPartNumber($query)
//     {
//         $builder = $this->table('dbo.OITM');  // Ganti dengan nama tabel yang sesuai di SQL Server
//         $builder->like('ItemCode', $query);  // Pencarian menggunakan LIKE
//         $result = $builder->get()->getResultArray();

//         return $result;
//     }
// }

namespace App\Models;

use CodeIgniter\Model;

class SqlServerModel extends Model
{
    // Tentukan koneksi ke SQL Server
    protected $DBGroup = 'tests';  // Gunakan koneksi 'tests' yang sudah diatur di Database.php

    public function searchName($query)
    {
        $builder = $this->table('inventory'); // Nama tabel sesuai dengan database SQL Server
        $builder->like('name', $query); // Menambahkan pencarian nama
        return $builder->get()->getResultArray();
    }

    public function searchPartNumber($query)
    {
        $builder = $this->table('inventory'); // Nama tabel sesuai dengan database SQL Server
        $builder->like('part_number', $query); // Menambahkan pencarian part number
        return $builder->get()->getResultArray();
    }
}


<?php

namespace App\Models;

use CodeIgniter\Model;

class SqlServerModel extends Model
{
    protected $DBGroup = 'sqlsvr';  // Gunakan koneksi 'sqlsvr' untuk SQL Server
    protected $table = 'OITM';
    protected $primaryKey = 'ItemCode';
    protected $allowedFields = ['ItemCode', 'ItemName'];

    // Fungsi untuk pencarian berdasarkan ItemName
    public function searchByName($query)
    {
        return $this->like('ItemName', $query)
            ->findAll(10);  // Limit hasil pencarian
    }

    // Fungsi untuk pencarian berdasarkan ItemCode
    public function searchByPartNumber($query)
    {
        return $this->like('ItemCode', $query)
            ->findAll(10);  // Limit hasil pencarian
    }
}



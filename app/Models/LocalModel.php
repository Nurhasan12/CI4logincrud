<?php
namespace App\Models;

use CodeIgniter\Model;

class LocalModel extends Model
{
    protected $DBGroup = 'default';  // Gunakan koneksi 'default' untuk MySQL
    protected $table = 'inventory';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'part_number'];
}


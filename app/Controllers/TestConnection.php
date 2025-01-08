<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class TestConnection extends Controller
{
    public function index()
    {
        // Mendapatkan instance database
        $db = \Config\Database::connect();


        // Cek apakah koneksi berhasil
        try {
            // Mengambil daftar tabel dari database
            $query = $db->query("SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_TYPE = 'BASE TABLE'");
            // $query = $db->query("SELECT * FROM [DBO].[@MIS_BC]");

            // Mendapatkan hasil query
            $result = $query->getResult();

            // Mengecek apakah ada tabel yang ditemukan
            if ($result) {
                echo "Koneksi Berhasil<br>";
                echo "Daftar Tabel :<br>";
                // Menampilkan nama tabel
                foreach ($result as $row) {
                    echo $row->TABLE_NAME . "<br>";
                }
            } else {
                echo "Tidak ada tabel ditemukan.";
            }
        } catch (\Exception $e) {
            echo "Koneksi gagal: " . $e->getMessage();
        }
    }
}



// namespace App\Controllers;

// use CodeIgniter\Controller;

// class TestConnection extends Controller
// {
//     public function index()
//     {
//         // Mendapatkan instance database
//         $db = \Config\Database::connect();
//         // $db = \Config\Database::connect('sqlserver');  // Misalnya menggunakan koneksi 'sqlserver'

//         // Cek apakah koneksi berhasil
//         try {
//             // $query = $db->query("SELECT * FROM [DBO].[@MIS_BC]");
//             $query = $db->query("SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_TYPE = 'BASE TABLE'");

//             // Mendapatkan hasil query
//             $result = $query->getResult();

//             // Mengecek apakah ada data yang ditemukan
//             if ($result) {
//                 echo "Koneksi Berhasil!<br>";
//                 // Menampilkan data
//                 foreach ($result as $row) {
//                     // Menampilkan data setiap baris
//                     foreach ($row as $column => $value) {
//                         echo $column . $value;
//                     }
//                     echo "<br>";
//                 }
//             } else {
//                 echo "Tidak ada data";
//             }
//         } catch (\Exception $e) {
//             echo "Koneksi gagal: " . $e->getMessage();
//         }
//     }
// }

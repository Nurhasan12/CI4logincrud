<?php


namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';

    protected $allowedFields = ['username', 'email', 'password', 'created_at', 'updated_at'];

    protected $useTimestamps = true;

    // Validasi untuk registrasi
    protected $validationRules = [
        'username' => 'required|min_length[3]|max_length[100]|is_unique[users.username]',
        'email' => 'required|valid_email|is_unique[users.email]',
        'password' => 'required|min_length[6]|max_length[255]',
    ];

    // Untuk menangani error validasi
    protected $validationMessages = [
        'username' => [
            'is_unique' => 'Username sudah terdaftar',
        ],
        'email' => [
            'is_unique' => 'Email sudah terdaftar',
        ],
    ];

    public function createUser($data)
    {
        // Hash password sebelum disimpan
        $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        return $this->save($data);
    }

    public function getUserByEmail($email)
    {
        return $this->where('email', $email)->first();
    }
}

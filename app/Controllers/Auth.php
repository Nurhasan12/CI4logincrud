<?php


namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class Auth extends Controller
{
    public function login()
    {
        return view('/auth/login');
    }

    public function loginSubmit()
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        // Ambil data user berdasarkan email
        $userModel = new UserModel();
        $user = $userModel->getUserByEmail($email);

        if ($user && password_verify($password, $user['password'])) {
            // Login berhasil, buat session atau redirect
            session()->set('user', $user);
            return redirect()->to('/home'); // Halaman setelah login
        } else {
            // Gagal login
            session()->setFlashdata('error', 'Email atau Password salah');
            return redirect()->to('/');
        }
    }

    public function register()
    {
        return view('/auth/register');
    }

    public function registerSubmit()
    {
        // Validasi form
        $validation = \Config\Services::validation();
        if (
            !$this->validate([
                'username' => 'required|min_length[3]|max_length[100]|is_unique[users.username]',
                'email' => 'required|valid_email|is_unique[users.email]',
                'password' => 'required|min_length[6]|max_length[255]',
                'confirm_password' => 'matches[password]',
            ])
        ) {
            // Jika validasi gagal, kembali ke halaman registrasi dengan error
            return redirect()->back()->withInput()->with('validation', $validation->getErrors());
        }

        // Simpan data user
        $userModel = new UserModel();
        $userModel->createUser([
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'password' => $this->request->getPost('password'),
        ]);

        // Berhasil registrasi
        session()->setFlashdata('success', 'Registrasi berhasil, silakan login');
        return redirect()->to('/');
    }

    //logout
    public function logout()
    {
        session()->remove('user'); // Menghapus session user
        session()->setFlashdata('success', 'Anda telah berhasil logout');
        return redirect()->to('/');
    }

}

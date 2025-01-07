<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Cek apakah session 'user' ada, artinya pengguna sudah login
        if (!session()->has('user')) {
            // Jika tidak ada, alihkan ke halaman login
            return redirect()->to('/')->with('error', 'Silakan login terlebih dahulu');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Filter ini tidak mempengaruhi response, jadi tidak perlu ada logika di sini
    }
}

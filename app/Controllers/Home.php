<?php


namespace App\Controllers;
use App\Models\MahasiswaModel;

class Home extends BaseController
{

    protected $mahasiswaModel;

    public function __construct()
    {
        // Load MahasiswaModel
        $this->mahasiswaModel = new MahasiswaModel();
    }
    public function index(): string
    {
        $data = [
            'title' => 'Home Page',
            'mahasiswa' => $this->mahasiswaModel->findAll() // Mengambil semua data mahasiswa
        ];

        // view home
        return view('home/home', $data);
    }

    public function create()
    {
        return view('home/create');
    }

    public function save()
    {
        $mahasiswaModel = new MahasiswaModel();

        // Validasi input
        if (
            $this->validate([
                'nama' => 'required|min_length[3]|max_length[255]',
                'nim' => 'required|is_unique[mahasiswa.nim]',
                'email' => 'required|valid_email|min_length[3]|max_length[255]',
            ])
        ) {
            // Simpan data mahasiswa baru
            $mahasiswaModel->save([
                'nama' => $this->request->getPost('nama'),
                'nim' => $this->request->getPost('nim'),
                'email' => $this->request->getPost('email'),
            ]);
            return redirect()->to('/home')->with('message', 'Data Mahasiswa berhasil disimpan.');
        } else {
            // Jika validasi gagal
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }






        // // Validasi input
        // if (
        //     $this->validate([
        //         'nama' => 'required|min_length[3]|max_length[255]',
        //         'nim' => 'required|is_unique[mahasiswa.nim]',
        //         'email' => 'required|min_length[3]|max_length[255]'
        //     ])
        // ) {

        //     // Simpan data mahasiswa baru
        //     $this->mahasiswaModel->save([
        //         'nama' => $this->request->getPost('nama'),
        //         'nim' => $this->request->getPost('nim'),
        //         'email' => $this->request->getPost('email'),
        //     ]);
        //     return redirect()->to('/home')->with('message', 'Data Mahasiswa berhasil disimpan.');
        // } else {
        //     // Jika validasi gagal
        //     return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        // }
    }

    public function edit($id)
    {
        $mahasiswa = $this->mahasiswaModel->find($id);

        if (!$mahasiswa) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Data mahasiswa tidak ditemukan!");
        }

        return view('/home/edit', ['mahasiswa' => $mahasiswa]);
    }

    // Mengupdate data mahasiswa
    public function update($id)
    {
        if (
            $this->validate([
                'nama' => 'required|min_length[3]|max_length[255]',
                'nim' => 'required|is_unique[mahasiswa.nim,id,' . $id . ']',
                'email' => 'required|min_length[3]|max_length[255]'
            ])
        ) {
            // Update data mahasiswa
            $this->mahasiswaModel->update($id, [
                'nama' => $this->request->getPost('nama'),
                'nim' => $this->request->getPost('nim'),
                'email' => $this->request->getPost('email'),
            ]);
            return redirect()->to('/home')->with('message', 'Data Mahasiswa berhasil diperbarui.');
        } else {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
    }

    // Menghapus data mahasiswa
    public function delete($id)
    {
        // Hapus data mahasiswa berdasarkan ID
        $this->mahasiswaModel->delete($id);
        return redirect()->to('/home')->with('message', 'Data Mahasiswa berhasil dihapus.');
    }
}







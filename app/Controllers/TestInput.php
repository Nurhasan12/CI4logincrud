<?php


namespace App\Controllers;
use App\Models\InputModel;

class TestInput extends BaseController
{
    private $inputModel;

    public function __construct()
    {
        // Load MahasiswaModel
        $this->inputModel = new InputModel();
    }

    public function index(): string
    {
        // $data = [
        //     'title' => 'Input',
        //     'input' => $this->inputModel->findAll() // Mengambil semua data input
        // ];

        // view home
        return view('input/index');
    }
}

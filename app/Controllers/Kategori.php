<?php
namespace App\Controllers;
use App\Models\KategoriModel;

class Kategori extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new KategoriModel();
    }

    public function index()
    {
        $data = [
            'title'     => 'Manajemen Kategori',
            'kategori'  => $this->model->findAll(),
        ];
        return view('kategori/index', $data);
    }

    public function tambah()
    {
        return view('kategori/form', ['title' => 'Tambah Kategori', 'kategori' => null]);
    }

    public function simpan()
    {
        $rules = ['nama_kategori' => 'required|min_length[3]|max_length[100]'];
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $this->model->insert(['nama_kategori' => $this->request->getPost('nama_kategori')]);
        return redirect()->to('/kategori')->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $data = [
            'title'    => 'Edit Kategori',
            'kategori' => $this->model->find($id),
        ];
        return view('kategori/form', $data);
    }

    public function update($id)
    {
        $rules = ['nama_kategori' => 'required|min_length[3]|max_length[100]'];
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $this->model->update($id, ['nama_kategori' => $this->request->getPost('nama_kategori')]);
        return redirect()->to('/kategori')->with('success', 'Kategori berhasil diupdate!');
    }

    public function hapus($id)
    {
        $this->model->delete($id);
        return redirect()->to('/kategori')->with('success', 'Kategori berhasil dihapus!');
    }
}

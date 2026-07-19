<?php
namespace App\Controllers;
use App\Models\ProdukModel;
use App\Models\KategoriModel;

class Produk extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new ProdukModel();
    }

    public function index()
    {
        $data = [
            'title'  => 'Manajemen Produk',
            'produk' => $this->model->getProdukWithKategori(),
        ];
        return view('produk/index', $data);
    }

    public function tambah()
    {
        $data = [
            'title'    => 'Tambah Produk',
            'kategori' => (new KategoriModel())->findAll(),
            'produk'   => null,
        ];
        return view('produk/form', $data);
    }

    public function simpan()
    {
        $rules = [
            'kode_produk'  => 'required|is_unique[produk.kode_produk]',
            'nama_produk'  => 'required|min_length[3]',
            'id_kategori'  => 'required',
            'harga'        => 'required|numeric',
            'stok'         => 'required|integer',
        ];
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $this->model->insert($this->request->getPost());
        return redirect()->to('/produk')->with('success', 'Produk berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $data = [
            'title'    => 'Edit Produk',
            'produk'   => $this->model->find($id),
            'kategori' => (new KategoriModel())->findAll(),
        ];
        return view('produk/form', $data);
    }

    public function update($id)
    {
        $rules = [
            'nama_produk' => 'required|min_length[3]',
            'id_kategori' => 'required',
            'harga'       => 'required|numeric',
            'stok'        => 'required|integer',
        ];
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $this->model->update($id, $this->request->getPost(['nama_produk','id_kategori','harga','stok']));
        return redirect()->to('/produk')->with('success', 'Produk berhasil diupdate!');
    }

    public function hapus($id)
    {
        $this->model->delete($id);
        return redirect()->to('/produk')->with('success', 'Produk berhasil dihapus!');
    }
}

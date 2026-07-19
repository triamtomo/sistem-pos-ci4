<?php
namespace App\Models;
use CodeIgniter\Model;

class ProdukModel extends Model
{
    protected $table      = 'produk';
    protected $primaryKey = 'id';
    protected $allowedFields = ['kode_produk','nama_produk','id_kategori','harga','stok'];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = '';

    public function getProdukWithKategori()
    {
        return $this->select('produk.*, kategori.nama_kategori')
                    ->join('kategori', 'kategori.id = produk.id_kategori')
                    ->findAll();
    }
}

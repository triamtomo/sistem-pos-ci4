<?php
namespace App\Models;
use CodeIgniter\Model;

class DetailTransaksiModel extends Model
{
    protected $table      = 'detail_transaksi';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_transaksi','id_produk','jumlah','harga_satuan','subtotal'];

    public function getDetailWithProduk($id_transaksi)
    {
        return $this->select('detail_transaksi.*, produk.nama_produk, produk.kode_produk')
                    ->join('produk', 'produk.id = detail_transaksi.id_produk')
                    ->where('id_transaksi', $id_transaksi)
                    ->findAll();
    }
}

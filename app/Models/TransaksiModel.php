<?php
namespace App\Models;
use CodeIgniter\Model;

class TransaksiModel extends Model
{
    protected $table      = 'transaksi';
    protected $primaryKey = 'id';
    protected $allowedFields = ['kode_transaksi','id_user','total_harga','bayar','kembalian'];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = '';

    public function getAllWithUser()
    {
        return $this->select('transaksi.*, users.nama as nama_kasir')
                    ->join('users', 'users.id = transaksi.id_user')
                    ->orderBy('transaksi.created_at', 'DESC')
                    ->findAll();
    }

    public function getTransaksiWithUser($id)
    {
        return $this->select('transaksi.*, users.nama as nama_kasir')
                    ->join('users', 'users.id = transaksi.id_user')
                    ->find($id);
    }

    public function transaksiTerakhir($limit = 5)
    {
        return $this->select('transaksi.*, users.nama as nama_kasir')
                    ->join('users', 'users.id = transaksi.id_user')
                    ->orderBy('transaksi.created_at', 'DESC')
                    ->limit($limit)
                    ->findAll();
    }

    public function pendapatanHariIni()
    {
        return $this->selectSum('total_harga', 'total')
                    ->where('DATE(created_at)', date('Y-m-d'))
                    ->first()['total'] ?? 0;
    }

    public function getLaporan($tgl_awal, $tgl_akhir)
    {
        return $this->select('transaksi.*, users.nama as nama_kasir')
                    ->join('users', 'users.id = transaksi.id_user')
                    ->where('DATE(transaksi.created_at) >=', $tgl_awal)
                    ->where('DATE(transaksi.created_at) <=', $tgl_akhir)
                    ->orderBy('transaksi.created_at', 'DESC')
                    ->findAll();
    }

    public function getTotalLaporan($tgl_awal, $tgl_akhir)
    {
        return $this->selectSum('total_harga', 'total')
                    ->where('DATE(created_at) >=', $tgl_awal)
                    ->where('DATE(created_at) <=', $tgl_akhir)
                    ->first()['total'] ?? 0;
    }
}

<?php
namespace App\Controllers;
use App\Models\ProdukModel;
use App\Models\TransaksiModel;
use App\Models\UserModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $produkModel    = new ProdukModel();
        $transaksiModel = new TransaksiModel();
        $userModel      = new UserModel();

        $data = [
            'title'          => 'Dashboard',
            'total_produk'   => $produkModel->countAll(),
            'total_user'     => $userModel->countAll(),
            'total_transaksi'=> $transaksiModel->countAll(),
            'pendapatan_hari'=> $transaksiModel->pendapatanHariIni(),
            'transaksi_terakhir' => $transaksiModel->transaksiTerakhir(5),
        ];
        return view('dashboard/index', $data);
    }
}

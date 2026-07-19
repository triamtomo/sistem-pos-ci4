<?php
namespace App\Controllers;
use App\Models\TransaksiModel;
use App\Models\DetailTransaksiModel;

class Laporan extends BaseController
{
    public function index()
    {
        if (session()->get('role') !== 'admin') {
            return redirect()->to('/dashboard')->with('error', 'Akses ditolak!');
        }
        $transaksiModel = new TransaksiModel();
        $tgl_awal  = date('Y-m-01');
        $tgl_akhir = date('Y-m-d');

        $data = [
            'title'      => 'Laporan Penjualan',
            'transaksi'  => $transaksiModel->getLaporan($tgl_awal, $tgl_akhir),
            'total'      => $transaksiModel->getTotalLaporan($tgl_awal, $tgl_akhir),
            'tgl_awal'   => $tgl_awal,
            'tgl_akhir'  => $tgl_akhir,
        ];
        return view('laporan/index', $data);
    }

    public function filter()
    {
        if (session()->get('role') !== 'admin') {
            return redirect()->to('/dashboard');
        }
        $tgl_awal  = $this->request->getPost('tgl_awal');
        $tgl_akhir = $this->request->getPost('tgl_akhir');
        $transaksiModel = new TransaksiModel();

        $data = [
            'title'     => 'Laporan Penjualan',
            'transaksi' => $transaksiModel->getLaporan($tgl_awal, $tgl_akhir),
            'total'     => $transaksiModel->getTotalLaporan($tgl_awal, $tgl_akhir),
            'tgl_awal'  => $tgl_awal,
            'tgl_akhir' => $tgl_akhir,
        ];
        return view('laporan/index', $data);
    }
}

<?php
namespace App\Controllers;
use App\Models\TransaksiModel;
use App\Models\DetailTransaksiModel;
use App\Models\ProdukModel;

class Transaksi extends BaseController
{
    public function index()
    {
        $produkModel = new ProdukModel();
        $data = [
            'title'  => 'Transaksi Penjualan',
            'produk' => $produkModel->getProdukWithKategori(),
        ];
        return view('transaksi/index', $data);
    }

    public function proses()
    {
        $items  = $this->request->getPost('items');
        $bayar  = $this->request->getPost('bayar');

        if (empty($items)) {
            return redirect()->back()->with('error', 'Keranjang masih kosong!');
        }

        $items  = json_decode($items, true);
        $total  = 0;

        $produkModel = new ProdukModel();
        foreach ($items as $item) {
            $total += $item['harga'] * $item['jumlah'];
        }

        if ($bayar < $total) {
            return redirect()->back()->with('error', 'Uang bayar kurang!');
        }

        $kembalian = $bayar - $total;
        $kode = 'TRX' . date('YmdHis');

        $transaksiModel = new TransaksiModel();
        $id_transaksi   = $transaksiModel->insert([
            'kode_transaksi' => $kode,
            'id_user'        => session()->get('user_id'),
            'total_harga'    => $total,
            'bayar'          => $bayar,
            'kembalian'      => $kembalian,
        ]);

        $detailModel = new DetailTransaksiModel();
        foreach ($items as $item) {
            $subtotal = $item['harga'] * $item['jumlah'];
            $detailModel->insert([
                'id_transaksi'  => $id_transaksi,
                'id_produk'     => $item['id'],
                'jumlah'        => $item['jumlah'],
                'harga_satuan'  => $item['harga'],
                'subtotal'      => $subtotal,
            ]);
            // Kurangi stok
            $produk = $produkModel->find($item['id']);
            $produkModel->update($item['id'], ['stok' => $produk['stok'] - $item['jumlah']]);
        }

        return redirect()->to('/transaksi/struk/' . $id_transaksi);
    }

    public function struk($id)
    {
        $transaksiModel = new TransaksiModel();
        $detailModel    = new DetailTransaksiModel();

        $data = [
            'title'     => 'Struk Transaksi',
            'transaksi' => $transaksiModel->getTransaksiWithUser($id),
            'detail'    => $detailModel->getDetailWithProduk($id),
        ];
        return view('transaksi/struk', $data);
    }

    public function riwayat()
    {
        $transaksiModel = new TransaksiModel();
        $data = [
            'title'      => 'Riwayat Transaksi',
            'transaksi'  => $transaksiModel->getAllWithUser(),
        ];
        return view('transaksi/riwayat', $data);
    }
}

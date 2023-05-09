<?php

namespace App\Http\Controllers;

use App\Http\Services\Api;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function uploadFromApi()
    {

        $apiProduct = new Api;
        $getApiProduct = $apiProduct->product();

        $data = json_decode($getApiProduct, true);
        dd($data);
        $banyakData = $data['data'];

       for ($i=0; $i < count($banyakData) ; $i++) { 
           $idProduct = $data['data'][$i]['id_produk'];
           $namaProduct = $data['data'][$i]['nama_produk'];
           $hargaProduct = $data['data'][$i]['harga'];
           $kategoriProduct = $data['data'][$i]['kategori'];
           $statusProduct = $data['data'][$i]['status'];
   
            // upload data api ke tabel product
           Product::create([
               'id_produk' => $idProduct,
               'nama_produk' => $namaProduct,
               'harga' => $hargaProduct,
               'kategori' => $kategoriProduct,
               'status' => $statusProduct
           ]);
       }

    }

    public function index()
    {
        $products = Product::where('status', 'bisa dijual')->orderBy('id_produk', 'desc')->get();

        return view('produk', compact('products'));
    }

    public function create()
    {
        return view('tambah-produk');
    }

    public function store(Request $request)
    {
        try {
            $dataValidated = $request->validate([
                'nama_produk' => 'required',
                'harga' => 'numeric',
                'kategori' => 'nullable',
                'status' => 'nullable'
            ]);
    
            Product::create([
                'nama_produk' => $dataValidated['nama_produk'],
                'harga' => $dataValidated['harga'],
                'kategori' => $dataValidated['kategori'],
                'status' => $dataValidated['status']
            ]);

        } catch (\Throwable $th) {
            return redirect()->route('produk.daftar')->with('failed', 'Gagal menambahkan data produk');
        }

       return redirect()->route('produk.daftar')->with('success', 'Berhasil menambahkan data produk');
    }

    public function edit(Request $request)
    {
       try {
            $dataValidated = $request->validate([
                'id_produk' => 'required',
                'nama_produk' => 'required',
                'harga' => 'numeric',
                'kategori' => 'nullable',
                'status' => 'nullable'
            ]);

            $product = Product::findOrFail($dataValidated['id_produk']);

            $product->update([
                'id_produk' => $dataValidated['id_produk'],
                'nama_produk' => $dataValidated['nama_produk'],
                'harga' => $dataValidated['harga'],
                'kategori' => $dataValidated['kategori'],
                'status' => $dataValidated['status']
            ]);

        $data = [
            'data' => 'Berhasil mengupdate data dengan nama '. '</br>' . $dataValidated['nama_produk']
        ];
       } catch (\Throwable $th) {
        $data = [
            'data' => $th->getMessage()
        ];
       }
       return $data;
    }

    public function destroy(Request $request)
    {
        try {
            $dataValidated = $request->validate([
                'id_produk' => 'required',
                'nama_produk' => 'required',
            ]); 

            Product::destroy($dataValidated['id_produk']);

            $data = [
                'data' => 'data berhasil dihapus'
            ];

        } catch (\Throwable $th) {
            //throw $th;
            $data = [
                'data' => $th->getMessage()];
        }

        return $data;
        
    }

}

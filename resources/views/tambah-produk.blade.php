@extends('layouts.template')
@section('title')
    Daftar Produk
@endsection
@section('content')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <h2 class="mt-3">Tambah Produk</h2>
        <form action="{{ route('produk.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="nama-produk">Nama Produk</label>
                <input type="text" class="form-control" name="nama_produk" id="nama-produk"
                    placeholder="Masukkan nama produk" required>
                <small>*nama produk harus di isi</small>
            </div>
            <div class="mb-3">
                <label for="harga">Harga Produk</label>
                <input type="number" class="form-control" name="harga" id="harga"
                    placeholder="Masukkan harga produk">
                <small>*input harga hanya bisa angka</small>
            </div>
            <div class="mb-3">
                <label for="kategori">Kategori Produk</label>
                <select class="form-select" name="kategori" aria-label="Default select example">
                    <option selected>Pilih..</option>
                    <option value="L QUEENLY">L QUEENLY</option>
                    <option value="L MTH AKSESORIS (IM)">L MTH AKSESORIS (IM)</option>
                    <option value="L MTH AKSESORIS (LK)">L MTH AKSESORIS (LK)</option>
                    <option value="L MTH TABUNG (LK)">L MTH TABUNG (LK)</option>
                    <option value="SP MTH SPAREPART (LK)">SP MTH SPAREPART (LK)</option>
                    <option value="CI MTH TINTA LAIN (IM)">CI MTH TINTA LAIN (IM)</option>
                    <option value="S MTH STEMPEL (IM)">S MTH STEMPEL (IM)</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="kategori">Status</label>
                <select class="form-select" name="status" aria-label="Default select example">
                    <option selected>Pilih..</option>
                    <option value="bisa dijual">bisa dijual</option>
                    <option value="tidak bisa dijual">tidak bisa dijual</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </main>
@endsection

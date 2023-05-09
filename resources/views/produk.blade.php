@extends('layouts.template')
@section('title')
    Daftar Produk
@endsection
@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@7.28.11/dist/sweetalert2.min.css">
@endpush
@section('content')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <h2 class="mt-3">Daftar Produk</h2>
        <div class="table-responsive">
            <table id="tabel" class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Produk</th>
                        <th>Harga</th>
                        <th>Kategori</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = 1;
                    @endphp
                    @foreach ($products as $product)
                        <tr>
                            <td class="align-middle">{{ $i++ }}</td>
                            <td class="align-middle">{{ $product->nama_produk }}</td>
                            <td class="align-middle">{{ $product->harga }}</td>
                            <td class="align-middle">{{ $product->kategori }}</td>
                            <td class="align-middle">{{ $product->status }}</td>
                            <td class="align-middle">
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button"
                                        id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                        Aksi
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                        <li>
                                            <button type="button" class="dropdown-item" data-bs-toggle="modal"
                                                data-bs-target="#modal_edit" data-id_produk="{{ $product->id_produk }}"
                                                data-nama_produk="{{ $product->nama_produk }}"
                                                data-harga="{{ $product->harga }}" data-kategori="{{ $product->kategori }}"
                                                data-status="{{ $product->status }}">
                                                Edit
                                            </button>
                                        </li>
                                        <li>
                                            <form
                                                action="{{ route('produk.delete', ['id_produk' => $product->id_produk]) }}"
                                                class="form-hapus" method="POST" onsubmit="deleteData(event)">
                                                @method('delete')
                                                @csrf
                                                <input type="hidden" value="{{ $product->id_produk }}" name="id_produk">
                                                <input type="hidden" value="{{ $product->nama_produk }}"
                                                    name="nama_produk">
                                                <button class="dropdown-item text-danger" type="submit">Delete</button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{-- Modal Edit --}}
    </main>
    <form action="#" method="POST" enctype="multipart/form-data" id="form_edit">
        @csrf
        <div class="modal fade" id="modal_edit" tabindex="-1" role="dialog" aria-labelledby="modal_edit"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="title_edit">Edit </h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="id-produk-edit" name="id_produk">
                        <div class="mb-3">
                            <label for="nama-produk">Nama Produk</label>
                            <input type="text" class="form-control" name="nama_produk" id="nama-produk-edit"
                                placeholder="Masukkan nama produk" value="{{ old('nama_produk') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="harga">Harga Produk</label>
                            <input type="number" class="form-control" name="harga" id="harga-edit"
                                placeholder="Masukkan harga produk" value="{{ old('harga') }}">
                        </div>
                        <div class="mb-3">
                            <label for="kategori">Kategori Produk</label>
                            <select class="form-select" name="kategori" id="kategori-edit"
                                aria-label="Default select example">
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
                            <select class="form-select" name="status" id="status-edit"
                                aria-label="Default select example">
                                <option selected>Pilih..</option>
                                <option value="bisa dijual">bisa dijual</option>
                                <option value="tidak bisa dijual">tidak bisa dijual</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
@push('script')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.28.11/dist/sweetalert2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#tabel').DataTable({
                responsive: true,
                autoWidth: false,
            });
        });

        @if (Session::has('success'))
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: "{!! Session::get('success') !!}",
                timer: 3000
            })
        @endif
        @if (Session::has('failed'))
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: "{!! Session::get('failed') !!}",
                timer: 3000
            })
        @endif
    </script>
    <script>
        $(document).ready(function() {
            $('#modal_edit').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var id = button.data('id_produk');
                var namaProduk = button.data('nama_produk');
                var harga = button.data('harga');
                var kategori = button.data('kategori');
                var status = button.data('status');

                var modal = $(this);
                modal.find('#id-produk-edit').val(id);
                modal.find('#nama-produk-edit').val(namaProduk);
                modal.find('#harga-edit').val(harga);
                modal.find('#kategori-edit').val(kategori).change();
                modal.find('#status-edit').val(status).change();

            })

            $('#form_edit').submit(function(e) {
                e.preventDefault();
                var url = "{{ route('produk.edit') }}";
                var fd = new FormData($(this)[0]);
                $.ajax({
                    type: "post",
                    url: url,
                    data: fd,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        Swal.fire(
                            'Good job!',
                            response.data,
                            'success'
                        )
                        setTimeout(function() {
                            window.location.reload();
                        }, 1000);
                    }
                });
            });
        });
    </script>
    <script>
        function deleteData(event) {
            event.preventDefault();
            var id_produk = event.target.querySelector('input[name="id_produk"]').value;
            var nama_produk = event.target.querySelector('input[name="nama_produk"]').value;

            var confirmDelete = confirm('Apakah kamu yakin ingin menghapus produk ' + nama_produk + '?');

            if (confirmDelete == true) {
                var url = "{{ route('produk.delete') }}";
                var fd = new FormData($(event.target)[0]);
                $.ajax({
                    type: "post",
                    url: url,
                    data: fd,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        Swal.fire(
                            'Good job!',
                            response.data,
                            'success'
                        )
                        setTimeout(function() {
                            window.location.reload();
                        }, 1000);
                    }
                });
            }
        }
    </script>
@endpush

@extends('layout.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between mb-3">
        <h2>Daftar Barang</h2>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createBarangModal">
            <i class="fas fa-plus"></i> Tambah Barang
        </button>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Nama</th>
                            <th>Stok</th>
                            <th>Harga Beli</th>
                            <th>Harga Jual</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($barangs as $barang)
                        <tr>
                            <td>{{ $barang->kode }}</td>
                            <td>{{ $barang->nama }}</td>
                            <td>{{ $barang->stok }}</td>
                            <td>Rp. {{ number_format($barang->harga_beli, 0, ',', '.') }}</td>
                            <td>Rp. {{ number_format($barang->harga_jual, 0, ',', '.') }}</td>
                            <td>
                                <button class="btn btn-sm btn-warning edit-btn" 
                                        data-id="{{ $barang->id }}"
                                        data-kode="{{ $barang->kode }}"
                                        data-nama="{{ $barang->nama }}"
                                        data-stok="{{ $barang->stok }}"
                                        data-harga_beli="{{ $barang->harga_beli }}"
                                        data-harga_jual="{{ $barang->harga_jual }}"
                                        data-bs-toggle="modal" 
                                        data-bs-target="#editBarangModal">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-sm btn-danger delete-btn" 
                                        data-id="{{ $barang->id }}"
                                        data-bs-toggle="modal" 
                                        data-bs-target="#deleteBarangModal">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Create Modal -->
<div class="modal fade" id="createBarangModal" tabindex="-1" role="dialog" aria-labelledby="createBarangModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createBarangModalLabel">Tambah Barang Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="createForm" action="{{ route('barang.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="kode">Kode Barang</label>
                        <input type="text" class="form-control" id="kode" name="kode" required>
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama Barang</label>
                        <input type="text" class="form-control" id="nama" name="nama" required>
                    </div>
                    <div class="form-group">
                        <label for="stok">Stok</label>
                        <input type="number" class="form-control" id="stok" name="stok" min="0" required>
                    </div>
                    <div class="form-group">
                        <label for="harga_beli">Harga Beli</label>
                        <input type="number" class="form-control" id="harga_beli" name="harga_beli" min="0" step="0.01" required>
                    </div>
                    <div class="form-group">
                        <label for="harga_jual">Harga Jual</label>
                        <input type="number" class="form-control" id="harga_jual" name="harga_jual" min="0" step="0.01" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editBarangModal" tabindex="-1" role="dialog" aria-labelledby="editBarangModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editBarangModalLabel">Edit Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="edit_kode">Kode Barang</label>
                        <input type="text" class="form-control" id="edit_kode" name="kode" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_nama">Nama Barang</label>
                        <input type="text" class="form-control" id="edit_nama" name="nama" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_stok">Stok</label>
                        <input type="number" class="form-control" id="edit_stok" name="stok" min="0" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_harga_beli">Harga Beli</label>
                        <input type="number" class="form-control" id="edit_harga_beli" name="harga_beli" min="0" step="0.01" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_harga_jual">Harga Jual</label>
                        <input type="number" class="form-control" id="edit_harga_jual" name="harga_jual" min="0" step="0.01" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteBarangModal" tabindex="-1" role="dialog" aria-labelledby="deleteBarangModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteBarangModalLabel">Hapus Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="deleteForm" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus barang ini?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        // Edit modal handler
        $('.edit-btn').click(function() {
            var id = $(this).data('id');
            var kode = $(this).data('kode');
            var nama = $(this).data('nama');
            var stok = $(this).data('stok');
            var harga_beli = $(this).data('harga_beli');
            var harga_jual = $(this).data('harga_jual');
            
            $('#editForm').attr('action', '/barang/' + id);
            $('#edit_kode').val(kode);
            $('#edit_nama').val(nama);
            $('#edit_stok').val(stok);
            $('#edit_harga_beli').val(harga_beli);
            $('#edit_harga_jual').val(harga_jual);
        });
        
        // Delete modal handler
        $('.delete-btn').click(function() {
            var id = $(this).data('id');
            $('#deleteForm').attr('action', '/barang/' + id);
        });
    });
</script>
@endsection
@extends('layout.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Data Pelanggan</h2>

    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createModal">Tambah Pelanggan</button>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Telepon</th>
                <th>Alamat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pelanggans as $pelanggan)
            <tr>
                <td>{{ $pelanggan->nama }}</td>
                <td>{{ $pelanggan->telepon }}</td>
                <td>{{ $pelanggan->alamat }}</td>
                <td>
                    <button 
                        class="btn btn-warning btn-sm editBtn"
                        data-id="{{ $pelanggan->id }}"
                        data-nama="{{ $pelanggan->nama }}"
                        data-telepon="{{ $pelanggan->telepon }}"
                        data-alamat="{{ $pelanggan->alamat }}"
                        data-bs-toggle="modal"
                        data-bs-target="#editModal">
                        Edit
                    </button>

                    <button 
                        class="btn btn-danger btn-sm deleteBtn"
                        data-id="{{ $pelanggan->id }}"
                        data-bs-toggle="modal"
                        data-bs-target="#deleteModal">
                        Hapus
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

{{-- MODAL TAMBAH --}}
<div class="modal fade" id="createModal" tabindex="-1">
  <div class="modal-dialog">
    <form action="{{ route('pelanggan.store') }}" method="POST" class="modal-content">
      @csrf
      <div class="modal-header">
        <h5 class="modal-title">Tambah Pelanggan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <input type="text" name="nama" class="form-control mb-2" placeholder="Nama" required>
        <input type="text" name="telepon" class="form-control mb-2" placeholder="Telepon">
        <textarea name="alamat" class="form-control" placeholder="Alamat"></textarea>
      </div>
      <div class="modal-footer">
        <button class="btn btn-success">Simpan</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
      </div>
    </form>
  </div>
</div>

{{-- MODAL EDIT --}}
<div class="modal fade" id="editModal" tabindex="-1">
  <div class="modal-dialog">
    <form method="POST" class="modal-content" id="editForm">
      @csrf @method('PUT')
      <div class="modal-header">
        <h5 class="modal-title">Edit Pelanggan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <input type="text" name="nama" id="editNama" class="form-control mb-2" required>
        <input type="text" name="telepon" id="editTelepon" class="form-control mb-2">
        <textarea name="alamat" id="editAlamat" class="form-control"></textarea>
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary">Update</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
      </div>
    </form>
  </div>
</div>

{{-- MODAL DELETE --}}
<div class="modal fade" id="deleteModal" tabindex="-1">
  <div class="modal-dialog">
    <form method="POST" class="modal-content" id="deleteForm">
      @csrf @method('DELETE')
      <div class="modal-header">
        <h5 class="modal-title">Hapus Pelanggan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <p>Yakin ingin menghapus pelanggan ini?</p>
      </div>
      <div class="modal-footer">
        <button class="btn btn-danger">Hapus</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
      </div>
    </form>
  </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Handle tombol edit
        document.querySelectorAll('.editBtn').forEach(button => {
            button.addEventListener('click', function () {
                const id = this.dataset.id;
                const nama = this.dataset.nama;
                const telepon = this.dataset.telepon;
                const alamat = this.dataset.alamat;

                document.getElementById('editNama').value = nama;
                document.getElementById('editTelepon').value = telepon;
                document.getElementById('editAlamat').value = alamat;

                document.getElementById('editForm').action = `/pelanggan/${id}`;
            });
        });

        // Handle tombol delete
        document.querySelectorAll('.deleteBtn').forEach(button => {
            button.addEventListener('click', function () {
                const id = this.dataset.id;
                document.getElementById('deleteForm').action = `/pelanggan/${id}`;
            });
        });
    });
</script>
@endsection

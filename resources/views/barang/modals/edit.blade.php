<div class="modal fade" id="editBarangModal" tabindex="-1" aria-labelledby="editBarangModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form method="POST" id="editForm">
      @csrf
      @method('PUT')
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editBarangModalLabel">Edit Barang</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <input type="text" name="kode" id="edit_kode" class="form-control mb-2" placeholder="Kode Barang" required>
          <input type="text" name="nama" id="edit_nama" class="form-control mb-2" placeholder="Nama Barang" required>
          <input type="number" name="stok" id="edit_stok" class="form-control mb-2" placeholder="Stok" required>
          <input type="number" name="harga_beli" step="0.01" id="edit_harga_beli" class="form-control mb-2" placeholder="Harga Beli" required>
          <input type="number" name="harga_jual" step="0.01" id="edit_harga_jual" class="form-control" placeholder="Harga Jual" required>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Update</button>
        </div>
      </div>
    </form>
  </div>
</div>

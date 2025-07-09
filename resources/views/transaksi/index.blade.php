@extends('layout.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Daftar Transaksi</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#transaksiModal">
        <i class="fas fa-plus"></i> Tambah Transaksi
    </button>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Pelanggan</th>
                <th>Total</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($transaksis as $transaksi)
            <tr>
                <td>{{ $transaksi->tanggal->format('d-m-Y') }}</td>
                <td>{{ $transaksi->pelanggan->nama }}</td>
                <td>Rp {{ number_format($transaksi->total, 0, ',', '.') }}</td>

                <td>

                    <form action="{{ route('transaksi.destroy', $transaksi->id) }}" method="POST" class="d-inline" 
                          onsubmit="return confirm('Yakin ingin menghapus transaksi ini?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" type="submit">
                            <i class="fas fa-trash"></i> Hapus
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="text-center">Belum ada data transaksi.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Modal Tambah Transaksi -->
<div class="modal fade" id="transaksiModal" tabindex="-1" aria-labelledby="transaksiModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <form action="{{ route('transaksi.store') }}" method="POST" id="transaksiForm">
                @csrf
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="transaksiModalLabel">Tambah Transaksi Baru</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="pelanggan_id" class="form-label">Pelanggan</label>
                                <select name="pelanggan_id" id="pelanggan_id" class="form-select" required>
                                    <option value="">-- Pilih Pelanggan --</option>
                                    @foreach($pelanggans as $pelanggan)
                                        <option value="{{ $pelanggan->id }}">{{ $pelanggan->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="tanggal" class="form-label">Tanggal</label>
                                <input type="date" name="tanggal" id="tanggal" class="form-control" 
                                    value="{{ date('Y-m-d') }}" required>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <h5 class="mb-3">Daftar Barang</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="barangTable">
                            <thead class="table-light">
                                <tr>
                                    <th width="30%">Barang</th>
                                    <th width="15%">Harga</th>
                                    <th width="15%">Jumlah</th>
                                    <th width="15%">Subtotal</th>
                                    <th width="10%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <select name="barang_id[]" class="form-select barang-select" required>
                                            <option value="">-- Pilih Barang --</option>
                                            @foreach($barangs as $barang)
                                                <option value="{{ $barang->id }}" data-harga="{{ $barang->harga_jual }}">
                                                    {{ $barang->nama }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <input type="number" name="harga[]" class="form-control harga" readonly>
                                    </td>
                                    <td>
                                        <input type="number" name="jumlah[]" class="form-control jumlah" min="1" value="1" required>
                                    </td>
                                    <td>
                                        <input type="number" name="subtotal[]" class="form-control subtotal" readonly>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-danger btn-sm removeRow">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="3" class="text-end">Total:</th>
                                    <th colspan="2">
                                        <input type="number" id="total" class="form-control fw-bold" readonly>
                                    </th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <button type="button" id="addRow" class="btn btn-success">
                        <i class="fas fa-plus"></i> Tambah Barang
                    </button>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times"></i> Batal
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan Transaksi
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Detail Transaksi -->
<div class="modal fade" id="detailModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title">Detail Transaksi</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="detailBody">
                <p>Memuat data...</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    // Inisialisasi data harga
    const hargaBarang = {};
    @foreach($barangs as $barang)
        hargaBarang[{{ $barang->id }}] = {{ $barang->harga_jual }};
    @endforeach

    // Fungsi hitung subtotal
    function hitungSubtotal(row) {
        const harga = parseFloat(row.find('.harga').val()) || 0;
        const jumlah = parseInt(row.find('.jumlah').val()) || 0;
        const subtotal = harga * jumlah;
        row.find('.subtotal').val(subtotal.toFixed(2));
        return subtotal;
    }

    // Fungsi hitung total
    function hitungTotal() {
        let total = 0;
        $('#barangTable tbody tr').each(function() {
            total += hitungSubtotal($(this));
        });
        $('#total').val(total.toFixed(2));
    }

    // Event ketika pilih barang
    $(document).on('change', '.barang-select', function() {
        const row = $(this).closest('tr');
        const barangId = $(this).val();
        const harga = hargaBarang[barangId] || 0;
        row.find('.harga').val(harga);
        hitungSubtotal(row);
        hitungTotal();
    });

    // Event ketika jumlah diubah
    $(document).on('input', '.jumlah', function() {
        const row = $(this).closest('tr');
        hitungSubtotal(row);
        hitungTotal();
    });

    // Tambah baris baru
    $('#addRow').click(function() {
        const newRow = `
        <tr>
            <td>
                <select name="barang_id[]" class="form-select barang-select" required>
                    <option value="">-- Pilih Barang --</option>
                    @foreach($barangs as $barang)
                        <option value="{{ $barang->id }}" data-harga="{{ $barang->harga_jual }}">
                            {{ $barang->nama }}
                        </option>
                    @endforeach
                </select>
            </td>
            <td>
                <input type="number" name="harga[]" class="form-control harga" readonly>
            </td>
            <td>
                <input type="number" name="jumlah[]" class="form-control jumlah" min="1" value="1" required>
            </td>
            <td>
                <input type="number" name="subtotal[]" class="form-control subtotal" readonly>
            </td>
            <td>
                <button type="button" class="btn btn-danger btn-sm removeRow">
                    <i class="fas fa-trash"></i>
                </button>
            </td>
        </tr>`;
        $('#barangTable tbody').append(newRow);
    });

    // Hapus baris
    $(document).on('click', '.removeRow', function() {
        if ($('#barangTable tbody tr').length > 1) {
            $(this).closest('tr').remove();
            hitungTotal();
        } else {
            alert('Minimal harus ada 1 barang dalam transaksi');
        }
    });

    // Load detail transaksi
    $('.btn-detail').click(function() {
        const transaksiId = $(this).data('id');
        $('#detailBody').html('<p>Memuat data...</p>');
        
        $.get(`/transaksi/${transaksiId}`, function(data) {
            $('#detailBody').html(data);
            $('#detailModal').modal('show');
        }).fail(function() {
            $('#detailBody').html('<p class="text-danger">Gagal memuat data detail transaksi</p>');
        });
    });

    // Inisialisasi perhitungan pertama kali
    hitungTotal();
});
</script>
@endsection
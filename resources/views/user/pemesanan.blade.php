@extends('template.bar')

@section('content')
<div class="col-sm-12">
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <div class="header-title">
                <h4 class="card-title">List Pesanan Saya</h4>
            </div>
        </div>
        <div class="card-body">
            <div class="row d-flex mb-4">
                <div class="col  text-right">
                </div>
            </div>
            <div class="table-responsive">
                <div id="datatable_wrapper" class="dataTables_wrapper">
                    <table id="datatable" class="table data-table table-striped dataTable" role="grid" aria-describedby="datatable_info">
                        <thead>
                            <tr class=" justify-content-center" role="row">
                            <tr class="ligth sorting_asc" role="row" tabindex="0" aria-controls="datatable" aria-sort="ascending" aria-label="activate to sort column descending" style="width: auto;">
                                <th style="text-align: center;">No</th>
                                <th style="text-align:center">Nomor Pesanan</th>
                                <th style="text-align:center">Total Harga</th>
                                <th style="text-align:center">Status</th>
                                <th style="text-align:center">Tanggal</th>
                                <th style="text-align:center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pemesanans as $index => $pemesanan)
                            <tr role="row" class="odd">
                                <td style="text-align: center;" class="sorting_1">{{ $index+1 }}</td>
                                <td style="text-align:center">{{ $pemesanan->no_pemesanan }}</td>
                                <td style="text-align:center">{{ $pemesanan->total_harga }}</td>
                                @if($pemesanan->status == "konfirmasi" && $pemesanan->status_pengembalian == 1)
                                    <td style="text-align: center;">Selesai</td>
                                @else
                                    <td style="text-align: center;">{{ $pemesanan->status }}</td>
                                @endif
                                <td style="text-align: center;">{{ $pemesanan->created_at }}</td>
                                <td style="text-align: center;">
                                    <div class="btn-group" role="group" aria-label="Basic mixed styles example" data-toggle="modal">
                                        <button type="button" data-target="#detailpemesanan{{ $pemesanan->id }}" data-toggle="modal" class="btn btn-primary"><i class="fa-solid fa-eye"></i></button>
                                        <!-- <button type="button" data-target="#editdataproduct" data-toggle="modal" class="btn btn-primary"><i class="fa-solid fa-edit"></i></button> -->
                                        <!-- <button type="button" class="btn btn-primary"><i class="fa-solid fa-trash"></i></button> -->
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@foreach($pemesanans as $pemesanan)
<!-- Detail Pesanan Modal -->
<div class="modal fade" id="detailpemesanan{{ $pemesanan->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header merah text-putih">
                <h4 class="modal-title" id="exampleModalLabel">Detail Pesanan</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="" action="">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group mb-3">
                                <label class="form-label">No Pesanan</label>
                                <input type="text" class="form-control" name="no_pemesanan" value="{{ $pemesanan->no_pemesanan }}" placeholder="Masukkan Jumlah" disabled>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group mb-3">
                                <label class="form-label">Total Harga</label>
                                <input type="text" class="form-control" name="total_harga" value="{{ $pemesanan->total_harga }}" placeholder="Masukkan Jumlah" disabled>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group mb-3">
                                <label class="form-label">Status</label>
                                @if($pemesanan->status == "konfirmasi" && $pemesanan->status_pengembalian == 1)
                                <input type="text" class="form-control" name="total_harga" value="Selesai" placeholder="Masukkan Jumlah" disabled>
                                @else
                                <input type="text" class="form-control" name="total_harga" value="{{ $pemesanan->status }}" placeholder="Masukkan Jumlah" disabled>
                                @endif
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group mb-3">
                                <label class="form-label">Tanggal</label>
                                <input type="text" class="form-control" name="total_harga" value="{{ $pemesanan->created_at }}" placeholder="Masukkan Jumlah" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama Produk</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Jumlah</th>
                            <th scope="col">Hari</th>
                            <th scope="col">SubTotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pemesanan->items as $index => $item)
                            <tr>
                                <th scope="row">{{ $index+1 }}</th>
                                <td>{{ $item->barang->nama }}</td>
                                <td>{{ $item->harga }}</td>
                                <td>{{ $item->jumlah }}</td>
                                <td>{{ $item->jumlah_hari}}</td>
                                <td>{{ $item->sub_total }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <!-- <button type="submit" class="btn btn-primary">Submit</button> -->
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach


<!-- Edit Data Product Modal -->
<div class="modal fade" id="editdataproduct" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header merah text-putih">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data Product</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="" action="">
                    <div class="form-group row mb-6">
                        <label class="col-md-3 col-form-label">Nama Barang</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="codematerial_sparepart" value="" disabled placeholder="Nama Barang 1">
                        </div>
                    </div>
                    <div class="form-group row mb-6">
                        <label class="col-md-3 col-form-label">Jumlah Barang</label>
                        <div class="col-md-9">
                            <input type="number" class="form-control" name="jumlah_product" value="" placeholder="Masukkan Jumlah">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <!-- <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button> -->
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
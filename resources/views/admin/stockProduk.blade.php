@extends('template.barAdmin')
@section('content')

<div class="col-sm-12">
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <div class="header-title">
                <h4 class="card-title">Products</h4>
            </div>
        </div>
        <div class="card-body">
            <div class="row d-flex mb-4">
                <div class="col  text-right">
                    <a href="#" class="btn btn-primary" data-target="#addproduct" data-toggle="modal"><i class="mr-2 fa fa-plus"></i>Tambahkan Produk</a>
                </div>
            </div>
            <div class="table-responsive">
                <div id="datatable_wrapper" class="dataTables_wrapper">
                    <table id="datatable" class="table data-table table-striped dataTable" role="grid" aria-describedby="datatable_info">
                        <thead>
                            <tr class=" justify-content-center" role="row">
                            <tr class="ligth sorting_asc" role="row" tabindex="0" aria-controls="datatable" aria-sort="ascending" aria-label="activate to sort column descending" style="width: auto;">
                                <th style="text-align: center;">No</th>
                                <th style="text-align:center">Kode Barang</th>
                                <th style="text-align:center">Nama Barang</th>
                                <th style="text-align:center">Harga</th>
                                <th style="text-align:center">Total Stock</th>
                                <th style="text-align:center">Stock Ready</th>
                                <th style="text-align:center">Stock Booking</th>
                                <th style="text-align:center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($barangs as $index => $barang)
                                <tr role="row" class="odd">
                                    <td style="text-align: center;" class="sorting_1">{{ $index+1 }}</td>
                                    <td style="text-align:center">{{ $barang->kode }}</td>
                                    <td style="text-align:center">{{ $barang->nama }}</td>
                                    <td style="text-align:center">{{ $barang->harga }}</td>
                                    <td style="text-align: center;">{{ $barang->stock }}</td>
                                    <td style="text-align: center;">{{ $barang->stock_ready }}</td>
                                    <td style="text-align: center;">{{ $barang->stock_booking }}</td>
                                    <td style="text-align: center;">
                                        <div class="btn-group" role="group" aria-label="Basic mixed styles example" data-toggle="modal">
                                            <button type="button" data-target="#editdataproduct{{$barang->id}}" data-toggle="modal" class="btn btn-primary"><i class="fa-solid fa-edit"></i></button>
                                            <button type="button" data-target="#deletedataproduct{{$barang->id}}" data-toggle="modal" class="btn btn-primary"><i class="fa-solid fa-trash"></i></button>
                                        </div>
                                    </td>
                                </tr>
                                <!-- Edit Data Product Modal -->
                                <div class="modal fade" id="editdataproduct{{ $barang->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header merah text-putih">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data Product</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="POST" action="{{ route('admin.stockProduk.update',$barang->id) }}">
                                                    @method('PATCH')
                                                    @csrf
                                                    <div class="form-group row mb-6">
                                                        <label class="col-md-3 col-form-label">Nama Product</label>
                                                        <div class="col-md-9">
                                                            <input type="hidden" name="barang_id" value="{{ $barang->id }}">
                                                            <input type="text" class="form-control" name="nama" value="{{ $barang->nama }}" placeholder="Masukkan Nama Product">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row mb-6">
                                                        <label class="col-md-3 col-form-label">Harga Product</label>
                                                        <div class="col-md-9">
                                                            <input type="number" class="form-control" name="harga" value="{{ $barang->harga }}" placeholder="Masukkan Harga">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row mb-6">
                                                        <label class="col-md-3 col-form-label">Stock Product</label>
                                                        <div class="col-md-9">
                                                            <input type="number" class="form-control" name="stock" value="{{ $barang->stock }}" placeholder="Masukkan Jumlah Stock">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Hapus Data Product Modal -->
                                <div class="modal fade" id="deletedataproduct{{ $barang->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header merah text-putih">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Data Product</h1>
                                                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Apakah anda yakin akan menghapus data ini&hellip;</p>
                                                <form method="POST" action="{{ route('admin.stockProduk.destroy',$barang->id) }}">
                                                    @method('DELETE')
                                                    @csrf
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Hapus</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Product Modal -->
<div class="modal fade" id="addproduct" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header merah text-putih">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add Product</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.stockProduk.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mb-3">
                        <label class="form-label">Nama Product</label>
                        <input type="text" class="form-control" name="nama" value="" placeholder="Masukkan Nama Barang" required>
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label">Foto Product</label>
                        <input type="file" class="form-control" name="foto" required>
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label">Harga</label>
                        <input type="number" class="form-control" name="harga" value="" placeholder="Masukkan Harga">
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label">Stock Awal</label>
                        <input type="number" class="form-control" name="stock" value="" placeholder="Masukkan Jumlah">
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

@section('js')
@endsection
@extends('template.bar')

@section('content')
<div class="col-sm-12">
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <div class="header-title">
                <h4 class="card-title">Keranjang</h4>
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
                                <th style="text-align:center">Harga Barang</th>
                                <th style="text-align:center">Jumlah</th>
                                <th style="text-align:center">Sub Total</th>
                                <th style="text-align:center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $total = 0; ?>
                            @foreach($keranjangs as $index => $keranjang)
                                <?php $total += $keranjang->jumlah *$keranjang->barang->harga; ?>
                                <tr role="row" class="odd">
                                    <td style="text-align: center;" class="sorting_1">{{ $index+1 }}</td>
                                    <td style="text-align:center">{{ $keranjang->barang->kode }}</td>
                                    <td style="text-align:center">{{ $keranjang->barang->nama }}</td>
                                    <td style="text-align:center">{{ $keranjang->barang->harga }}</td>
                                    <td style="text-align: center;">{{ $keranjang->jumlah }}</td>
                                    <td style="text-align: center;">{{ $keranjang->jumlah *$keranjang->barang->harga  }}</td>
                                    <td style="text-align: center;">
                                        <div class="btn-group" role="group" aria-label="Basic mixed styles example" data-toggle="modal">
                                            <button type="button" data-target="#editdataproduct{{ $keranjang->id }}" data-toggle="modal" class="btn btn-primary"><i class="fa-solid fa-edit"></i></button>
                                            <button type="button" data-target="#deletedataproduct{{ $keranjang->id }}" data-toggle="modal" class="btn btn-primary"><i class="fa-solid fa-trash"></i></button>
                                        </div>
                                    </td>
                                </tr>
                                <!-- Edit Data Product Modal -->
                                <div class="modal fade" id="editdataproduct{{ $keranjang->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header merah text-putih">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data Keranjang</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('user.keranjang.update',$keranjang->id) }}" method="POST">
                                                    @method('PATCH')
                                                    @csrf
                                                    <div class="form-group row mb-6">
                                                        <label class="col-md-3 col-form-label">Nama Produk</label>
                                                        <div class="col-md-9">
                                                            <input type="text" class="form-control" name="nama_barang" value="{{ $keranjang->barang->nama }}" disabled placeholder="Nama Barang 1">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row mb-6">
                                                        <label class="col-md-3 col-form-label">Jumlah Barang</label>
                                                        <div class="col-md-9">
                                                            <input type="number" class="form-control" name="jumlah" value="{{ $keranjang->jumlah }}" placeholder="Masukkan Jumlah">
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
                                <!-- Hapus Data Product Modal -->
                                <div class="modal fade" id="deletedataproduct{{ $keranjang->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header merah text-putih">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Data Product</h1>
                                                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Apakah anda yakin akan menghapus data ini&hellip;</p>
                                                <form method="POST" action="{{ route('user.keranjang.destroy',$keranjang->id) }}">
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
            <div class="row d-flex mt-4">
                <div class="col">
                    <h6>Total : {{ $total }}/Hari</h6>
                </div>
                <div class="col  text-right">
                    <a href="#" class="btn btn-success" data-target="#new-project-modal" data-toggle="modal"><i class="mr-2 fa fa-table"></i>Checkout Pesanan</a>
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
                <form action="{{ route('user.keranjang.store') }}" method="POST">
                    @csrf
                    <div class="form-group mb-3">
                        <label class="form-label">Nama Barang</label>
                        <select class="form-control" name="barang">
                            @foreach($barangs as $barang)
                                <option value="{{ $barang->id }}">{{ $barang->nama }}  (Rp. {{ $barang->harga }}, stock: {{ $barang->stock_ready }})</option>
                            @endforeach
                            <!-- Tambahkan opsi barang sesuai kebutuhan -->
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label">Jumlah</label>
                        <input type="text" class="form-control" name="jumlah" value="" placeholder="Masukkan Jumlah">
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
<!-- New Project -->
<div class="modal fade" id="new-project-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header merah text-putih">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Buat Pesanan</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('user.pemesanan.store') }}" method="POST">
                    @csrf
                    <div class="form-group mb-3">
                        <label class="form-label">Jumlah Hari</label>
                        <input type="text" class="form-control" name="jumlah_hari" value="1" placeholder="Masukkan Jumlah Hari" required>
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label">Catatan</label>
                        <input type="text" class="form-control" name="catatan" value="" placeholder="Masukkan Catatan" >
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

@endsection
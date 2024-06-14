@extends('template.barAdmin')
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
                    <a href="#" class="btn btn-primary" data-target="#new-project-modal" data-toggle="modal"><i class="mr-2 fa fa-table"></i>Download Nota</a>
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
                                <th style="text-align:center">Jumlah</th>
                                <th style="text-align:center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr role="row" class="odd">
                                <td style="text-align: center;" class="sorting_1">1</td>
                                <td style="text-align:center">12345678</td>
                                <td style="text-align:center">Tenda Kap 4</td>
                                <td style="text-align: center;">4</td>
                                <td style="text-align: center;">
                                    <div class="btn-group" role="group" aria-label="Basic mixed styles example" data-toggle="modal">
                                        <button type="button" data-target="#editdataproduct" data-toggle="modal" class="btn btn-primary"><i class="fa-solid fa-edit"></i></button>
                                        <button type="button" class="btn btn-primary"><i class="fa-solid fa-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
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
                <form method="" action="">
                    <div class="form-group mb-3">
                        <label class="form-label">Nama Barang</label>
                        <select class="form-control" name="barang">
                            <option value="barang1">Barang 1</option>
                            <option value="barang2">Barang 2</option>
                            <option value="barang3">Barang 3</option>
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
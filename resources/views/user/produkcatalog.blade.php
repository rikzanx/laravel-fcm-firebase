@extends('template.bar')

@section('content')
<div class="container-fluid">
    <div class="col-lag-16">
        <div class="card">
            <div class="card-body">
                <div class="d-flex flex-wrap align-items-center justify-content-between breadcrumb-content">
                    <h5>Produk Catalog</h5>
                    <div class="d-flex flex-wrap align-items-center justify-content-between">
                        <div class="list-grid-toggle d-flex align-items-center mr-3">
                            <div data-toggle-extra="tab" data-target-extra="#grid" class="active">
                                <div class="grid-icon mr-3">
                                    <svg width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <rect x="3" y="3" width="7" height="7"></rect>
                                        <rect x="14" y="3" width="7" height="7"></rect>
                                        <rect x="14" y="14" width="7" height="7"></rect>
                                        <rect x="3" y="14" width="7" height="7"></rect>
                                    </svg>
                                </div>
                            </div>
                            <div data-toggle-extra="tab" data-target-extra="#list">
                                <div class="grid-icon">
                                    <svg width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <line x1="21" y1="10" x2="3" y2="10"></line>
                                        <line x1="21" y1="6" x2="3" y2="6"></line>
                                        <line x1="21" y1="14" x2="3" y2="14"></line>
                                        <line x1="21" y1="18" x2="3" y2="18"></line>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div class="pl-3 border-left btn-new">
                            <a href="/keranjang" class="btn btn-primary" data-target="#new-project-modal" data-toggle="modal">keranjang</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- grid content -->
<div id="grid" class="item-content animate__animated animate__fadeIn active" data-toggle-extra="tab-content">
    <!-- <div class="container-fluid"> -->
    <div class="row">
        <div class="col-lg-4 col-md-6">
            <div class="card">
                <img src="templateot/assets/images/page-img/07.jpg" class="card-img-top" alt="#">
                <div class="card-body">
                    <h4 class="card-title">Card title</h4>
                    <p class="card-text">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. </p>
                    <a href="#" class="btn btn-primary">Button</a>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="card">
                <img src="templateot/assets/images/page-img/07.jpg" class="card-img-top" alt="#">
                <div class="card-body">
                    <h4 class="card-title">Card title</h4>
                    <p class="card-text">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. </p>
                    <a href="#" class="btn btn-primary">Button</a>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="card">
                <img src="templateot/assets/images/page-img/07.jpg" class="card-img-top" alt="#">
                <div class="card-body">
                    <h4 class="card-title">Card title</h4>
                    <p class="card-text">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. </p>
                    <a href="#" class="btn btn-primary">Button</a>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="card">
                <img src="templateot/assets/images/page-img/07.jpg" class="card-img-top" alt="#">
                <div class="card-body">
                    <h4 class="card-title">Card title</h4>
                    <p class="card-text">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. </p>
                    <a href="#" class="btn btn-primary">Button</a>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="card">
                <img src="templateot/assets/images/page-img/07.jpg" class="card-img-top" alt="#">
                <div class="card-body">
                    <h4 class="card-title">Card title</h4>
                    <p class="card-text">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. </p>
                    <a href="#" class="btn btn-primary">Button</a>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="card">
                <img src="templateot/assets/images/page-img/07.jpg" class="card-img-top" alt="#">
                <div class="card-body">
                    <h4 class="card-title">Card title</h4>
                    <p class="card-text">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. </p>
                    <a href="#" class="btn btn-primary">Button</a>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="card">
                <img src="templateot/assets/images/page-img/07.jpg" class="card-img-top" alt="#">
                <div class="card-body">
                    <h4 class="card-title">Card title</h4>
                    <p class="card-text">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. </p>
                    <a href="#" class="btn btn-primary">Button</a>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="card">
                <img src="templateot/assets/images/page-img/07.jpg" class="card-img-top" alt="#">
                <div class="card-body">
                    <h4 class="card-title">Card title</h4>
                    <p class="card-text">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. </p>
                    <a href="#" class="btn btn-primary">Button</a>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="card">
                <img src="templateot/assets/images/page-img/07.jpg" class="card-img-top" alt="#">
                <div class="card-body">
                    <h4 class="card-title">Card title</h4>
                    <p class="card-text">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. </p>
                    <a href="#" class="btn btn-primary">Button</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- list content -->
<div id="list" class="item-content animate__animated animate__fadeIn" data-toggle-extra="tab-content">
    <div class="row">
        <div class="col-md-6 col-lg-4">
            <div class="card mb-2">
                <div class="row no-gutters">
                    <div class="col-md-6 col-lg-4">
                        <img src="templateot/assets/images/page-img/08.jpg" class="card-img" alt="#">
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="card-body">
                            <h4 class="card-title">Card title</h4>
                            <p class="card-text">This is a </p>
                            <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4">
            <div class="card mb-2">
                <div class="row no-gutters">
                    <div class="col-md-6 col-lg-4">
                        <img src="templateot/assets/images/page-img/08.jpg" class="card-img" alt="#">
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="card-body">
                            <h4 class="card-title">Card title</h4>
                            <p class="card-text">This is a </p>
                            <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4">
            <div class="card mb-2">
                <div class="row no-gutters">
                    <div class="col-md-6 col-lg-4">
                        <img src="templateot/assets/images/page-img/08.jpg" class="card-img" alt="#">
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="card-body">
                            <h4 class="card-title">Card title</h4>
                            <p class="card-text">This is a </p>
                            <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
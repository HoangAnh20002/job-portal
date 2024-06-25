@extends('interface.layouts.home')

@section('sidebar')
    <div class="sidebar d-none d-lg-block" style="height: 700px">
        @include('interface.layouts.sidebar')
    </div>
    <div class="offcanvas offcanvas-start d-lg-none" tabindex="-1" id="offcanvasSidebar" aria-labelledby="offcanvasSidebarLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasSidebarLabel">Sidebar</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            @include('interface.layouts.sidebar')
        </div>
    </div>
    <button id="toggleSidebar" class="btn btn-secondary d-lg-none mt-3 ml-3 py-2 px-3" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasSidebar" aria-controls="offcanvasSidebar">
        <i class="bi bi-layout-text-sidebar"></i>
    </button>
@endsection

@section('content')
    <div class="container">
        <h2 class="my-4">Thống kê</h2>
        <div class="row">
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-body d-flex">
                        <div class="p-4 bg-primary-subtle mr-3">
                            <i class="bi bi-cash"></i>
                        </div>
                        <div>
                        <h5 class="card-title">Tổng số Doanh thu</h5>
                        <p class="card-text">{{ $sumAmounts }} VND</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-body d-flex">
                        <div class="p-4 bg-primary mr-3">
                            <i class="bi bi-people"></i>
                        </div>
                        <div>
                        <h5 class="card-title">Tổng số Người dùng</h5>
                        <p class="card-text">{{ $totalUsers }} người</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-body d-flex">
                        <div class="p-4 bg-success-subtle mr-3">
                            <i class="bi bi-person-badge"></i>
                        </div>
                        <div>
                        <h5 class="card-title">Tổng số Nhà tuyển dụng</h5>
                        <p class="card-text">{{ $totalEmployers }} người</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-body d-flex">
                        <div class="p-4 bg-success mr-3">
                            <i class="bi bi-person"></i>
                        </div>
                        <div>
                        <h5 class="card-title">Tổng số Người tìm việc</h5>
                        <p class="card-text">{{ $totalJobSeekers }} người</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-body d-flex">
                        <div class="p-4 bg-warning mr-3">
                            <i class="bi bi-person-vcard"></i>
                        </div>
                        <div>
                        <h5 class="card-title">Tổng số Ứng tuyển</h5>
                        <p class="card-text">{{ $totalApplications }} ứng tuyển</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-body d-flex">
                        <div class="p-4 bg-info mr-3">
                            <i class="bi bi-file-earmark-post"></i>
                        </div>
                        <div>
                        <h5 class="card-title">Tổng số Bài đăng công việc</h5>
                        <p class="card-text">{{ $totalPostJobs }} bài đăng</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

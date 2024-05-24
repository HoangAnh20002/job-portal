@extends('interface.layouts.home')

@section('sidebar')
    @include('interface.layouts.sidebar')
@endsection

@section('content')
    <div class="container">
        <h2 class="my-4">Thống kê</h2>
        <div class="row">
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Tổng số Người dùng</h5>
                        <p class="card-text">{{ $totalUsers }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Tổng số Nhà tuyển dụng</h5>
                        <p class="card-text">{{ $totalEmployers }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Tổng số Người tìm việc</h5>
                        <p class="card-text">{{ $totalJobSeekers }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Tổng số Công ty</h5>
                        <p class="card-text">{{ $totalCompanies }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Tổng số Ứng tuyển</h5>
                        <p class="card-text">{{ $totalApplications }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Tổng số Bài đăng công việc</h5>
                        <p class="card-text">{{ $totalPostJobs }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

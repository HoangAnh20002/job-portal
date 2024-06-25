@extends('interface.layouts.home')

@section('sidebar')
    <div class="sidebar d-none d-lg-block" style="height: 700px;">
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
    <style>
        .table-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }
        .table-wrapper {
            width: 48%;
            margin-bottom: 20px;
        }
        .card-header {
            background-color: #007bff;
            color: white;
            padding: 15px;
        }
        .card-body {
            background-color: #f8f8f8;
            padding: 20px;
        }
        .table {
            margin-bottom: 0;
        }
    </style>
    <div class="container">
        <div class="row my-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Dịch vụ</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-container">
                            <!-- Table 1 -->
                            <div class="table-wrapper">
                                <table class="table table-bordered table-hover">
                                    <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">Tên dịch vụ</th>
                                        <th scope="col">Mô tả</th>
                                        <th scope="col">Giá</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($services as $index => $service)
                                        @if($index % 2 == 0)
                                            <tr>
                                                <td>{{ $service->name }}</td>
                                                <td>{{ $service->description }}</td>
                                                <td>{{ $service->price }}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>
                                @if($role_id == \App\Enums\Base::EMPLOYER)
                                    <div class="d-flex justify-content-center mt-3">
                                        @if($paymentCount > 5)
                                            <button class="bg-secondary text-white btn" disabled>Dịch vụ đã đạt giới hạn</button>
                                        @elseif($isService1Registered)
                                            <button class="bg-secondary text-white btn" disabled>Bạn đã đăng ký dịch vụ này</button>
                                        @else
                                            <a href="{{ route('createPayment', ['amount' => 500000, 'service_id' => 1, 'postjob_id' => $post_job]) }}">
                                                <button class="bg-primary text-white btn">Thanh toán dịch vụ</button>
                                            </a>
                                        @endif
                                    </div>
                                @endif
                            </div>
                            <!-- Table 2 -->
                            <div class="table-wrapper">
                                <table class="table table-bordered table-hover">
                                    <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">Tên dịch vụ</th>
                                        <th scope="col">Mô tả</th>
                                        <th scope="col">Giá</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($services as $index => $service)
                                        @if($index % 2 != 0)
                                            <tr>
                                                <td>{{ $service->name }}</td>
                                                <td>{{ $service->description }}</td>
                                                <td>{{ $service->price }}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>
                                @if($role_id == \App\Enums\Base::EMPLOYER)
                                    <div class="d-flex justify-content-center mt-3">
                                        @if($isService2Registered)
                                            <button class="bg-secondary text-white btn" disabled>Bạn đã đăng ký dịch vụ này</button>
                                        @else
                                            <a href="{{ route('createPayment', ['amount' => 100000, 'service_id' => 2, 'postjob_id' => $post_job]) }}">
                                                <button class="bg-primary text-white btn">Thanh toán dịch vụ</button>
                                            </a>
                                        @endif
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

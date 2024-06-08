@extends('interface.layouts.home')

@section('sidebar')
    @include('interface.layouts.sidebar')
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
                                    <a href="{{ route('create-payment') }}">
                                        <button class="bg-primary text-white btn">Thanh toán dịch vụ</button>
                                    </a>
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
                                @if($role_id ==  \App\Enums\Base::EMPLOYER)
                                <div class="d-flex justify-content-center mt-3">
                                    <a href="{{ route('create-payment') }}">
                                        <button class="bg-primary text-white btn">Thanh toán dịch vụ</button>
                                    </a>
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

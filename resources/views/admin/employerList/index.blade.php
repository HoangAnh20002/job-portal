@extends('interface.layouts.home')

@section('sidebar')
    @include('interface.layouts.sidebar')
@endsection

@section('content')
    <div class="container">
        <h2 class="my-4">Danh sách Nhà tuyển dụng</h2>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên</th>
                    <th>Email</th>
                    <th>Công ty</th>
                    <th>Thông tin liên hệ</th>
                </tr>
                </thead>
                <tbody>
                @foreach($employers as $employer)
                    <tr>
                        <td>{{ $employer->id }}</td>
                        <td>{{ $employer->user->username ?? 'N/A' }}</td>
                        <td>{{ $employer->user->email ?? 'N/A' }}</td>
                        <td>{{ $employer->company->company_name ?? 'N/A' }}</td>
                        <td>{{ $employer->contact_info ?? 'N/A' }}</td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>
    <div class="mb-5 mt-5">
        {{ $employers->appends(request()->query())->setPath(route('user.employer'))->links('vendor.pagination.bootstrap-5') }}
    </div>
@endsection

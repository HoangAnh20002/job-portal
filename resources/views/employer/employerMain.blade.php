@extends('interface.layouts.home')

@section('sidebar')
    @include('interface.layouts.sidebar')
@endsection

@section('content')
    <style>
        .avatar {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            margin-top: 10px;
            border: 2px solid #ddd;
        }

        .company-logo {
            max-width: 100px;
            height: auto;
            border: 2px solid #ddd;
            padding: 5px;
            background-color: #f8f8f8;
        }

        .card-header {
            background-color: #007bff;
            color: white;
            padding: 15px;
        }

        .card-body h5 {
            color: #007bff;
            margin-bottom: 15px;
        }

        .form-group label {
            font-weight: bold;
        }
    </style>
    @include('interface.layouts.alert')
    <div class="container">
        <div class="row my-4">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h4>Thông tin cá nhân của Nhà tuyển dụng</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h5>Thông tin cá nhân</h5>
                                <p><strong>Tên người dùng:</strong> {{ $employer->user->username ?? 'Chưa cập nhật' }}
                                </p>
                                <p><strong>Email:</strong> {{ $employer->user->email ?? 'Chưa cập nhật' }}</p>
                                <div class="mb-3">
                                    <div><strong>Avatar:</strong></div>
                                    @if($employer->user->avatar)
                                        <img class="avatar"
                                             src="{{ asset('storage/avatars/'.$employer->user->avatar) }}" alt="Avatar">
                                    @else
                                        <p>Chưa có avatar</p>
                                    @endif
                                </div>
                                <p><strong>Thông tin liên hệ:</strong> {{ $employer->contact_info ?? 'Chưa cập nhật' }}
                                </p>
                            </div>
                            <div class="col-md-6">
                                <h5>Thông tin công ty</h5>
                                <p><strong>Tên công
                                        ty:</strong> {{ $employer->company->company_name ?? 'Chưa cập nhật' }}</p>
                                <div class="mb-3">
                                    <div><strong>Logo công ty:</strong></div>
                                    @if(isset($employer->company) && $employer->company->logo)
                                        <img class="h-25 w-25"
                                             src="{{ asset('storage/logos/'.$employer->company->logo) }}" alt="Logo">
                                    @else
                                        <p>Chưa có logo</p>
                                    @endif

                                </div>
                                <p><strong>Ngành:</strong> {{ $employer->company->industry ?? 'Chưa cập nhật' }}</p>
                                <p><strong>Mô tả:</strong> {{ $employer->company->description ?? 'Chưa cập nhật' }}</p>
                                <p><strong>Vị trí:</strong> {{ $employer->company->location ?? 'Chưa cập nhật' }}</p>
                                <p><strong>Website:</strong>
                                    @if($employer->company)
                                        <a href="{{ $employer->company->website }}"
                                           target="_blank">{{ $employer->company->website ?? 'Chưa cập nhật' }}</a>
                                    @else
                                        {{ 'Chưa cập nhật' }}
                                    @endif
                                </p>
                                <p><strong>Số điện thoại công
                                        ty:</strong> {{ $employer->company->phone ?? 'Chưa cập nhật' }}</p>
                            </div>
                        </div>
                        <a href="{{ route('employer.edit', ['employer' => $employer->id]) }}"
                           class="btn btn-primary mt-4">Cập nhật thông tin</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

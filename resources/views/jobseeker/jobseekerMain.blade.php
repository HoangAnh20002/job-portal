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
    <div class="container">
        <div class="row my-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h4>Thông tin cá nhân của Người ứng tuyển</h4>
                    </div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if(session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        <div class="row">
                            <div class="col-md-6">
                                <h5>Thông tin cá nhân</h5>
                                <p><strong>Tên người dùng:</strong> {{ $jobseeker->user->username ?? 'Chưa cập nhật' }}</p>
                                <p><strong>Email:</strong> {{ $jobseeker->user->email ?? 'Chưa cập nhật' }}</p>
                                <div class="mb-3">
                                    <div><strong>Avatar:</strong></div>
                                    @if($jobseeker->user->avatar)
                                        <img class="avatar" src="{{ asset('storage/avatars/'.$jobseeker->user->avatar) }}" alt="Avatar">
                                    @else
                                        <p>Chưa có avatar</p>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h5>Thông tin ứng tuyển</h5>
                                <p><strong>Sơ yếu lý lịch (CV):</strong>
                                    @if(isset($jobseeker->resume))
                                        <a href="{{ asset('storage/resumes/' . $jobseeker->resume) }}" target="_blank">Xem CV</a>
                                    @else
                                        Chưa cập nhật
                                    @endif
                                </p>
                                <p><strong>Thư xin việc:</strong> {{ $jobseeker->cover_letter ?? 'Chưa cập nhật' }}</p>
                                <p><strong>Thông tin liên hệ:</strong> {{ $jobseeker->contact_info ?? 'Chưa cập nhật' }}</p>
                            </div>
                        </div>

                        <a href="{{ route('jobseeker.edit', ['jobseeker' => $jobseeker->id]) }}" class="btn btn-primary mt-4">Cập nhật thông tin</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

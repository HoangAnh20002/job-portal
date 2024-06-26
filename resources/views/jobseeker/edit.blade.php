@extends('interface.layouts.home')

@section('sidebar')
    <div class="sidebar d-none d-lg-block" style="height: 1000px;">
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
    @include('interface.layouts.alert')
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
    <div class="container">
        <div class="row my-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h4>Cập nhật thông tin cá nhân của Người ứng tuyển</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('jobseeker.update', ['jobseeker' => $jobseeker->id]) }}" method="POST"
                              enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="row">
                                <div class="col-md-6">
                                    <h5>Thông tin cá nhân</h5>
                                    <div class="form-group">
                                        <label for="username">Tên người dùng</label>
                                        <input type="text" name="username" id="username" class="form-control"
                                               value="{{ old('username', $jobseeker->user->username) }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" name="email" id="email" class="form-control"
                                               value="{{ old('email', $jobseeker->user->email) }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="avatar">Avatar</label>
                                        <input type="file" name="avatar" id="avatar" class="form-control">
                                        @if($jobseeker->user->avatar)
                                            <img class="avatar"
                                                 src="{{ asset('storage/avatars/'.$jobseeker->user->avatar) }}"
                                                 alt="Avatar">
                                        @else
                                            <p>Chưa có avatar</p>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <h5>Thông tin ứng tuyển</h5>
                                    <div class="form-group">
                                        <label for="resume">Sơ yếu lý lịch (CV)</label>
                                        <input type="file" name="resume" id="resume" class="form-control">
                                        @if($jobseeker->resume)
                                            <a href="{{ asset('storage/resumes/' . $jobseeker->resume) }}"
                                               target="_blank">Xem CV hiện tại</a>
                                        @else
                                            <p>Chưa cập nhật</p>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="cover_letter">Lời nhắn thêm</label>
                                        <textarea name="cover_letter" id="cover_letter"
                                                  class="form-control">{{ old('cover_letter', $jobseeker->cover_letter) }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="contact_info">Thông tin liên hệ</label>
                                        <input type="text" name="contact_info" id="contact_info" class="form-control"
                                               value="{{ old('contact_info', $jobseeker->contact_info) }}">
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary mt-4">Cập nhật thông tin</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

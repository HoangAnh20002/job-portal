@extends('interface.layouts.home')

@section('sidebar')
    <div class="sidebar d-none d-lg-block">
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
    <div class="container">
        <h2 class="my-4">Tạo người ứng tuyển</h2>
        <div class="card mb-4">
            <div class="card-header">Thông Tin ứng tuyển</div>
            <div class="card-body">
                <form action="{{ route('jobseeker.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label for="username" class="form-label">Tên Người Dùng <span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="username" name="username"
                               value="{{ old('username') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}"
                               required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Mật khẩu <span class="text-danger">*</span></label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>

                    <div class="mb-3">
                        <label for="resume" class="form-label">CV (PDF)</label>
                        <input type="file" class="form-control" id="resume" name="resume" accept="application/pdf">
                    </div>

                    <div class="mb-3">
                        <label for="cove_letter" class="form-label">Lời Nhắn Thêm</label>
                        <textarea class="form-control" id="cove_letter" name="cove_letter"
                                  rows="3">{{ old('additional_message') }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="contact_info" class="form-label">Thông Tin Liên Hệ</label>
                        <textarea class="form-control" id="contact_info" name="contact_info"
                                  rows="3">{{ old('contact_info') }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Tạo Tài Khoản Người Tìm Việc</button>
                </form>
            </div>
        </div>

    </div>

@endsection

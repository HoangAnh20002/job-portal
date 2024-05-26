@extends('interface.layouts.home')

@section('sidebar')
    @include('interface.layouts.sidebar')
@endsection

@section('content')
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if(session(('error')))
        <div class="alert alert-danger">
            {{session('error')}}
        </div>
    @endif
    <div class="container">
        <h2 class="my-4">Chỉnh Sửa Thông Tin Người Tìm Việc</h2>

        <div class="card mb-4">
            <div class="card-header">Thông Tin Người Tìm Việc</div>
            <div class="card-body">
                <form action="{{ route('jobseeker.update', $jobseeker->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="username" class="form-label">Tên Người Dùng <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="username" name="username" value="{{ old('username', $jobseeker->user->username) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $jobseeker->user->email) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Mật khẩu <span class="text-danger">*</span></label>
                        <input type="password" class="form-control" id="password" name="password">
                        <small class="form-text text-muted">Để trống nếu không muốn thay đổi mật khẩu</small>
                    </div>

                    <div class="mb-3">
                        <label for="resume" class="form-label">CV (PDF)</label>
                        @if($jobseeker->resume)
                            <div>
                                <a href="{{ asset('storage/resumes/' . $jobseeker->resume) }}" target="_blank">Xem CV hiện tại</a>
                            </div>
                        @endif
                        <input type="file" class="form-control" id="resume" name="resume" accept="application/pdf">
                    </div>

                    <div class="mb-3">
                        <label for="cover_letter" class="form-label">Lời Nhắn Thêm</label>
                        <textarea class="form-control" id="cover_letter" name="cover_letter" rows="3">{{ old('cover_letter', $jobseeker->cover_letter) }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="contact_info" class="form-label">Thông Tin Liên Hệ</label>
                        <textarea class="form-control" id="contact_info" name="contact_info" rows="3">{{ old('contact_info', $jobseeker->contact_info) }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Cập Nhật Thông Tin</button>
                </form>
            </div>
        </div>

    </div>

@endsection

@extends('interface.layouts.home')

@section('sidebar')
    @include('interface.layouts.sidebar')
@endsection

@section('content')
    @include('interface.layouts.alert')
    <div class="container">
        <h2 class="my-4">Chỉnh Sửa Thông Tin Nhà Tuyển Dụng</h2>
        <form action="{{ route('employer.update', $employer->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card mb-4">
                <div class="card-header">Thông Tin Nhà Tuyển Dụng</div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="username" class="form-label">Tên <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="username" name="username"
                               value="{{ $employer->user->username }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" id="email" name="email"
                               value="{{ $employer->user->email }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Mật khẩu <span class="text-danger">*</span></label>
                        <input type="password" class="form-control" id="password" name="password">
                        <small class="form-text text-muted">Để trống nếu không muốn thay đổi mật khẩu</small>
                    </div>
                    <div class="mb-3">
                        <label for="contact_info" class="form-label">Thông Tin Liên Lạc</label>
                        <textarea class="form-control" id="contact_info" name="contact_info"
                                  rows="3">{{ $employer->contact_info }}</textarea>
                    </div>
                    <div class="mb-3">
                        <div>Avatar hiện tại:</div>
                        @if($employer->user->avatar)
                            <img class="h-25 w-25" src="{{ asset('storage/avatars/'.$employer->user->avatar) }}"
                                 alt="Avatar">
                        @else
                            <p>Chưa có avatar</p>
                            @endif
                            </br>
                            <label for="avatar" class="form-label">Chọn avatar mới: </label>
                            <div class="input-group mb-3">
                                <label class="input-group-text" for="inputGroupFile01">Avatar</label>
                                <input type="file" class="form-control" id="inputGroupFile01" name="avatar"
                                       accept="image/png, image/jpeg" onchange="previewImage1(this)">
                            </div>
                            <div id="imagePreview1" class="mt-2 mb-2" style="display: none;">
                                <img id="preview1" src="#" alt="Avatar Preview" style="max-width: 200px;">
                                <button type="button" class="btn btn-outline-secondary mt-2" onclick="removeImage1()">
                                    Remove Image
                                </button>
                            </div>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">Thông Tin Công Ty</div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="company_name" class="form-label">Tên Công Ty</label>
                        <input type="text" class="form-control" id="company_name" name="company_name"
                               value="{{ $employer->company->company_name}}">
                    </div>
                    <div class="mb-3">
                        <label for="industry" class="form-label">Ngành</label>
                        <input type="text" class="form-control" id="industry" name="industry"
                               value="{{ $employer->company->industry }}">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Mô Tả</label>
                        <textarea class="form-control" id="description" name="description"
                                  rows="3">{{ $employer->company->description }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="location" class="form-label">Vị Trí</label>
                        <input type="text" class="form-control" id="location" name="location"
                               value="{{ $employer->company->location }}">
                    </div>
                    <div class="mb-3">
                        <label for="website" class="form-label">Website</label>
                        <input type="url" class="form-control" id="website" name="website"
                               value="{{ $employer->company->website }}">
                    </div>
                    <div class="mb-3">
                        <div>Logo hiện tại:</div>
                        @if($employer->company->logo)
                            <img class="h-25 w-25" src="{{ asset('storage/logos/'.$employer->company->logo) }}"
                                 alt="Avatar">
                        @else
                            <p>Chưa có logo</p>
                            @endif
                            </br>
                            <label for="avatar" class="form-label">Chọn logo mới: </label>
                            <input type="file" class="form-control" id="inputGroupFile02" name="logo"
                                   accept="image/png, image/jpeg" onchange="previewImage2(this)">
                            <div id="imagePreview2" class="mt-2 mb-2" style="display: none;">
                                <img id="preview2" src="#" alt="Logo Preview" style="max-width: 200px;">
                                <button type="button" class="btn btn-outline-secondary mt-2" onclick="removeImage2()">
                                    Remove Image
                                </button>
                            </div>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Số Điện Thoại</label>
                        <input type="text" class="form-control" id="phone" name="phone"
                               value="{{ $employer->company->phone }}">
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary mb-4">Cập Nhật Thông Tin Nhà Tuyển Dụng</button>
        </form>
    </div>

@endsection
<script>
    function previewImage1(input) {
        var preview = document.getElementById('preview1');
        var imagePreview = document.getElementById('imagePreview1');

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                preview.src = e.target.result;
                imagePreview.style.display = 'block';
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    function removeImage1() {
        var preview = document.getElementById('preview1');
        var imagePreview = document.getElementById('imagePreview1');
        var fileInput = document.getElementById('inputGroupFile01');

        preview.src = '#';
        imagePreview.style.display = 'none';
        fileInput.value = '';
    }

    function previewImage2(input) {
        var preview = document.getElementById('preview2');
        var imagePreview = document.getElementById('imagePreview2');

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                preview.src = e.target.result;
                imagePreview.style.display = 'block';
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    function removeImage2() {
        var preview = document.getElementById('preview2');
        var imagePreview = document.getElementById('imagePreview2');
        var fileInput = document.getElementById('inputGroupFile02');

        preview.src = '#';
        imagePreview.style.display = 'none';
        fileInput.value = '';
    }
</script>


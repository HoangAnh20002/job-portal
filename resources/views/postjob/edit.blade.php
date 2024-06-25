@extends('interface.layouts.home')

@section('sidebar')
    <div class="sidebar d-none d-lg-block"style="height: 1000px">
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
        <div class="row my-4">
            <div class="col-12">
                <h2 class="mt-2 mb-3">Chỉnh sửa Bài đăng tuyển dụng</h2>
                <div class="card">
                    <div class="card-header">
                        <div>Thông tin bài đăng tuyển dụng</div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('postjob.update', ['postjob' => $postjob->id]) }}" method="POST">
                            @csrf
                            @method('PATCH')

                            <div class="form-group">
                                <label for="job_title">Tiêu đề công việc:</label>
                                <input type="text" class="form-control" id="job_title" name="job_title"
                                       value="{{ old('job_title', $postjob->job_title) }}" required>
                            </div>

                            <div class="form-group mt-3">
                                <label for="job_description">Mô tả công việc:</label>
                                <textarea class="form-control" id="job_description" name="job_description" rows="5"
                                          required>{{ old('job_description', $postjob->job_description) }}</textarea>
                            </div>

                            <div class="form-group mt-3">
                                <label for="job_requirement">Yêu cầu công việc:</label>
                                <textarea class="form-control" id="job_requirement" name="job_requirement" rows="5"
                                          required>{{ old('job_requirement', $postjob->job_requirement) }}</textarea>
                            </div>

                            <div class="form-group mt-3">
                                <label for="salary">Lương:</label>
                                <input type="number" class="form-control" id="salary" name="salary"
                                       value="{{ old('salary', $postjob->salary) }}" required>
                            </div>

                            <div class="form-group mt-3">
                                <label for="employment_type">Loại công việc:</label>
                                <select class="form-control" id="employment_type" name="employment_type" required>
                                    <option
                                        value="1" {{ old('employment_type', $postjob->employment_type) == 1 ? 'selected' : '' }}>
                                        Toàn thời gian
                                    </option>
                                    <option
                                        value="2" {{ old('employment_type', $postjob->employment_type) == 2 ? 'selected' : '' }}>
                                        Bán thời gian
                                    </option>
                                    <option
                                        value="3" {{ old('employment_type', $postjob->employment_type) == 3 ? 'selected' : '' }}>
                                        Thỏa thuận
                                    </option>
                                </select>
                            </div>
                            @php
                                $expirationDate = \Carbon\Carbon::parse($postjob->expiration_date)->toDateString();
                            @endphp

                            <div class="form-group mt-3">
                                <label for="expiration_date">Ngày hết hạn:</label>
                                <input type="date" class="form-control" id="expiration_date" name="expiration_date"
                                       value="{{ old('expiration_date', $expirationDate) }}" required>
                            </div>


                            <button type="submit" class="btn btn-primary mt-3">Cập nhật</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

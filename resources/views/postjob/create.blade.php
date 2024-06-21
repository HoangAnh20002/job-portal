@extends('interface.layouts.home')

@section('sidebar')
    @include('interface.layouts.sidebar')
@endsection

@section('content')
    @include('interface.layouts.alert')
    <div class="container">
        <div class="row my-4">
            <div class="col-12">
                <h2 class="my-4">Tạo Bài đăng mới</h2>
                <div class="card">
                    <div class="card-header ">
                        <div>Tạo mới Bài đăng tuyển dụng</div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('postjob.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="job_title">Tiêu đề công việc:</label>
                                <input type="text" class="form-control" id="job_title" name="job_title"
                                       value="{{ old('job_title') }}" required>
                            </div>

                            <div class="form-group mt-3">
                                <label for="job_description">Mô tả công việc:</label>
                                <textarea class="form-control" id="job_description" name="job_description" rows="5"
                                          required>{{ old('job_description') }}</textarea>
                            </div>

                            <div class="form-group mt-3">
                                <label for="job_requirement">Yêu cầu công việc:</label>
                                <textarea class="form-control" id="job_requirement" name="job_requirement"
                                          value="{{old('job_requirement')}}" rows="5" required></textarea>
                            </div>

                            <div class="form-group mt-3">
                                <label for="salary">Lương(vnd):</label>
                                <input type="number" class="form-control" id="salary" name="salary"
                                       value="{{old('salary')}}" required>
                            </div>
                            <div class="form-group mt-3">
                                <label for="employment_type">Loại công việc:</label>
                                <select class="form-control" id="employment_type" name="employment_type" required>
                                    <option value="1" {{ old('employment_type') == 1 ? 'selected' : '' }}>Toàn thời
                                        gian
                                    </option>
                                    <option value="2" {{ old('employment_type') == 2 ? 'selected' : '' }}>Bán thời
                                        gian
                                    </option>
                                    <option value="3" {{ old('employment_type') == 3 ? 'selected' : '' }}>Thỏa thuận
                                    </option>
                                </select>
                            </div>

                            <div class="form-group mt-3">
                                <label for="expiration_date">Ngày hết hạn:</label>
                                <input type="date" class="form-control" id="expiration_date" name="expiration_date"
                                       value="{{ old('expiration_date') }}" required>
                            </div>
                            <input type="hidden" name="post_date" value="{{ old('post_date', now()->toDateString()) }}">

                            <button type="submit" class="btn btn-primary mt-3">Tạo mới</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

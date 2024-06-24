@extends('interface.layouts.home')

@section('content')
    <style>
        .side-bar {
            display: none;
        }

        .content {
            width: 100%;
            max-width: 100%;
            flex: 1;
            padding-right: 15px;
            padding-left: 15px;
            margin-right: auto;
            margin-left: auto;
        }

        body {
            background: linear-gradient(270deg, rgba(135, 170, 255, 0.5) 0%, rgba(135, 150, 180, 0.5) 73.72%);
        }

        .highlight {
            color: #004085;
            background-color: #cce5ff;
            padding: 0.2em 0.4em;
            border-radius: 0.2em;
        }

        .card {
            background-color: rgba(255, 255, 255, 0.9);
            border: 1px solid #ced4da;
        }

        .card-body h5 {
            font-weight: bold;
            color: #333;
        }

        .card-body p {
            color: #555;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }

        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
        }

        .btn-secondary:hover {
            background-color: #545b62;
            border-color: #4e555b;
        }

        .btn-success {
            background-color: #28a745;
            border-color: #28a745;
        }

        .btn-success:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }
    </style>

    <div class="container">
        <div class="row my-4">
            <div class="col-12 text-center">
                <h2 class="highlight">Chi tiết Bài đăng tuyển dụng</h2>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><strong>Tiêu đề công việc:</strong> <span class="highlight">{{ $postjob->job_title }}</span></h5>
                <p class="card-text"><strong>Mô tả:</strong> {{ $postjob->job_description }}</p>
                <p class="card-text"><strong>Yêu cầu:</strong> {{ $postjob->job_requirement }}</p>
                <p class="card-text"><strong>Lương:</strong> <span class="highlight">{{ $postjob->salary }}</span></p>
                <p class="card-text"><strong>Loại công việc:</strong>
                    <span class="highlight">
                    @switch($postjob->employment_type)
                            @case(1)
                                Toàn thời gian
                                @break
                            @case(2)
                                Bán thời gian
                                @break
                            @case(3)
                                Thỏa thuận
                                @break
                            @default
                                Không xác định
                        @endswitch
                </span>
                </p>
                <p class="card-text"><strong>Ngày đăng:</strong> {{ $postjob->post_date }}</p>
                <p class="card-text"><strong>Ngày hết hạn:</strong> {{ $postjob->expiration_date }}</p>
                @if($role_id == \App\Enums\Base::ADMIN)
                    @if($postjob->status == 2)
                        <form action="{{ route('postjob.update_status', ['id' => $postjob->id]) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="status" value="1">
                            <button type="submit" class="btn btn-primary mt-3">Duyệt bài đăng</button>
                        </form>
                    @else
                        <button class="btn btn-success mt-3" disabled>Đã được duyệt</button>
                    @endif
                @elseif($role_id == \App\Enums\Base::JOBSEEKER || $role_id == null)
                    <button type="button" class="btn btn-primary mt-3" data-toggle="modal" data-target="#confirmModal">
                        Ứng tuyển
                    </button>
                @endif
                <a href="{{route('home')}}" class="btn btn-secondary mt-3">Quay lại</a>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmModalLabel">Xác nhận ứng tuyển</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Bạn có chắc chắn muốn ứng tuyển công việc này không?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                        <form id="applicationForm" action="{{ route('application-store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="postjob_id" value="{{ $postjob->id }}">
                            <input type="hidden" name="application_status" value="Pending">
                            <button type="submit" class="btn btn-primary">Xác nhận ứng tuyển</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

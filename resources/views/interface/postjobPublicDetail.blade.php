@extends('interface.layouts.home')
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

    .body {
        background-image: url('https://static.vecteezy.com/system/resources/thumbnails/000/374/866/small/Background_1_A.jpg');
        background-repeat: repeat;
    }
</style>
@section('content')
    @include('interface.layouts.alert')
    <div class="container">
        <div class="row my-4">
            <h2>Chi tiết Bài đăng tuyển dụng</h2>
        </div>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><strong>Tiêu đề công việc:</strong> {{ $postjob->job_title }}</h5>
                <p class="card-text"><strong>Mô tả:</strong> {{ $postjob->job_description }}</p>
                <p class="card-text"><strong>Yêu cầu:</strong> {{ $postjob->job_requirement }}</p>
                <p class="card-text"><strong>Lương:</strong> {{ $postjob->salary }}</p>
                <p class="card-text"><strong>Loại công việc:</strong>
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
                        <button type="button" class="btn btn-primary mt-3" data-toggle="modal"
                                data-target="#confirmModal">
                            Ứng tuyển
                        </button>
                    @endif
                    <a href="{{route('home')}}" class="btn btn-secondary mt-3">Quay lại</a>
                    <!-- Modal -->
                    <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog"
                         aria-labelledby="confirmModalLabel" aria-hidden="true">
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
        </div>
    </div>
@endsection

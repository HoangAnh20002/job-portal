@extends('interface.layouts.home')

@section('sidebar')
    <div class="sidebar d-none d-lg-block" style="height: 700px;">
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
            <h2>Chi tiết Bài đăng tuyển dụng</h2>
        </div>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><strong>Tiêu đề công việc:</strong> {{ $postjob->job_title }}</h5>
                <p class="card-text"><strong>Mô tả:</strong> {{ $postjob->job_description }}</p>
                <p class="card-text"><strong>Yêu cầu:</strong> {{ $postjob->job_requirement }}</p>
                <p class="card-text"><strong>Lương:</strong> {{ $postjob->salary }}</p>
                <p class="card-text"><strong>Loại công việc:</strong> @switch($postjob->employment_type)
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
                    @endswitch</p>
                <p class="card-text"><strong>Ngày đăng:</strong> {{ $postjob->post_date }}</p>
                <p class="card-text"><strong>Ngày hết hạn:</strong> {{ $postjob->expiration_date }}</p>
                <p class="card-text"><strong>Nổi
                        bật:</strong> {{ $postjob->is_highlighted ? 'Đã làm nổi bật ' : 'Chưa làm nổi bật' }}</p>
                <p class="card-text"><strong>Trạng
                        thái:</strong> {{ $postjob->status == 1 ? 'Được duyệt' : 'Chưa được duyệt' }}</p>
                @if($role_id == \App\Enums\Base::ADMIN)
                    @if($postjob->status == 2)
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary mt-3" data-toggle="modal" data-target="#confirmModal">
                            Duyệt bài đăng
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="confirmModalLabel">Xác nhận duyệt bài đăng</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Bạn có chắc chắn muốn duyệt bài đăng này không?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                        <form action="{{ route('postjob.update_status', ['id' => $postjob->id]) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="1">
                                            <button type="submit" class="btn btn-primary">Duyệt bài đăng</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <button class="btn btn-success mt-3" disabled>Đã được duyệt</button>
                    @endif
                @endif
                <a href="{{ route('postjob.index') }}" class="btn btn-secondary mt-3">Quay lại</a>
            </div>
        </div>
    </div>
@endsection

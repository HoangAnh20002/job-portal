@extends('interface.layouts.home')

@section('sidebar')
    <div class="sidebar d-none d-lg-block">
        @include('interface.layouts.sidebar')
    </div>
    <div class="offcanvas offcanvas-start d-lg-none" tabindex="-1" id="offcanvasSidebar"
         aria-labelledby="offcanvasSidebarLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasSidebarLabel">Sidebar</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            @include('interface.layouts.sidebar')
        </div>
    </div>
    <button id="toggleSidebar" class="btn btn-secondary d-lg-none mt-3 ml-3 py-2 px-3" type="button"
            data-bs-toggle="offcanvas" data-bs-target="#offcanvasSidebar" aria-controls="offcanvasSidebar">
        <i class="bi bi-layout-text-sidebar"></i>
    </button>
@endsection

@section('content')
    @include('interface.layouts.alert')
    <style>
        .truncate {
            max-width: 150px;
            color: #0079c1;
            height: 2em;
            text-overflow: ellipsis;
            cursor: pointer;
            overflow: hidden;
            white-space: nowrap;
        }

        .truncate:hover {
            overflow: visible;
            white-space: normal;
            height: auto;
            background-color: #f0f0f0;
        }

        .table-responsive {
            cursor: grab;
        }

        .table-responsive:active {
            cursor: grabbing;
        }
    </style>
    <div class="container">
        <div class="row my-4">
            <h2 class="col-8">Quản lý Bài đăng tuyển dụng</h2>
            @if($role_id == \App\Enums\Base::EMPLOYER)
                <div class="col-4">
                    <form method="GET" action="{{ route('postjob.create') }}">
                        <button class="bg-primary text-white btn" type="submit">Tạo mới</button>
                    </form>
                </div>
            @endif
        </div>
        @if($role_id == \App\Enums\Base::ADMIN)
            <div class="row mt-4">
                <div class="d-flex">
                    <form action="{{ route('filterStatus') }}" method="get">
                        <div class="btn-group mb-3" role="group" aria-label="Basic example">
                            <button type="submit" class="btn btn-primary" name="status" value="1">Lọc bài đăng đã
                                duyệt
                            </button>
                            <button type="submit" class="btn btn-success ml-2" name="status" value="2">Lọc bài đăng chưa
                                duyệt
                            </button>
                        </div>
                    </form>
                    <form action="{{ route('postjob.index') }}" method="get">
                        <button type="submit" class="btn btn-warning ml-2" name="status" value="2">Bỏ lọc bài viết
                        </button>
                    </form>
                </div>
            </div>
        @endif
        <div class="table-responsive mt-4">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>ID</th>
                    @if($employer)
                        <th>Chi tiết</th>
                    @endif
                    <th>Trạng thái</th>
                    <th>Tiêu đề công việc</th>
                    <th>Mô tả công việc</th>
                    <th>Yêu cầu công việc</th>
                    @if($employer == null)
                        <th>ID Nhà tuyển dụng</th>
                    @endif
                    <th>Lương</th>
                    <th>Loại công việc</th>
                    <th>Ngày đăng</th>
                    <th>Ngày hết hạn</th>
                    @if($employer)
                        <th>Thao tác</th>
                    @endif
                </tr>
                </thead>
                <tbody>
                @if($employer)
                    @foreach($employer_posts_jobs as $employer_posts_job)
                        @if($employer_posts_job->employer_id == $employer->id)
                            <tr>
                                <td>{{ $employer_posts_job->id }}</td>
                                <td>
                                    <a href="{{ route('postjob.show', ['postjob' => $employer_posts_job->id]) }}"
                                       class="btn btn-info">
                                        Chi tiết
                                    </a>
                                </td>
                                <td>{{ $employer_posts_job->status == 1 ? 'Được duyệt' : 'Chưa duyệt' }}  </td>
                                <td class="truncate">{{ $employer_posts_job->job_title }}</td>
                                <td class="truncate">{{ $employer_posts_job->job_description }}</td>
                                <td class="truncate">{{ $employer_posts_job->job_requirement }}</td>
                                <td>{{ $employer_posts_job->salary }}</td>
                                <td>
                                    @switch($employer_posts_job->employment_type)
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
                                </td>
                                <td>{{ $employer_posts_job->post_date }}</td>
                                <td>{{ $employer_posts_job->expiration_date }}</td>
                                <td>
                                    <div>
                                        <div class="d-flex mb-2">
                                            <a href="{{ route('postjob.edit', ['postjob' => $employer_posts_job->id]) }}">
                                                <button class="bg-success text-white btn">Sửa</button>
                                            </a>
                                            <button type="button" class="ml-2 bg-danger text-white btn"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#exampleModal{{ $employer_posts_job->id }}">
                                                Xóa
                                            </button>
                                            <div class="modal fade" id="exampleModal{{ $employer_posts_job->id }}"
                                                 tabindex="-1"
                                                 aria-labelledby="exampleModalLabel{{ $employer_posts_job->id }}"
                                                 aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5"
                                                                id="exampleModalLabel{{ $employer_posts_job->id }}">
                                                                Xóa bài đăng {{$employer_posts_job->job_title}}</h1>
                                                            <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal"
                                                                    aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Bạn có chắc chắn muốn xóa bài đăng này?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">
                                                                Đóng
                                                            </button>
                                                            <form
                                                                action="{{ route('postjob.destroy', ['postjob' => $employer_posts_job->id]) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger">Xóa
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        @if($employer && $employer_posts_job->status == '1')
                                            <form action="{{ route('servicesroute.index') }}" method="GET"
                                                  style="display: inline;">
                                                <input type="hidden" name="postjob_id"
                                                       value="{{ $employer_posts_job->id }}">
                                                <button type="submit" class="bg-primary text-white btn">Đăng ký dịch
                                                    vụ
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                @else
                    @foreach($post_jobs as $post_job)
                        <tr>
                            <td>{{ $post_job->id }}</td>
                            <td>
                                <a href="{{ route('postjob.show', ['postjob' => $post_job->id]) }}"
                                   class="btn btn-info">
                                    {{ $post_job->status == 1 ? 'Được duyệt' : 'Chưa duyệt' }}
                                </a>
                            </td>
                            <td class="truncate">{{ $post_job->job_title }}</td>
                            <td class="truncate">{{ $post_job->job_description }}</td>
                            <td class="truncate">{{ $post_job->job_requirement }}</td>
                            <td>{{ $post_job->employer_id }}</td>
                            <td>{{ $post_job->salary }}</td>
                            <td>
                                @switch($post_job->employment_type)
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
                            </td>
                            <td>{{ $post_job->post_date }}</td>
                            <td>{{ $post_job->expiration_date }}</td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
    </div>
    @if($employer == null)
        <div class="mb-5 mt-5">
            {{ $post_jobs->appends(request()->query())->links('vendor.pagination.bootstrap-5') }}
        </div>
    @endif
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function () {
        let isMouseDown = false,
            startX,
            startScrollLeft;

        const tableResponsive = document.querySelector('.table-responsive');

        tableResponsive.addEventListener('mousedown', (event) => {
            isMouseDown = true;
            startX = event.pageX - tableResponsive.offsetLeft;
            startScrollLeft = tableResponsive.scrollLeft;
            tableResponsive.style.cursor = 'grabbing';
        });

        tableResponsive.addEventListener('mousemove', (event) => {
            if (!isMouseDown) return;
            event.preventDefault();
            const x = event.pageX - tableResponsive.offsetLeft;
            const walk = (x - startX) * 2;
            tableResponsive.scrollLeft = startScrollLeft - walk;
        });

        tableResponsive.addEventListener('mouseup', () => {
            isMouseDown = false;
            tableResponsive.style.cursor = 'grab';
        });

        tableResponsive.addEventListener('mouseleave', () => {
            isMouseDown = false;
            tableResponsive.style.cursor = 'grab';
        });
    });
</script>

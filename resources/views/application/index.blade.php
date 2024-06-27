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
    <style>
        .username {
            max-width: 150px;
            color: #0079c1;
            height: 2em;
            text-overflow: ellipsis;
            cursor: pointer;
            overflow: hidden;
            white-space: nowrap;
        }

        .username:hover {
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
            <h2 class="col-8">Danh sách bài đăng có người ứng tuyển</h2>
            <div class="col-4">
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Tiêu đề công việc</th>
                    <th>Mô tả công việc</th>
                    <th>Yêu cầu công việc</th>
                    <th>Lương</th>
                    <th>Loại công việc</th>
                    <th>Ngày đăng</th>
                    <th>Ngày hết hạn</th>
                    <th>Xem người ứng tuyển</th>
                </tr>
                </thead>
                <tbody>
                @foreach($listPostJobs as $listPostJob)
                    <tr>
                        <td>{{ $listPostJob->id }}</td>
                        <td class="username">{{ $listPostJob->job_title }}</td>
                        <td class="username">{{ $listPostJob->job_description }}</td>
                        <td class="username">{{ $listPostJob->job_requirement }}</td>
                        <td>{{ $listPostJob->salary }}</td>
                        <td>
                            @switch($listPostJob->employment_type)
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
                        <td>{{ $listPostJob->post_date }}</td>
                        <td>{{ $listPostJob->expiration_date }}</td>
                        <td>
                            <form action="{{ route('application.showUserApply') }}" method="GET">
                                @csrf
                                <input type="hidden" name="postjob_id" value="{{ $listPostJob->id }}">
                                <input type="hidden" name="job_title" value="{{ $listPostJob->job_title }}">
                                <button type="submit" class="btn btn-info">Xem người ứng tuyển</button>
                            </form>
                        </td>
                    </tr>
            @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="mb-5 mt-5">
        {{ $listPostJobs->links('vendor.pagination.bootstrap-5') }}
    </div>
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
            const walk = (x - startX) * 2; // Adjust the scroll speed if necessary
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

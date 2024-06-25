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
            word-break: break-all;
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
            <h2 class="col-8">Danh sách Người ứng tuyển</h2>
            <div class="col-4">
                <form method="GET" action="{{ route('jobseeker.create') }}">
                    <button class="bg-primary text-white btn" type="submit">Tạo mới</button>
                </form>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col">
                <form action="{{ route('searchJobSeekers') }}" method="GET" class="form-inline">
                    <div class="form-group mb-2">
                        <label for="searchInput" class="sr-only">Tìm kiếm nhà người ứng tuyển</label>
                        <input style="width: 300px" type="text" class="form-control" id="searchInput" name="content"
                               placeholder="Nhập từ khóa tên hoặc email">
                    </div>
                    <button type="submit" class="btn btn-primary mb-2 ml-2">Tìm kiếm</button>
                </form>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên</th>
                    <th>Email</th>
                    <th>Cv việc làm</th>
                    <th>Lời nhắn thêm</th>
                    <th>Thông tin liên hệ</th>
                    <th>Thao tác</th>
                </tr>
                </thead>
                <tbody>
                @foreach($jobseekers as $jobseeker)
                    <tr>
                        <td>{{ $jobseeker->id }}</td>
                        <td class="username">{{ $jobseeker->user->username ?? 'N/A' }}</td>
                        <td class="username">{{ $jobseeker->user->email ?? 'N/A' }}</td>
                        <td class="username">{{ $jobseeker->resume ?? 'N/A' }}</td>
                        <td class="username">{{ $jobseeker->cover_letter ?? 'N/A' }}</td>
                        <td class="username">{{ $jobseeker->contact_info ?? 'N/A' }}</td>
                        <td>
                            <div class="d-flex">
                                <a href="{{ route('jobseeker.edit', ['jobseeker' => $jobseeker->id]) }}">
                                    <button class="bg-success text-white btn">Sửa</button>
                                </a>
                                <button type="button" class="ml-2 bg-danger text-white btn" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal{{ $jobseeker->id }}">
                                    Xóa
                                </button>
                                <div class="modal fade" id="exampleModal{{ $jobseeker->id }}" tabindex="-1"
                                     aria-labelledby="exampleModalLabel{{ $jobseeker->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel{{ $jobseeker->id }}">
                                                    Xóa đi {{$jobseeker->user->username}}</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Bạn có chắc chắn muốn xóa ?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                    Đóng
                                                </button>
                                                <form
                                                    action="{{ route('jobseeker.destroy', ['jobseeker' => $jobseeker->id]) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Xóa</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="mb-5 mt-5">
        {{ $jobseekers->appends(request()->query())->setPath(route('jobseeker.index'))->links('vendor.pagination.bootstrap-5') }}
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

@extends('interface.layouts.home')

@section('sidebar')
    @include('interface.layouts.sidebar')
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
            <h2 class="col-8">Danh sách Nhà tuyển dụng</h2>
            <div class="col-4">
                <form method="GET" action="{{ route('employer.create') }}">
                    <button class="bg-primary text-white btn" type="submit">Tạo mới</button>
                </form>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col">
                <form action="{{ route('searchEmployers') }}" method="GET" class="form-inline">
                    <div class="form-group mb-2">
                        <label for="searchInput" class="sr-only">Tìm kiếm nhà tuyển dụng</label>
                        <input style="width: 500px" type="text" class="form-control" id="searchInput" name="content"
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
                    <th>Công ty</th>
                    <th>Thông tin liên hệ</th>
                    <th>Thao tác</th>
                </tr>
                </thead>
                <tbody>
                @foreach($employers as $employer)
                    <tr>
                        <td>{{ $employer->id }}</td>
                        <td class="username">{{ $employer->user->username ?? 'N/A' }}</td>
                        <td class="username">{{ $employer->user->email ?? 'N/A' }}</td>
                        <td class="username">{{ $employer->company->company_name ?? 'N/A' }}</td>
                        <td class="username">{{ $employer->contact_info ?? 'N/A' }}</td>
                        <td>
                            <div class="d-flex">
                                <a href="{{ route('employer.edit', ['employer' => $employer->id]) }}">
                                    <button class="bg-success text-white btn">Sửa</button>
                                </a>
                                <button type="button" class="ml-2 bg-danger text-white btn" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal{{ $employer->id }}">
                                    Xóa
                                </button>
                                <div class="modal fade" id="exampleModal{{ $employer->id }}" tabindex="-1"
                                     aria-labelledby="exampleModalLabel{{ $employer->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel{{ $employer->id }}">
                                                    Xóa đi {{$employer->user->username}}</h1>
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
                                                    action="{{ route('employer.destroy', ['employer' => $employer->id]) }}"
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
        {{ $employers->appends(request()->query())->setPath(route('employer.index'))->links('vendor.pagination.bootstrap-5') }}
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

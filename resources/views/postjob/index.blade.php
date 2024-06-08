@extends('interface.layouts.home')

@section('sidebar')
    @include('interface.layouts.sidebar')
@endsection

@section('content')
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if(session(('error')))
        <div class="alert alert-danger">
            {{session('error')}}
        </div>
    @endif
    <style>
        .truncate {
            max-width: 150px;
            color: #0079c1;
            height: 2em;
            text-overflow: ellipsis;
            cursor: pointer;
            word-break: break-all;
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
                        <button class="bg-primary text-white btn" type="submit">Tạo mới </button>
                    </form>
                </div>
            @endif
        </div>

        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                <tr>
                    @if($employer == null) <th>ID</th>@endif
                    @if($employer)<th>Chi tiết</th> @endif
                    <th>Trạng thái</th>
                    <th>Tiêu đề công việc</th>
                    <th>Mô tả công việc</th>
                    <th>Yêu cầu công việc</th>
                     @if($employer == null) <th>ID Nhà tuyển dụng</th>@endif
                    <th>Lương</th>
                    <th>Loại công việc</th>
                    <th>Ngày đăng</th>
                    <th>Ngày hết hạn</th>
                    <th>Nổi bật</th>
                    @if($employer)<th>Thao tác</th> @endif

                </tr>
                </thead>
                <tbody>
                @foreach($post_jobs as $post_job)

                    @if($employer && $employer->id == $post_job->employer_id)
                        <tr>
                        <td>
                            <a href="{{ route('postjob.show', ['postjob' => $post_job->id]) }}" class="btn btn-info">
                               Chi tiết
                            </a>
                        </td>
                        <td>{{ $post_job->status == 1 ? 'Được duyệt' : 'Chưa duyệt' }}  </td>
                        <td class="truncate">{{ $post_job->job_title }}</td>
                        <td class="truncate">{{ $post_job->job_description }}</td>
                        <td class="truncate">{{ $post_job->job_requirement }}</td>
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
                        <td>{{ $post_job->is_highlighted ? 'Có' : 'Không' }}</td>
                       <td>
                            <div>
                                <div class="d-flex mb-2">
                                    <a href="{{ route('postjob.edit', ['postjob' => $post_job->id]) }}">
                                        <button class="bg-success text-white btn">Sửa</button>
                                    </a>
                                    <button type="button" class="ml-2 bg-danger text-white btn" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal{{ $post_job->id }}">
                                        Xóa
                                    </button>
                                    <div class="modal fade" id="exampleModal{{ $post_job->id }}" tabindex="-1"
                                         aria-labelledby="exampleModalLabel{{ $post_job->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel{{ $post_job->id }}">
                                                        Xóa bài đăng {{$post_job->job_title}}</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Bạn có chắc chắn muốn xóa bài đăng này?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                        Đóng
                                                    </button>
                                                    <form action="{{ route('postjob.destroy', ['postjob' => $post_job->id]) }}"
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
                                @if($employer)<a href="{{ route('servicesroute.index') }}">
                                    <button class="bg-primary text-white btn">Làm nổi bật bài đăng của bạn</button>
                                </a>@endif
                            </div>
                        </td>
                    </tr>@elseif($employer == null)
                        <tr>
                            <td>{{ $post_job->id }}</td>
                            <td>
                                <a href="{{ route('postjob.show', ['postjob' => $post_job->id]) }}" class="btn btn-info">
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
                            <td>{{ $post_job->is_highlighted ? 'Có' : 'Không' }}</td>
                        </tr>
                    @endif
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @if($employer == null)
    <div class="mb-5 mt-5">
        {{ $post_jobs->appends(request()->query())->setPath(route('postjob.index'))->links('vendor.pagination.bootstrap-5') }}
    </div> @endif
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

@extends('interface.layouts.home')
@section('sidebar')
    <div class="sidebar d-none d-lg-block" style="height: 700px">
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
    <div class="container mt-5">
        <h2>Lịch sử Ứng tuyển</h2>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Tên công việc</th>
                <th>Miêu tả công việc</th>
                <th>Yêu câù công việc</th>
                <th>Lương</th>
                <th>Ngày hết hạn</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
            </tr>
            </thead>
            <tbody>
            @foreach($applyHistorys as $application)
                <tr>
                    <td class="username">{{ $application->postjob->job_title }}</td>
                    <td class="username">{{ $application->postjob->job_description }}</td>
                    <td class="username">{{ $application->postjob->job_requirement }}</td>
                    <td>{{ $application->postjob->salary }}</td>
                    <td>{{ $application->postjob->expiration_date }}</td>
                    <td>
                        @switch($application->application_status)
                            @case('Pending')
                                Đang chờ xử lý
                                @break
                            @case('Accepted')
                                Đã được chấp thuận
                                @break
                            @case('Rejected')
                                Đã bị từ chối
                                @break
                            @default
                                Không rõ
                        @endswitch
                    </td>                    <td>
                        @if($application->application_status == 'Pending')
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirmCancelModal" data-id="{{ $application->id }}">
                                Hủy trạng thái
                            </button>
                        @else
                            <button type="button" class="btn btn-danger" disabled>
                                Hủy trạng thái
                            </button>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="confirmCancelModal" tabindex="-1" role="dialog" aria-labelledby="confirmCancelModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmCancelModalLabel">Xác nhận hủy trạng thái</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Bạn có chắc chắn muốn hủy trạng thái ứng tuyển này?
                </div>
                <div class="modal-footer">
                    <form id="cancelForm" action="{{ route('application.destroy', $application->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-danger">Hủy trạng thái</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
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
@endsection

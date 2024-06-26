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
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-3">
                <h2>Danh sách người ứng tuyển {{$job_title}}</h2>
                <a href="{{ url()->previous() }}" class="btn btn-secondary my-3">Quay lại</a>

                @if($applyUsers->isEmpty())
                    <p>Không có người ứng tuyển nào.</p>
                @else
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Tên người ứng tuyển</th>
                            <th>Email</th>
                            <th>CV ứng tuyển</th>
                            <th>Lời nhắn</th>
                            <th>Thông tin liên hệ</th>
                            <th>Trạng thái</th>
                            <th>Hành động</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($applyUsers as $application)
                            <tr>
                                <td>{{ $application->jobSeeker->user->username }}</td>
                                <td>{{ $application->jobSeeker->user->email }}</td>
                                <td> <a href="{{ asset('storage/resumes/' . $application->jobSeeker->resume) }}" target="_blank">Xem CV</a></td>
                                <td>{{ $application->jobSeeker->cover_letter }}</td>
                                <td>{{ $application->jobSeeker->contact_info }}</td>
                                <td>@switch($application->application_status)
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
                                </td>
                                <td>
                                    <button class="btn btn-success" data-toggle="modal" data-target="#confirmModal" data-id="{{ $application->id }}" data-status="Accepted">Chấp thuận</button>
                                    <button class="btn btn-danger mt-1" data-toggle="modal" data-target="#confirmModal" data-id="{{ $application->id }}" data-status="Rejected">Từ chối</button>
                                    <button class="btn btn-warning mt-1" data-toggle="modal" data-target="#confirmModal" data-id="{{ $application->id }}" data-status="Pending">Hủy hành động </button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmModalLabel">Xác nhận</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Bạn có chắc chắn muốn thay đổi trạng thái ứng tuyển này?
                </div>
                <div class="modal-footer">
                    <form id="updateStatusForm" method="POST" action="">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="application_status" id="application_status" value="">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                        <button type="submit" class="btn btn-primary">Xác nhận</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $('#confirmModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var applicationId = button.data('id');
            var status = button.data('status');

            var modal = $(this);
            var form = modal.find('#updateStatusForm');
            form.attr('action', '/application/' + applicationId + '/updateStatus');
            form.find('#application_status').val(status);
        });
    </script>
@endsection

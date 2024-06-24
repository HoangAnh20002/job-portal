@extends('interface.layouts.home')
@section('sidebar')
    @include('interface.layouts.sidebar')
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
                                <td>{{ $application->application_status }}</td>
                                <td>
                                    <button class="btn btn-success" data-toggle="modal" data-target="#confirmModal" data-id="{{ $application->id }}" data-status="Accepted">Chấp thuận</button>
                                    <button class="btn btn-danger mt-1" data-toggle="modal" data-target="#confirmModal" data-id="{{ $application->id }}" data-status="Rejected">Từ chối</button>
                                    <button class="btn btn-warning mt-1" data-toggle="modal" data-target="#confirmModal" data-id="{{ $application->id }}" data-status="Pending">Hủy xác nhận</button>
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

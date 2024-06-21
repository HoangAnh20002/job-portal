@extends('interface.layouts.home')

@section('sidebar')
    @include('interface.layouts.sidebar')
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
                        <form action="{{ route('postjob.update_status', ['id' => $postjob->id]) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="status" value="1">
                            <button type="submit" class="btn btn-primary mt-3">Duyệt bài đăng</button>
                        </form>
                    @else
                        <button class="btn btn-success mt-3" disabled>Đã được duyệt</button>
                    @endif
                @else
                @endif
                <a href="{{ route('postjob.index') }}" class="btn btn-secondary mt-3">Quay lại</a>
            </div>
        </div>
    </div>
@endsection

@php
    use App\Enums\Base;
@endphp

<div class="bg-dark h-100 text-white">
    @if($role_id == Base::ADMIN)
        <div class="border border-white p-3">
            <a href="{{ route('adminMain') }}" class="text-decoration-none text-white ml-3">Bảng điều khiển</a>
        </div>
    @elseif($role_id == Base::EMPLOYER)
        <div class="border border-white p-3">
            <a href="{{ route('employerMain') }}" class="text-decoration-none text-white ml-3">Hồ sơ cá nhân</a>
        </div>
    @elseif($role_id == Base::JOBSEEKER)
        <div class="border border-white p-3">
            <a href="{{ route('jobseekerMain') }}" class="text-decoration-none text-white ml-3">Hồ sơ cá nhân</a>
        </div>
    @endif
    @if($role_id == Base::ADMIN)
    <div class="border border-white p-3">
        <div class="nav-item has-submenu">
            <a class="nav-link" href="#" data-bs-toggle="collapse" data-bs-target="#submenuCollapse" aria-expanded="false" aria-controls="submenuCollapse">
                Quản lí người dùng  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
                    <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
                </svg>
            </a>
            <ul class="submenu collapse" id="submenuCollapse">
                <div><a class="nav-link mt-2" href="{{ route('employer.index') }}">Nhà tuyển dụng</a></div>
                <div><a class="nav-link mt-2" href="{{ route('jobseeker.index') }}" >Người ứng tuyển</a></div>
            </ul>
        </div>
    </div>
    @endif
        <div class="border border-white p-3">
            <a href="{{ route('company.index') }}" class="text-decoration-none text-white ml-3">Danh sách công ty</a>
        </div>
        <div class="border border-white p-3">
            <a href="{{ route('postjob.index') }}" class="text-decoration-none text-white ml-3">Quản lí bài đăng</a>
        </div>
        @if($role_id == Base::ADMIN)
            <div class="border border-white p-3">
                <a href="{{ route('service.index') }}" class="text-decoration-none text-white ml-3">Dịch vụ</a>
            </div>
        @endif

{{--    @if($role == Base::ADMIN)--}}
{{--        <div class="border border-white p-3">--}}
{{--            <a href="{{route('student.index')}}" class="text-decoration-none text-white">Student</a>--}}
{{--        </div>--}}
{{--        <div class="border border-white p-3">--}}
{{--            <a href="{{route('result.index')}}" class="text-decoration-none text-white">Result</a>--}}
{{--        </div>--}}
{{--    @endif--}}
{{--    <div class="border border-white p-3">--}}
{{--        <a href="{{route('course.index')}}" class="text-decoration-none text-white">Course</a>--}}
{{--    </div>--}}

</div>


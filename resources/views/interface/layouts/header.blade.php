<header class="bg-light d-flex align-items-center" style="height: 90px;">
    @php
    use App\Enums\Base;
    @endphp
    <div class="container-fluid mx-3">
        <div class="d-flex align-items-center justify-content-between">
            <div class="col-12 col-md-4 text-center text-md-start my-auto">
                <a href="{{route('home')}}" class="text-decoration-none mx-auto fw-bold text-primary"
                    style="font-size: 2.5rem; font-family: 'Arial', sans-serif; text-shadow: 1px 1px 2px #000;">
                    Job Portal
                </a>
            </div>
            <div class="col-12 col-md-8 d-flex justify-content-end align-items-center">
                <div class="">
                    @if($role_id == null)
                    @elseif($role_id == Base::ADMIN)
                    <a href="{{ route('adminMain') }}" class="btn btn-primary">Admin-Quản lý</a>
                    @elseif($role_id == Base::EMPLOYER)
                    <a href="{{ route('employerMain') }}" class="btn btn-primary">Nhà tuyển dụng-Quản lý</a>
                    @else
                    <a href="{{ route('jobseekerMain') }}" class="btn btn-primary">Người tìm việc-Quản lý</a>
                    @endif
                </div>
                <div class="ms-3">
                    @if(is_null($role_id))
                    <a href="{{ route('login') }}" class="btn btn-primary me-2">Đăng nhập</a>
                    <a href="{{ route('register') }}" class="btn btn-outline-primary">Đăng ký</a>
                    @else
                    <button type="button" class="btn btn-danger me-2" data-bs-toggle="modal"
                        data-bs-target="#logoutModal">
                        Đăng xuất
                    </button>
                    @endif
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="logoutModalLabel">Đăng xuất</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    Bạn có chắc chắn muốn đăng xuất không?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <a type="button" class="btn btn-primary" href="{{ route('logout') }}">Đăng xuất</a>
                </div>
            </div>
        </div>
    </div>
</header>
<style>
    @media (max-width: 406px) {
        .header{
            height: 200px;
        }
    }
    @media (min-width: 406px) {
        .header{
            height: 120px;
        }
    }
</style>
<header class=" header bg-light d-flex align-items-center">
    @php
    use App\Enums\Base;
    @endphp
    <div class="container-fluid mx-3">
        <div class="row">
            <div class="col-md-4">
                <div class="d-flex align-items-center justify-content-center justify-content-sm-start mb-3 mb-sm-0">
                    <a href="{{ route('home') }}" class="text-decoration-none fw-bold text-primary"
                       style="font-size: 2.5rem; font-family: 'Arial', sans-serif; text-shadow: 1px 1px 2px #000;">
                        Job Portal
                    </a>
                </div>
            </div>
            <div class="col-md-8">
                <div class="d-flex justify-content-end align-items-center justify-content-sm-end">
                    <div style="text-align: center; margin-top: 15px; margin-right: 40px;">
                        <a href="{{ url('/about-us') }}" style="text-decoration: none; color: #007bff; font-weight: bold; font-size: 18px;">
                            Về chúng tôi
                        </a>
                    </div>
                    <div class="mr-2">
                        @if($role_id == null)
                            <a href="{{ route('login') }}" class="btn btn-primary">Đăng nhập</a>
                            <a href="{{ route('register') }}" class="btn btn-outline-primary">Đăng ký</a>
                        @else
                            <button type="button" class="btn btn-danger me-2" data-bs-toggle="modal"
                                    data-bs-target="#logoutModal">
                                Đăng xuất
                            </button>
                        @endif
                    </div>
                    <div>
                        @if($role_id == Base::ADMIN)
                            <a href="{{ route('adminMain') }}" class="btn btn-primary" style="width: fit-content">Quản lý</a>
                        @elseif($role_id == Base::EMPLOYER)
                            <a href="{{ route('employerMain') }}" class="btn btn-primary">Quản lý</a>
                        @elseif($role_id == Base::JOBSEEKER)
                            <a href="{{ route('jobseekerMain') }}" class="btn btn-primary">Quản lý</a>
                        @endif
                    </div>
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

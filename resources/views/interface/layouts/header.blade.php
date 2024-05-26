<header>
    @php
        use App\Enums\Base;
    @endphp
    <div class="bg-light">
        <div class="row pl-3">
            <div class="col-4 text-center my-auto pl-2 fs-3" style="padding-right: 100px;">
                <a href="{{route('home')}}" class="text-decoration-none mx-auto fw-semibold" style="font-size: 2.5rem; font-weight: bold; color: #007bff; font-family: 'Arial', sans-serif; text-shadow: 1px 1px 2px #000;">
                    Job Portal
                </a>
            </div>
            <div class="col-8 mt-3 row">
                <div class="col-7"></div>
                <div class="text-right col-5" style="height: 80px">
                    <div class="d-flex">
                        <div class="text-right mr-1">
                            <div class="mr-4 pt-2">
                                @if($role_id == null)
                                @elseif($role_id == Base::ADMIN)
                                    <a href="{{ route('adminMain') }}" class="btn btn-primary"> Admin-Quản lý</a>
                                @elseif($role_id == Base::EMPLOYER)
                                    <a href="{{ route('employerMain') }}" class="btn btn-primary">Nhà tuyển dụng-Quản lý </a>
                                @else
                                    <a href="{{ route('jobseekerMain') }}" class="btn btn-primary"> Người tìm việc-Quản lý</a>
                                @endif
                            </div>
                        </div>
                        <div class="mt-2 mr-3">
                            @if(is_null($role_id))
                                <button class="btn btn-primary mr-3"><a href="{{ route('login') }}" class="btn mr-2 text-white">
                                        Đăng nhập
                                    </a></button>
                                <button class="border btn">
                                    <a href="{{ route('register') }}" class="btn mr-2">
                                        Đăng ký
                                    </a>
                                </button>
                            @else
                                <button type="button" class="btn btn-danger mr-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    Đăng xuất
                                </button>
                            @endif
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                 aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Đăng xuất</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

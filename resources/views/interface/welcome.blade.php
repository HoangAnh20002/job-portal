@extends('interface.layouts.home')
<style>
    .side-bar {
        display: none;
    }

    .content {
        width: 100%;
        max-width: 100%;
        flex: 1;
        padding-right: 15px;
        padding-left: 15px;
        margin-right: auto;
        margin-left: auto;
    }

    .body {
        background-image: url('https://images.deepai.org/art-image/81e8c033b6464e4baf0267f50de18132/back-ground-image-main-color-is-white-with-some-blue-.jpg');
        background-repeat: repeat;
    }

    .carousel-item {
        transition: transform 0.3s ease-in-out !important;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #0056b3;
        transform: translateY(-2px);
    }

    .search-button:hover {
        background-color: #0056b3;
        border-color: #0056b3;
        transform: translateY(-2px);
    }

    .select2-search__field {
        padding-bottom: 6px;
        padding-left: 3px;
    }
    .highlighted-text {
        font-size: 3em;
        font-weight: bold;
        color: black;
        text-align: center;
        margin-top: 30px;
        text-shadow: 3px 3px 6px rgba(0, 0, 0, 0.3);
       padding: 50px;
    }
    @media (max-width: 768px) {
        .highlighted-text {
            font-size: 3em;
            padding: 15px;
        }

    }
    @media (max-width: 480px) {
        .highlighted-text {
            font-size: 2em;
            padding: 10px;
        }
        #apply{
            padding: 2px 5px;
        }
    }
    .carousel-item {
        height: 350px;
        background-size: cover;
        background-position: center;
    }
    .carousel-caption {
        background: rgba(0, 0, 0, 0.5);
        padding: 40px;
        border-radius: 10px;
    }
    .carousel-caption h4, .carousel-caption p, .carousel-caption .btn {
        text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.8);
    }
    .carousel-caption img {
        width: 150px;
        height: auto;
        border-radius: 10%;
        background: #fff;
        padding: 5px;
    }
</style>
@section('content')
    @include('interface.layouts.alert')
    <div class="highlighted-text">Job Portal - Website tìm việc số 1 Việt Nam</div>
    <div style="width:100%">
        <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
            @if(count($postJobsWithFirstService) > 0)
                <div class="carousel-indicators">
                    @foreach ($postJobsWithFirstService as $index => $postJob)
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="{{ $index }}"
                                class="{{ $index == 0 ? 'active' : '' }}"
                                aria-current="{{ $index == 0 ? 'true' : 'false' }}"
                                aria-label="Slide {{ $index + 1 }}"></button>
                    @endforeach
                </div>
                <div class="carousel-inner">
                    @foreach ($postJobsWithFirstService as $index => $postJob)
                        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}"
                             style="background-image: url('{{ asset('bg/' . $backgroundImages[$index % count($backgroundImages)]) }}');">
                            <div class="carousel-caption d-md-block">
                                <div class="row align-items-center">
                                    <div class="col-4 row">
                                        <img src="{{ asset('storage/logos/' . $postJob->employer->company->logo) }}"
                                             alt="Logo" class="img-fluid">
                                        <h4 class="text-white mt-2">{{ $postJob->employer->company->company_name }}</h4>
                                    </div>
                                    <div class="col-8 text-start">
                                        <h4 class="text-white">{{ $postJob->job_title }}</h4>
                                        <p class="text-white">{{ $postJob->job_description }}</p>
                                        <div class="d-flex mb-2">
                                            <div class='mt-1'>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                     fill="currentColor" class="bi bi-cash-coin" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd"
                                                          d="M11 15a4 4 0 1 0 0-8 4 4 0 0 0 0 8m5-4a5 5 0 1 1-10 0 5 5 0 0 1 10 0"/>
                                                    <path
                                                        d="M9.438 11.944c.047.596.518 1.06 1.363 1.116v.44h.375v-.443c.875-.061 1.386-.529 1.386-1.207 0-.618-.39-.936-1.09-1.1l-.296-.07v-1.2c.376.043.614.248.671.532h.658c-.047-.575-.54-1.024-1.329-1.073V8.5h-.375v.45c-.747.073-1.255.522-1.255 1.158 0 .562.378.92 1.007 1.066l.248.061v1.272c-.384-.058-.639-.27-.696-.563h-.668zm1.36-1.354c-.369-.085-.569-.26-.569-.522 0-.294.216-.514.572-.578v1.1zm.432.746c.449.104.655.272.655.569 0 .339-.257.571-.709.614v-1.195z"/>
                                                    <path
                                                        d="M1 0a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h4.083q.088-.517.258-1H3a2 2 0 0 0-2-2V3a2 2 0 0 0 2-2h10a2 2 0 0 0 2 2v3.528c.38.34.717.728 1 1.154V1a1 1 0 0 0-1-1z"/>
                                                    <path
                                                        d="M9.998 5.083 10 5a2 2 0 1 0-3.132 1.65 6 6 0 0 1 3.13-1.567"/>
                                                </svg>
                                            </div>
                                            <div class="text-white ms-2">: {{ $postJob->salary }}</div>
                                        </div>
                                        <div class="d-flex mb-2">
                                            <div class="mt-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                     fill="currentColor" class="bi bi-building-add" viewBox="0 0 16 16">
                                                    <path
                                                        d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0"/>
                                                    <path
                                                        d="M2 1a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1v6.5a.5.5 0 0 1-1 0V1H3v14h3v-2.5a.5.5 0 0 1 .5-.5H8v4H3a1 1 0 0 1-1-1z"/>
                                                    <path
                                                        d="M4.5 2a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm3 0a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm3 0a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm-6 3a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm3 0a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm3 0a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm-6 3a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm3 0a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5z"/>
                                                </svg>
                                            </div>
                                            <div class="text-white ms-2">{{ $postJob->employer->company->location }}</div>
                                        </div>
                                        <a href="{{ route('showPublic', $postJob->id) }}" class="btn btn-primary" id="apply"
                                           style="background-color: #007bff; border-color: #007bff; border-radius: 25px; padding: 10px 20px; font-size: 16px; font-weight: bold; text-transform: uppercase; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); transition: background-color 0.3s, transform 0.3s;">
                                            Ứng tuyển ngay
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
                        data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
                        data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            @else
                <div class="carousel-inner">
                    <div class="carousel-item active"
                         style="background-image: url('{{ asset('bg/banner.jpg') }}'); height: 500px; background-size: cover; background-position: center;">
                        <div class="carousel-caption d-md-block">
                            <h2 class="text-white">Chào mừng bạn đến với trang web của chúng tôi</h2>
                            <p class="text-white">Nơi tìm công việc mơ ước của bạn</p>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
    {{--    search --}}
    <div class="container mt-5 border border-primary-subtle p-4 shadow rounded bg-body-tertiary">
        <form id="searchForm" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-4">
                    <input type="text" name="job_title" id="job_title" class="form-control mb-3"
                           placeholder="Nhập tiêu đề công việc">
                </div>
                <div class="col-md-2">
                    <select id="locationDropdown" name="location[]" class="form-control mb-3" multiple>
                        @foreach($companies as $company)
                            <option value="{{ $company->location }}">{{ $company->location }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="salary" id="salary" class="form-control mb-3">
                        <option value="">Mức lương</option>
                        <option value="5-10">5-10 triệu</option>
                        <option value="10-20">10-20 triệu</option>
                        <option value="20+">Trên 20 triệu</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="employment_type" id="employment_type" class="form-control mb-3">
                        <option value="">Loại hình công việc</option>
                        <option value="1">Full time</option>
                        <option value="2">Part time</option>
                        <option value="3">Hợp đồng</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <select id="industryDropdown" name="industry[]" class="form-control mb-3" multiple>
                        @foreach($companies as $company)
                            <option value="{{ $company->industry }}">{{ $company->industry }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                </div>
            </div>
        </form>
    </div>
    {{--    list --}}
    <div id="postJobsList" class="row mt-4">
        @foreach($postJobs as $postJob)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $postJob->job_title }}</h5>
                        <div class="d-flex">
                            <div class="col-4">
                                <img src="{{ asset('storage/logos/' . $postJob->employer->company->logo) }}" alt="Logo"
                                     class="img-fluid"
                                     style="width: 150px; height: auto; border-radius: 10%; background: #fff; padding: 5px;">
                                <h4 class="text-white mt-2">{{ $postJob->employer->company->company_name }}</h4>
                            </div>
                            <div>
                                <p class="card-text">Công ty: {{ $postJob->employer->company->company_name }}</p>
                                <p class="card-text">Mức lương: {{ $postJob->salary }}</p>
                                <p class="card-text">Loại hình công việc: @switch($postJob->employment_type)
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
                                <p class="card-text">Địa điểm: {{ $postJob->employer->company->location }}</p>
                                <a href="{{ route('showPublic', $postJob->id) }}" class="btn btn-primary">Chi tiết</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="mb-5 mt-5">
        {{ $postJobs->links('vendor.pagination.bootstrap-5') }}
    </div>
    <script>
        $(document).ready(function () {
            $('#searchForm').submit(function (event) {
                event.preventDefault();

                var formData = {
                    job_title: $('input[name=job_title]').val(),
                    salary: $('select[name=salary]').val(),
                    employment_type: $('select[name=employment_type]').val(),
                    location: $('select[name="location[]"]').val(),
                    industry: $('select[name="industry[]"]').val()
                };
                $.ajax({
                    type: 'GET',
                    url: '{{ route('home.search') }}',
                    data: formData,
                    success: function (response) { console.log(response)
                        $('#postJobsList').empty();
                        if (response.length > 0) {
                            $.each(response, function (index, postJob) {
                                console.log(postJob)
                                var employmentType = '';
                                switch (postJob.employment_type) {
                                    case 1:
                                        employmentType = 'Toàn thời gian';
                                        break;
                                    case 2:
                                        employmentType = 'Bán thời gian';
                                        break;
                                    case 3:
                                        employmentType = 'Thỏa thuận';
                                        break;
                                    default:
                                        employmentType = 'Không xác định';
                                }
                                var logoPath = `{{ asset('storage/logos/') }}/${postJob.employer.company.logo}`;
                                var html = `
                                <div class="col-md-4">
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <h5 class="card-title">${postJob.job_title}</h5>
                                            <div class="d-flex">
                                            <div class="col-4">
                                                <img src="${logoPath}" alt="Logo"
                                                     class="img-fluid"
                                                     style="width: 150px; height: auto; border-radius: 10%; background: #fff; padding: 5px;">
                                                <h4 class="text-white mt-2">Công ty :${postJob.employer.company.company_name}</h4>
                                            </div>
                                            <div class="col-8">
                                            <p class="card-text">${postJob.employer.company.company_name}</p>
                                            <p class="card-text">Mức lương: ${postJob.salary}</p>
                                            <p class="card-text">Loại hình công việc: ${employmentType}</p>
                                            <p class="card-text">Địa điểm: ${postJob.employer.company.location }}</p>
                                            <a href="/postjob/${postJob.id}" class="btn btn-primary">Chi tiết</a>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        `;
                                $('#postJobsList').append(html);
                            });
                        } else {
                            $('#postJobsList').html('<p>Không tìm thấy công việc phù hợp.</p>');
                        }
                    },
                    error: function (xhr) {
                        console.log(xhr.responseText);
                        $('#postJobsList').html('<p>Có lỗi xảy ra khi tìm kiếm công việc.</p>');
                    }
                });
            });
        });

        $(document).ready(function () {
            $('#industryDropdown').select2({
                placeholder: 'Chọn ngành nghề',
                allowClear: true
            });

            $('#locationDropdown').select2({
                placeholder: 'Chọn địa điểm',
                allowClear: true
            });
        });
    </script>

@endsection

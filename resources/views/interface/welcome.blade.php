@extends('interface.layouts.home')
<style>
    .side-bar{
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
    .body{
        background-image: url("https://img.freepik.com/free-vector/gradient-abstract-background-design_23-2149066048.jpg?w=1060&t=st=1718127249~exp=1718127849~hmac=6222f8de3bb95ccddfbabdc3ad9aae501af591eabacbd784c8d57ce2f7d00064");
        background-repeat: repeat-x;
    }
</style>
@section('content')
    <div style="width:100%">
        <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                @foreach ($postJobsWithFirstService as $index => $postJob)
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="{{ $index }}" class="{{ $index == 0 ? 'active' : '' }}" aria-current="{{ $index == 0 ? 'true' : 'false' }}" aria-label="Slide {{ $index + 1 }}"></button>
                @endforeach
            </div>
            <div class="carousel-inner">
                @foreach ($postJobsWithFirstService as $index => $postJob)
                    <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                        <div class="d-block w-100" style="background-image: url('{{ asset('bg/' . $backgroundImages[$index % count($backgroundImages)]) }}'); height: 400px; background-size: cover;">
                            <img src="{{ asset('images/' . $backgroundImages[$index % count($backgroundImages)]) }}" alt="Slide Image" class="d-block w-100" style="height: 400px; object-fit: cover;">
                            <div class="carousel-caption d-none d-md-block">
                                <h5>{{ $postJob->job_title }}</h5>
                                <div>{{$postJob->job_description}}</div>
                                <div>{{$postJob->salary}}</div>
                                <p>{{ $postJob->employer->company->company_name }}, {{ $postJob->employer->company->location }}</p>
                                <a href="{{ route('postjob.show', $postJob->id) }}" class="btn btn-primary">Ứng tuyển ngay</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
@endsection

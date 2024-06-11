@extends('interface.layouts.home')
@section('content')
    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            @foreach ($postJobsWithFirstService as $index => $postJob)
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="{{ $index }}" class="{{ $index == 0 ? 'active' : '' }}" aria-current="{{ $index == 0 ? 'true' : 'false' }}" aria-label="Slide {{ $index + 1 }}"></button>
            @endforeach
        </div>
        <div class="carousel-inner">
            @foreach ($postJobsWithFirstService as $index => $postJob)
                <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                    <div class="d-block w-100" style="background-image: url('{{ asset('images/' . $backgroundImages[$index % count($backgroundImages)]) }}'); height: 400px; background-size: cover;">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>{{ $postJob->title }}</h5>
                            {{dd($postJob->employer)}}
                            <p>{{ $postJob->employer->company->name }}, {{ $postJob->employer->company->address }}</p>
                            <a href="{{ route('postjob.show', $postJob->id) }}" class="btn btn-primary">Chi tiết</a>
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
@endsection

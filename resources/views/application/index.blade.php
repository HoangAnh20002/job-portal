@extends('interface.layouts.home')

@section('sidebar')
    @include('interface.layouts.sidebar')
@endsection

@section('content')
    @include('interface.layouts.alert')
    <style>
        .username {
            max-width: 150px;
            color: #0079c1;
            height: 2em;
            text-overflow: ellipsis;
            cursor: pointer;
            word-break: break-all;
            overflow: hidden;
            white-space: nowrap;
        }

        .username:hover {
            overflow: visible;
            white-space: normal;
            height: auto;
            background-color: #f0f0f0;
        }

        .table-responsive {
            cursor: grab;
        }

        .table-responsive:active {
            cursor: grabbing;
        }
    </style>
    <div class="container">
        <div class="row my-4">{{dd($applications)}}
            <h2 class="col-8">Danh sách ứng tuyển</h2>
            <div class="col-4">
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên Công ty</th>
                    <th>ID Nhà Tuyển Dụng</th>
                    <th>Logo</th>
                    <th>Ngành</th>
                    <th>Mô Tả</th>
                    <th>Vị Trí</th>
                    <th>URL Website</th>
                    <th>Số Điện Thoại</th>
                </tr>
                </thead>
                <tbody>
                @foreach($companies as $company)
                    <tr>
                        <td>{{ $company->id }}</td>
                        <td class="username">{{ $company->company_name }}</td>
                        <td>{{ $company->employer->id }}</td>
                        <td>
                            @if($company->logo)
                                <img src="{{ asset('storage/logos/' . $company->logo) }}" alt="Logo"
                                     style="width: 50px; height: auto;">
                            @else
                                N/A
                            @endif
                        </td>
                        <td>{{ $company->industry }}</td>
                        <td class="username">{{ $company->description }}</td>
                        <td class="username">{{ $company->location }}</td>
                        <td class="username">
                            @if($company->website)
                                <a href="{{ $company->website}}" target="_blank">{{ $company->website}}</a>
                            @else
                                N/A
                            @endif
                        </td>
                        <td>{{ $company->phone}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="mb-5 mt-5">
        {{ $companies->appends(request()->query())->setPath(route('company.index'))->links('vendor.pagination.bootstrap-5') }}
    </div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function () {
        let isMouseDown = false,
            startX,
            startScrollLeft;

        const tableResponsive = document.querySelector('.table-responsive');

        tableResponsive.addEventListener('mousedown', (event) => {
            isMouseDown = true;
            startX = event.pageX - tableResponsive.offsetLeft;
            startScrollLeft = tableResponsive.scrollLeft;
            tableResponsive.style.cursor = 'grabbing';
        });

        tableResponsive.addEventListener('mousemove', (event) => {
            if (!isMouseDown) return;
            event.preventDefault();
            const x = event.pageX - tableResponsive.offsetLeft;
            const walk = (x - startX) * 2; // Adjust the scroll speed if necessary
            tableResponsive.scrollLeft = startScrollLeft - walk;
        });

        tableResponsive.addEventListener('mouseup', () => {
            isMouseDown = false;
            tableResponsive.style.cursor = 'grab';
        });

        tableResponsive.addEventListener('mouseleave', () => {
            isMouseDown = false;
            tableResponsive.style.cursor = 'grab';
        });
    });
</script>

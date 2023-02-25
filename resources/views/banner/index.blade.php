@extends('layouts.master')

@section('content')
    <div class="pagetitle">
        <h1>Banner</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Banner</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">

            <!-- Recent Sales -->
            <div class="col-12">
                <div class="card recent-sales overflow-auto">

                    <div class="filter">
                        <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                            <li class="dropdown-header text-start">
                                <h6>Filter</h6>
                            </li>

                            <li><a class="dropdown-item" href="#">Today</a></li>
                            <li><a class="dropdown-item" href="#">This Month</a></li>
                            <li><a class="dropdown-item" href="#">This Year</a></li>
                        </ul>
                    </div>

                    <div class="card-body">

                        {{-- tampilkan pesan success jika ada --}}
                        @if (Session::get('success'))
                            <div class="alert alert-success fade show mt-2" role="alert">
                                <strong>{{ Session::get('success') }}</strong>
                            </div>
                        @endif

                        <a href="{{ route('add-banner') }}" class="btn btn-primary mt-4">Add Data</a>

                        <h5 class="card-title">Data Banner <span>|</span></h5>

                        <table class="table table-borderless datatable">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama Banner</th>
                                    <th scope="col">Gambar Banner</th>
                                    <th scope="col">Posisi</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($data as $banner)
                                    <tr>
                                        <td scope="row">#{{ $loop->index + 1 }}</td>
                                        <td>{{ $banner->nama_banner }}</td>
                                        <td>
                                            <img src="{{ asset('storage/' . $banner->gambar_banner ) }}" width="200" height="250" alt="" srcset="">
                                        </td>
                                        <td> {{ $banner->status_publish == '1' ? 'Publish' : 'Not Publish' }} </td>
                                        <td>
                                            <a class="btn btn-success btn-sm" href="{{ route('edit-banner', $banner->id ) }}">Edit</a>
                                            <a class="btn btn-danger btn-sm" href="{{ route('delete-banner', $banner->id ) }}"
                                                onclick="return confirm('Yakin hapus data?')">Hapus</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <th colspan="5" class="text-center">Data kosong</th>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                    </div>

                </div>
            </div><!-- End Recent Sales -->

        </div>
    </section>
@endsection

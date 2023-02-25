@extends('layouts.master')

@section('content')
    <div class="pagetitle">
        <h1>Pemesanan</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Pemesanan</li>
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

                        {{-- <a href="{{ route('add-hotel') }}" class="btn btn-primary mt-4">Add Data</a> --}}

                        <h5 class="card-title">Data Hotel <span>|</span></h5>

                        <table class="table table-borderless datatable">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama Hotel</th>
                                    <th scope="col">Nama Pemesanan</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Telp</th>
                                    <th scope="col">Tipe Kamar</th>
                                    <th scope="col">Metode Pembayaran</th>
                                    <th scope="col">Total Harga</th>
                                    <th scope="col">Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($data as $pemesanan)
                                    <tr>
                                        <td scope="row">#{{ $loop->index + 1 }}</td>
                                        <td>{{ $pemesanan->nama_hotel }}</td>
                                        <td>{{ $pemesanan->nama_pemesan }}</td>
                                        <td> {{ $pemesanan->email_pemesan }} </td>
                                        <td>{{ $pemesanan->telp_pemesan }}</td>
                                        <td> {{ $pemesanan->tipe_kamar }} </td>
                                        <td> {{ $pemesanan->metode_pembayaran }} </td>
                                        <td> Rp. {{ number_format($pemesanan->total_harga) }} </td>
                                        <td>
                                            <a class="btn btn-success btn-sm"
                                                href="{{ route('edit-hotel', $pemesanan->id) }}">Edit</a>
                                            <a class="btn btn-danger btn-sm"
                                                href="{{ route('delete-hotel', $pemesanan->id) }}"
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

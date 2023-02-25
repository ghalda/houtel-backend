@extends('layouts.master')

@section('content')
    <div class="pagetitle">
        <h1>User</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">User</li>
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

                        <a href="{{ route('add-user') }}" class="btn btn-primary mt-4">Add Data</a>

                        <h5 class="card-title">Data User <span>|</span></h5>

                        <table class="table table-borderless datatable">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($data as $user)
                                    <tr>
                                        <th scope="row"><a href="#">#{{ $loop->index + 1 }}</a></th>
                                        <td>{{ $user->name }}</td>
                                        <td><a href="#" class="text-primary">{{ $user->email }}</a></td>
                                        <td>
                                            {{ $user->role == 'Adm' ? 'Admin' : 'Kasir' }}
                                        </td>
                                        <td>
                                            {{-- <a class="btn btn-success btn-sm" href="{{ url('edit-user/' .$user->id ) }}">Edit</a> --}}
                                            <a class="btn btn-success btn-sm"
                                                href="{{ route('edit-user', $user->id) }}">Edit</a>

                                            {{-- tidak bisa hapus data dia sendiri --}}
                                            {{-- bandingkan id user yg login dengan id user yg di loopinhg --}}
                                            {{-- jika id user yg login itu tidak sama dengan id user yg di looping --}}
                                            {{-- maka tombol hapus tampil --}}
                                            @if (Auth::user()->id != $user->id)
                                                <a class="btn btn-danger btn-sm"
                                                    href="{{ route('delete-user', $user->id) }}"
                                                    onclick="return confirm('Yakin hapus data?')">Hapus</a>
                                            @else
                                                <i class="bi bi-info-circle-fill" title="Tidak bisa hapus data sendiri"></i>
                                            @endif

                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <th colspan="5">Data kosong</th>
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

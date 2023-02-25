@extends('layouts.master')

@section('content')
    <div class="pagetitle">
        <h1>Edit User</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">User</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <!-- Recent Sales -->
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        {{-- tampilkan pesan error jika ada --}}
                        @if (Session::get('error'))
                            <div class="alert alert-warning fade show" role="alert">
                                <strong>{{ Session::get('error') }}</strong>
                            </div>
                        @endif

                        <h5 class="card-title">General Form Elements</h5>

                        <!-- General Form Elements -->
                        <form method="POST" action="{{ route('update-user') }}">
                            @csrf
                            <input type="hidden" name="id" value="{{ $data->id }}">
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Nama</label>
                                <div class="col-sm-10">
                                    <input type="text" name="name"
                                        class="form-control @error('name') is-invalid @enderror" placeholder="Input Nama"
                                        value="{{ $data->name }}">
                                    {{-- tampilkan pesan jika ada error --}}
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" name="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        value="{{ $data->email }}" disabled>
                                    {{-- tampilkan pesan jika ada error --}}
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
                                <div class="col-sm-10">
                                    <input type="password" name="password"
                                        class="form-control @error('password') is-invalid @enderror" id="inputPassword">
                                    {{-- tampilkan pesan jika ada error --}}
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputRole" class="col-sm-2 col-form-label">Role</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="role" id="inputRole">
                                        {{-- kondisi saat yg login adalah admin dan nilai dari id pd data yg dipilih sama dengan nilai id user yg login  --}}
                                        @if (Auth::user()->role == 'Adm' && $data->id == Auth::user()->id)
                                            <option value="Adm"
                                                @if ($data->role == 'Adm') {{ 'selected' }} @endif>
                                                Admin</option>

                                        @else
                                        {{-- kondisi jika tidak sama dengan yg di atas --}}
                                            <option value="Adm"
                                                @if ($data->role == 'Adm') {{ 'selected' }} @endif>
                                                Admin</option>
                                            <option value="Ksr"
                                                @if ($data->role == 'Ksr') {{ 'selected' }} @endif>
                                                Kasir</option>
                                        @endif

                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Submit Button</label>
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary">Submit Form</button>
                                </div>
                            </div>

                        </form><!-- End General Form Elements -->

                    </div>
                </div>
            </div><!-- End Recent Sales -->

        </div>
    </section>
@endsection

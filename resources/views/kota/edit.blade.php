@extends('layouts.master')

@section('content')
    <div class="pagetitle">
        <h1>Edit Kota</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Kota</li>
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
                        <form method="POST" action="{{ route('update-kota') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $data->id }}">
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Nama Kota</label>
                                <div class="col-sm-10">
                                    <input type="text" name="nama_kota" value="{{ $data->nama_kota }}"
                                        class="form-control @error('nama_kota') is-invalid @enderror">
                                    {{-- tampilkan pesan jika ada error --}}
                                    @error('nama_kota')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="inputNumber" class="col-sm-2 col-form-label">Cover</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="file" name="cover" id="formFile">
                                    <img src="{{ asset('storage/' . $data->cover ) }}" width="150" height="150" alt="" srcset="">
                                    {{-- tampilkan pesan jika ada error --}}
                                    @error('cover')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="inputRole" class="col-sm-2 col-form-label">Status</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="status_publish" id="inputRole">
                                        <option value="1" {{ $data->status_publish == '1' ? 'selected' : '' }} >Publish</option>
                                        <option value="0" {{ $data->status_publish == '0' ? 'selected' : '' }}>Not Publish</option>
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

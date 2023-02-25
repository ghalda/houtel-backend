@extends('layouts.master')

@section('content')
    <div class="pagetitle">
        <h1>Edit Banner</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Banner</li>
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
                        <form method="POST" action="{{ route('update-banner') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $data->id }}">
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Nama Banner</label>
                                <div class="col-sm-10">
                                    <input type="text" name="nama_banner" value="{{ $data->nama_banner }}"
                                        class="form-control @error('nama_banner') is-invalid @enderror">
                                    {{-- tampilkan pesan jika ada error --}}
                                    @error('nama_banner')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="inputNumber" class="col-sm-2 col-form-label">Gambar Banner</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="file" name="gambar_banner" id="formFile">
                                    <img src="{{ asset('storage/' . $data->gambar_banner ) }}" width="150" height="150" alt="" srcset="">
                                    {{-- tampilkan pesan jika ada error --}}
                                    @error('gambar_banner')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="inputRole" class="col-sm-2 col-form-label">Posisi Banner</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="position" id="inputRole">
                                        <option value="">Select</option>
                                        <option value="Top" {{ $data->position == 'Top' ? 'selected' : '' }} >Top</option>
                                        <option value="Middle" {{ $data->position == 'Middle' ? 'selected' : '' }}>Middle</option>
                                        <option value="Bottom" {{ $data->position == 'Bottom' ? 'selected' : '' }}>Bottom</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="inputRole" class="col-sm-2 col-form-label">Status</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="status_publish" id="inputRole">
                                        <option value="">Select</option>
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

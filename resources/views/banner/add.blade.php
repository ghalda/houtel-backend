@extends('layouts.master')

@section('content')
    <div class="pagetitle">
        <h1>Add Banner</h1>
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
                        <form method="POST" action="{{ route('insert-banner') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Nama Banner</label>
                                <div class="col-sm-10">
                                    <input type="text" name="nama_banner"
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
                                    <input class="form-control @error('gambar_banner') is-invalid @enderror" type="file" name="gambar_banner" id="formFile">
                                    {{-- tampilkan pesan jika ada error --}}
                                    @error('gambar_banner')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="inputRole" class="col-sm-2 col-form-label">Posisi</label>
                                <div class="col-sm-10">
                                    <select class="form-control @error('position') is-invalid @enderror" name="position" id="position">
                                        <option value="">--Select--</option>
                                        <option {{ old('position') == "Top" ? "selected" : ""}} value="Top">Top</option>
                                        <option {{ old('position') == "Middle" ? "selected" : ""}}  value="Middle">Middle</option>
                                        <option {{ old('position') == "Bottom" ? "selected" : ""}}  value="Bottom">Bottom</option>
                                    </select>
                                    {{-- tampilkan pesan jika ada error --}}
                                    @error('position')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="inputRole" class="col-sm-2 col-form-label">Status</label>
                                <div class="col-sm-10">
                                    <select class="form-control @error('status_publish') is-invalid @enderror" name="status_publish" id="status_publish">
                                        <option value="">--Select--</option>
                                        <option {{ old('status_publish') == "1" ? "selected" : ""}} value="1">Publish</option>
                                        <option {{ old('status_publish') == "0" ? "selected" : ""}} value="0">Not Publish</option>
                                    </select>
                                    @error('status_publish')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
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

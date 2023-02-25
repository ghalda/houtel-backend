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
                        <form method="POST" action="{{ route('update-hotel') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $data->id }}">
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Nama Hotel</label>
                                <div class="col-sm-10">
                                    <input type="text" name="nama_hotel"
                                        class="form-control @error('nama_hotel') is-invalid @enderror" value="{{ $data->nama_hotel }}">
                                    {{-- tampilkan pesan jika ada error --}}
                                    @error('nama_hotel')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Kota</label>
                                <div class="col-sm-10">
                                    <select name="kota_id" class="form-control @error('kota_id') is-invalid @enderror" id="">
                                        <option value="">--Pilih--</option>
                                        @foreach ($kota as $kt)
                                            <option value="{{ $kt->id }}" @if($kt->id == $data->kota_id ) {{ 'selected' }}  @endif  >{{ $kt->nama_kota }}</option>
                                        @endforeach
                                    </select>
                                    {{-- tampilkan pesan jika ada error --}}
                                    @error('kota_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Harga</label>
                                <div class="col-sm-10">
                                    <input type="number" name="harga"
                                        class="form-control @error('harga') is-invalid @enderror" value="{{ $data->harga }}">
                                    {{-- tampilkan pesan jika ada error --}}
                                    @error('harga')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Alamat</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name="alamat" id="alamat" cols="30" rows="10">{{ $data->alamat }}</textarea>
                                    {{-- tampilkan pesan jika ada error --}}
                                    @error('alamat')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Deskripsi</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name="deskripsi" id="deskripsi" cols="30" rows="10">{{ $data->deskripsi }}</textarea>
                                    {{-- tampilkan pesan jika ada error --}}
                                    @error('deskripsi')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Rating</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="rating" value="{{ $data->rating }}">
                                    {{-- tampilkan pesan jika ada error --}}
                                    @error('rating')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="status_publish" class="col-sm-2 col-form-label">Publish?</label>
                                <div class="col-sm-10">
                                    <select name="status_publish"
                                        class="form-control @error('status_publish') is-invalid @enderror" id="status_publish">
                                        <option value="">--Pilih--</option>
                                        <option value="Y" {{ $data->status_publish == 'Y' ? 'selected' : "" }} >Ya</option>
                                        <option value="N" {{ $data->status_publish == 'N' ? 'selected' : "" }}>Tidak</option>
                                    </select>
                                    {{-- tampilkan pesan jika ada error --}}
                                    @error('status_publish')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="status_rekomendasi" class="col-sm-2 col-form-label">Rekomen?</label>
                                <div class="col-sm-10">
                                    <select name="status_rekomendasi"
                                        class="form-control @error('status_rekomendasi') is-invalid @enderror" id="status_rekomendasi">
                                        <option value="">--Pilih--</option>
                                        <option value="Y" {{ $data->status_rekomendasi == 'Y' ? 'selected' : "" }} >Ya</option>
                                        <option value="N" {{ $data->status_rekomendasi == 'N' ? 'selected' : "" }}>Tidak</option>
                                    </select>
                                    {{-- tampilkan pesan jika ada error --}}
                                    @error('status_rekomendasi')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="inputNumber" class="col-sm-2 col-form-label">Gambar</label>
                                <div class="col-sm-10">
                                    <input class="form-control @error('gambar') is-invalid @enderror" type="file" name="gambar" id="formFile">
                                    <img src="{{ asset('storage/' . $data->gambar ) }}" width="150" height="150" alt="" srcset="">
                                    {{-- tampilkan pesan jika ada error --}}
                                    @error('gambar')
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

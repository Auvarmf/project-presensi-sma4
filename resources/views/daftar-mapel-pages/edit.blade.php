@extends('layouts.main')

@section('title', $title)

@section('container')

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Ubah Data Mata Pelajaran</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('mapel.index') }}">Kelola Mapel</a></li>
                    <li class="breadcrumb-item active">Ubah Mapel</li>
                </ol>
            </nav>
        </div>

        <section class="section dashboard">
            <div class="row">

                <!-- Left side columns -->
                <div class="col-lg-12">
                    <div class="row">

                        <!-- Default Card -->
                        <div class="card">
                            <div class="card-body p-3 overflow-auto">

                                <form action="{{ route('mapel.update', $matapelajaran->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="row mb-3">
                                        <label for="kode_mapel" class="col-sm-2 col-form-label">Kode Mata Pelajaran</label>
                                        <div class="col-sm-10">
                                            <input id="kode_mapel" name="kode_mapel" type="text"
                                                class="form-control @error('kode_mapel') is-invalid @enderror"
                                                value="{{ old('kode_mapel') ?? $matapelajaran->kode_mapel}}">
                                            @error('kode_mapel')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="nama_mapel" class="col-sm-2 col-form-label">Nama Mata Pelajaran</label>
                                        <div class="col-sm-10">
                                            <input id="nama_mapel" name="nama_mapel" type="text"
                                                class="form-control @error('nama_mapel') is-invalid @enderror"
                                                value="{{ old('nama_mapel') ?? $matapelajaran->nama_mapel }}">
                                            @error('nama_mapel')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-end gap-2">
                                        <button type="submit" class="btn btn-success">Simpan</button>
                                        <a href="{{ route('mapel.index') }}">
                                            <button type="button" class="btn btn-secondary">Kembali</button>
                                        </a>
                                    </div>
                                </form>

                            </div>
                        </div><!-- End Default Card -->

                    </div>
                </div><!-- End Left side columns -->

            </div>
        </section>
    </main>

@endsection

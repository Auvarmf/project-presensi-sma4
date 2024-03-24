@extends('layouts.main')

@section('title', $title)

@section('container')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Ubah Data Akun</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('user.index') }}">Kelola Akun</a></li>
                <li class="breadcrumb-item active">Ubah Akun</li>
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

                            <form action="{{ route('user.update', $user->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row mb-3">
                                    <label for="name" class="col-sm-2 col-form-label">Nama Lengkap</label>
                                    <div class="col-sm-10">
                                        <input id="name" name="name" type="text"
                                            class="form-control @error('name') is-invalid @enderror"
                                            value="{{ old('name') ?? $user->name }}">
                                        @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="nip" class="col-sm-2 col-form-label">NIP/NISN</label>
                                    <div class="col-sm-10">
                                        <input id="nip" name="nip" type="number"
                                            class="form-control @error('nip') is-invalid @enderror"
                                            value="{{ old('nip') ?? $user->nip }}">
                                        @error('nip')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="d-flex justify-content-end gap-2">
                                    <button type="submit" class="btn btn-success">Simpan</button>
                                    <a href="{{ route('user.index') }}">
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

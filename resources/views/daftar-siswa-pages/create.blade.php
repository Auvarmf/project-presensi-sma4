@extends('layouts.main')

@section('title', $title)

@section('container')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Tambah Siswa</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('siswa.index') }}">Kelola Siswa</a></li>
                <li class="breadcrumb-item active">Tambah Siswa</li>
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

                            <form action="{{ route('siswa.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row mb-5">
                                    <label for="jenjang_kelas" class="col-sm-2 col-form-label">Jenjang Kelas</label>
                                    <div class="col-sm-10">
                                        <select id="jenjang_kelas" name="jenjang_kelas"
                                            class="form-select @error('jenjang_kelas') is-invalid @enderror"
                                            aria-label="Default select example">
                                            <option selected disabled>Pilih Jenjang Kelas</option>
                                            @foreach (App\Models\Kelas::getKelasValues() as $jenjang_kelas)
                                            <option value="{{ $jenjang_kelas }}">{{ $jenjang_kelas }}</option>
                                            @endforeach
                                        </select>
                                        @error('jenjang_kelas')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="kategori_kelas" class="col-sm-2 col-form-label">Kategori Kelas</label>
                                    <div class="col-sm-10">
                                        <input placeholder="A/B/C" id="kategori_kelas" name="kategori_kelas" type="text"
                                            class="form-control @error('kategori_kelas') is-invalid @enderror"
                                            value="{{ old('kategori_kelas') }}">
                                        @error('kategori_kelas')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-5">
                                    <label for="nisn" class="col-sm-2 col-form-label">Siswa</label>
                                    <div class="col-sm-10">
                                        <select id="nisn" name="nisn"
                                            class="form-select @error('nisn') is-invalid @enderror"
                                            aria-label="Default select example">
                                            <option selected disabled>Pilih Siswa</option>
                                            @foreach ($siswas as $siswas)
                                            <option value="{{ $siswas->nip }}">{{ $siswas->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('nisn')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="d-flex justify-content-end gap-2">
                                    <button type="submit" class="btn btn-success">Simpan</button>
                                    <a href="{{ route('siswa.index') }}">
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

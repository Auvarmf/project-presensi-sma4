@extends('layouts.main')

@section('title', $title)

@section('container')

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Ubah Data Jadwal</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('jadwal.index') }}">Kelola Jadwal</a></li>
                    <li class="breadcrumb-item active">Ubah Jadwal</li>
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

                                <form action="{{ route('jadwal.update', $jadwal->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="row mb-5">
                                        <label for="id_mapel" class="col-sm-2 col-form-label">Mata Pelajaran</label>
                                        <div class="col-sm-10">
                                            <select id="id_mapel" name="id_mapel" class="form-select @error('id_mapel') is-invalid @enderror" aria-label="Default select example">
                                                <option selected disabled>Pilih Mata Pelajaran</option>
                                                @foreach ($data_mapel as $mapel)
                                                    <option value="{{ $mapel->id }}" {{ $jadwal->id_mapel == $mapel->id ? 'selected' : '' }}>{{ $mapel->nama_mapel }}</option>
                                                @endforeach
                                            </select>
                                            @error('id_mapel')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-5">
                                        <label for="id_guru" class="col-sm-2 col-form-label">Guru Pengajar</label>
                                        <div class="col-sm-10">
                                            <select id="id_guru" name="id_guru" class="form-select @error('id_guru') is-invalid @enderror" aria-label="Default select example">
                                                <option selected disabled>Pilih Guru</option>
                                                @foreach ($guru_pengajar as $guru)
                                                    <option value="{{ $guru->id }}" {{ $jadwal->id_guru == $guru->id ? 'selected' : '' }}>{{ $guru->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('id_guru')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-5">
                                        <label for="id_kelas" class="col-sm-2 col-form-label">Kelas</label>
                                        <div class="col-sm-10">
                                            <select id="id_kelas" name="id_kelas" class="form-select @error('id_kelas') is-invalid @enderror" aria-label="Default select example">
                                                <option selected disabled>Pilih Kelas</option>
                                                @foreach ($data_kelas as $kelas)
                                                    <option value="{{ $kelas->id }}" {{ $jadwal->id_kelas == $kelas->id ? 'selected' : '' }}>{{ $kelas->jenjang_kelas }} {{ $kelas->kategori_kelas }}</option>
                                                @endforeach
                                            </select>
                                            @error('id_kelas')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-5">
                                        <label for="hari" class="col-sm-2 col-form-label">Hari</label>
                                        <div class="col-sm-10">
                                            <select id="hari" name="hari" class="form-select @error('hari') is-invalid @enderror" aria-label="Default select example">
                                                <option selected disabled>Pilih Hari</option>
                                                @foreach (App\Models\Jadwal::getHariValues() as $hari)
                                                    <option value="{{ $hari }}" {{ $jadwal->hari == $hari ? 'selected' : '' }}>{{ $hari }}</option>
                                                @endforeach
                                            </select>
                                            @error('hari')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="waktu_mulai" class="col-sm-2 col-form-label">Waktu Mulai</label>
                                        <div class="col-sm-10">
                                            <input id="waktu_mulai" name="waktu_mulai" type="time" class="form-control @error('waktu_mulai') is-invalid @enderror" value="{{ $jadwal->waktu_mulai }}">
                                            @error('waktu_mulai')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="waktu_selesai" class="col-sm-2 col-form-label">Waktu Selesai</label>
                                        <div class="col-sm-10">
                                            <input id="waktu_selesai" name="waktu_selesai" type="time" class="form-control @error('waktu_selesai') is-invalid @enderror" value="{{ $jadwal->waktu_selesai }}">
                                            @error('waktu_selesai')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-end gap-2">
                                        <button type="submit" class="btn btn-success">Simpan</button>
                                        <a href="{{ route('jadwal.index') }}">
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

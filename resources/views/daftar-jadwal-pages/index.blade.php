@extends('layouts.main')

@section('title', $title)

@section('container')

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Kelola Jadwal</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Kelola Jadwal</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">

                <!-- Left side columns -->
                <div class="col-lg-12">
                    <div class="row">

                        <!-- Default Card -->
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"><span class="d-none d-lg-block">Dibuat oleh <a href="#">Tim
                                            Kerja Praktik</a></span>
                                    <hr>
                                </h5>
                                <div class="mb-3">
                                    @if (session('success'))
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            <i class="bi bi-check-circle me-1"></i>
                                            {{ session('success') }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                        </div>
                                    @endif
                                </div>
                                <h1>
                                    Daftar Jadwal
                                </h1>
                                <div class="position-relative">
                                    <a href="{{ route('jadwal.create') }}">
                                        <button type="button" class="btn btn-primary mt-2">Tambah</button>
                                    </a>
                                </div>

                                <!-- Table with stripped rows -->
                                <div class="table-responsive">
                                    <table class="table table-responsive datatable">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Mata Pelajaran</th>
                                                <th>Guru Pengajar</th>
                                                <th>Kelas</th>
                                                <th>Hari</th>
                                                <th>Waktu</th>
                                                <th colspan="2">Tindakan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $i = 1;
                                            @endphp
                                            @forelse ($data_jadwal as $jadwal)
                                                <tr>
                                                    <td>{{ $i++ }}</td>
                                                    <td>{{ $jadwal->mataPelajaran->nama_mapel }}</td>
                                                    <td>{{ $jadwal->guru->name }}</td>
                                                    <td>{{ $jadwal->kelas->jenjang_kelas }}
                                                        {{ $jadwal->kelas->kategori_kelas }} </td>
                                                    <td>{{ $jadwal->hari }}</td>
                                                    <td>
                                                        {{ \Carbon\Carbon::parse($jadwal->waktu_mulai)->format('H:i') }} -
                                                        {{ \Carbon\Carbon::parse($jadwal->waktu_selesai)->format('H:i') }}
                                                    </td>
                                                    <td>
                                                        <form action="{{ route('jadwal.destroy', $jadwal->id) }}"
                                                            method="post">
                                                            <a href="{{ route('jadwal.edit', $jadwal->id) }}">
                                                                <button type="button" class="btn btn-warning btn-sm"><i
                                                                        class="bi bi-pencil-fill"></i></button>
                                                            </a>
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm"
                                                                onclick="return confirm('Yakin ingin menghapus jadwal {{ $jadwal->mataPelajaran->nama_mapel }} {{ $jadwal->kelas->jenjang_kelas }} {{ $jadwal->kelas->kategori_kelas }}?')"><i
                                                                    class="bi bi-trash-fill"></i></button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="7" class="text-center">Tidak Ada Data</td>
                                                </tr>
                                            @endforelse

                                        </tbody>
                                    </table>
                                </div>
                                <!-- End Table with stripped rows -->

                            </div>
                        </div><!-- End Default Card -->

                    </div>
                </div><!-- End Left side columns -->

            </div>
        </section>

    </main><!-- End #main -->

@endsection

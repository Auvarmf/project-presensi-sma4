@extends('layouts.main')

@section('title', $title)

@section('container')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Scan QR</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active">Qr Scan</li>
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
                            <h5 class="card-title"><span class="d-none d-lg-block"></span>
                                <hr>
                            </h5>
                            <h1>
                                Jadwal Pelajaran
                            </h1>

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
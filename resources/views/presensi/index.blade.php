@extends('layouts.main')

@section('title', $title)

@section('container')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Jadwal</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active">Jadwal</li>
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
                            <h5 class="card-title"><span class="d-none d-lg-block">Dibuat oleh <a href="#">Tim Kerja Praktik</a></span>
                                <hr>
                            </h5>


                            <!-- Table with stripped rows -->
                            <div class="table-responsive">
                                <table class="table table-responsive datatable">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Kode MP</th>
                                            <th>Mata Pelajaran</th>
                                            <th>Jadwal</th>
                                            <th>Tindakan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($jadwals as $jadwal)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $jadwal->kode_mp }}</td>
                                            <td>{{ $jadwal->mata_pelajaran }}</td>
                                            <td>{{ $jadwal->hari }}, {{ $jadwal->jam_mulai->format('H:i') }} s/d {{ $jadwal->jam_selesai->format('H:i') }}</td>
                                            <td>
                                                <a href="{{ route('presensi-siswa.index', ['kode_mp' => $jadwal->kode_mp]) }}" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="right" title="Presensi QR">
                                                    <i class="bi bi-upc-scan"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach

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

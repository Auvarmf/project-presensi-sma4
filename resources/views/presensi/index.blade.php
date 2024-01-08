@extends('layouts.main')

@section('title', $title)

@section('container')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Scan Face</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active">Scanface</li>
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
                            <h1>
                                Presensi Siswa
                            </h1>

                            <!-- Table with stripped rows -->
                            <div class="table-responsive">
                                <table class="table table-responsive">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>NISN</th>
                                            <th>Nama</th>
                                            <th>Kelas</th>
                                            <th>Kehadiran</th>
                                            <th colspan="2">Tindakan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($siswaData as $key => $siswa)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $siswa->nisn }}</td>
                                            <td>{{ $siswa->nama }}</td>
                                            <td>{{ $siswa->kelas }}</td>
                                            <td><!-- Status kehadiran Start -->
                                                @if ($siswa->kehadiran && $siswa->kehadiran->keterangan_hadir == 'Hadir')
                                                <h7 class="card-title">
                                                    <button type="button" class="btn btn-success btn-sm">{{ $siswa->kehadiran->keterangan_hadir }}</button>
                                                </h7>
                                                @else
                                                <h7 class="card-title">
                                                    <button type="button" class="btn btn-danger btn-sm">{{ $siswa->kehadiran ? $siswa->kehadiran->keterangan_hadir : 'Belum ada data' }}</button>
                                                </h7>
                                                @endif
                                                <!-- Status kehadiran End -->
                                            </td>
                                            <td>
                                                <!-- Button Edit -->
                                                <!-- <a href="edit-kos.php?update={{ $siswa->id }}">
                                                        <button type="button" class="btn btn-light" value="Edit"><i class="bi bi-pencil-square"></i></button>
                                                    </a> -->
                                            </td>
                                        </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                            <!-- End Table with stripped rows -->

                            <!-- Modal -->
                            <div class="modal fade" id="verticalycentered" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Presensi Berhasil</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- Output hasil presensi -->

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- End Vertically centered Modal-->

                        </div>
                    </div><!-- End Default Card -->

                </div>
            </div><!-- End Left side columns -->

        </div>
    </section>

</main><!-- End #main -->

@endsection
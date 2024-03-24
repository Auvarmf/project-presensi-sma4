@extends('layouts.main')

@section('title', $title)

<style>
#preview {
    z-index: 1;
    width: 100%;
    height: auto;
    display: block;
    margin: 0 auto;
}

.card {
    display: grid;
    grid-template-columns: 100%;
    grid-template-rows: auto;
    /* Change to 'auto' for responsiveness */
    background: white;
    min-height: 300px;
    /* Set a minimum height for the card */
}

.card .wrapper {
    background-image: url('https://i.hizliresim.com/p6gcx5c.png');
    background-repeat: no-repeat;
    background-size: cover;
    border-radius: 10px;
    min-height: 300px;
    /* Set a minimum height for the wrapper */
}

.wrapper .scanner {
    animation-play-state: running;
    z-index: 2;
}

.scanner {
    width: 100%;
    height: 3px;
    background-color: red;
    opacity: 0.7;
    position: relative;
    box-shadow: 0px 0px 8px 10px rgba(170, 11, 23, 0.49);
    top: 50%;
    animation-name: scan;
    animation-duration: 4s;
    animation-timing-function: linear;
    animation-iteration-count: infinite;
    animation-play-state: paused;
}

@keyframes scan {
    0% {
        box-shadow: 0px 0px 8px 10px rgba(170, 11, 23, 0.49);
        top: 50%;
    }

    25% {
        box-shadow: 0px 6px 8px 10px rgba(170, 11, 23, 0.49);
        top: 5px;
    }

    75% {
        box-shadow: 0px -6px 8px 10px rgba(170, 11, 23, 0.49);
        top: 98%;
    }
}

@media (max-width: 767px) {
    .card {
        min-height: 150px;
        /* Adjust minimum height for smaller screens */
    }

    .card .wrapper {
        min-height: 150px;
        /* Adjust minimum height for smaller screens */
    }
}
</style>

@section('container')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Scan QR</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active">Scanqr</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <secti class="section dashboard">
        <div class="row">

            <!-- Left side columns -->
            <div class="col-lg-12">
                <div class="row">

                    <!-- Default Card -->
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><span class="d-none d-lg-block">Dibuat oleh <a href="#">Tim Kerja
                                        Praktik</a></span>
                                <hr>
                            </h5>
                            <h2>
                                Presensi Siswa Mapel: <em>{{ $jadwal->mataPelajaran->nama_mapel }}</em> Kelas
                                {{ $jadwal->kelas->kategori_kelas }}
                            </h2>

                            <div class="container col-lg-7 py-1">
                                <!-- scanner -->
                                <div class="card bg-white shadow rounded-3 p-3 border-0">
                                    <!-- pesan -->
                                    @if (session()->has('gagal'))
                                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                        <i class="bi bi-exclamation-triangle me-1"></i>
                                        <strong>{{ session()->get('gagal') }}</strong>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                    @endif

                                    @if (session()->has('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <i class="bi bi-check-circle me-1"></i>
                                        <strong>{{ session()->get('success') }}</strong>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                    @endif

                                    <div class="wrapper">
                                        <div class="scanner"></div>
                                        <video id="preview"></video>
                                    </div>

                                    <!-- form -->
                                    <form action="{{ route('store') }}" method="post" id="form">
                                        @csrf
                                        <input type="hidden" name="nisn" id="nisn">
                                        <input type="hidden" name="id" value="{{ $id }}">
                                    </form>
                                </div>
                                <!-- scanner -->


                            </div>

                            <!-- Scrolling Modal -->
                            <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                data-bs-target="#scrollingModal"><i class="bi bi-people-fill"></i>
                                Daftar Hadir
                            </button>
                            <a href="{{ route('export-kehadiran', ['id' => $id]) }}" class="btn btn-success"><i
                                    class="ri-file-excel-2-line"></i>
                                Export to Excel
                            </a>
                            <div class="modal fade" id="scrollingModal" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Daftar Hadir Siswa Kelas
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body" style="min-height: auto;">
                                            <div class="table-responsive mt-5">
                                                <form action="{{ route('presensi-siswa.update', ['id' => $id]) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <table class="table table-bordered table-hover">
                                                        <tr>
                                                            <th>NISN</th>
                                                            <th>Nama</th>
                                                            <th>Kehadiran</th>
                                                        </tr>
                                                        @foreach($siswas as $siswa)
                                                        <tr>
                                                            <td>{{ $siswa->nisn}}</td>
                                                            <td>{{ $siswa->siswa->name }}</td>
                                                            <td>
                                                                @php
                                                                $currentDate = now()->format('Y-m-d');
                                                                $todaysAttendance = $siswa->kehadirans
                                                                ->where('tanggal', $currentDate)
                                                                ->where('id_mapel', $id)
                                                                ->first();
                                                                $attendanceOptions = ['Hadir', 'Sakit', 'Izin', 'Alpa'];
                                                                @endphp

                                                                @if($todaysAttendance)
                                                                <select name="kehadiran[{{ $siswa->nisn }}]"
                                                                    class="form-select">
                                                                    @foreach($attendanceOptions as $option)
                                                                    <option value="{{ $option }}"
                                                                        {{ $todaysAttendance->kehadiran === $option ? 'selected' : '' }}>
                                                                        {{ $option }}
                                                                    </option>
                                                                    @endforeach
                                                                </select>
                                                                <input type="hidden"
                                                                    name="original_kehadiran[{{ $siswa->nisn }}]"
                                                                    value="{{ $todaysAttendance->kehadiran }}">
                                                                @else
                                                                <select name="kehadiran[{{ $siswa->nisn }}]"
                                                                    class="form-select">
                                                                    <option value="" selected hidden></option>
                                                                    @foreach($attendanceOptions as $option)
                                                                    <option value="{{ $option }}">{{ $option }}</option>
                                                                    @endforeach
                                                                </select>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    </table>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div><!-- End Scrolling Modal-->

                            <script type="text/javascript">
                            document.addEventListener('DOMContentLoaded', function() {
                                let scanner;

                                // Initialize scanner
                                scanner = new Instascan.Scanner({
                                    video: document.getElementById('preview')
                                });

                                // Add scan event listener
                                scanner.addListener('scan', function(content) {
                                    console.log(content);
                                    document.getElementById('nisn').value = content;
                                    document.getElementById('form').submit();
                                });

                                // Get cameras and start scanner
                                Instascan.Camera.getCameras().then(function(cameras) {
                                    if (cameras.length > 0) {
                                        scanner.start(cameras[0]);
                                    } else {
                                        console.error('No cameras found.');
                                    }
                                }).catch(function(e) {
                                    console.error(e);
                                });

                            });
                            </script>

                        </div>
                    </div><!-- End Default Card -->

                </div>
            </div><!-- End Left side columns -->

        </div>
    </secti on>

</main>

<!--
 End #main -->


@endsection
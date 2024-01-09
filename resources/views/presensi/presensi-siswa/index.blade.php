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

                            <div class="container col-lg-7 py-1">
                                <!-- scanner -->
                                <div class="card bg-white shadow rounded-3 p-3 border-0">
                                    <!-- pesan -->
                                    @if (session()->has('gagal'))
                                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                        <strong>{{ session()->get('gagal') }}</strong>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                    @endif

                                    @if (session()->has('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <strong>{{ session()->get('success') }}</strong>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
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
                                    </form>
                                </div>
                                <!-- scanner -->


                            </div>

                            <!-- Scrolling Modal -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#scrollingModal">
                                Daftar Hadir
                            </button>
                            <div class="modal fade" id="scrollingModal" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Daftar Hadir Siswa</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body" style="min-height: auto;">
                                            <div class="table-responsive mt-5">
                                                <table class="table table-bordered table-hover">
                                                    <tr>
                                                        <th>Nama</th>
                                                        <th>Tanggal</th>
                                                    </tr>
                                                    @foreach ($kehadiran as $item)
                                                    <tr>
                                                        <td>{{ $item->siswa->nama }}</td>
                                                        <td>{{ $item->tanggal }}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- End Scrolling Modal-->

                            <script type="text/javascript">
                                document.addEventListener('DOMContentLoaded', function() {
                                    let scanner = new Instascan.Scanner({
                                        video: document.getElementById('preview')
                                    });
                                    scanner.addListener('scan', function(content) {
                                        console.log(content);
                                    });
                                    Instascan.Camera.getCameras().then(function(cameras) {
                                        if (cameras.length > 0) {
                                            scanner.start(cameras[0]);
                                        } else {
                                            console.error('No cameras found.');
                                        }
                                    }).catch(function(e) {
                                        console.error(e);
                                    });

                                    scanner.addListener('scan', function(c) {
                                        document.getElementById('nisn').value = c;
                                        document.getElementById('form').submit();
                                    });
                                });
                            </script>

                        </div>
                    </div><!-- End Default Card -->

                </div>
            </div><!-- End Left side columns -->

        </div>
    </section>

</main><!-- End #main -->

@endsection